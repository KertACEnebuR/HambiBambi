<?php
session_start();

include "../../../connect.php";

// Ellenőrzi, hogy a felhasználó már be van-e jelentkezve
if (isset($_SESSION['user_id'])) {
    header("location: ./../loginregLogin.php");
    exit();
}

//Bejelentkezés a weboldalra
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ellenőrizzük, hogy az email szerepel-e az adatbázisban
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $error = "A felhasználó nem található!";
    } else {
        error_log("Hashed password from DB: " . $user['password']);
        error_log("Entered password: " . $password);

        if (password_verify($password, $user['password'])) {
            // Bejelentkezés sikeres, munkamenet beállítása
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: ../../../index.php"); // Átirányítás a főoldalra
            exit();
        } else {
            $error = "Hibás email vagy jelszó!";
        }
    }
}

?>
<?php include("header.php"); ?>
<?php include("../navbar/navbar.php"); ?>
<div class="container">
<div class="area2">
<div class="login-form">
    <h2>Bejelentkezés</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="POST">
        <div class="field input">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="field input">
            <label for="password">Jelszó:</label>
            <input type="password" name="password" placeholder="Jelszó" required>
        </div>
        <button type="submit">Bejelentkezés</button>
        <div class="link">Ha még nincs regisztrációja: <a href="loginreg.php">Regisztráció</a></div>
    </form>
</div>
</div>
</div>
<?php include("footer.php"); ?>