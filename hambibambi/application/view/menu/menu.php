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
            <a class ="nav-link" href="#desserts">Desszertek</a>
        </nav>
    </div>
    <main>
        <p>
            <?php require $Path . "application/view/product.html"; ?>
        </p>
        <!--<div class="hamburgers">
            <legend>Hamburgerek</legend>
            <div class="container" id="hamburgers">
                
            </div>
        </div>

        <div class="soups">
        <legend>Levesek</legend>

        </div>

        <div class="drinks">
            <legend>Italok</legend>
            
        </div>

        <div class="salads">
            <legend>Saláták</legend>
            
        </div>

        <div class="desserts">
            
        </div>-->
   
    </main>
<?php include("../footer.php"); ?>