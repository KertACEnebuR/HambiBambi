<?php
$Path = "./";
if($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/logreg/loginreg.php") {
    $Path = "../../../";
}
if($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/logreg/loginregLogin.php") {
    $Path = "../../../";
}
elseif($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/menu/menu.php") {
    $Path = "../../../";
}
elseif($_SERVER["REQUEST_URI"] == "/hambibambi/application/view/contacts/contact.php") {
    $Path = "../../../";
}
require $Path . "application/view/cart.html";
?>