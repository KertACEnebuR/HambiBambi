// Form validáció
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    const inputs = form.querySelectorAll("input, select");
    let isValid = true;

    inputs.forEach((input) => {
      if (!input.checkValidity()) {
        isValid = false;
        input.classList.add("invalid");
      } else {
        input.classList.remove("invalid");
      }
    });

    if (!isValid) {
      event.preventDefault();
      alert("Kérjük, töltse ki az összes kötelező mezőt!");
    }
  });
});

// Kosár tartalmának betöltése
document.addEventListener("DOMContentLoaded", function () {
  const cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
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
    cartList.innerHTML = ""; // Kosár tartalmának törlése
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
});

