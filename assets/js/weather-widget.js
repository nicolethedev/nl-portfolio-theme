document.addEventListener("DOMContentLoaded", () => {
  const containers = [
    document.getElementById("weather-widget"),
    document.getElementById("weather-widget-mobile"),
  ].filter(Boolean);
  if (!containers.length) return;

  const baseEndpoint = WeatherConfig.endpoint;

  function render(data) {
    const temp = Math.round(data.temp);
    const iconUrl = `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
    containers.forEach((container) => {
      container.innerHTML = `
          <span class="weather-temp">${temp}&deg;C</span>
          <img
            class="weather-icon"
            src="${iconUrl}"
            alt="${data.description}"
            title="${data.description}"
          />`;
    });
  }

  function fetchAndRender(params) {
    fetch(`${baseEndpoint}${params}`, { mode: "same-origin" })
      .then((res) => res.json())
      .then(render)
      .catch(() => containers.forEach((c) => (c.textContent = "N/A")));
  }

  // Load default location (Vancouver, CA) first:
  fetchAndRender("?city=Vancouver,CA");

  // If geolocation is available, use it to get the user's location:
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (pos) => {
        const { latitude, longitude } = pos.coords;
        fetchAndRender(`?lat=${latitude}&lon=${longitude}`);
      },
      () => {}, // silently fail
      { timeout: 5000 }
    );
  }
});
