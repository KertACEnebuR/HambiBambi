<?php 
//Hasító függvények működésének bemutatása

$jelszo = "jelszó"; // legyen egy jelszó amit kiíratunk:
print "<p><b>Jelszo:</b> {$jelszo}<br>";
print "<p><b>md5():</b> ".md5($jelszo)."<br>"; //titkosítási módszer aminek a neve md5, ezek már nem annyira biztonságosak, mint amikor régen használták, de gyakorlatilag egy 32 karakter hosszú zöldséget fog nekünk előállítani,
print "<p><b>sha1():</b> ".sha1($jelszo)."<p>"; // ez a sha1 pedig egy 40 karakteres zöldséget, de ettől már vannak erősebb módszerek is


$password = password_hash("jelszó", PASSWORD_DEFAULT);
print "<p><b>password_hash:</b> ".$password."<p>";
//$2y$10$lSKAiYGPcEAns8UkszthtOVgwTYRTZaqjN6RkVMoWj8GlPsnYnFBi
//60 karakter hosszúságú titkosított jelszót ad vissza
?>