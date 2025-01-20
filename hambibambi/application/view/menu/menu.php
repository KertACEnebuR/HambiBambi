<?php

$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'login';
?>

<?php include("header.php"); ?>
<?php include("../navbar/navbar.php"); ?>
    <main>
        <div class="hamburgers">
            <legend>Hamburgerek</legend>
            <div class="card" style="width: 18rem;">
            <img src="./assets/img/duplaSajtburger.jpg" class="card-img-top" alt="Dupla Sajtburger">
            <div class="card-body">
                <h5 class="card-title">Dupla Sajtburger</h5>
                <p class="card-text">Házikészítésű buci, cheddar sajt, saláta, sajtszósz, dupla marha húspogácsa</p>
                <a href="#" class="btn btn-primary">Kosárba</a> <p class="ar"></p>
            </div>
        </div>
        </div>
   
    </main>
<?php include("../footer.php"); ?>