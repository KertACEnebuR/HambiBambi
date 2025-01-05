<?php
$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'login';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HambiBambi Étterem</title>
    <link rel="stylesheet" href="../css/loginreg.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/HambiBambi_Logo.png" alt="HambiBambi Étterem Logó">
        </div>
        <nav>
            <ul class="menu">
                <li><a href="home.php">Kezdőlap</a></li>
                <li><a href="etlap.php">Étlap</a></li>
                <li><a href="akciok.php">Akciók</a></li>
                <li><a href="kapcsolat.php">Kapcsolat</a></li>
                <li><a href="loginreg.php">Belépés / Regisztráció</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <div class="container">
        <div class="tabs">
            <a href="?tab=login" class="tab <?php echo $current_tab === 'login' ? 'active' : ''; ?>">Belépés</a>
            <a href="?tab=register" class="tab <?php echo $current_tab === 'register' ? 'active' : ''; ?>">Regisztráció</a>
        </div>
        <div id="login" class="form-container <?php echo $current_tab === 'login' ? 'active' : ''; ?>">
            <h2>Belépés</h2>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Felhasználónév" required>
                <input type="password" name="password" placeholder="Jelszó" required>
                <button type="submit">Belépés</button>
            </form>
        </div>
        <div id="register" class="form-container <?php echo $current_tab === 'register' ? 'active' : ''; ?>">
            <h2>Regisztráció</h2>
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Felhasználónév" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Jelszó" required>
                <button type="submit">Regisztráció</button>
            </form>
        </div>
    </div>
    </main>

    <footer>
        <p>HambiBambi Étterem</p>
    </footer>
</body>
</html>