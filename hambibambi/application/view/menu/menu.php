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
        <div class="hamburgers container" id="hamburgers">
            <legend>Hamburgerek</legend>
            <div class="card cards" style="width: 18rem;">
                <img src="" class="card-img-top" alt="">
                <div class="card-body product">
                    <h5 class="card-title">Test hamburger</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, non.</p>
                    <a href="#" class="btn btn-primary">Kosárba</a> <p class="ar"></p>
                </div>
                <div class="card-body product">
                    <h5 class="card-title">Test hamburger</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, non.</p>
                    <a href="#" class="btn btn-primary">Kosárba</a> <p class="ar"></p>
                </div>
                <div class="card-body product">
                    <h5 class="card-title">Test hamburger</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, non.</p>
                    <a href="#" class="btn btn-primary">Kosárba</a> <p class="ar"></p>
                </div>
                <div class="card-body product">
                    <h5 class="card-title">Test hamburger</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, non.</p>
                    <a href="#" class="btn btn-primary">Kosárba</a> <p class="ar"></p>
                </div>
            </div>
        </div>

        <hr>

        <div class="soups container" id="soups">
            <legend>Levesek</legend>
            <div class="card cards" style="width: 18rem;">
                <img src="" class="card-img-top" alt="">
                <div class="card-body product">
                    <h5 class="card-title">Test leves</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, velit.</p>
                    <a href="#" class="btn btn-primary">Kosárba</a> <p class="ar"></p>
                </div>
            </div>
        </div>

        <hr>

        <div class="drinks container" id="drinks">
            <legend>Italok</legend>
            <div class="card cards" style="width: 18rem;">
                <img src="" class="card-img-top" alt="">
                <div class="card-body product">
                    <h5 class="card-title">Test ital</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, accusamus?</p>
                    <a href="#" class="btn btn-primary">Kosárba</a> <p class="ar"></p>
                </div>
            </div>
        </div>

        <hr>

        <div class="salads container" id="salads">
            <legend>Saláták</legend>
            <div class="card cards" style="width: 18rem;">
                <img src="" class="card-img-top" alt="">
                <div class="card-body product">
                    <h5 class="card-title">Test saláta</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, illo!</p>
                    <a href="#" class="btn btn-primary">Kosárba</a> <p class="ar"></p>
                </div>
            </div>
        </div>

        <hr>

        <div class="desserts container" id="desserts">
            <legend>Desszertek</legend>
            <div class="card cards" style="width: 18rem;">
                <img src="" class="card-img-top" alt="">
                <div class="card-body product">
                    <h5 class="card-title">Test desszert</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, illo!</p>
                    <a href="#" class="btn btn-primary">Kosárba</a> <p class="ar"></p>
                </div>
            </div>
        </div>
   
    </main>
<?php include("../footer.php"); ?>