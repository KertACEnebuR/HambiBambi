<?php
 session_start();
 if(!isset($_SESSION['user_id'])){
     header("location: login.php");
 }
 include_once "php/connect.php";

// Felhasználói azonosító beolvasása a session-ből
$user_id = $_SESSION['user_id'];

// Saját profil adatainak lekérdezése
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$result = mysqli_query($conn, $sql);

// Ellenőrizd a lekérdezés eredményét és hiba esetén kezeld
if (!$result) {
    die("Hiba a lekérdezésben: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
    
$fname = $row['fname'];
$lname = $row['lname'];
$email = $row['email'];
$department = $row['department'];
$occupation = $row['occupation'];
$kep = $row['img'];
$mobil = $row['mobil'];
        //------------------------
    
//Saját profil felületének összeállítása a $output változóba
        $output = "
        <div class=\"profile_container\">

       
            <div class=\"profil_image\">
                <div class=\"images\"><img src=\"php/images/" .$kep. "\"></div>
            </div>
            <div class=\"user_details\">
                <table>
                    <tr>
                        <th>Vezetéknév:</th>
                        <td>{$fname}</td>
                    </tr>
                    <tr>
                        <th>Keresztnév:</th>
                        <td>{$lname}</td>
                    </tr>
                    <tr>
                        <th>Szervezeti egység: </th>
                        <td>{$department}</td>
                    </tr>
                    <tr>
                        <th>Beosztás: </th>
                        <td>{$occupation}</td>
                    </tr>
                    <tr>
                        <th>E-mail:</th>
                        <td>{$email}</td>
                    </tr>
                    <tr>
                        <th>Telefon:</th>
                        <td>{$mobil}</td>
                    </tr>
                    <tr>
                        <td><a class=\"update\"href=\"update.php\">Adatok módosítása</a></td>
                    
                    </tr>
                    </table>
                    </div>
                    ";
        
                    
?>

<!DOCTYPE html>
<html lang="hu">

<?php include_once "head.php"; ?>

<body>
  <!-- Menu -->
  <?php include_once "navigation.php"; ?>
  <?php echo $output;?>
    <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</body>

</html>