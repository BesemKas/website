const signup = document.getElementById("signup");
const firstname = document.getElementById("Firstname");
const lastname = document.getElementById("Lastname");
const email = document.getElementById("email");
const phoneNum = document.getElementById("phoneNum");
const password = document.getElementById("password");
const passwordCon = document.getElementById("passwordCon");

const signUpElements = [
  firstname,
  lastname,
  email,
  phoneNum,
  password,
  passwordCon,
];

signup.addEventListener("submit", async function (signup_event) {
  signup_event.preventDefault();

  const isValid = await ValidateForm();

  if (isValid) {
    signup.submit();
  }
});

function setError(element, message) {
  const inputGroup = element.parentElement;
  const inputControl = inputGroup.parentElement;
  const errorDisplay = inputControl.querySelector(".errordisp");

  errorDisplay.innerText = message;

  //ADD error class to the inputcontrol
  inputControl.classList.add("error");
}

function clearError(element) {
  const inputGroup = element.parentElement;
  const inputControl = inputGroup.parentElement;
  const errorDisplay = inputControl.querySelector(".errordisp");

  errorDisplay.innerText = "";
  inputControl.classList.remove("error");
}

// function ValidateFormValues(event, Elements) {

//     for (const element of Elements) {
//         if (element.value.trim() === '') {
//             setError(element, "This field is required!");
//             event.preventDefault();
//         } else {
//             clearError(element);
//         }
//     }

// }

function fetchEmail(emailValue) {
  const url = `./phpScripts/validate-email.php?email=${encodeURIComponent(
    emailValue
  )}`;

  return fetch(url)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      return data.available;
    })
    .catch(function (error) {
      console.error("Error fetching data:", error);
      return false;
    });
}

async function ValidateForm() {
  const nameV = firstname.value.trim();
  const surnameV = lastname.value.trim();
  const emailV = email.value.trim();
  const phone = phoneNum.value.trim();
  const password1 = password.value.trim();
  const password2 = passwordCon.value.trim();
  let valid = true;

  //patterns
  const letterTest = /[a-zA-Z]/;
  const specialTest = /[@#$%*!^&]/;
  const emailTest =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  const signUpElements = [
    firstname,
    lastname,
    email,
    phoneNum,
    password,
    passwordCon,
  ];

  //check if any fields are empty
  for (const element of signUpElements) {
    if (element.value.trim() === "") {
      setError(element, "This field is required!");
      valid = false;
    } else {
      clearError(element);
    }
  }

  //password check
  if (password1.length < 8) {
    setError(password, "Password must have at least 8 characters.");
    valid = false;
  } else if (!letterTest.test(password1)) {
    setError(password, "Password must contain atleast one letter.");
    valid = false;
  } else if (!specialTest.test(password1)) {
    setError(password, "Password must contain at least one special character.");
    valid = false;
  } else if (password1 !== password2) {
    setError(passwordCon, "Passwords must match.");
    valid = false;
  } else {
    clearError(password);
    clearError(passwordCon);
  }

  //EMAIL CHECK
  if (!emailTest.test(emailV)) {
    setError(email, "Enter a valid email address.");
    return false;
  }

  const isAvailable = await fetchEmail(emailV);
  if (!isAvailable) {
    setError(email, "this email is already taken.");
    return false;
  } else {
    clearError(email);
  }

  return valid;
}
