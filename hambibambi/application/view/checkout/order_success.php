<?php
session_start();
require("../../../connect.php");

if (!isset($_SESSION['user_id']) || !isset($_GET['order_id'])) {
    header("Location: ../../../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = (int)$_GET['order_id'];

// Rendelés adatainak lekérése
$sql = "SELECT o.order_id, o.order_date, o.delivery_date, 
               os.status, p.payment_method, 
               SUM(pr.price * b.quantity) as total
        FROM Orders o
        JOIN Order_Statuses os ON o.order_status_id = os.order_status_id
        JOIN Payments p ON o.payment_id = p.payment_id
        JOIN Baskets b ON o.order_id = b.order_id
        JOIN Products pr ON b.product_id = pr.product_id
        WHERE o.user_id = ? AND o.order_id = ?
        GROUP BY o.order_id";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Rendelés nem található.");
}

$order = $result->fetch_assoc();

// Rendelt termékek lekérése
$sql = "SELECT p.product_name, p.price, b.quantity, 
               (p.price * b.quantity) as item_total
        FROM Baskets b
        JOIN Products p ON b.product_id = p.product_id
        WHERE b.order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$products = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendelés sikeres</title>
    <link rel="stylesheet" href="../../../assets/css/checkout.css">
</head>
<body>
    <div class="container">
        <header class="text-center">
            <h1>Köszönjük a rendelését!</h1>
            <p>Rendelését sikeresen fogadtuk és feldolgozzuk.</p>
        </header>
        <main>
            <div class="order-summary">
                <h2>Rendelés összegzése</h2>
                <div class="order-details">
                    <p><strong>Rendelés azonosító:</strong> #<?= $order['order_id'] ?></p>
                    <p><strong>Rendelés dátuma:</strong> <?= date('Y-m-d H:i', strtotime($order['order_date'])) ?></p>
                    <p><strong>Várható kiszállítás:</strong> <?= date('Y-m-d', strtotime($order['delivery_date'])) ?></p>
                    <p><strong>Állapot:</strong> <?= $order['status'] ?></p>
                    <p><strong>Fizetési mód:</strong> <?= $order['payment_method'] ?></p>
                </div>
                
                <h3>Rendelt termékek</h3>
                <ul class="ordered-items">
                    <?php while ($product = $products->fetch_assoc()): ?>
                        <li class="ordered-item">
                            <div>
                                <h6><?= htmlspecialchars($product['product_name']) ?></h6>
                                <small>Mennyiség: <?= $product['quantity'] ?></small>
                            </div>
                            <span><?= number_format($product['item_total'], 0, ',', ' ') ?> Ft</span>
                        </li>
                    <?php endwhile; ?>
                </ul>
                
                <div class="order-total">
                    <p><strong>Végösszeg:</strong> <?= number_format($order['total'], 0, ',', ' ') ?> Ft</p>
                </div>
                
                <div class="actions">
                    <a href="../../../index.php" class="btn">Vissza a főoldalra</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>