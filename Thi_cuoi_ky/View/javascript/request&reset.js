function validateForm() {
    var username = document.getElementById("account").value;
    var messageContainer = document.getElementById("messageContainer");
    messageContainer.innerHTML = "";

    if (username.trim() === "") {
        displayMessage("Hãy nhập login id", "error");
        return;
    }

    if (username.length < 4) {
        displayMessage("Hãy nhập login id tối thiểu 4 ký tự", "error");
        return;
    }
    window.location.href = "reset.html";
}

function displayMessage(message, messageType) {
    var messageContainer = document.getElementById("messageContainer");
    var messageElement = document.createElement("div");
    
    messageElement.textContent = message;
    messageElement.classList.add(messageType);

    messageContainer.appendChild(messageElement);
}
