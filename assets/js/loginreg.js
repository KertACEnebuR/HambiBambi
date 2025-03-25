const LOGIN_TAB        = document.querySelector(".login-tab");
const REGISTRATION_TAB = document.querySelector(".registration-tab");

const LOGIN_FORM        = document.querySelector(".login-form");
const REGISTRATION_FORM = document.querySelector(".registration-form");

function changeTab(e) {
    if (LOGIN_TAB.classList.contains("active")) {

        LOGIN_TAB.classList.remove('active');
        REGISTRATION_TAB.classList.add('active');
        
        LOGIN_FORM.classList.remove('active');
        REGISTRATION_FORM.classList.add('active');

    } else {

        LOGIN_TAB.classList.add('active');
        REGISTRATION_TAB.classList.remove('active');

        LOGIN_FORM.classList.add('active');
        REGISTRATION_FORM.classList.remove('active');

    }
}

function sendLogin (e) {
  console.log(e);
  //e.preventDefault();
  //alert("sendlogin");

  let email    = document.querySelector(".email").value;
  let password = document.querySelector(".password").value;

  // Your JSON data
  const jsonData = { c: 'login', email:email, password:password };

  // Set up options for the fetch request
  const options = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json' // Set content type to JSON
    },
    body: JSON.stringify(jsonData) // Convert JSON data to a string and set it as the request body
  };

  // Make the fetch request with the provided options
  fetch('../../controller/loginController.php', options)
    .then(response => {
      // Check if the request was successful
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      // Parse the response as JSON
      return response.json();
    })
    .then(data => {
      if(data.message != "") {
        document.querySelector(".statusMessage").innerHTML = data.message;
        document.querySelector(".statusMessage").classList.remove("hide");
        document.querySelector(".statusMessage").classList.add("show");
      } else {
        document.querySelector(".statusMessage").classList.remove("show");
        document.querySelector(".statusMessage").classList.add("hide");
        document.querySelector(".statusMessage").innerHTML = "";

      }
  })
  .catch(error => {
    // Handle any errors that occurred during the fetch
    console.error('Fetch error:', error);
  });    
}
