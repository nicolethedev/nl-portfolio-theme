document.addEventListener("DOMContentLoaded", function () {
  function createFallingLogo(delay, leftPercent) {
    var img = document.createElement("img");
    img.src = themeData.themeDirectory + "/assets/images/flower-logo.png";
    img.alt = "Flower Logo";
    img.className = "falling-logo";
    img.style.left = leftPercent + "%";
    img.style.animationDelay = delay + "s";
    document.body.appendChild(img);

    setTimeout(function () {
      img.remove();
    }, (delay + 10) * 1000);
  }

  for (var i = 0; i < 10; i++) {
    createFallingLogo(i * 0.5, Math.random() * 100);
  }

  setInterval(function () {
    createFallingLogo(0, Math.random() * 100);
  }, 1000);
});
