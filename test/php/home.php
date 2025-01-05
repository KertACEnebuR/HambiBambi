<?php
session_start();
$akciok = [
    ["cim" => "Hamburger menü 20% kedvezménnyel", "leiras" => "Kóstold meg akciós hamburger menünket!", "kep" => "images/hamburger_menu.jpg"],
    ["cim" => "Kézműves sültkrumpli", "leiras" => "Próbáld ki különleges sültkrumplinkat most olcsóbban!", "kep" => "images/sultkrumpli.jpg"],
    ["cim" => "Finom levesek", "leiras" => "Kiváló előétel egy burger előtt.", "kep" => "images/pizza.jpg"],
    ["cim" => "Tavaszi saláta", "leiras" => "Friss és egészséges saláták akcióban!", "kep" => "images/salata.jpg"]
];

$kiemelt_ajanlatok = array_rand($akciok, 3);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HambiBambi Étterem</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/home.css">
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

    <section class="slider">
            <div class="slide">
                <img src="images/slide1.jpg" alt="Ínycsiklandó ételek">
            </div>
            <div class="slide">
                <img src="images/slide2.jpg" alt="Friss alapanyagok">
            </div>
            <div class="slide">
                <img src="images/slide3.jpg" alt="Családbarát légkör">
            </div>
        </section>

        <section class="kiemelt-ajanlatok">
            <h2>Kiemelt ajánlataink</h2>
            <div class="ajanlatok">
                <?php foreach ($kiemelt_ajanlatok as $index): ?>
                    <div class="ajanlat">
                        <img src="<?php echo $akciok[$index]['kep']; ?>" alt="<?php echo $akciok[$index]['cim']; ?>">
                        <h3><?php echo $akciok[$index]['cim']; ?></h3>
                        <p><?php echo $akciok[$index]['leiras']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    <main>
        <section class="bemutatkozas">
            <h2>Rólunk</h2>
            <div class="bemutatkozoDiv">
            <p>Üdvözlünk a HambiBambi Étteremben! Büszkék vagyunk arra, hogy mindig friss alapanyagokból készítjük ételeinket. Legyen szó egy finom hamburger menüről, 
                könnyű salátákról vagy finom levesről, nálunk mindenki megtalálja a kedvencét. Látogass el hozzánk és tapasztald meg a minőséget és a vendégszeretetet!</p>
            </div>
        </section>
    </main>

    <footer>
        <p>HambiBambi Étterem</p>
    </footer>
</body>
</html>
