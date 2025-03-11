<?php 
session_start();

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    include_once "connect.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

    // Az $output változó inicializálása üres stringgel
    $output = "";

    $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.user_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) 
            ORDER BY msg_id";
    
    $query = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            if($row['outgoing_msg_id'] === $outgoing_id){
                $message = $row['msg'];

                // Ellenőrizzük, hogy az üzenet kép-e
                if (strpos($message, "[image]: ") === 0) {
                    $image_name = str_replace("[image]: ", "", $message);
                    $output .= '<div class="chat outgoing">                      
                                <div class="details">
                                <img src="php/images/' . $image_name . '" alt="Image" class="chat-image">
                                </div>
                                </div>';
                } else {
                    $output .= '<div class="chat outgoing">                      
                                <div class="details">
                                <p>' . $message . '</p>
                                </div>
                                </div>';
                }
            } else {
                // Bejövő üzenetek kezelése
                $message = $row['msg'];

                if (strpos($message, "[image]: ") === 0) {
                    $image_name = str_replace("[image]: ", "", $message);
                    $output .= '<div class="chat incoming">                      
                                <div class="details">
                                <img src="php/images/' . $image_name . '" alt="Image" class="chat-image">
                                </div>
                                </div>';
                } else {
                    $output .= '<div class="chat incoming">                      
                                <div class="details">
                                <p>' . $message . '</p>
                                </div>
                                </div>';
                }
            }
        }
        echo $output; // Az $output változó kiírása
    } else {
        echo "Nincsenek üzenetek!";
    }
} else {
    header("Location: ../login.php");
    exit();
}
