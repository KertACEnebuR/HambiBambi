<?php
session_start();

// Minden munkamenet változó törlése
$_SESSION = [];

// Munkamenet megsemmisítése
session_destroy();

// Visszairányítás a bejelentkezési oldalra
header("Location: ../../../index.php");
exit;