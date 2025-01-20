<?php
$logoPath = "./";
if($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/logreg/loginreg.php") {
    $logoPath = "../../../";
}

?>
<header>
        <div class="logo">
            <img src="<?= $logoPath."assets/img/HambiBambi_Logo.png"?>" alt="HambiBambi Étterem Logó">
        </div>
        <nav>
            <ul class="navbar">
                <li><a href=<?= $logoPath."index.php";?>>Kezdőlap</a></li>
                <li><a href=<?= $logoPath."menu.php";?>>Étlap</a></li>
                <li><a href=<?= $logoPath."akciok.php";?>>Akciók</a></li>
                <li><a href=<?= $logoPath."kapcsolat.php";?>>Kapcsolat</a></li>
                <li><a href=<?= $logoPath."application/view/logreg/loginreg.php";?>>Belépés / Regisztráció</a></li>
            </ul>
        </nav>
    </header>