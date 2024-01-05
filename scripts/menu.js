function myFunction() {
  var x = document.getElementById("myTopnav");

  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function hideToggleMenu() {

  var toggleMenu = document.getElementById("topnavIcon");

  if (window.innerWidth <= 700) {
    toggleMenu.style.display = "block";

  } else {
    toggleMenu.style.display = "none";
  }
}

hideToggleMenu();