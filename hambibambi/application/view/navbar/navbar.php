<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$Path = "./";
if($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/logreg/loginreg.php") {
    $Path = "../../../";
}
if($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/logreg/loginregLogin.php") {
    $Path = "../../../";
}
elseif($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/menu/menu.php") {
    $Path = "../../../";
}
elseif($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/contacts/contact.php") {
    $Path = "../../../";
}
elseif($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/profile/profile.php") {
    $Path = "../../../";
}
require $Path . "application/view/cart.html";
?>
<header>
    <div class="logo">
        <img src="<?= $Path."assets/img/HambiBambi_Logo.png"?>" alt="HambiBambi Étterem Logó">
    </div>
    <nav>
        <ul class="navbar">
            <li><a href=<?= $Path . "index.php"; ?>>Kezdőlap</a></li>
            <li><a href=<?= $Path . "application/view/menu/menu.php"; ?>>Étlap</a></li>
            <li><a href=<?= $Path . "application/view/contacts/contact.php"; ?>>Kapcsolat</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Ha a felhasználó be van jelentkezve -->
                <li><a href=<?= $Path . "application/view/profile/profile.php"; ?>>Profil</a></li>
                <li>
                    <div class="kosarikon">
                        <p>0</p><i class="fa fa-shopping-cart"></i>
                    </div>
                </li>
            <?php else: ?>
                <!-- Ha a felhasználó nincs bejelentkezve -->
                <li><a href=<?= $Path . "application/view/logreg/loginreg.php"; ?>>Belépés / Regisztráció</a></li>
            <?php endif; ?>
        </ul>
    </nav>      
</header>