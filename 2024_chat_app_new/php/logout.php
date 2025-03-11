<?php 
//munkamenet hozzáadása
session_start();

if (isset($_SESSION['user_id'])) {
    include_once "connect.php";

    $user_id = $_SESSION['user_id'];
    $status = "Offline now";

    // A felhasználó státuszának frissítése
    $sql = mysqli_query($conn, "UPDATE users SET status = '$status' WHERE user_id = $user_id");

    if ($sql) {
        // Munkamenet lezárása
        session_unset();
        session_destroy();
        header("location: ../index.php");
    }
} else {
    header("location: ../login.php");
}
?>

?>