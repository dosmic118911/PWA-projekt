<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nedovoljna prava</title>

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
    <h2>Bok, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Uspješno ste prijavljeni, ali nemate administratorska prava za pristup ovoj stranici.</p>
    <a class="button-custom" href="login.php">Prijava na drugi račun</a>
    <a class="button-custom" href="indeks.php">Natrag na početnu</a>
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
