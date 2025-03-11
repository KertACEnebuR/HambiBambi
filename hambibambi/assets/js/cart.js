document.addEventListener("DOMContentLoaded", function() {
    // Kosár ikon
    const cartIcon = document.querySelector('.kosarikon');
    // Kosár bezáró gomb a felugró ablakban
    const cartCloseBtn = document.querySelector('.fa-close');
    // Kosár felugró ablak doboz
    const cartBox = document.querySelector('.cartBox');

    // Kosár megjelenítése
    if (cartIcon && cartBox) {
        cartIcon.addEventListener("click", function() {
            cartBox.classList.add('active');
        });
    }

    // Kosár bezárása
    if (cartCloseBtn && cartBox) {
        cartCloseBtn.addEventListener("click", function() {
            cartBox.classList.remove('active');
        });
    }

    // Kosárhoz hozzáadott gombok
    const addToCartButtons = document.getElementsByClassName('kosarhoz');
    let cartItems = [];

    // Hozzáadás a kosárhoz
    for (let i = 0; i < addToCartButtons.length; i++) {
        addToCartButtons[i].addEventListener("click", function(e) {
            if (typeof(Storage) !== 'undefined') {
                let item = {               
                    id: i + 1,
                    name: e.target.parentElement.children[0].innerHTML,
                    price: parseInt(e.target.parentElement.children[1].innerHTML),
                    quantity: parseInt(e.target.parentElement.children[2].value)
                };

                let storedItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                let existingItem = storedItems.find(data => data.id === item.id);
                if (existingItem) {
                    existingItem.quantity += item.quantity;
                } else {
                    storedItems.push(item);
                }

                localStorage.setItem("cartItems", JSON.stringify(storedItems));
                window.location.reload();
            } else {
                alert('A helyi tárolás nem támogatott az Ön böngészőjében!');
            }
        });
    }

    // Kosár ikon számláló frissítése
    const cartIconCounter = document.querySelector('.kosarikon p');
    let totalQuantity = 0;
    const storedCartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    storedCartItems.forEach(data => {
        totalQuantity += data.quantity;
    });

    if (cartIconCounter) {
        cartIconCounter.innerHTML = totalQuantity;
    }

    // Kosár tartalmának frissítése a felugró ablakban
    if (cartBox) {
        const cartBoxTable = cartBox.querySelector('table');
        if (cartBoxTable) {
            let tableData = '<tr><th>Termék ID</th><th>Termék Név</th><th>Mennyiség</th><th>Ár</th><th></th></tr>';

            if (storedCartItems.length === 0) {
                tableData += '<tr><td colspan="5">A kosár üres</td></tr>';
            } else {
                storedCartItems.forEach(data => { 
                    let totalPrice = data.price * data.quantity;
                    tableData += `<tr>
                        <td>${data.id}</td>
                        <td>${data.name}</td>
                        <td>${data.quantity}</td>
                        <td class="prices">${totalPrice}</td>
                        <td><a href="#" onclick="Delete(${data.id});">Törlés</a></td>
                    </tr>`;            
                });
            }

            let totalSum = storedCartItems.reduce((sum, data) => sum + data.price * data.quantity, 0);
            tableData += `<tr>
                <th colspan="3"><a href="megrendeles.html">Megrendelés</a></th>
                <th>${totalSum}</th>
                <th><a href="#" onclick="clearAll();">Minden törlése</a></th>
            </tr>`;

            cartBoxTable.innerHTML = tableData;
        }
    }
});

// Törlés egy adott termékre
function Delete(itemId) {
    let storedItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    storedItems = storedItems.filter(data => data.id !== itemId);
    localStorage.setItem('cartItems', JSON.stringify(storedItems));
    window.location.reload();
}

// Kosár teljes törlése
function clearAll() {
    localStorage.removeItem('cartItems');
    window.location.reload();
}
