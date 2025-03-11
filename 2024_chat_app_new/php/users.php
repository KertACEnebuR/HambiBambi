<?php
session_start();

$inactive_timeout = 1800; // 30 perc inaktivitás (30*60 = 1800 másodperc)

// Ellenőrzés az automatikus kijelentkezésre
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $inactive_timeout) {
    session_unset();
    session_destroy();
    header("Location: logout.php");
    exit();
} else {
    // Frissítjük az utolsó aktivitást
    $_SESSION['last_activity'] = time();
}

// Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once "connect.php";

$outgoing_id = $_SESSION['user_id'];

// Lekérdezzük az összes felhasználót, kivéve a bejelentkezettet
$sql = mysqli_query($conn, "SELECT * FROM users WHERE user_id != {$outgoing_id}");
$output = "";

if(mysqli_num_rows($sql) == 0){
    $output .= "Nincs online felhasználó az alkalmazásban";
} else {
    // A felhasználói lista dinamikus megjelenítése
    while($row = mysqli_fetch_assoc($sql)) {
        $output .= '
        <a href="chat.php?user_id='. $row['user_id'] .'">
            <div class="content">
                <img src="php/images/'. $row['img'] .'" alt="">
                <div class="details">
                    <span>'. $row['lname'] . " " . $row['fname'] .'</span>
                    <p>'. $row['status'] .'</p>
                </div>
            </div>
            <div class="status-dot '. ($row['status'] == 'Offline now' ? 'offline' : '') .'"><i class="fas fa-circle"></i></div>
        </a>';
    }
}

echo $output;

