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
<body>

    <?php include("./application/view/navbar/navbar.php"); ?>
    
    <div id="carouselExampleAutoplaying" class="carousel slide slider" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="./assets/img/slide1P.jpg" class="d-block w-100 img-fluid" alt="slide1">
            </div>
            <div class="carousel-item">
            <img src="./assets/img/slide2P.jpg" class="d-block w-100 img-fluid" alt="slide2">
            </div>
            <div class="carousel-item">
            <img src="./assets/img/slide3.jpg" class="d-block w-100 img-fluid" alt="slide3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> 
    </footer>
</body>
</html>
