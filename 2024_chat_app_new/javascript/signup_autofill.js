document.addEventListener("DOMContentLoaded", () => {
    // Automatikusan kitöltendő adatok
    const formData = {
        lname: "Koczka",
        fname: "Balázs",
        department: "Fejlesztés",
        occupation: "Programozó",
        mobil: "06701234567",
        email: "koczka.balazs@gmail.com",
        password: "titkosjelszo",
        image: null // vagy adj meg egy elérési utat: "path/to/image.jpg"
    };

    // Mezők kitöltése
    document.querySelector("input[name='lname']").value = formData.lname;
    document.querySelector("input[name='fname']").value = formData.fname;
    document.querySelector("input[name='department']").value = formData.department;
    document.querySelector("input[name='occupation']").value = formData.occupation;
    document.querySelector("input[name='mobil']").value = formData.mobil;
    document.querySelector("input[name='email']").value = formData.email;
    document.querySelector("input[name='password']").value = formData.password;

    /* fájlfeltöltést nem lehet programból automatikusan végrehajtani a biztonság miatt*/

});
