<?php
    session_start();
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Elections</title>

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

    <section>
        <h2>Élections Européennes 2019</h2>

        <div>
        <?php       
        require_once 'connect.php';

        $sql = "SELECT id, image, title, category FROM news ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $image = htmlspecialchars($row['image']);
                $title = htmlspecialchars($row['title']);
                $category = htmlspecialchars($row['category']);
                $id = $row['id'];

                if ($category === 'elections') {
                    echo "<article>
                        <a href ='clanak.php?id=$id'>
                            <img src='slike/$image' alt='Image'>
                            <h3>$title</h3>
                        </a>
                    </article>";
                }
            }
        }
        ?>
        </div>
    </section>

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