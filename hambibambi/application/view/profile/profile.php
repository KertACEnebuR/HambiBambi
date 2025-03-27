<?php
 session_start();
 if(!isset($_SESSION['user_id'])){
     header("location: ../../../application/view/loginreg/loginreg.php");
 }
 include_once "../../../connect.php";

// Felhasználói azonosító beolvasása a session-ből
$user_id = $_SESSION['user_id'];

// Saját profil adatainak lekérdezése
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$result = mysqli_query($conn, $sql);

// Ellenőrizd a lekérdezés eredményét és hiba esetén kezeld
if (!$result) {
    die("Hiba a lekérdezésben: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $full_name = $row['full_name'];
    $email = $row['email'];
    $phone_number = $row['phone_number'];
    $address = $row['address'];
    $settlementName = $row['settlement_name'];
    $countyName = $row['county_name'];
} else {
    // Ha nincs eredmény, állíts be alapértelmezett értékeket vagy kezeld a hibát
    $fullname = "Nincs adat";
    $email = "Nincs adat";
    $phone_number = "Nincs adat";
    $address = "Nincs adat";
    $settlementName = "Nincs adat";
    $countyName = "Nincs adat";
}
        //------------------------
    
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
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0sG1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="../../../assets/js/cart.js"></script>
</body>

</html>