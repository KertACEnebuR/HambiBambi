<?php
$Path = "./";
if($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/logreg/loginreg.php") {
    $Path = "../../../";
}
elseif($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/menu/menu.php") {
    $Path = "../../../";
}
elseif($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/contacts/contact.php") {
    $Path = "../../../";
}

?>
<header>
        <div class="logo">
            <img src="<?= $Path."assets/img/HambiBambi_Logo.png"?>" alt="HambiBambi Étterem Logó">
        </div>
        <nav>
            <ul class="navbar">
                <li><a href=<?= $Path."index.php";?>>Kezdőlap</a></li>
                <li><a href=<?= $Path."application/view/menu/menu.php";?>>Étlap</a></li>
                <li><a href=<?= $Path."akciok.php";?>>Akciók</a></li>
                <li><a href=<?= $Path."application/view/contacts/contact.php";?>>Kapcsolat</a></li>
                <li><a href=<?= $Path."application/view/logreg/loginreg.php";?>>Belépés / Regisztráció</a></li>
            </ul>
        </nav>
    </header>