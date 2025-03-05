<?php
$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'login';
?>

<?php include("header.php"); ?>
<?php include("../navbar/navbar.php"); ?>
    <div class="insideNavbar">
        <nav id = "navbar">
            <a class ="nav-link" href ="#hamburgers">Hamburgerek</a>
            <a class ="nav-link" href="#soups">Levesek</a>
            <a class ="nav-link" href="#drinks">Italok</a>
            <a class ="nav-link" href="#salads">Saláták</a>
            <a class ="nav-link" href="#pastas">Tészták</a>
            <a class ="nav-link" href="#desserts">Sütik</a>
            <a class ="nav-link" href="#drinks">Üdítők</a>
            <a class ="nav-link" href="#drinks2">Szeszes italok</a>
        </nav>
    </div>
    <main>

        <?php require $Path . "application/view/product.html"; ?>
    </p>
   
    </main>
<?php include("../footer.php"); ?>