<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT korisnickoIme, password, admin FROM korisnik WHERE korisnickoIme = ?";
    $stmt = mysqli_stmt_init($conn);
    
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
            mysqli_stmt_fetch($stmt);
            
            if (password_verify($lozinka, $lozinkaKorisnika)) {
                $_SESSION['username'] = $imeKorisnika;
                $_SESSION['level'] = $levelKorisnika;

                if ($levelKorisnika == 1) {
                    header("Location: administrator.php");
                    exit;
                } else {
                    header("Location: loginAlready.php");
                    exit;
                }
            } else {
                echo "<p>Pogrešna lozinka. <a href='registracija.php'>Registriraj se</a></p>";
            }
        } else {
            echo "<p>Korisnik ne postoji. <a href='registracija.php'>Registriraj se</a></p>";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>

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
        <h2>Molim vas, ulogirajte se</h2>
        <form action="login.php" method="post">
            <label for="username">Korisničko ime:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="lozinka">Lozinka:</label><br>
            <input type="password" id="lozinka" name="lozinka" required><br><br>

            <input type="submit" value="Prijavi se">
        </form>
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
