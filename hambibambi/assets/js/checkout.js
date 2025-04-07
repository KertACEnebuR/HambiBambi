// Form validáció
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

  // Kosár tartalmának megjelenítése
  const cartList = document.querySelector(".cart-items");
  const totalElement = document.querySelector(".total strong");
  let totalSum = 0;

  if (cartItems.length === 0) {
      cartList.innerHTML = `
          <li class="cart-item">
              <div>
                  <h6>A kosár üres</h6>
              </div>
          </li>`;
  } else {
      cartList.innerHTML = "";
      cartItems.forEach((item) => {
          const itemTotal = item.price * item.quantity;
          totalSum += itemTotal;

          cartList.innerHTML += `
              <li class="cart-item">
                  <div>
                      <h6>${item.name}</h6>
                      <small>Mennyiség: ${item.quantity}</small>
                  </div>
                  <span>${itemTotal} Ft</span>
              </li>`;
      });

      cartList.innerHTML += `
          <li class="cart-item total">
              <span>Végösszeg:</span>
              <strong>${totalSum} Ft</strong>
          </li>`;
  }

  // Form elküldése
  form.addEventListener("submit", function (event) {
      event.preventDefault();
      
      // Ellenőrizzük, hogy van-e termék a kosárban
      if (cartItems.length === 0) {
          alert("A kosár üres, nem lehet leadni a rendelést!");
          return;
      }
      
      // Ellenőrizzük a fizetési módot
      const paymentMethod = form.querySelector('input[name="payment"]:checked');
      if (!paymentMethod) {
          alert("Kérjük, válasszon fizetési módot!");
          return;
      }
      
      // AJAX kérés a rendelés elküldéséhez
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      
      xhr.onload = function() {
          if (xhr.status === 200) {
              // Sikeres rendelés, átirányítjuk a felhasználót
              window.location.href = "../../../index.php";
          } else {
              alert("Hiba történt a rendelés feldolgozása során: " + xhr.responseText);
          }
      };
      
      xhr.onerror = function() {
          alert("Hiba történt a kérés küldése során.");
      };
      
      // Adatok összeállítása
      const data = new URLSearchParams();
      data.append("payment", paymentMethod.value);
      data.append("cartItems", JSON.stringify(cartItems));
      
      xhr.send(data.toString());
  });
});
