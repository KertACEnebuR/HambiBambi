<?php 
session_start();
/*
if(!isset($_SESSION['user_id'])){//ha a user nincs van lépve
    header("location:index.php");
}*/

include_once "php/connect.php";
//űrlap adatok beolvasása
$user_id = $_SESSION['user_id'];


    $sql = "SELECT * FROM users WHERE user_id LIKE '{$user_id}'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);
    //var_dump($sql);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $occupation = $row['occupation'];
    $department = $row['department'];
    $mobil = $row['mobil'];
    $email = $row['email'];
    $hash = $row['password']; //a titkosított jelszó beolvasása
    $writtenpass = "";
    $password = password_verify($writtenpass, $hash); //itt kerül visszafejtésre a jelszó

?>
<?php include_once "head.php"; ?>
<body>

<div class="content">
    <div class="wrapper">
        <section class="form signup">
            <header>
                Adatok módosítása
            </header>
            <form action="#" enctype="multipart/form-data" autocomplete="off">
                <div class="error-txt"></div>
                <!--meg kell adni az id-t is, de megjelennie nem kell-->
                <input type="hidden" id="user_id" name="user_id" value="<?php print $user_id; ?>">
                <div class="name-details">
                    <div class="field input">
                        <label>Vezetéknév:</label>
                        <input type="text" placeholder="Vezetéknév" name="lname" value="<?php print $lname; ?>" required>
                    </div>
                    <div class="field input">
                        <label>Keresztnév:</label>
                        <input type="text" placeholder="Keresztnév" name="fname" value="<?php print $fname; ?>"required>
                    </div>
                    
                </div>
                <div class="field input">
                        <label>Szervezeti egység:</label>
                        <input type="text" name="department" placeholder="Szervezeti egység" name="department" value="<?php print $department; ?>" required>
                    </div>
                    <div class="field input">
                        <label>Beosztás:</label>
                        <input type="text" name="occupation" placeholder="Beosztás" name="occupation" value="<?php print $occupation; ?>" required>
                    </div>
                    <div class="field input">
                        <label>Telefon:</label>
                        <input type="text" placeholder="Telefonszám" name="mobil" value="<?php print $mobil; ?>" required>
                    </div>
                    <div class="field input">
                        <label>E-mail:</label>
                        <input type="email" name="email" placeholder="E-amil cím" name="email" value="<?php print $email; ?>" required>
                    </div>
                    <div class="field input">
                        <label>Jelszó:</label>
                        <input type="password" placeholder="Jelszó" name="password" value="<?php print $password; ?>" required><i class="fas fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label>Profil kép:</label>
                        <input type="file" name="image" <input type="hidden" id="id" name="id">
                    </div>
                    <input type="hidden" id="status" name="status" value="<?php print $status; ?>">
                    <div class="field button">
                        <input type="submit" value="Módosítások mentése">
                    </div>
           
                
            </form>
            <div class="link">Ha már van regisztrációja lépjen be: <a href="login.php">Belépés</a></div>
        </section>
        </div>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/update.js"></script>
</body>

</html>