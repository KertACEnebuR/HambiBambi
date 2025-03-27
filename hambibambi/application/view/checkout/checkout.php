<?php
// Adatbázis kapcsolat
require("../../../connect.php");

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
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
                <div class="billing-form">
                    <h2>Számlázási adatok</h2>
                    <form>
                        <div class="form-group">
                            <label for="fullName">Teljesnév</label>
                            <input type="text" id="fullName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="minta@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="tel">Telefonszám</label>
                            <input type="tel" id="tel" placeholder="+01234567890" required>
                        </div>
                        <div class="form-group">
                            <label for="county">Vármegye</label>
                            <input type="county" id="county" placeholder="Vármegye" required>
                        </div>
                        <div class="form-group">
                            <label for="settlement">Település</label>
                            <input type="settlement" id="settlement" placeholder="Település" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Lakcím</label>
                            <input type="text" id="address" placeholder="Rákóczi út 24." required>
                        </div>
                        <h3>Fizetési mód</h3>
                        <div class="form-group">
                            <label><input type="radio" name="payment" value="cash" required> Készpénz</label>
                            <label><input type="radio" name="payment" value="card" required> Bankkártya</label>
                            <label><input type="radio" name="payment" value="szep" required> SZÉP-kártya</label>
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