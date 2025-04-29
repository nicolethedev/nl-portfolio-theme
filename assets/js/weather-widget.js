document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("weather-widget");
  const baseEndpoint = WeatherConfig.endpoint; // "/wp-json/weather/v1/current"

  function render(data) {
    const temp = Math.round(data.temp);
    const iconUrl = `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
    container.innerHTML = `
        <span class="weather-temp">${temp}&deg;C</span>
        <img
          class="weather-icon"
          src="${iconUrl}"
          alt="${data.description}"
          title="${data.description}"
        />
      `;
  }

  function fetchAndRender(params) {
    fetch(`${baseEndpoint}${params}`, { mode: "same-origin" })
      .then((res) => res.json())
      .then(render)
      .catch(() => (container.textContent = "N/A"));
  }

  if (navigator.geolocation) {
    // ask for permission
    navigator.geolocation.getCurrentPosition(
      (pos) => {
        const { latitude, longitude } = pos.coords;
        fetchAndRender(`?lat=${latitude}&lon=${longitude}`);
      },
      // if denied or error
      () => fetchAndRender("?city=Vancouver,CA")
    );
  } else {
    // fallback if unsupported
    fetchAndRender("?city=Vancouver,CA");
  }
});
