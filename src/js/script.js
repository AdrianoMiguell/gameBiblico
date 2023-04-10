const btnUser = document.getElementById("btnUser");

if (btnUser != undefined) {
  const nome = btnUser.textContent.trim().split("@");
  btnUser.innerHTML = "<span>" + nome[0].slice(0, 15) + "</span>";
}