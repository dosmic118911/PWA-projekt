<?php
require_once 'connect.php';
define('UPLPATH', 'slike/');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $id = (int)$_POST['id'];
        $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $about = $_POST['about'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $archive = isset($_POST['archive']) ? 1 : 0;
        $id = (int)$_POST['id'];

        if (!empty($_FILES['pphoto']['name'])) {
            $originalImageName = basename($_FILES["pphoto"]["name"]);
            $imageExtension = pathinfo($originalImageName, PATHINFO_EXTENSION);
            $image = uniqid('img_', true) . '.' . $imageExtension;
            $target = UPLPATH . $image;
            move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target);

            $stmt = $conn->prepare("UPDATE news SET title=?, about=?, content=?, image=?, category=?, archive=?, date=DATE(NOW()) WHERE id=?");
            $stmt->bind_param("ssssssi", $title, $about, $content, $image, $category, $archive, $id);
        } else {
            $stmt = $conn->prepare("UPDATE news SET title=?, about=?, content=?, category=?, archive=?, date=DATE(NOW()) WHERE id=?");
            $stmt->bind_param("ssssii", $title, $about, $content, $category, $archive, $id);
        }

        $stmt->execute();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Administracija</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <div><h1>franceinfo<span>:</span></h1></div>
</header>
<nav>
    <div>
        <ul>
            <li><a href="indeks.php">home</a></li>
            <li><a href="elections.php">elections</a></li>
            <li><a href="lesjt.php">les jt</a></li>
            <li><a href="administrator.php">administracija</a></li>
            <li><a href="unos.html">unos</a></li>
        </ul>
    </div>
</nav>
<section class="section-admin">
    <?php
    $result = $conn->query("SELECT * FROM news ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
        echo '<form enctype="multipart/form-data" action="" method="POST">
              <div class="form-item-admin">
                <label>Naslov vijesti:</label>
                <textarea name="title" cols="40" rows="6" class="form-field-textual">'.htmlspecialchars($row['title']).'</textarea>
              </div>

              <div class="form-item-admin">
                <label>Kratki sadrzaj vijesti:</label>
                <textarea name="about" cols="40" rows="10" class="form-field-textual">'.htmlspecialchars($row['about']).'</textarea>
              </div>

              <div class="form-item-admin">
                <label>Sadrzaj vijesti:</label>
                <textarea name="content" cols="40" rows="20" class="form-field-textual">'.htmlspecialchars($row['content']).'</textarea>
              </div>

              <div class="form-item-admin">
                <label>Slika:</label>
                <input type="file" name="pphoto"><br><img src="'.UPLPATH.htmlspecialchars($row['image']).'" width="100px">
              </div>

              <div class="form-item-admin">
                <label>Kategorija vijesti:</label>
                <select name="category" class="form-field-textual">
                    <option value="elections"'.($row['category'] == 'elections' ? ' selected' : '').'>Elections</option>
                    <option value="lesjt"'.($row['category'] == 'lesjt' ? ' selected' : '').'>Les jt</option>
                </select>
              </div>

              <div class="form-item-admin">
                <label>Spremiti u arhivu?</label>
                <input type="checkbox" name="archive"'.($row['archive'] ? ' checked' : '').'>
              </div>

              <div class="form-item-admin">
                <input type="hidden" name="id" value="'.(int)$row['id'].'">
                <button type="reset">Poništi</button>
                <button type="submit" name="update">Izmjeni</button>
                <button type="submit" name="delete">Izbriši</button>
              </div>
              </form>';
    }
    ?>
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
<?php
$conn->close();
?>
