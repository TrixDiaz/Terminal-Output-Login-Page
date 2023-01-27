<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'test_db';

    $conn = mysqli_connect($servername, $username, $password, $database);
    return $conn;


    if(!$conn)
    die("Oh Shoot!! Connection Failed");
?>