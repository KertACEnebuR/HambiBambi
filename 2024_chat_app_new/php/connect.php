<?php 
// Forrás: https://www.w3schools.com/php/func_mysqli_connect.asp
$host = "localhost";
$username = "root";
$password = "";
$database = "2024chatApp";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Hiba a kapcsolat létrehozása közben: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
