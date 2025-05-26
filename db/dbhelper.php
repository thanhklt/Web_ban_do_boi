<?php
require_once("db_connect.php");

//insert, update, delete
function execute($sql){
    // Open conn
    $conn = connectDB();
    mysqli_set_charset("utf-8");

    // Query
    mysqli_query($conn, $query);

    // Closed conn
    mysqli_close($conn);
}

// Select lay du lieu ra
function executeResult($sql, $isSingle = false){
    $data = null;

    // Open conn
    $conn = connectDB();
    mysqli_set_charset($conn, "utf8");
    
    // Query
    $resultSet = mysqli_query($conn, $sql); #resultset dang cho de du lieu truy van -> phai dua no vao php obj
    if ($isSingle){
        $data = mysqli_fetch_array($resultSet, 1);
    }
    else{
        $data = [];
        while ($row = mysqli_fetch_array($resultSet, MYSQLI_NUM)){
            $data[] = $row;
        }
    }
    // Closed conn
    mysqli_close($conn);

    return $data;
}