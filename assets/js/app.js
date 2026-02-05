const timeNow = document.getElementById('time-now');
const dateNow = document.getElementById('date-now');
const weatherTemp = document.getElementById('weather-temp');
const weatherCity = document.getElementById('weather-city');

function updateClock() {
    const now = new Date();
    if (timeNow) timeNow.textContent = now.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
    if (dateNow) dateNow.textContent = now.toLocaleDateString('pt-BR', { weekday: 'short', day: '2-digit', month: 'short' });
}

async function loadWeather() {
    try {
        const city = 'São Paulo';
        const response = await fetch('https://api.open-meteo.com/v1/forecast?latitude=-23.55&longitude=-46.63&current=temperature_2m');
        const data = await response.json();
        const temp = Math.round(data.current.temperature_2m);
        if (weatherTemp) weatherTemp.textContent = `${temp}°C`;
        if (weatherCity) weatherCity.textContent = city;
    } catch (err) {
        if (weatherCity) weatherCity.textContent = 'Tempo';
    }
}

function startTicker() {
    const ticker = document.getElementById('breaking-ticker');
    if (!ticker) return;
    let offset = 0;
    setInterval(() => {
        offset -= 1;
        ticker.style.transform = `translateX(${offset}px)`;
        if (Math.abs(offset) > ticker.scrollWidth / 2) {
            offset = 0;
        }
    }, 30);
}

updateClock();
setInterval(updateClock, 1000 * 30);
loadWeather();
startTicker();
