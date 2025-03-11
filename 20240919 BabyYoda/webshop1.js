window.onload = function() {

    // Tároljuk a kosár ikonját egy változóba
    const cartIcon = document.querySelector('.kosarikon');
    // Kosár bezáró gomb a felugró ablakban
    const cartCloseBtn = document.querySelector('.fa-close');
    // Kosár felugró ablak doboz
    const cartBox = document.querySelector('.cartBox');

    // Megjelenítjük a felugró ablakot, amikor a kosár ikonra kattintunk
    cartIcon.addEventListener("click", function() {
        cartBox.classList.add('active');
    });

    // Bezárjuk a felugró ablakot, amikor a kosár bezáró gombra kattintunk
    cartCloseBtn.addEventListener("click", function() {
        cartBox.classList.remove('active');
    });

    // Kosárhoz hozzáadott gombok kiválasztása
    const addToCartButtons = document.getElementsByClassName('kosarhoz');
    
    // Létrehozunk egy üres tömböt a kosárban lévő elemek számára
    let cartItems = [];
    
    // Minden "hozzáadás a kosárhoz" gombhoz hozzáadunk egy eseménykezelőt
    for (let i = 0; i < addToCartButtons.length; i++) {
        addToCartButtons[i].addEventListener("click", function(e) {
            if (typeof(Storage) !== 'undefined') {
                // Új termék objektum létrehozása
                let item = {               
                    id: i + 1,
                    name: e.target.parentElement.children[0].innerHTML,
                    price: parseInt(e.target.parentElement.children[1].innerHTML),
                    quantity: parseInt(e.target.parentElement.children[2].value)
                };

                // Ha a kosár üres, akkor hozzáadjuk az új elemet
                if (JSON.parse(localStorage.getItem('cartItems')) === null) {
                    cartItems.push(item);
                    localStorage.setItem("cartItems", JSON.stringify(cartItems));
                    window.location.reload();
                } else {
                    // Ha a kosár nem üres, akkor frissítjük az elemeket
                    const storedItems = JSON.parse(localStorage.getItem("cartItems"));
                    storedItems.map(data => {
                        if (item.id == data.id) {
                            item.quantity += data.quantity;
                        } else {
                            cartItems.push(data);
                        }
                    });
                    cartItems.push(item);
                    localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    window.location.reload();
                }
            } else {
                alert('A helyi tárolás nem támogatott az Ön böngészőjében!');
            }
        });
    }

    // Kosár ikon számláló frissítése
    const cartIconCounter = document.querySelector('.kosarikon p');
    let totalQuantity = 0;
    JSON.parse(localStorage.getItem('cartItems')).map(data => {
        totalQuantity += data.quantity;
    });
    cartIconCounter.innerHTML = totalQuantity; // Kosár ikon számláló frissítése

    // Kosár tartalmának hozzáadása a felugró ablak táblázatához
    const cartBoxTable = cartBox.querySelector('table');
    let tableData = '';
    tableData += '<tr><th>Termék ID</th><th>Termék Név</th><th>Mennyiség</th><th>Ár</th><th></th></tr>';
    
    if (JSON.parse(localStorage.getItem('cartItems'))[0] === null) {
        tableData += '<tr><td colspan="5"></td></tr>';
    } else {
        JSON.parse(localStorage.getItem('cartItems')).map(data => { 
            let totalPrice = data.price * data.quantity;
            tableData += '<tr><th>' + data.id + '</th><th>' + data.name + '</th><th>' + data.quantity + '</th><th class="prices">'+ totalPrice + '</th><th><a href="#" onclick=Delete(this);>Törlés</a></th></tr>';            
        });
    }
    
    let totalSum = 0;
    JSON.parse(localStorage.getItem('cartItems')).map(data => {
        totalSum += data.price * data.quantity;
    });
    tableData += '<tr><th colspan="3"><a href="order.html">Megrendelés</a></th><th>'+ totalSum +'</th><th><a href="#" onclick=clearAll();>Minden törlése</a></th></tr>';
    cartBoxTable.innerHTML = tableData;
}

function Delete(elem) {
    // Kosár elemek frissítése törlés után
    let cartItems = [];
    JSON.parse(localStorage.getItem('cartItems')).map(data => {
        if (data.id != elem.parentElement.parentElement.children[0].textContent) {
            cartItems.push(data);
        }
    });
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    window.location.reload();
}

function clearAll() {
    // Kosár teljes törlése
    let cartItems = [];
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    window.location.reload();
}
