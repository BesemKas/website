document
  .getElementById("contactForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    alert(
      "Thank you for your message, we'll get back to you as soon as possible!"
    );
  });
