//elemek összegyűjtése
const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button");
const usersList = document.querySelector(".users .users-list");

/*változó nevéhez onclik eventhandler hozzárendelése, esemény estén arrow function futása, lényegében  eseménykezelőt definiál azáltal, hogy egy "keresés" gombra való kattintáskor néhány műveletet hajt végre a DOM elemeken*/
searchBtn.onclick = ()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

searchBar.onkeyup = ()=> {
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }

    fetchUserList(searchTerm); // hívjuk meg a fetchUserList-et a kereséskor
}

function fetchUserList(searchTerm) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data); // Ide tegyél egy logot, hogy lásd, mit kapsz vissza
                usersList.innerHTML = data;
            }
        }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

// Felhasználói lista frissítése 500 ms-enként
setInterval(() => {
    // Ajax hívás a felhasználói listához
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // Ha a keresőmező nincs aktív állapotban, akkor frissítjük a felhasználói listát
                if (!searchBar.classList.contains("active")) {
                    usersList.innerHTML = data;
                }
            }
        }
    };
    xhr.send();
}, 500);

document.addEventListener("DOMContentLoaded", () => {
    const postForm = document.getElementById("postForm");
    const postsFeed = document.querySelector(".posts-feed");

    // Bejegyzés létrehozása
    postForm.onsubmit = (e) => {
        e.preventDefault();
        const formData = new FormData(postForm);

        fetch("php/save-post.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Ellenőrizheted, hogy sikeres volt-e
            loadPosts(); // Frissítjük az üzenőfalat
            postForm.reset(); // Törli az űrlap tartalmát
        });
    };

    // Bejegyzések betöltése
    function loadPosts() {
        fetch("php/get-posts.php")
        .then(response => response.text())
        .then(data => {
            postsFeed.innerHTML = data;
        });
    }

    // Az oldal betöltésekor betöltjük a bejegyzéseket
    loadPosts();
});

