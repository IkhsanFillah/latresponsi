<?php 
session_start();
include 'db.php';
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

$email = $_SESSION['email'];
$sql_id = "select id from users where email='$email'";
$result_id = $conn->query($sql_id);
$row = $result_id->fetch_assoc();
$user_id = $row['id'];

$book_id = $_GET['id'];

$sql = "delete from books where id='$book_id' and user_id='$user_id'";
$result = $conn->query($sql);

if($result === true){
    header("location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>