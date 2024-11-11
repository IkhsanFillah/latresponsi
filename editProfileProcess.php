<?php 
session_start();
include 'db.php';

$email = $_SESSION["email"];
$name = $_POST["name"];
$password = $_POST["password"];

$sql = "update users set name='$name', password='$password' where email='$email'";
$result = $conn->query($sql);

if($result === true){
    header("location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>