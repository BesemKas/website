fetch("Extras/NavBar.php")
  .then((response) => response.text())
  .then((data) => {
    document.getElementById("nav").innerHTML = data;
    // run script after nav is loaded
    return fetch("js/mobileMenu.js");
  })
  .then((response) => response.text())
  .then((data) => {
    eval(data);
  });

fetch("Extras/Footer.html")
  .then((response) => response.text())
  .then((data) => {
    document.getElementById("footer").innerHTML = data;
  });
