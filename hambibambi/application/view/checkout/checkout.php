<?php
session_start();
require("../../../connect.php");

// Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Felhasználói adatok lekérése
$sql = "SELECT full_name, email, phone_number, settlements.settlement_name,
        counties.county_name, address 
        FROM users
        LEFT JOIN settlements ON users.settlement_id = settlements.settlement_id
        LEFT JOIN counties ON settlements.county_id = counties.county_id
        WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("Felhasználói adatok nem találhatók.");
}

// Rendelés feldolgozása, ha elküldték a formot
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment'])) {
    // Kosár tartalmának lekérése a localStorage-ból (JavaScript segítségével)
    // Ez a rész a JavaScriptben lesz kezelve, majd AJAX kéréssel elküldve
    
    // Mivel a localStorage csak JavaScriptből érhető el, 
    // AJAX kérést kell használnunk a kosár adatainak elküldéséhez
    
    // Ellenőrizzük, hogy van-e kosár tartalom
    if (empty($_POST['cartItems'])) {
        die("A kosár üres, nem lehet leadni a rendelést.");
    }
    
    $cartItems = json_decode($_POST['cartItems'], true);
    $payment_method = (int)$_POST['payment'];
    
    // Tranzakció kezdete
    $conn->begin_transaction();
    
    try {
        // Rendelés létrehozása
        $order_date = date('Y-m-d H:i:s');
        $delivery_date = date('Y-m-d H:i:s', strtotime('+3 days'));
        
        $sql = "INSERT INTO Orders (user_id, payment_id, order_status_id, order_date, delivery_date) 
                VALUES (?, ?, 1, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $user_id, $payment_method, $order_date, $delivery_date);
        $stmt->execute();
        
        $order_id = $conn->insert_id;
        
        // Termékek hozzáadása a kosárhoz (Baskets tábla)
        foreach ($cartItems as $item) {
            $product_id = (int)$item['id'];
            $quantity = (int)$item['quantity'];
            
            $sql = "INSERT INTO Baskets (product_id, order_id, quantity) 
                    VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $product_id, $order_id, $quantity);
            $stmt->execute();
            
            // Termék készletének csökkentése
            $sql = "UPDATE Products SET quantity = quantity - ? WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $quantity, $product_id);
            $stmt->execute();
        }
        
        // Tranzakció véglegesítése
        $conn->commit();
        
        // Kosár ürítése
        echo "<script>localStorage.removeItem('cartItems');</script>";
        
        // Átirányítás a siker oldalra
        header("Location: order_success.php?order_id=" . $order_id);
        exit();
        
    } catch (Exception $e) {
        // Tranzakció visszagörgetése hiba esetén
        $conn->rollback();
        die("Hiba történt a rendelés feldolgozása során: " . $e->getMessage());
    }
}

// Megyék és települések lekérése a legördülő listákhoz
$counties = [];
$sql = "SELECT * FROM Counties ORDER BY county_name";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $counties[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../../../assets/css/checkout.css">
</head>
<body>
    <div class="container">
        <header class="text-center">
            <h1>Rendelés véglegesítése</h1>
        </header>
        <main>
            <div class="checkout-grid">
                <!-- Kosár tartalma -->
                <div class="cart-summary">
                    <h2>Kosár tartalma</h2>
                    <ul class="cart-items">
                        <li class="total"></li>
                    </ul>
                </div>

                <!-- Számlázási adatok -->
                <div class="rendeles">
                    <h2>Számlázási adatok</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="fullName">Teljesnév</label>
                            <input class="adatok" type="text" id="fullName" value="<?= htmlspecialchars($user['full_name']) ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="adatok" type="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="tel">Telefonszám</label>
                            <input class="adatok" type="tel" id="tel" value="<?= htmlspecialchars($user['phone_number']) ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="county">Vármegye</label>
                            <input class="adatok" type="text" id="county" value="<?= htmlspecialchars($user['county_name']) ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="settlement">Település</label>
                            <input class="adatok" type="text" id="settlement" value="<?= htmlspecialchars($user['settlement_name']) ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="address">Lakcím</label>
                            <input class="adatok" type="text" id="address" value="<?= htmlspecialchars($user['address']) ?>" disabled>
                        </div>
                        <h3>Fizetési mód</h3>
                        <div class="form-group">
                            <label><input type="radio" class="payment" name="payment" value="1" required> Készpénz</label>
                            <label><input type="radio" class="payment" name="payment" value="2" required> Bankkártya</label>
                            <label><input type="radio" class="payment" name="payment" value="3" required> SZÉP-kártya</label>
                        </div>
                        <button type="submit" class="submit-btn">Rendelés véglegesítése</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="../../../assets/js/checkout.js"></script>
    <script>
        const counties = <?= json_encode($counties) ?>;
    </script>
</body>
</html>