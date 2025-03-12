document.addEventListener("DOMContentLoaded", function() {
    // Kosár ikon, bezáró gomb és kosár doboz
    const cartIcon = document.querySelector('.kosarikon');
    const cartCloseBtn = document.querySelector('.fa-close');
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

    // Kosárba rakás (AngularJS termékkártyák figyelése)
    document.querySelectorAll('.kosarhoz').forEach(button => {
        button.addEventListener("click", function(e) {
            if (typeof(Storage) !== 'undefined') {
                //let productCard = e.target.closest('.product');
                let productName = productCard.querySelector('.card-title').innerText;
                let productPrice = parseInt(productCard.querySelector('.ar').innerText);
                let productQuantity = parseInt(productCard.querySelector('.quantity').value);
                let productImage = productCard.querySelector('img').src;

                let item = {
                    id: productName + "-" + productPrice, // Egyedi azonosító
                    name: productName,
                    price: productPrice,
                    quantity: productQuantity,
                    image: productImage
                };

                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                // Ha már benne van a termék, akkor csak a mennyiséget növeljük
                let existingItem = cartItems.find(data => data.id === item.id);
                if (existingItem) {
                    existingItem.quantity += item.quantity;
                } else {
                    cartItems.push(item);
                }

                localStorage.setItem("cartItems", JSON.stringify(cartItems));
                updateCartCounter();
                updateCartBox();
            } else {
                alert('A helyi tárolás nem támogatott az Ön böngészőjében!');
            }
        });
    });

    // Kosár ikon számláló frissítése
    function updateCartCounter() {
        const cartIconCounter = document.querySelector('.kosarikon p');
        let totalQuantity = 0;
        const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        cartItems.forEach(data => {
            totalQuantity += data.quantity;
        });
        if (cartIconCounter) {
            cartIconCounter.innerText = totalQuantity;
        }
    }

    // Kosár tartalmának frissítése
    function updateCartBox() {
        if (cartBox) {
            const cartBoxTable = cartBox.querySelector('table');
            if (cartBoxTable) {
                let tableData = '<tr><th>Termék</th><th>Név</th><th>Mennyiség</th><th>Ár</th><th></th></tr>';
                let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

                if (cartItems.length === 0) {
                    tableData += '<tr><td colspan="5">A kosár üres</td></tr>';
                } else {
                    cartItems.forEach(data => { 
                        let totalPrice = data.price * data.quantity;
                        tableData += `<tr>
                            <td><img src="${data.image}" width="50"></td>
                            <td>${data.name}</td>
                            <td>${data.quantity}</td>
                            <td class="prices">${totalPrice} Ft</td>
                            <td><a href="#" onclick="Delete('${data.id}');">Törlés</a></td>
                        </tr>`;            
                    });
                }

                let totalSum = cartItems.reduce((sum, data) => sum + data.price * data.quantity, 0);
                tableData += `<tr>
                    <th colspan="3"><a href="megrendeles.html">Megrendelés</a></th>
                    <th>${totalSum} Ft</th>
                    <th><a href="#" onclick="clearAll();">Minden törlése</a></th>
                </tr>`;

                cartBoxTable.innerHTML = tableData;
            }
        }
    }

    // Elemet törlő függvény
    window.Delete = function(itemId) {
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        cartItems = cartItems.filter(data => data.id !== itemId);
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartCounter();
        updateCartBox();
    };

    // Kosár teljes törlése
    window.clearAll = function() {
        localStorage.removeItem('cartItems');
        updateCartCounter();
        updateCartBox();
    };

    // Indításkor frissítjük az adatokat
    updateCartCounter();
    updateCartBox();
});
