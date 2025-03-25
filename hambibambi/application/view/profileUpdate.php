<?php 
session_start();
/*
if(!isset($_SESSION['user_id'])){//ha a user nincs van lépve
    header("location:index.php");
}*/

include_once "../../connect.php";
//űrlap adatok beolvasása
$user_id = $_SESSION['user_id'];


    $sql = "SELECT * FROM users WHERE user_id LIKE '{$user_id}'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    
        $fullname = $row['fullname'];
        $email = $row['email'];
        $phone_number = $row['phone_number'];
        $address = $row['address'];
        $settlementName = $row['settlement_name'];
        $countyName = $row['county_name'];
        $hash = $row['password']; //a titkosított jelszó beolvasása
        $writtenpass = "";
    } else {
        // Ha nincs eredmény, állíts be alapértelmezett értékeket
        $fullname = "Nincs adat";
        $email = "Nincs adat";
        $phone_number = "Nincs adat";
        $address = "Nincs adat";
        $settlementName = "Nincs adat";
        $countyName = "Nincs adat";
        $hash = "Nincs adat";
    };


?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../assets/css/main.css">
    <title>Chat</title>
</head>
<body>

<div class="content">
    <div class="wrapper">
        <section class="form signup">
            <header>
                Adatok módosítása
            </header>
            <form action="#" enctype="multipart/form-data" autocomplete="off">
                <div class="error-txt"></div>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
                <div class="field input">
                    <label>Teljes név:</label>
                    <input type="text" placeholder="Teljes név" name="fullname" value="<?php echo $fullname; ?>" required>
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
                    <label>Lakcím:</label>
                    <input type="text" placeholder="Lakcím" name="address" value="<?php echo $address; ?>" required>
                </div>
                <div class="field input">
                    <label>Település:</label>
                    <input type="text" placeholder="Település" name="settlement_name" value="<?php echo $settlementName; ?>" required>
                </div>
                <div class="field input">
                    <label>Megye:</label>
                    <input type="text" placeholder="Megye" name="county_name" value="<?php echo $countyName; ?>" required>
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
        // Elemek kiválasztása a DOM-ból
        const form = document.querySelector(".signup form");
        const continueBtn = form.querySelector(".button input");
        const errorText = document.querySelector(".error-txt");

        form.onsubmit = (e)=>{
            e.preventDefault();
        }

        continueBtn.onclick = ()=>{
        //Ajax
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "PHP/update.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    //console.log(data);
                    if(data == "success"){
                        location.href = "profile.php"
                    }else{
                        errorText.textContent = data;
                        errorText.style.display = "block";               
                    }
                }
            }
        }

        //az adatokat el kell küldenünk az ajaxon keresztül a PHP-nek
        let formData = new FormData(form);
        xhr.send(formData);
        }

        const pswrField = document.querySelector(".form .field input[type='password']"),
        toggleBtn = document.querySelector(".form .field i");

        toggleBtn.onclick = ()=>{
            if(pswrField.type == "password"){
                pswrField.type = "text";
                toggleBtn.classList.add("active");
            }else{
                pswrField.type = "password";
                toggleBtn.classList.remove("active");
            }
        }
    </script>
</body>

</html>