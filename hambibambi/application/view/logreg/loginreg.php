<?php

$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'login';
?>

<?php include("header.php"); ?>
<?php include("../navbar/navbar.php"); ?>
<?php include("../../controller/loginController.php"); ?>
    <main>
    <div class="container">
        <div class="tabs"> 
            <div onclick="changeTab()" class="login-tab active  tab">Belépés</div>
            <div onclick="changeTab()" class="registration-tab tab">Regisztráció</div>
            
            <!--
            <a href="?tab=login" class="tab <?= $current_tab === 'login' ? 'active' : ''; ?>">Belépés</a>
            <a href="?tab=register" class="tab <?= $current_tab === 'register' ? 'active' : ''; ?>">Regisztráció</a>
            -->
        </div>
        <div id="login" class="login-form active form-container">
            <div class="statusMessage">&nbsp;</div>
            <h2>Belépés</h2>
            <form action="" method="POST" >
                <input type="email" class="email" name="email" placeholder="E-mail cím" >
                <input type="password" class="password" name="password" placeholder="Jelszó" >
                <ipnut type="hidden" name="c" value="test">
                <div class="button" onclick="sendLogin()">Belépés</div>
                <!--<button onclick="sendLogin()" type="submit">Belépés</button>-->
            </form>
        </div>
        <div id="register" class="registration-form form-container">
            <h2>Regisztráció</h2>
            <form action="register.php" method="POST" action=''>
                <input type="text" name="username" placeholder="Felhasználónév" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Jelszó" required>
                <button type="submit">Regisztráció</button>
            </form>
        </div>
    </div>
    </main>
<?php include("footer.php"); ?>
