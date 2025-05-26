<?php
require_once("config.php");

function connectDB(){
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>