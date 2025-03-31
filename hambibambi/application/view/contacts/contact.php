<?php

?>
<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<body>
    <?php include("../navbar/navbar.php"); ?>
    <div class="container">
  <div class="area1">
    <h1 class="elerhetosegh1">Elérhetőségek</h1>
    <p> Telefonszám: +36 30 123 4567 <br>
    <br>
        E-mail cím: info.hambibambi@gmail.com <br>
        <br>
        Cím: 2660 Balassagyarmat, Hamburger utca 12.</p>
      </div>
  <div class="area2">
    <h1 class="nyitvatartash1">Nyitvatartás</h1>
    <p> Hétfő: 8:00 - 20:00 <br>
        Kedd: 8:00 - 20:00 <br>
        Szerda: 8:00 - 20:00 <br>
        Csötörtök: 8:00 - 20:00 <br>
        Péntek: 8:00 - 18:00 <br>
        Szombat 8:00 - 18:00 <br>
        Vasárnap: Zárva
    </p>
      </div>
  <div class="area3">
    <h1 class="kozossegimediah1">Közösségi média</h1>
    <p>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
  <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
</svg> <a href="https://www.tiktok.com/en/" style="text-decoration:none">Tiktok</a> <br>
<br>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
</svg> <a href="https://www.instagram.com/" style="text-decoration:none">Instagram</a> <br>
<br>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
</svg> <a href="https://www.facebook.com/" style="text-decoration:none"> Facebook</a> <br>
    </p>  
  </div>
  
<div class="area4">
  <div class="contact-container">
    <!--Kapcsolatfelvétel-->
        <?php if (isset($_SESSION['user_id'])): ?>

          <form action="#" method="post">
          <h1 class="ertekelesh1">Értékelés</h1>
          <div class="stars" id="rating">
        <span class="star" data-value="5">★</span>
        <span class="star" data-value="4">★</span>
        <span class="star" data-value="3">★</span>
        <span class="star" data-value="2">★</span>
        <span class="star" data-value="1">★</span>
    </div>
    <p class="ertekelesertek"><span id="rating-value">0</span>/5</p>
    <script src="../../../assets/js/csillagertekeles.js"></script>
            
            <label for="message" style="text-align:center;">Üzenet:</label>
            <input type="text" id="message" name="message" class="beviteluzenet"><br>
            <button type="submit">Üzenet küldése</button>
        </form>
            <?php else: ?>
                   <h1 class="kapcsolatfelvetelh1">Értékelés</h2>
        <p>Ha értékelni szeretné szolgáltatásunkat, jelentkezzen be!</p> <br>
        <p>Az értékeléshez kérem jelentkezzen be!</p>
            <?php endif; ?>
    </div>
  </div>
</div>
    <?php include("../footer.php"); ?>
</body>
</html>