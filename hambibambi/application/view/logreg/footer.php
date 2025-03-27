    <footer>
    <nav>
            <ul class="navbar">
                <li><a href=<?= $Path."index.php";?>>Kezdőlap</a></li>
                <li><a href=<?= $Path."application/view/menu/menu.php";?>>Étlap</a></li>
                <li><a href=<?= $Path."application/view/contacts/contact.php";?>>Kapcsolat</a></li>
                <li><a href=<?= $Path."application/view/logreg/loginreg.php";?>>Belépés / Regisztráció</a></li>
            </ul>
        </nav>
        <h3>HambiBambi Étterem</h3>
        <div class="logo">
            <img src="<?= $Path."assets/img/HambiBambi_Logo.png"?>" alt="HambiBambi Étterem Logó">
        </div>  
        
    </footer>
        <script>
        var counties = <?= json_encode($counties, JSON_UNESCAPED_UNICODE); ?>;
        </script>
        <script>
        function updateSettlements() {
            const countySelect = document.getElementById('county');
            const settlementSelect = document.getElementById('settlement');
            const selectedCounty = countySelect.value;

            // Töröljük a meglévő településeket
            settlementSelect.innerHTML = '<option value="">Válasszon</option>';

            // Hozzáadjuk az új településeket, ha léteznek
            if (counties[selectedCounty]) {
                counties[selectedCounty].forEach(settlement => {
                    const option = document.createElement('option');
                    option.value = settlement;
                    option.textContent = settlement;
                    settlementSelect.appendChild(option);
                });
            }
        }
        </script>
    <script src="../../../assets/js/loginreg.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>