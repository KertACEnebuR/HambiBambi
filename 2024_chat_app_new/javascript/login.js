
const form = document.querySelector(".login form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
    e.preventDefault();
};

continueBtn.onclick = () => {
    // Adatok elküldése
    const formData = new FormData(form);

    fetch("PHP/login.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === "success") {
            // Sikeres eset kezelése
            window.location.href = "users.php"; // Átirányítás a chat felületre
        } else {
            errorText.style.display = "block";
            errorText.textContent = data;
        }
    })
    .catch(error => {
        console.error("Hiba történt:", error);
    });
};

 