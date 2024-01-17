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

switch (Month)
{
  case 0: Month="января"; break;
  case 1: Month="февраля"; break;
  case 2: Month="марта"; break;
  case 3: Month="апреля"; break;
  case 4: Month="мае"; break;
  case 5: Month="июня"; break;
  case 6: Month="июля"; break;
  case 7: Month="августа"; break;
  case 8: Month="сентября"; break;
  case 9: Month="октября"; break;
  case 10: Month="ноября"; break;
  case 11: Month="декабря"; break;
}

let date = document.createElement('p');
date.className = "time";
date.innerHTML = Day + " " + Month + " " + Year;
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