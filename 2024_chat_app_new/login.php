<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("location: users.php");
    exit();
}
?>

<?php include_once "head.php"; ?>

<body>
<?php include_once "navigation.php"; ?>
    <div class="content">

        <div class="wrapper">
     
            <section class="form login">
                <header>
                    Realtime Chat
                </header>
                <form action="#">
                    <div class="error-txt">Hiba üzenet!</div>

                    <div class="field input">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" placeholder="E-mail cím" name="email">
                    </div>
                    <div class="field input">
                        <label for="password">Jelszó:</label>
                        <input type="password" id="password" placeholder="Jelszó" name="password">
                        <i class="fas fa-eye"></i>
                    </div>

                    <div class="field button">
                        <input type="submit" value="Tovább a chat felületre">
                    </div>
                </form>
                <div class="link">Ha még nincs regisztrációja: <a href="signup.php">Regisztráció</a></div>
            </section>
        </div>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
</body>

</html>
