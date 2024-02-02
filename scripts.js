function updateNameTextbox(selectedUser) {
    var senderNameInput = document.getElementById('senderName');
    senderNameInput.value = selectedUser; 
}

document.addEventListener("DOMContentLoaded", function (event) {
  let message = document.getElementById("message");
  message.addEventListener("keyup", sendMessages);
});

function sendMessages() {
  let senderName = document.getElementById("senderName");
  let senderPass = document.getElementById("senderPass");
  let message = document.getElementById("message");
  let xhr = new XMLHttpRequest();
  xhr.addEventListener("load", function () {
    let warning = document.getElementById("warning");
    if (this.status === 200 && this.readyState === 4 && this.response === "Invalid User") {
      warning.style.display = "contents";
    } 
    else {
      warning.style.display = "none";
    }});

  let queryString =
    "senderName=" + encodeURIComponent(senderName.value) +
    "&senderPass=" + encodeURIComponent(senderPass.value) +
    "&message=" + encodeURIComponent(message.value);
  xhr.open("GET", "SendsTo.php?" + queryString);
  xhr.send();
}

const autoUpdate = setInterval(retrieveMessages, 100);

function retrieveMessages() {
  let recieverName = document.getElementById("recieverName");
  let xhr = new XMLHttpRequest();
  xhr.addEventListener("load", function () {
    let messagesBox = document.getElementById("displayedMSG");
    if (this.status === 200 && this.readyState === 4) {
      messagesBox.innerHTML = this.response;
    }
  });
  let queryString = "recieverName=" + encodeURIComponent(recieverName.value);
  xhr.open("GET", "RetrievesFrom.php?" + queryString);
  xhr.send();
}