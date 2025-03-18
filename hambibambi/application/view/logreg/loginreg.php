<?php
session_start();

$host = 'localhost';
$dbname = 'hambibambi';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Ellenőrzi, hogy a felhasználó már be van-e jelentkezve
if (isset($_SESSION['user_id'])) {
    header("Location: ./../loginreg.php");
    exit();
}

// Regisztrációs adatok kezelése
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['full_name'], $_POST['email'], $_POST['password'], $_POST['phone_number'], $_POST['address'])) {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone_number = trim($_POST['phone_number']);
    $address = trim($_POST['address']);

    // Ellenőrizzük, hogy az e-mail már létezik-e
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    if ($stmt->rowCount() > 0) {
        echo "A felhasználó már regisztrálva van ezzel az e-mail címmel.";
    } else {
        // Jelszó titkosítása
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Adatok mentése az adatbázisba
        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, phone_number, address, registration_date) 
        VALUES (:full_name, :email, :password, :phone_number, :address, NOW())");
        $stmt->execute([
            'full_name' => $full_name,
            'email' => $email,
            'password' => $hashed_password,
            'phone_number' => $phone_number,
            'address' => $address
        ]);

        // Sikeres regisztráció után átirányítás
        header("Location: loginreg.php");
        exit();
    }
}

//Bejelentkezés a weboldalra
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ellenőrizzük, hogy az email szerepel-e az adatbázisban
    $stmt = $pdo->prepare("SELECT user_id, password FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Bejelentkezés sikeres, munkamenet beállítása
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: ../../../index.php"); // Átirányítás a főoldalra
        exit();
    } else {
        $error = "Hibás email vagy jelszó!";
    }
}

?>
<?php include("header.php"); ?>
<?php include("../navbar/navbar.php"); ?>
<div class="container">
<div class="area1">
<div id="register" class="registration-form form-container">
        <h2>Regisztráció</h2>
        <form action="" method="POST">
            <div class="field input">
                <label for="full_name">Felhasználónév:</label>
                <input type="text" name="full_name" placeholder="Felhasználónév" required>
            </div>
            <div class="field input">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="minta@gmail.com" required>
            </div>
            <div class="field input">
                <label for="password">Jelszó:</label>
                <input type="password" name="password" placeholder="Jelszó" required>
            </div>
            <div class="field input">
                <label for="phone_number">Telefonszám:</label>
                <input type="text" name="phone_number" placeholder="+23563324591" required>
            </div>
            <div class="field input">
                <label for="address">Cím:</label>
                <input type="text" name="address" placeholder="Lakcím" required>
            </div>
            <button type="submit">Regisztráció</button>
            <button style="margin-top: 5px" type="button" onclick="window.location.href='loginregLogin.php'">Bejelentkezés</button>
        </form>
</div>
</div>
</div>
<?php include("footer.php"); ?>