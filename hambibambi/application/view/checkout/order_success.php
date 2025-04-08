<?php
session_start();
if (!isset($_GET['order_id'])) {
    die("Hibás rendelés azonosító.");
}

$order_id = (int)$_GET['order_id'];
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Köszönjük a rendelést!</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}

header h1 {
    color: #333;
    margin-bottom: 20px;
}

main p {
    color: #555;
    margin: 10px 0;
}

a.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

a.btn:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Köszönjük a rendelést!</h1>
        </header>
        <main>
            <p>A rendelés azonosítója: <strong>#<?= htmlspecialchars($order_id) ?></strong></p>
            <p>Köszönjük, hogy nálunk vásárolt! Hamarosan felvesszük Önnel a kapcsolatot a rendelés kiszállításával kapcsolatban.</p>
            <a href="/hambibambi/index.php" class="btn">Vissza a főoldalra</a>
        </main>
    </div>
</body>
</html>