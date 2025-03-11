const signupForm = document.querySelector(".signup form");
const continueBtn = signupForm.querySelector(".button input");
const errorText = signupForm.querySelector(".error-txt");
//console.log(signupForm);semmi nem fog megjelenni
signupForm.onsubmit = (e) => {
    e.preventDefault();
};

continueBtn.onclick = () => {
    // Kliensoldali ellenőrzés
    if (!validateForm()) {
        return; // Ha az ellenőrzés sikertelen, megállítjuk a folyamatot
    }

    // Adatok elküldése
    const formData = new FormData(signupForm);

    fetch("PHP/signup.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success") {
            // Sikeres eset kezelése
            location.href = "users.php"; // Példa: átirányítás a users.php-re
        } else {
            errorText.style.display = "block";
            errorText.textContent = data;
        }
    })
    .catch(error => {
        console.error("Hiba történt:", error);
    });
};

function validateForm() {
    // Mezők lekérése
    const lname = signupForm.querySelector("input[name='lname']").value.trim();
    const fname = signupForm.querySelector("input[name='fname']").value.trim();
    const department = signupForm.querySelector("input[name='department']").value.trim();
    const occupation = signupForm.querySelector("input[name='occupation']").value.trim();
    const mobil = signupForm.querySelector("input[name='mobil']").value.trim();
    const email = signupForm.querySelector("input[name='email']").value.trim();
    const password = signupForm.querySelector("input[name='password']").value.trim();
    const image = signupForm.querySelector("input[name='image']").files[0];

    // Ellenőrzések
    if (!lname || !fname || !department || !occupation || !mobil || !email || !password) {
        errorText.style.display = "block";
        errorText.textContent = "Minden mezőt ki kell tölteni!";
        return false;
    }

    // Telefonszám ellenőrzése (csak számok és legalább 10 karakter)
    const phoneRegex = /^[0-9]{10,}$/;
    if (!phoneRegex.test(mobil)) {
        errorText.style.display = "block";
        errorText.textContent = "Érvényes telefonszámot adjon meg!";
        return false;
    }

    // Email formátum ellenőrzése
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errorText.style.display = "block";
        errorText.textContent = "Érvényes e-mail címet adjon meg!";
        return false;
    }

    // Jelszó hosszának ellenőrzése (legalább 6 karakter)
    if (password.length < 6) {
        errorText.style.display = "block";
        errorText.textContent = "A jelszónak legalább 6 karakter hosszúnak kell lennie!";
        return false;
    }

    // Fájl ellenőrzése (ha szükséges)
    if (!image) {
        errorText.style.display = "block";
        errorText.textContent = "Kérjük, töltsön fel egy profilképet!";
        return false;
    }

    const allowedExtensions = ["jpg", "jpeg", "png", "gif"];
    const fileExtension = image.name.split(".").pop().toLowerCase();
    if (!allowedExtensions.includes(fileExtension)) {
        errorText.style.display = "block";
        errorText.textContent = "Csak képfájlokat tölthet fel (jpg, jpeg, png, gif)!";
        return false;
    }

    // Ha minden rendben van
    errorText.style.display = "none";
    return true;
}
