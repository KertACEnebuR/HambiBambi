<?php
$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'login';
?>

<?php include("header.php"); ?>

<?php include("../navbar/navbar.php"); ?>

<?php include("insideNavbar.php"); ?>

<?php require $Path . "application/view/product.html"; ?> 

<?php include("../footer.php"); ?>