<?php
$SN = "localhost";
$UN = "root";
$PW = "";
$DB = "latresponsi";

$conn = new mysqli($SN, $UN, $PW, $DB);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>