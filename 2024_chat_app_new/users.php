<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit();
}

include_once "head.php";

include_once "php/connect.php";
$sql = mysqli_query($conn, "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
}
?>

<body >
    <?php include_once "navigation.php"; ?>
    <div class="users-posts">
    <div class="content">
        <div class="wrapper">
            <section class="users">
                <header>
                    <div class="content">
                        <img src="php/images/<?php echo $row['img']; ?>" alt="">
                        <div class="details">
                            <span><a href="profile.php"><?php echo $row['lname'] . " " . $row['fname'] ?></a></span>
                            <p><?php echo $row['status'] ?></p>
                        </div>
                    </div>
                    <a href="php/logout.php?logout_id=<?php echo $row['user_id'] ?>" class="logout">Kilépés</a>
                    <a href="index.php" class="logout">Főoldal</a>
                </header>
                <div class="search">
                    <span class="text">Válassz felhasználót a chat indításához!</span>
                    <input type="text" placeholder="Írjon be nevet a kereséshez!">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list"></div>
            </section>
           
        </div>
    </div>
    <section class="post-section">
                <div class="create-post">
                    <form id="postForm" enctype="multipart/form-data">
                        <textarea name="content" placeholder="Mit szeretnél megosztani?" required></textarea>
                        <label for="post-image" class="photo-icon"><i class="fas fa-camera"></i></label>
                        <input type="file" id="post-image" name="post_image" style="display: none;">
                        <button type="submit" class="post-btn">Megosztás</button>
                    </form>
                </div>
                <div class="posts-feed">
                    <!-- Bejegyzések ide fognak kerülni -->
                </div>
            </section>
            </div>
    <script src="javascript/users.js"></script>

</body>

</html>