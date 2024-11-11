<?php 
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$id = $_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];
$year = $_POST['year'];
$genre = $_POST['genre'];

// Debugging: Periksa nilai variabel
echo "ID: $id, Title: $title, Author: $author, Year: $year, Genre: $genre<br>";

$sql = "UPDATE books SET title='$title', author='$author', year='$year', genre='$genre' WHERE id='$id'";

// Debugging: Periksa query SQL
echo "SQL: $sql<br>";

$result = $conn->query($sql);

if ($result === true) {
    $_SESSION['message'] = "Buku berhasil diperbarui!";
    $_SESSION['message_type'] = "success";
    header("location: index.php");
    exit();
} else {
    $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
    $_SESSION['message_type'] = "danger";
    header("location: index.php");
    exit();
}

$conn->close();
?>