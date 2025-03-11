<?php
// Munkamenet kezelése
session_start();

// Ellenőrzi, hogy a felhasználó már be van-e jelentkezve
if (isset($_SESSION['user_id'])) {
    header("location:users.php");
}
?>
<?php include_once "head.php"; ?>

<body>
<?php include_once "navigation.php"; ?>
    <div class="content">
        <div class="wrapper">
            <section class="form signup">
                <header>
                    Realtime Chat
                </header>
                <form action="#" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-box">
                        <div class="error-txt">Hiba üzenetek</div>
                    </div>
                    <div class="name-details">
                        <div class="field input">
                            <label>Vezetéknév:</label>
                            <input type="text" placeholder="Vezetéknév" name="lname">
                        </div>
                        <div class="field input">
                            <label>Keresztnév:</label>
                            <input type="text" placeholder="Keresztnév" name="fname">
                        </div>
                    </div>
                    <div class="field input">
                        <label>Szervezeti egység:</label>
                        <input type="text" name="department" placeholder="Szervezeti egység">
                    </div>
                    <div class="field input">
                        <label>Beosztás:</label>
                        <input type="text" name="occupation" placeholder="Beosztás">
                    </div>
                    <div class="field input">
                        <label>Telefon:</label>
                        <input type="text" name="mobil" placeholder="Telefonszám">
                    </div>
                    <div class="field input">
                        <label>E-mail:</label>
                        <input type="email" name="email" placeholder="E-mail cím">
                    </div>
                    <div class="field input">
                        <label>Jelszó:</label>
                        <input type="password" name="password" placeholder="Jelszó"><i class="fas fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label>Profil kép:</label>
                        <input type="file" name="image">
                    </div>
                    <div class="field button">
                        <input type="submit" value="Tovább a chat felületre">
                    </div>
                </form>
                <div class="link">Ha már van regisztrációja, lépjen be: <a href="login.php">Belépés</a></div>
            </section>
        </div>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    
    <script src="javascript/signup.js"></script>
    
    <script src="javascript/signup_autofill.js"></script>
</body>

</html>
