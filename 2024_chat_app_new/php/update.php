<?php 
session_start();
include_once "connect.php";

// Űrlap adatok beolvasása
$user_id = $_SESSION['user_id'];

// Módosítás
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$mobil = mysqli_real_escape_string($conn, $_POST['mobil']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$passwordrow = mysqli_real_escape_string($conn, $_POST['password']);

// Jelszó ellenőrzése és újrahasonlítása a meglévővel (ha szükséges)
$sql = "SELECT password FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);
$existingPassword = $row['password'];

if (password_verify($passwordrow, $existingPassword) || empty($passwordrow)) {
    // A jelszó helyes vagy üres, így a módosítás folytatódhat

    // E-mail cím érvényes formátumának ellenőrzése
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status = "Active now";
        $random_id = rand(time(), 100000000);

        // Képfeltöltés csak akkor, ha van új kép
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);
            $extension = ['png', 'jpg', 'jpeg'];

            if (in_array($img_ext, $extension)) {
                $time = time();
                $new_img_name = $time . $img_name;

                if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                    // Adatok frissítése
                    $sql2 = mysqli_query($conn, "UPDATE users 
                        SET fname = '$fname', 
                            lname = '$lname', 
                            email = '$email',
                            department = '$department', 
                            occupation = '$occupation', 
                            img = '$new_img_name', 
                            status = '$status', 
                            mobil = '$mobil'
                        WHERE user_id = '$user_id'");

                    if ($sql2) {
                        echo "success";
                    } else {
                        echo "Valami hiba történt!";
                    }
                } else {
                    echo "Hiba történt a képfeltöltés során.";
                }
            } else {
                echo "Kérem válasszon jpg, jpeg, vagy png kiterjesztésű fotót!";
            }
        } else {
            // Nincs képfeltöltés, csak adatok frissítése
            $sql2 = mysqli_query($conn, "UPDATE users 
                SET fname = '$fname', 
                    lname = '$lname', 
                    email = '$email',
                    department = '$department', 
                    occupation = '$occupation', 
                    status = '$status', 
                    mobil = '$mobil'
                WHERE user_id = '$user_id'");

            if ($sql2) {
                echo "success";
            } else {
                echo "Valami hiba történt!";
            }
        }
    } else {
        echo "Érvénytelen e-mail cím formátum.";
    }
} else {
    echo "Hibás jelszó!";
}
?>
