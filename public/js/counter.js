const FULL_DASH_ARRAY = 283;
const WARNING_THRESHOLD = 10;
const ALERT_THRESHOLD = 5;

const COLOR_CODES = {
  info: {
    color: "green"
  },
  warning: {
    color: "orange",
    threshold: WARNING_THRESHOLD
  },
  alert: {
    color: "red",
    threshold: ALERT_THRESHOLD
  }
};

const TIME_LIMIT = 20;
let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let remainingPathColor = COLOR_CODES.info.color;

document.getElementById("app").innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="base-timer-label" class="base-timer__label">${formatTime(
    timeLeft
  )}</span>
</div>
`;

startTimer();

function onTimesUp() {
    clearInterval(timerInterval);

    getAnswers();

    setTimeout(() => {
      setTableVisible();
    }, 1000);

    
}

function startTimer() {
  timerInterval = setInterval(() => {
    timePassed = timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    document.getElementById("base-timer-label").innerHTML = formatTime(
      timeLeft
    );
    setCircleDasharray();
    setRemainingPathColor(timeLeft);

    if (timeLeft === 0) {
      onTimesUp();
    }
  }, 1000);
}

function formatTime(time) {
  let seconds = time % 60;

  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  return `${seconds}`;
}

function setRemainingPathColor(timeLeft) {
  const { alert, warning, info } = COLOR_CODES;
  if (timeLeft <= alert.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(warning.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(alert.color);
  } else if (timeLeft <= warning.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(info.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(warning.color);
  }
}

function calculateTimeFraction() {
  const rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray() {
  const circleDasharray = `${(
    calculateTimeFraction() * FULL_DASH_ARRAY
  ).toFixed(0)} 283`;
  document
    .getElementById("base-timer-path-remaining")
    .setAttribute("stroke-dasharray", circleDasharray);
}


function setTableVisible(){

    var app = document.getElementById('counter-element');
    var table = document.getElementById('table-element');

    app.classList.add('counter-element-hide');

    setTimeout(() => {
      table.classList.add('table-element-show');
    }, 500);

    

}


function getAnswers(){

    var textPitanja = document.getElementById('pitanje-text').innerHTML;
    var idPrezentacije = document.getElementById('kljuc-text').innerHTML;

    $.ajax({
        type:'POST',
        url:"/pitanje/getAnswers",
        data:{
            'textPitanja': textPitanja,
            'idPrezentacije': idPrezentacije, 
        },
        success: function(data) {
            getData(data)
        }
    });
}

function getData(data){

    if(document.getElementById('odgovor-3') != null && document.getElementById('odgovor-4') != null){
        drawChart(data[1],data[3],data[5],data[7]);
    }
    else if(document.getElementById('odgovor-3') != null && document.getElementById('odgovor-4') == null){
        drawChart(data[1],data[3],data[5]);
    }
    else{
        drawChart(data[1],data[3]);
    }

}

function drawChart(odg1, odg2, odg3, odg4){

    if(odg3==undefined && odg4==undefined){
        var ctx = document.getElementById('questionChart').getContext('2d');
        var gradientStroke = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke.addColorStop(1, "#621EA7");
        gradientStroke.addColorStop(.75, "#9B1E80");
        gradientStroke.addColorStop(.5, "#C61D62");
        gradientStroke.addColorStop(.25, "#E21D4F");
        gradientStroke.addColorStop(0, "#FF1D3B");

        var myChart = new Chart(ctx, {
        
            type: 'bar',
            data: {
                labels:['A', 'B'],
                datasets: [{
                    label: 'Rezultat',
                    data: [odg1, odg2],
                    backgroundColor: [
                        gradientStroke,
                        gradientStroke,
                    ],
                    borderColor: [
                        gradientStroke,
                        gradientStroke
                    ],
                    borderWidth: 1
                }]
            },
        
            options: {
              layout:{
                padding:{
                  top: 10,
                }
              },
              scales: {
                  yAxes: [{
                      gridLines:{
                        display:false,
                      },
                      display:false,
                  }],
                  xAxes:[{
                    maxBarThickness: 80,
                }]
              }
          }
        });
    }
    else if(odg3!=undefined && odg4==undefined){
        var ctx = document.getElementById('questionChart').getContext('2d');
        var gradientStroke = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke.addColorStop(1, "#621EA7");
        gradientStroke.addColorStop(.75, "#9B1E80");
        gradientStroke.addColorStop(.5, "#C61D62");
        gradientStroke.addColorStop(.25, "#E21D4F");
        gradientStroke.addColorStop(0, "#FF1D3B");

        var myChart = new Chart(ctx, {
        
            type: 'bar',
            data: {
                labels:['A', 'B', 'C'],
                datasets: [{
                    label: 'Rezultat',
                    data: [odg1, odg2, odg3],
                    backgroundColor: [
                      gradientStroke,
                      gradientStroke,
                      gradientStroke,
                    ],
                    borderColor: [
                      gradientStroke,
                      gradientStroke,
                      gradientStroke,
                    ],
                    borderWidth: 1
                }]
            },
        
            options: {
              layout:{
                padding:{
                  top: 10,
                }
              },
              scales: {
                  yAxes: [{
                      gridLines:{
                        display:false,
                      },
                      display:false,
                  }],
                  xAxes:[{
                    maxBarThickness: 80,
                }]
              }
          }
        });
    }
    else if(odg3!=undefined && odg4!=undefined){
        var ctx = document.getElementById('questionChart').getContext('2d');
        var gradientStroke = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke.addColorStop(1, "#621EA7");
        gradientStroke.addColorStop(.75, "#9B1E80");
        gradientStroke.addColorStop(.5, "#C61D62");
        gradientStroke.addColorStop(.25, "#E21D4F");
        gradientStroke.addColorStop(0, "#FF1D3B");

        var myChart = new Chart(ctx, {
        
            type: 'bar',
            data: {
                labels:['A', 'B', 'C', 'D'],
                datasets: [{
                    label: 'Rezultat',
                    data: [odg1, odg2, odg3, odg4],
                    backgroundColor: [
                      gradientStroke,
                      gradientStroke,
                      gradientStroke,
                      gradientStroke,
                    ],
                    borderColor: [
                      gradientStroke,
                      gradientStroke,
                      gradientStroke,
                      gradientStroke,
                    ],
                    borderWidth: 1
                }]
            },
        
            options: {
              layout:{
                padding:{
                  top: 10,
                }
              },
              scales: {
                  yAxes: [{
                      gridLines:{
                        display:false,
                      },
                      display:false,
                  }],
                  xAxes:[{
                    maxBarThickness: 80,
                }]
              }
          }
        });
    }

}
