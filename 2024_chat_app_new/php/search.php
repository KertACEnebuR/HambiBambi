<?php
session_start();
include_once "connect.php";

$outgoing_id = $_SESSION['user_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

// Felhasználók keresése, kivéve a bejelentkezett felhasználót
$sql = mysqli_query($conn, "SELECT * FROM users 
WHERE NOT user_id = {$outgoing_id} 
AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");

if (mysqli_num_rows($sql) > 0) {
    include "data.php"; // Eredmények megjelenítése
} else {
    echo "Nincs eredménye a keresésnek."; // Ha nincs találat
}

