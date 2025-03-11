<?php
/*session_start(); itt nem kell hozzá adni, mivel a munkamenet aktív*/
$outgoing_id = $_SESSION['user_id'];

/*
$sql = mysqli_query($conn, "SELECT * FROM users WHERE user_id LIKE '{$outgoing_id}'");
*/
// Üzenetek lekérése az adatbázisból
/**
 * A while ciklus az adatbázisból lekért sorokon végig iterál. A lekérdezés eredményét a $sql változóból kéri le, majd minden iterációnál egy sor értéket tárol a $row változóban.
 * 
 * A cikluson belül a második SQL lekérdezés ($sql2) azért szükséges, hogy lekérje az üzeneteket a "messages" táblából a megadott feltételek alapján. 
 * 
 * Az első feltétel ellenőrzi, hogy az üzenet bejövő üzenet-e az aktuális felhasználónak (az aktuális sorban tárolt user_id alapján), vagy kimenő üzenet-e a felhasználótól. 
 * 
 * A második feltétel azt vizsgálja, hogy az üzenet kimenő üzenet-e a megadott outgoing_msg_id értékkel. 
 * 
 * Az ORDER BY az üzeneteket a "msg_id" (üzenet azonosítója) szerint csökkenő sorrendbe rendezi, és csak az utolsó üzenetet kéri le (LIMIT 1).
 */
//ha van jelen felhasználó:
   while($row = mysqli_fetch_assoc($sql)){
    // kiíratjuk a felhasználók tömbjét
    //var_dump($row);
    $sql2 = "SELECT * FROM messages 
            WHERE (incoming_msg_id = {$row['user_id']}
            OR outgoing_msg_id = {$row['user_id']})
            AND (incoming_msg_id = {$outgoing_id}
            OR outgoing_msg_id = {$outgoing_id}) 
            ORDER BY msg_id DESC LIMIT 1";   
    //a lekért adatok eltárolása változóba      
    $query2 = mysqli_query($conn, $sql2);
    //var_dump($query2);
    //a változóból a szükséges adatok kinyerése
    $row2 = mysqli_fetch_assoc($query2);
    //var_dump($row2);
    /*ha a változóba került adat, azaz értéke nagyobb mint 0, akkor a $result változóba tárolja el az adatbázisból az üzenetet, ha az érték hamis vagyis 0 az értéke, akkor írja ki Nincs üzenet.*/

    /**Probléma: a fogadónál nem frissül az üzenet, egy hétig kerestem a hibát mire rájöttem a legkérdezésben az elírásra */
    if (mysqli_num_rows($query2) > 0) {
        $row2 = mysqli_fetch_assoc($query2);
        $result = $row2['msg'];
        //var_dump($result);
    }else{
        $result = "Nincs üzenet!";
    }
//...üzenet, ha egy szöveg, szó hosszabb mint 28 karakter
(strlen($result) > 20) ? $msg = substr($result, 0 ,20).'...' : $msg = $result;
/*üezentemhez hozzá adom hogy: "Saját:" üzenet. 
itt vizsgálni kell van e kimenő üzenet, mert ha üres az adatbázis akkor hibát ír az outgoing_id null értéket kap, de ha már van üzent az adatbázisban legalább egy, akkor az isset vizsgálat nélkül is jól működik. A vizsgálatot egy conditional operátor segítségével végeztem el.*/
/*
(isset($row2['outgoing_msg_id']) &&  ($row2['outgoing_msg_id']) === $outgoing_id) ? $you = "Saját: " : $you = '';*/
//rövidebb formában
$you = (isset($row2['outgoing_msg_id']) && $row2['outgoing_msg_id'] === $outgoing_id) ? "Saját: " : '';


//vizsgálat ki online, ki offline
($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
//kimenet összeállítása
$output .= '<a href="chat.php?user_id='. $row['user_id'].'">
    <div class="content">
        <img src="php/images/'. $row['img'] .'" alt="">
        <div class="details">
            <span>'.$row['lname']." ".$row['fname'].'</span>
            <p>'. $you . $msg .'</p>
        </div>
    </div>
    <div class="status-dot '. $offline .'"><i class="fas fa-circle"> </i></div>
</a>';
   }

   echo $output;

   
?>