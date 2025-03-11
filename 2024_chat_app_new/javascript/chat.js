document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".typing-area");
    const inputField = form.querySelector(".input-field");
    const sendBtn = document.querySelector(".send-btn");
    const chatBox = document.querySelector(".chat-box");
    const fileInput = document.getElementById("file-upload");
    const insertChatURL = "php/insert-chat.php";
    const getChatURL = "php/get-chat.php";

    // Űrlap elküldésének meggátolása és Ajax hívás kezelése
    form.onsubmit = (e) => {
        e.preventDefault();

        // Adatok összegyűjtése
        const formData = new FormData(form);

        // Ha van fájl kiválasztva, azt is hozzáadjuk a formData-hoz
        if (fileInput.files.length > 0) {
            formData.append('image', fileInput.files[0]);
        }

        console.log("Elküldött adatok:", formData); // Ellenőrzés a konzolban
        performAjaxRequest(insertChatURL, "POST", formData, (response) => {
            console.log("Válasz a szervertől:", response); // Ellenőrzés a szerver válaszáról
            inputField.value = ""; // Szövegmező kiürítése
            fileInput.value = "";  // Fájlfeltöltés törlése
            scrollToBottom();
        });
    }

    // Üzenetek frissítése 500 ms-enként
    setInterval(() => {
        const formData = new FormData(form);
        performAjaxRequest(getChatURL, "POST", formData, (data) => {
            chatBox.innerHTML = data;
            if (!chatBox.classList.contains("active")) {
                scrollToBottom();
            }
        });
    }, 500);

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function performAjaxRequest(url, method, formData, callback) {
        const xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                callback(xhr.response);
            }
        };
        xhr.send(formData);
    }
});
