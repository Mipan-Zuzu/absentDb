
  const apiKey = "e28f434589904c8256f79516b04d2c19"
  const city = "Denpasar"
  const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`

  async function getWeather() {
    try {
      const res = await fetch(url)
      const data = await res.json()
      document.getElementById('weather-temp').textContent = `${Math.round(data.main.temp)}°C`
      document.getElementById('weather-description').textContent = data.weather[0].description
    } catch (error) {
      document.getElementById('weather-description').textContent = "Failed to load weather"
    }
  }

  getWeather()

const name = document.getElementById('name');
const day = new Date();
const hour = day.getHours();

if(hour >= 6 && hour < 10) {
  name.innerHTML = `<i class='bx bx-sun'></i> Morning User`;
} else if (hour >= 10 && hour < 15) {
  name.innerHTML = `<i class='bx bx-sun' style='color:#FFD700'></i> Afternoon User`;
} else if (hour >= 15 && hour < 19) {
  name.innerHTML = `<i class='bx bx-sunset'></i> Evening User`;
} else if (hour >= 19 && hour <= 24) {
  name.innerHTML = `<i class='bx bx-moon'></i> Night User`;
} else {
  name.textContent = "What time is it? User";
}


const myHeaders = new Headers()
myHeaders.append("apikey", "62f89fd56f0KLyv6vJ4IRnw12vvQdiKU")

const requestOptions = {
  method: "GET",
  redirect: "follow",
  headers: myHeaders
}

fetch("https://api.apilayer.com/exchangerates_data/latest?base=USD&symbols=IDR", requestOptions)
  .then(response => response.json())
  .then(result => {
    console.log(result)
    const rate = result.rates.IDR
    document.getElementById('currency-rate').textContent = `Rp ${rate.toLocaleString('id-ID')}`
    document.getElementById('currency-description').textContent = 'USD to IDR'
  })
  .catch(error => console.log('error', error))


