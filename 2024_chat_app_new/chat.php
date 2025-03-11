<?php
// Session kezelése: ellenőrzi, hogy a felhasználó bejelentkezett-e, és ha nem, átirányítja a "login.php" oldalra.
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
?>


<?php include_once "head.php"; ?>
<!-- Beilleszti a "head.php" fájlt a HTML dokumentumba, amely tartalmazhatja a címet, stílusokat, és egyebeket. -->

<body>
<?php include_once "navigation.php"; ?>
<div class="content">
    <div class="wrapper">
  
        <section class="chat-area">
            <header>
            <?php
            // Adatbázis kapcsolat inicializálása
            include_once "php/connect.php";

            // A "user_id" paraméter kiolvasása az URL-ből
            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

            // A felhasználó adatainak lekérdezése az adatbázisból
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_id = {$user_id}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img'];?>" alt="">
                <div class="details">
                    <span><?php echo $row['lname']." ".$row['fname'];?></span>
                    <p><?php echo $row['status'];?></p>
                </div>
            </header>
            <div class="chat-box">
                <!-- Itt jelenítenéd meg a chat üzeneteit, de jelenleg nincs tartalom. -->
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <!-- Űrlap a chat üzenetek írásához -->
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" class="input-field" placeholder="Üzenet..." name="message" id="">

<!-- Fotó feltöltése ikon -->
<label for="file-upload" class="photo-icon">
        <i class="fas fa-camera"></i>
    </label>
    <input type="file" name="image" id="file-upload" style="display: none;">

                <button type="submit" class="send-btn"><i class="fab fa-telegram-plane"></i></button>

            </form>
        </section>
    </div>
</div>
<script src="javascript/chat.js"></script>
<!-- A chat funkcionalitásért felelős JavaScript fájl betöltése. -->
</body>

</html>
