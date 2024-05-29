
function validateEmail() {
  const email = document.querySelector("#email");
  const emailValue = email.value;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const emailAlert = document.querySelector("#emailAlert");
  if (!emailRegex.test(emailValue)) {
    emailAlert.innerHTML = "*Please enter a valid email address.";
    email.style.borderColor = "red";
    return false;
    // formIsValid = false;
  } else {
    emailAlert.innerHTML = "";
    email.style.borderColor = "";
    return true;
  }
}
//name input validation
function validateUsername() {
  const name = document.querySelector("#userName");
  const nameValue = name.value;
  const nameAlert = document.querySelector("#nameAlert");
  if (nameValue === "" || nameValue.length >= 30) {
    nameAlert.innerHTML =
      "*User Name should be non-empty and less than 30 characters long.";
    name.style.borderColor = "red";
    return false;
    // formIsValid = false;
    //console.log(nameAlert.innerHTML);
  } else {
    nameAlert.innerHTML = "";
    name.style.borderColor = "";
    return true;
  }
}

//validate password characters
function validatePassword() {
  const pwd = document.querySelector("#password");
  const pwdValue = pwd.value;
  const pwdAlert = document.querySelector("#pwdAlert");
  if (pwdValue.length < 8) {
    pwdAlert.innerHTML = "*Passward should at least 8 characters long.";
    pwdAlert.style.color = "red";
    pwd.style.borderColor = "red";
    //console.log(pwdAlert.innerHTML);
    formIsValid = false;
  } else {
    pwdAlert.innerHTML = "";
    pwd.style.borderColor = "";
    return true;
  }
}

// Password re-type/match validation
function validatePasswordMatch() {
  const pwd = document.querySelector("#password");
  const pwdValue = pwd.value;
  const pwd2 = document.querySelector("#pass2");
  let pwd2Value = pwd2.value;
  const pwd2Alert = document.querySelector("#pwd2Alert");
  if (pwdValue !== pwd2Value || pwd2Value === "") {
    pwd2Alert.innerHTML = "*Re-check your input or Re-type.";
    pwd2.style.borderColor = "red";
    //console.log(pwd2Alert.innerHTML);
  } else {
    pwd2Alert.innerHTML = "";
    pwd2.style.borderColor = "";
    return true;
  }
}

// Terms and conditions validation
function validateTerms() {
  const terms = document.querySelector("#terms");
  const termsAlert = document.querySelector("#termsAlert");
  if (!terms.checked) {
    termsAlert.innerHTML = "*Please accept the terms and conditons.";
    formIsValid = false;
  } else {
    termsAlert.innerHTML = ""; // Clear message if terms are accepted
    return true;
  }
}

document.querySelector("#email").addEventListener("input", validateEmail);
document.querySelector("#userName").addEventListener("input", validateUsername);
document.querySelector("#password").addEventListener("input", validatePassword);
document
  .querySelector("#pass2")
  .addEventListener("input", validatePasswordMatch);
document.querySelector("#terms").addEventListener("change", validateTerms);

//define validatr function based the seperated validate result
function validate() {
  const isValidEmail = validateEmail();
  const isValidUsername = validateUsername();
  const isValidPassword = validatePassword();
  const isValidPasswordMatch = validatePasswordMatch();
  const isValidTerms = validateTerms();

  if (
    !isValidEmail ||
    !isValidUsername ||
    !isValidPassword ||
    !isValidPasswordMatch ||
    !isValidTerms
  ) {
    return false;
  }
  return true;
}
