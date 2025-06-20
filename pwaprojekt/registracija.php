<?php
session_start();
include 'connect.php';

$registriranKorisnik = false;
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['korisnickoIme'];
    $lozinka1 = $_POST['password'];
    $lozinka2 = $_POST['passwordRep'];

    if ($lozinka1 !== $lozinka2) {
        $msg = "Lozinke se ne podudaraju!";
    } else {        
        $sql = "SELECT korisnickoIme FROM korisnik WHERE korisnickoIme = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $msg = "Korisničko ime već postoji!";
            } else {               
                $hashed_password = password_hash($lozinka1, CRYPT_BLOWFISH);
                $admin = 0;

                $sql = "INSERT INTO korisnik (ime, prezime, korisnickoIme, password, admin) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $admin);
                    mysqli_stmt_execute($stmt);
                    $registriranKorisnik = true;
                }
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>

    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <header>
        <div>
            <h1>franceinfo<span>:</span></h1>
        </div>
    </header>

    <nav>
        <div>
            <ul>
                <li><a href="indeks.php">home</a></li>
                <li><a href="elections.php">elections</a></li>
                <li><a href="lesjt.php">les jt</a></li>
                <?php
                    if (!isset($_SESSION['username'])) {
                        $link = 'login.php';
                    } else if (isset($_SESSION['level']) && $_SESSION['level'] == 1) {
                        $link = 'administrator.php';
                    } else {
                        $link = 'loginAlready.php';
                    }
                ?>
                <li><a href="<?php echo $link; ?>">administracija</a></li>             
            </ul>
        </div>
    </nav>

    
    <div class="div-custom">
    <h2>Registracija korisnika</h2>

    <?php if ($registriranKorisnik): ?>
        <p>Korisnik je uspješno registriran! <a href="login.php">Prijavi se</a></p>
    <?php else: ?>
        <p style="color:red;"><?php echo $msg; ?></p>
        <form method="POST" action="registracija.php">
            <label for="ime">Ime:</label><br>
            <input type="text" name="ime" id="ime" required><br>

            <label for="prezime">Prezime:</label><br>
            <input type="text" name="prezime" id="prezime" required><br>

            <label for="korisnickoIme">Korisničko ime:</label><br>
            <input type="text" name="korisnickoIme" id="korisnickoIme" required><br>

            <label for="password">Lozinka:</label><br>
            <input type="password" name="password" id="password" required><br>

            <label for="passwordRep">Ponovite lozinku:</label><br>
            <input type="password" name="passwordRep" id="passwordRep" required><br><br>

            <input type="submit" value="Registriraj se">
        </form>
    <?php endif; ?>
    </div>
    

    <footer>
        <div class="footer-container">
            <ul class="footer-left">
                <li>Denis Osmić</li>
                <li>dosmic@tvz.hr</li>
                <li>2025.</li>
            </ul>

            <div class="footer-right">
                <p>france.tv</p>
            </div>
        </div>
    </footer>

</body>
</html>
