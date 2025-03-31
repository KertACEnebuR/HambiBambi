<?php
 session_start();
 if(!isset($_SESSION['user_id'])){
     header("location: ../../../application/view/loginreg/loginreg.php");
 }
 include_once "../../../connect.php";

// Felhasználói azonosító beolvasása a session-ből
$user_id = $_SESSION['user_id'];

// Saját profil adatainak lekérdezése
$sql = "SELECT * FROM users
        LEFT JOIN settlements 
        ON users.settlement_id = settlements.settlement_id
        LEFT JOIN counties 
        ON settlements.county_id = counties.county_id  
        WHERE user_id = {$user_id}";
$result = mysqli_query($conn, $sql);

// Ellenőrizd a lekérdezés eredményét és hiba esetén kezeld
if (!$result) {
    die("Hiba a lekérdezésben: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $full_name = $row['full_name'] ?? "Nincs adat";
    $email = $row['email'] ?? "Nincs adat";
    $phone_number = $row['phone_number'] ?? "Nincs adat";
    $address = $row['address'] ?? "Nincs adat";
    $settlementName = $row['settlement_name'] ?? "Nincs adat";
    $countyName = $row['county_name'] ?? "Nincs adat";
}   
    
//Saját profil felületének összeállítása a $output változóba
        $output = "
        <div class=\"profile_container\">
            <div class=\"user_details\">
                <table>
                    <tr>
                        <th>Teljesnév:</th>
                        <td>{$full_name}</td>
                    </tr>
                    <tr>
                        <th>Telefonszám: </th>
                        <td>+{$phone_number}</td>
                    </tr>
                    <tr>
                        <th>E-mail:</th>
                        <td>{$email}</td>
                    </tr>
                    <tr>
                        <th>Megye: </th>
                        <td>{$countyName}</td>
                    </tr>
                    <tr>
                        <th>Település: </th>
                        <td>{$settlementName}</td>
                    </tr>
                    <tr>
                        <th>Lakcím:</th>
                        <td>{$address}</td>
                    </tr>
                    <tr>
                        <td><a class=\"update\"href=\"profileUpdate.php\">📦 Adatok módosítása</a></td>
                        <td><a class=\"logout\"<a href=\"profileLogout.php\">🚪 Kijelentkezés</a></td>
                    </tr>
                    </table>
                    </div>
                    ";                    
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <link rel="stylesheet" href="../../../assets/css/main.css">
  <link rel="stylesheet" href="../../../assets/css/profile.css">
  <link rel="stylesheet" href="../../../assets/css/cart.css">
</head>
<body>
  <!-- Menu -->
  <?php include_once "../navbar/navbar.php"; ?>
  <?php echo $output; ?>
  <script src="../../../assets/js/cart.js"></script>
</body>

</html>