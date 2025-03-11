<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include_once "connect.php";
    $user_id = $_SESSION['user_id'];
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    // Kezeljük a feltöltött képet
    $image_name = null;
    if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] == 0) {
        $image_name = $_FILES['post_image']['name'];
        $image_tmp_name = $_FILES['post_image']['tmp_name'];
        $image_folder = "images/posts/" . $image_name;
        move_uploaded_file($image_tmp_name, $image_folder);
    }
    
    $sql = "INSERT INTO posts (user_id, content, post_image) VALUES ('$user_id', '$content', '$image_name')";
    if (mysqli_query($conn, $sql)) {
        echo "Bejegyzés sikeresen elmentve!";
    } else {
        echo "Hiba történt: " . mysqli_error($conn);
    }
} else {
    echo "Be kell jelentkeznie!";
}

