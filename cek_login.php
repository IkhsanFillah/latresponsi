<?php 
session_start();
include 'db.php';

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "select * from users where email='$email' and password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION["email"] = $email;
    $_SESSION["status"] = "login";
    header("location: index.php");
}else {
    header("location: login.php?pesan=gagal");
}

$conn->close();
?>