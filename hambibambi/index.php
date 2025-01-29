<?php
session_start();

$akciok = [
    ["cim" => "Hamburger menü 20% kedvezménnyel", "leiras" => "Kóstold meg akciós hamburger menünket!", "kep" => "./assets/img/hamburger_menu.png"],
    ["cim" => "Kézműves sültkrumpli", "leiras" => "Próbáld ki különleges sültkrumplinkat most olcsóbban!", "kep" => "./assets/img/sultkrumpli.png"],
    ["cim" => "Finom levesek", "leiras" => "Kiváló előétel egy burger előtt.", "kep" => "./assets/img/leves.jpg"],
    ["cim" => "Tavaszi saláta", "leiras" => "Friss és egészséges saláták akcióban!", "kep" => "./assets/img/salata.png"]
];

$kiemelt_ajanlatok = array_rand($akciok, 3);
?>

<!DOCTYPE html>
<html lang="hu">
<?php include("./application/view/header.php"); ?>

    <?php include("./application/view/navbar/navbar.php"); ?>

    <div class="containerKep1">
        <img src="./assets/img/slide1.jpg" alt="">
    </div>

    <div class="containerSzoveg1">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga tenetur debitis nesciunt earum harum cumque sint sequi ratione eveniet unde!</p>
    </div>

    <div class="containerSzoveg2">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores est non unde quidem accusantium veniam at delectus fuga fugiat laborum?</p>
    </div>

    <div class="containerKep2">
    <img src="./assets/img/slide3.jpg" alt="">
    </div>

    <section class="kiemelt-ajanlatok">
        <h2>Kiemelt ajánlataink</h2>
        <div class="ajanlatok">
            <?php foreach ($kiemelt_ajanlatok as $ajanlat): ?>
                <div class="ajanlat">
                    <img src="<?php echo $akciok[$ajanlat]['kep']; ?>" alt="<?php echo $akciok[$ajanlat]['cim']; ?>">
                    <h3><?php echo $akciok[$ajanlat]['cim']; ?></h3>
                    <p class="ajanlatP"><?php echo $akciok[$ajanlat]['leiras']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <main>
        <div class="bemutatkozas">
            <h2>Rólunk</h2>
            <div class="bemutatkozoDiv">
            <p>Üdvözlünk a HambiBambi Étteremben! Büszkék vagyunk arra, hogy mindig friss alapanyagokból készítjük ételeinket. Legyen szó egy finom hamburger menüről, 
                könnyű salátákról vagy finom levesről, nálunk mindenki megtalálja a kedvencét. Látogass el hozzánk és tapasztald meg a minőséget és a vendégszeretetet!</p>
            </div>
            </div>
    </main>

    <?php include("./application/view/footer.php")?>

