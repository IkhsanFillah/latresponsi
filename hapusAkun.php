<?php 
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$email = $_SESSION['email'];


$sql_id = "SELECT id FROM users WHERE email='$email'";
$result_id = $conn->query($sql_id);
$row = $result_id->fetch_assoc();
$user_id = $row['id'];


$sql_delete_books = "DELETE FROM books WHERE user_id='$user_id'";
$conn->query($sql_delete_books);


$sql_delete_user = "DELETE FROM users WHERE id='$user_id'";
$result = $conn->query($sql_delete_user);

if ($result === true) {
    session_destroy();
    header("location: login.php?pesan=akun_terhapus");
} else {
    $_SESSION['message'] = "Error: " . $sql_delete_user . "<br>" . $conn->error;
    $_SESSION['message_type'] = "danger";
    header("location: index.php");
}

$conn->close();
?>