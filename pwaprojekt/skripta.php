<?php
require_once 'connect.php';
session_start();

$statusMsg = ''; 
$targetDir = "slike/"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_FILES["pphoto"]["name"])) {
        $fileName = basename($_FILES["pphoto"]["name"]);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowTypes)) {
            $image = uniqid('img_', true) . '.' . $fileType;
            $targetFilePath = $targetDir . $image;

            if (move_uploaded_file($_FILES["pphoto"]["tmp_name"], $targetFilePath)) {
                $title = $_POST['title'] ?? '';
                $about = $_POST['about'] ?? '';
                $content = $_POST['content'] ?? '';
                $category = $_POST['category'] ?? '';
                $archive = isset($_POST['archive']) ? 1 : 0;

                $stmt = $conn->prepare("INSERT INTO news (title, about, content, image, category, archive, date) 
                                        VALUES (?, ?, ?, ?, ?, ?, DATE(NOW()))");
                if ($stmt) {
                    $stmt->bind_param("sssssi", $title, $about, $content, $image, $category, $archive);

                    if ($stmt->execute()) {
                        $statusMsg = "Vijest i datoteka su uspješno prenesene.";
                    } else {
                        $statusMsg = "Greška u bazi: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    $statusMsg = "Greška u prepared statement: " . $conn->error;
                }
            } else {
                $statusMsg = "Greška u uploadnju datoteke.";
            }
        } else {
            $statusMsg = 'Samo JPG, JPEG, PNG & GIF datoteke su dozvoljene.';
        }
    } else {
        $statusMsg = 'Molim vas izaberite datoteku za uploadanje.';
    }
}

echo $statusMsg;
$conn->close();
?>
