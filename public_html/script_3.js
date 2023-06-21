// finding of user time
let info_time = document.getElementById('time_clt');
let date_footer = document.getElementById('date_footer');
let Data = new Date();
let Year = Data.getFullYear();
let Month = Data.getMonth();
let Day = Data.getDate();
Data.setTime(Date.now());
let Hours = Data.getHours();
Hours = String(Hours).padStart(2, '0');
let Minutes = Data.getMinutes();
Minutes = String(Minutes).padStart(2, '0');

// Преобразуем месяца
switch (Month)
{
  case 0: fMonth="января"; break;
  case 1: fMonth="февраля"; break;
  case 2: fMonth="марта"; break;
  case 3: fMonth="апреля"; break;
  case 4: fMonth="мае"; break;
  case 5: fMonth="июня"; break;
  case 6: fMonth="июля"; break;
  case 7: fMonth="августа"; break;
  case 8: fMonth="сентября"; break;
  case 9: fMonth="октября"; break;
  case 10: fMonth="ноября"; break;
  case 11: fMonth="декабря"; break;
}

let date = document.createElement('p');
date.className = "time";
date.innerHTML = Day + " " + fMonth + " " + Year;
let date_2 = document.createElement('p');
date_2.innerHTML ="copyrigth &copy;&nbsp;" + Year;

let time = document.createElement('p');
time.className = "time";
time.innerHTML = Hours +":" + Minutes;
info_time.append(date, time);

date_footer.append(date_2);

// finding of user weather
let city = document.getElementById('city').innerHTML;
const api_key = '603f39b6ff4ab0913af4355d87e938ea';
const url = `http://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${api_key}`;

const output = document.getElementById('output');

// Сетевые запросы XMLHttpRequest с исп. промисов

const request = new XMLHttpRequest();

request.open('GET', url);
request.responseType = 'json';
request.send();

let promise = new Promise(function(resolve) {
    request.addEventListener('load', function() {
        if (request.status == 200) {
            resolve(request.response);
        }
    });
});

promise.then(function(response) {
    output.textContent = ` ${Math.round(response.main.temp - 273.15)} °C`;
});