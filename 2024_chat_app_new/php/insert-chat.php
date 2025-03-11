<?php 
session_start();
if (isset($_SESSION['user_id'])) {
    include_once "connect.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Ellenőrizzük, hogy van-e feltöltött fájl (kép)
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = "images/" . $image_name;

        // Ellenőrizzük, hogy sikeres volt-e a kép feltöltése
        if (move_uploaded_file($image_tmp_name, $image_folder)) {
            $message = "[image]: " . $image_name;  // Jelezzük, hogy ez egy kép
        } else {
            echo "Hiba történt a kép feltöltésekor.";
            exit();
        }
    }

    if (!empty($message)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES ('{$incoming_id}', '{$outgoing_id}', '{$message}')") or die(mysqli_error($conn));
        echo "Üzenet elküldve";
    } else {
        echo "Az üzenet nem lehet üres.";
    }
} else {
    header("Location: ../login.php");
    exit();
}
