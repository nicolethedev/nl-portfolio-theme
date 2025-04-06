document.addEventListener("DOMContentLoaded", function () {
  // Function to create a falling logo.
  function createFallingLogo(delay, leftPercent) {
    var img = document.createElement("img");
    // Use the dynamic theme directory provided by wp_localize_script.
    img.src = themeData.themeDirectory + "/assets/images/flower-logo.png";
    img.alt = "Flower Logo";
    img.className = "falling-logo";
    img.style.left = leftPercent + "%";
    img.style.animationDelay = delay + "s";
    document.body.appendChild(img);

    // Remove the logo after it completes its fall (10s animation duration).
    setTimeout(function () {
      img.remove();
    }, (delay + 10) * 1000);
  }

  // Create an initial batch of falling logos.
  for (var i = 0; i < 10; i++) {
    createFallingLogo(i * 0.5, Math.random() * 100);
  }

  // Continuously add more logos at regular intervals.
  setInterval(function () {
    createFallingLogo(0, Math.random() * 100);
  }, 1000);
});
