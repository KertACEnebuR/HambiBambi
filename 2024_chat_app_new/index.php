<?php
require("php/connect.php");

/* Beállítások */
$sql = "SELECT *
		FROM users";
$result = mysqli_query($conn, $sql);

$alluser = mysqli_num_rows($result);
$pax = 9;
$pages = ceil($alluser / $pax); //ceil felfelé kerekít
$actual = (isset($_GET['site'])) ? (int) $_GET['site'] : 1;
$from = ($actual - 1) * $pax;

/* Lapozó */
$pagination = "<p>";
$pagination .= ($actual != 1) ? "<a href=\"?site=1\">Első</a> | " : "Első | ";

$pagination .= ($actual > 1 && $actual <= $pages) ? "<a href=\"?site=" . ($actual - 1) . "\">Előző</a> | " : "Előző | ";

for ($site = 1; $site <= $pages; $site++) {
  $pagination .= ($actual != $site) ? "<a href=\"?site={$site}\">{$site}</a> | " : $site . " | ";
}
$pagination .= ($actual > 0 && $actual < $pages) ? "<a href=\"?site=" . ($actual + 1) . "\">Következő</a> | " : "Következő | ";
$pagination .= ($actual != $pages) ? "<a href=\"?site=10\">Utolsó</a>" : "Utolsó";
$pagination .= "</p>";


$search = (isset($_POST['search'])) ? $_POST['search'] : "";
$sql = "SELECT *
		FROM users
		WHERE (
			fname LIKE '%{$search}%'
      OR lname LIKE '%{$search}%'
      OR department LIKE '%{$search}%'
			OR occupation LIKE '%{$search}%'
			OR mobil LIKE '%{$search}%'
			OR email LIKE '%{$search}%'
		)
		ORDER BY fname ASC
		LIMIT {$from}, {$pax}";
$result = mysqli_query($conn, $sql);

if (@mysqli_num_rows($result) < 1) {
  $output = "<article>
		<h2>Nincs találat a rendszerben!</h2>
	</article>\n";
} else {
  $output = "";
  while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<article>
		
			<img src=\"php/images/{$row['img']}\" alt=\"{$row['fname']}{$row['lname']}\">
      <section>
			<h4>{$row['fname']} {$row['lname']}</h4>
      <p><b>{$row['department']}</b></p>
			<p><b><i>{$row['occupation']}</i></b></p>
			<p>Telefon: <a href=\"tel:{$row['mobil']}\">{$row['mobil']}</a></p>
			<p>E-mail: <a href=\"mailto:{$row['email']}\">{$row['email']}</a></p>
      </section>
		</article>\n";
  }
}
?>
<!DOCTYPE html>
<html lang="hu">

<?php include_once "head.php"; ?>

<body>
  <!-- Menu -->
  <?php include_once "navigation.php"; ?>

  
  <!--Regisztrált felhasználók-->
  <main>
    <h1>Regisztrált munkatársaink</h1>
    <h3>Üzenet küldéshez, kérjük regisztráljon rendszerünkbe!</h3>

    <?php print $pagination; ?>
    <div class="container">
      <?php print $output; ?>
    </div>
    <?php print $pagination; ?>
  </main>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</body>
</html>