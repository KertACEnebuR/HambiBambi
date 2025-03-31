<?php 
session_start();
include_once "../../../connect.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Hozzáférés megtagadva!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    // Sanitize and validate inputs
    $full_name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $county_name = mysqli_real_escape_string($conn, $_POST['county_name']);
    $settlement_name = mysqli_real_escape_string($conn, $_POST['settlement_name']);
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Érvénytelen e-mail cím formátum.";
        exit();
    }

    // Verify the password
    $sql = "SELECT password FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!password_verify($password, $row['password'])) {
        echo "Hibás jelszó!";
        exit();
    }

    // Update the user's data
    $update_query = "
        UPDATE users 
        SET 
            full_name = '$full_name', 
            email = '$email', 
            phone_number = '$phone_number', 
            address = '$address', 
            settlement_id = (
                SELECT settlement_id 
                FROM settlements 
                WHERE settlement_name = '$settlement_name'
            )
        WHERE user_id = '$user_id'
    ";

    if (mysqli_query($conn, $update_query)) {
        echo "success";
    } else {
        echo "Hiba történt az adatok frissítése során: " . mysqli_error($conn);
    }
} else {
    //űrlap adatok beolvasása
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM users
            LEFT JOIN settlements 
            ON users.settlement_id = settlements.settlement_id
            LEFT JOIN counties 
            ON settlements.county_id = counties.county_id  
            WHERE user_id = {$user_id}";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $row = mysqli_fetch_assoc($result);

    $full_name = $row['full_name'] ?? "Nincs adat";
    $email = $row['email'] ?? "Nincs adat";
    $phone_number = $row['phone_number'] ?? "Nincs adat";
    $address = $row['address'] ?? "Nincs adat";
    $settlementName = $row['settlement_name'] ?? "Nincs adat";
    $countyName = $row['county_name'] ?? "Nincs adat";
    $hash = $row['password'] ?? "Nincs adat"; //a titkosított jelszó beolvasása
    $writtenpass = "" ?? "Nincs adat";
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../../assets/css/main.css">
    <title>Chat</title>
</head>
<body>

<div class="content">
    <div class="wrapper">
        <section class="form signup">
            <header>
                <h1>Adatok módosítása</h1>
            </header>
            <form action="#" enctype="multipart/form-data" autocomplete="off">
                <div class="error-txt"></div>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
                <div class="field input">
                    <label>Teljes név:</label>
                    <input type="text" placeholder="Teljes név" name="fullname" value="<?php echo $full_name; ?>" required>
                </div>
                <div class="field input">
                    <label>E-mail:</label>
                    <input type="email" placeholder="E-mail cím" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="field input">
                    <label>Telefonszám:</label>
                    <input type="text" placeholder="Telefonszám" name="phone_number" value="<?php echo $phone_number; ?>" required>
                </div>
                <div class="field input">
                    <label>Megye:</label>
                    <input type="text" placeholder="Megye" name="county_name" value="<?php echo $countyName; ?>" required>
                </div>
                <div class="field input">
                    <label>Település:</label>
                    <input type="text" placeholder="Település" name="settlement_name" value="<?php echo $settlementName; ?>" required>
                </div>
                <div class="field input">
                    <label>Lakcím:</label>
                    <input type="text" placeholder="Lakcím" name="address" value="<?php echo $address; ?>" required>
                </div>
                <div class="field input">
                        <label>Jelszó:</label>
                        <input type="password" placeholder="Jelszó" name="password" value="<?php print $password; ?>" required><i class="fas fa-eye"></i>
                    </div>
                <div class="field button">
                    <input type="submit" value="Módosítások mentése">
                </div>
            </form>
        </section>
    </div>
</div>

<script>
    const form = document.querySelector(".signup form");
    const continueBtn = form.querySelector(".button input");
    const errorText = document.querySelector(".error-txt");

    form.onsubmit = (e) => {
        e.preventDefault();
    };

    continueBtn.onclick = () => {
        // AJAX
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "PHP/update.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "success") {
                        location.href = "profile.php";
                    } else {
                        errorText.textContent = data;
                        errorText.style.display = "block";
                    }
                }
            }
        };

        // Send form data via AJAX
        let formData = new FormData(form);
        xhr.send(formData);
    };

    // Password toggle
    const pswrField = document.querySelector(".form .field input[type='password']");
    const toggleBtn = document.querySelector(".form .field i");

    toggleBtn.onclick = () => {
        if (pswrField.type === "password") {
            pswrField.type = "text";
            toggleBtn.classList.add("active");
        } else {
            pswrField.type = "password";
            toggleBtn.classList.remove("active");
        }
    };
</script>
</body>

</html>