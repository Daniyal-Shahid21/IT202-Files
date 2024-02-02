function emailReq() {
  var checkBox = document.getElementById("confirm");
  var text = document.getElementById("reqtext");
  if (checkBox.checked == true){
    text.style.visibility = "visible";
  } 
  else {
     text.style.visibility = "hidden";
  }
}

function showFailedAlert(message) {
  var audio = document.getElementById("alertAudio");
  audio.play();
  alert(message);
}

function showValidAlert(message) {
  var audio = document.getElementById("yippeeAudio");
  audio.play();
  alert(message);
}

let form = document.querySelector("form");
form.addEventListener("submit", validation);
function validation(event) {
  let fnval = document.forms["HoHSIPage"]["fname"].value;
  let lnval = document.forms["HoHSIPage"]["lname"].value;
  let passval = document.forms["HoHSIPage"]["pass"].value;
  let idval = document.forms["HoHSIPage"]["idnum"].value;
  let phval = document.forms["HoHSIPage"]["phonum"].value;
  let emval = document.forms["HoHSIPage"]["email"].value;
  let tranval = document.forms["HoHSIPage"]["transaction"].value;

  var namere = /^[A-Za-z]+$/;
  var passre = /^(?=.*[A-Z])(?=.*\d)(?=.*[-!@#$%^&*+.%"\/])[A-Za-z\d!@#$%^&*+-.%"\/]{1,16}$/;
  var emailre = /^[a-zA-Z0-9~!$%^&*_=+}{'\-?.]+@[a-zA-Z0-9.-]+\.(com|gov|edu|net|org|mil|co\.uk|ac\.uk|njit)$/;
  var idre = /^\d{4}$/;
  var phre = /^\d{3}-\d{3}-\d{4}$/
  var checkBox = document.getElementById("confirm");
  let hohForm = document.getElementById("HoHForm");

  if (fnval == "") {
    showFailedAlert("First Name is missing");
    event.preventDefault();
    hohForm.fname.focus();
    return false;
  } 
  else if (!namere.test(fnval)) {
    showFailedAlert("First Name has incorrect formatting");
    event.preventDefault();
    hohForm.fname.focus();
    return false;
  }

  if (lnval == "") {
    showFailedAlert("Last Name is missing");
    event.preventDefault();
    hohForm.lname.focus();
    return false;
  } 
  else if (!namere.test(lnval)) {
    showFailedAlert("Last Name has incorrect formatting");
    event.preventDefault();
    hohForm.lname.focus();
    return false;
  }

  if (passval == "") {
    showFailedAlert("Password is missing");
    event.preventDefault();
    hohForm.pass.focus();
    return false;
  } 
  else if (!passre.test(passval)) {
    showFailedAlert("Password has incorrect formatting");
    event.preventDefault();
    hohForm.pass.focus();
    return false;
  }

  if (idval == "") {
    showFailedAlert("ID is missing");
    event.preventDefault();
    hohForm.idnum.focus();
    return false;
  }
  else if (!idre.test(idval)) {
    showFailedAlert("ID has incorrect formatting");
    event.preventDefault();
    hohForm.idnum.focus();
    return false;
  }

  if (phval == ""){
    showFailedAlert("Phone Number is missing");
    event.preventDefault();
    hohForm.phonum.focus();
    return false;
  }
  else if (!phre.test(phval)) {
    showFailedAlert("Phone Number has incorrect formatting");
    event.preventDefault();
    hohForm.phonum.focus();
    return false;
  }

  if (checkBox.checked == true && emval == "") {
    showFailedAlert("Email is missing");
    event.preventDefault();
    hohForm.email.focus();
    return false;
  }
  else if (checkBox.checked == true && !emailre.test(emval)) {
    showFailedAlert("Email has incorrect formatting");
    event.preventDefault();
    hohForm.email.focus();
    return false;
  }
  if (tranval == '0'){
    showFailedAlert("No transaction was selected, please select one before continuing.");
    event.preventDefault();
    hohForm.transaction.focus();
    return false;
}
}