<?php
$outgoing_id = $_SESSION['user_id'];

// Iterálunk a lekérdezett felhasználókon
while ($row = mysqli_fetch_assoc($sql)) {
    // Az üzenetek lekérdezése
    $sql2 = "SELECT * FROM messages 
            WHERE (incoming_msg_id = {$row['user_id']} 
            OR outgoing_msg_id = {$row['user_id']})
            AND (incoming_msg_id = {$outgoing_id} 
            OR outgoing_msg_id = {$outgoing_id}) 
            ORDER BY msg_id DESC LIMIT 1";

    $query2 = mysqli_query($conn, $sql2);
    
    if (mysqli_num_rows($query2) > 0) {
        $row2 = mysqli_fetch_assoc($query2);
        $result = $row2['msg'];
    } else {
        $result = "Nincs üzenet!";
    }

    // Üzenet rövidítése, ha hosszabb mint 20 karakter
    $msg = (strlen($result) > 20) ? substr($result, 0, 20) . '...' : $result;

    // Vizsgálat: Saját üzenet vagy más felhasználóé
    $you = (isset($row2['outgoing_msg_id']) && $row2['outgoing_msg_id'] === $outgoing_id) ? "Saját: " : '';

    // Online/offline státusz meghatározása
    $offline = ($row['status'] == "Offline now") ? "offline" : "";

    // Kimenet összeállítása
    $output .= '<a href="chat.php?user_id='. $row['user_id'].'">
        <div class="content">
            <img src="php/images/'. $row['img'] .'" alt="">
            <div class="details">
                <span>'. $row['lname'] . " " . $row['fname'] .'</span>
                <p>'. $you . $msg .'</p>
            </div>
        </div>
        <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
    </a>';
}

// Kimenet kiírása
echo $output;


