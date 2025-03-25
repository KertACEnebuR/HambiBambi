<?php
// Adatbázis kapcsolat
require("../../../connect.php");

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

// Vármegyék és települések lekérdezése
$sql = "SELECT counties.county_id, counties.county_name, settlements.settlement_name, settlements.settlement_id 
        FROM counties 
        LEFT JOIN settlements 
        ON counties.county_id = settlements.county_id
        ORDER BY county_name, settlement_name";

$result = $conn->query($sql);

$counties = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countyName = $row['county_name'];
        $settlementName = $row['settlement_name'];

        // Ellenőrizzük, hogy a vármegye már létezik-e a tömbben
        if (!isset($counties[$countyName])) {
            $counties[$countyName] = [];
        }

        // Hozzáadjuk a települést a vármegyéhez
        if (!empty($settlementName)) { // Csak akkor adjuk hozzá, ha a település neve nem üres
            $counties[$countyName][] = $settlementName;
        }
    }
}

$conn->close();
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
                            <select id="county" required onchange="updateSettlements()">
                                <option value="">Válasszon</option>
                                <?php foreach ($counties as $county => $cities): ?>
                                    <option value="<?= htmlspecialchars($county) ?>"><?= htmlspecialchars($county) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="settlement">Település</label>
                            <select id="settlement" required>
                                <option value="">Válasszon</option>
                            </select>
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