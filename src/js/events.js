const messageError = document.getElementById("messageError");

if (typeof messageError != undefined) {
    setTimeout(() => {
        messageError.style.display = "none";
        messageError.removeChild(messageError);
    }, 5000);
}
