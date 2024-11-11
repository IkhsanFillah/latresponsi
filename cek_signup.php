<?php 
include 'db.php';

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "insert into users (name, email, password) values ('$name', '$email', '$password')";
$result = $conn->query($sql);
if ($result === true) {
    header("location: login.php");
}else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>