<?php 
//session_start();

include_once "connect.php";
/*Ürlap adatok biztonságos feldolgozása a mysqli_real_escape_string függvény segítségével, amely megakadályozza a SQL injektálást. 
 */
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$mobil = mysqli_real_escape_string($conn, $_POST['mobil']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$passwordrow = mysqli_real_escape_string($conn, $_POST['password']);

/**Fontos!!! Vissza is kell tudni fejteni belépésnél!!!! így önmagában nem fog engedni újra belépni, ha a loginnál nem oldom meg, tehát a loginnál is módosítani kell!!!
 * 
 * A password_hash függvény a PHP beépített funkciója, amely hash értéket generál a megadott jelszóból. Az első paraméterben átadott jelszót fogja hashelni, és a második paraméterben pedig a hashelési algoritmus kiválasztása szerepel. Itt a PASSWORD_DEFAULT konstans használata azt jelenti, hogy a PHP az aktuális legjobb gyakorlatoknak megfelelő algoritmust választja automatikusan.
 */
$password = password_hash($passwordrow, PASSWORD_DEFAULT);

if(!empty($fname) && !empty($lname) && !empty($occupation) && !empty($mobil) &&  !empty($email) && !empty($password)){
//e-mail cím érvényes formátumának ellenőrzése
if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    //ellenőrzés létezik e már ez a mail cím
    $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
/*Ha az e-mail cím érvényes formátumú és nem létezik az adatbázisban, akkor a program megkezdi profilkép feltöltésének feldolgozását. Az if-else szerkezetek további ellenőrzéseket hajtanak végre, például a kép méretének és kiterjesztésének ellenőrzését, valamint a kép átmozgatását a végleges mappába, az ideiglenes mappából. */
    if(mysqli_num_rows($sql) > 0){
        echo "$email - már létező e-mail cím!";
    }else{
        if(isset($_FILES['image'])){
            $img_name = $_FILES['image']['name'];//megkapjuk a feltöltött fájl nevét
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            //fájl nevének kialakítása
            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);
            $extension = ['png', 'jpg', 'jpeg'];
            if(in_array($img_ext, $extension) === true){
                $time = time(); //jelenlegi időt adja vissza
                //ezzel adunk egyedi nevet a képnek
                //kép mozgatása végleges mappába az ideglenesből
                $new_img_name = $time.$img_name;
                if(move_uploaded_file($tmp_name, "images/".$new_img_name)){
                    $status = "Active now";
                    $random_id = rand(time(), 100000000);
//adatok beszúrása
$sql2 = mysqli_query($conn, "INSERT INTO users (user_id, fname, lname, department, occupation, email, password, img, status, mobil)
VALUES ('{$random_id}', '{$fname}', '{$lname}', '{$department}', '{$occupation}', '{$email}', '{$password}', '{$new_img_name}', '{$status}', '{$mobil}')");
                    if($sql2){
                        $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                        if(mysqli_num_rows($sql3) > 0){
                            $row = mysqli_fetch_assoc($sql3);
                            $_SESSION['user_id'] = $row['user_id'];
                            echo "success";
                        }
                    }else{
                        echo "Valami hiba történt!";
                    }
                }
            }else{
                echo "Kérem válasszon jpg, jpeg, vagy png kiterjesztésű fotót!";
            }
        }else{
            echo "Töltsön fel fotót!";
        }
    }
}else{
    echo "Minden mezőt ki kell töltenie!";
}
}
