<?php
session_start();
require_once 'connect.php';

$article = null;

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT title, about, image, content FROM news WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($title, $about, $image, $content);
            $stmt->fetch();
            $article = [
                'title' => $title,
                'about' => $about,
                'image' => $image,
                'content' => $content
            ];
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Članak</title>
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

<main>
    <?php if ($article): ?>
        <div class="headline">
            <h1><?= htmlspecialchars($article['title']) ?></h1>
            <p class="subtitle"><?= htmlspecialchars($article['about']) ?></p>
        </div>

        <div class="image">
            <img src="slike/<?= htmlspecialchars($article['image']) ?>" alt="Article image">
        </div>

        <div class="article">
            <?php
            $paragraphs = explode("\n", $article['content']);
            foreach ($paragraphs as $para):
                $trimmed = trim($para);
                if (!empty($trimmed)):
            ?>
                <p><?= htmlspecialchars($trimmed) ?></p>
            <?php endif; endforeach; ?>
        </div>
    <?php else: ?>
        <p>Article not found.</p>
    <?php endif; ?>
</main>

<footer class="footer-clanak">
    <div>
        <p>franceinfo<span>:</span></p>
    </div>
</footer>

</body>
</html>
