<?php 
session_start();
include 'db.php';

if (!isset($_SESSION["email"])) {
    header("location: login.php");
    exit();
}

$email = $_SESSION["email"];

$sql = "select id from users where email='$email'";
$result_id = $conn->query($sql);
$row = $result_id->fetch_assoc();
$user_id = $row["id"];

$title = $_POST["title"];
$author = $_POST["author"];
$year = $_POST["year"];
$genre = $_POST["genre"];

// Sebutkan kolom secara eksplisit dalam query SQL
$sql = "INSERT INTO books (user_id, title, author, year, genre) VALUES ('$user_id','$title', '$author', '$year', '$genre')";
$result = $conn->query($sql);

if ($result === true){
    header("location: index.php");
} else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>