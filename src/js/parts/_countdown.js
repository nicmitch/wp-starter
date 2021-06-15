

//var moment = require('moment-timezone');
var countDownDate;
var days;
var hours;
var minutes;
var seconds;
const elems = document.querySelectorAll('.countdown');

const updateOutput = () => {

    if(elems){
        elems.forEach( (el) => {

            el.querySelector('.countdown__output--days').innerHTML = days;
            el.querySelector('.countdown__output--hours').innerHTML = hours;
            el.querySelector('.countdown__output--minutes').innerHTML = minutes;
            el.querySelector('.countdown__output--seconds').innerHTML = seconds;
        });
    }

};

const getCurrentTime = () => {

    let toDay = new Date();
    let thisYear = toDay.getFullYear();
    let thisMonth = toDay.getMonth();

    countDownDate = new Date(thisYear, thisMonth+1, 1).getTime();
};

const init = () => {

    getCurrentTime();

    var gogogo = setInterval(function() {

        var now = new Date().getTime();
        var timeleft = countDownDate - now;
        
        if(timeleft > 0){
            days = ('0' + Math.floor(timeleft / (1000 * 60 * 60 * 24))).slice(-2);
            hours = ('0' + Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).slice(-2);
            minutes = ('0' + Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60))).slice(-2);
            seconds = ('0' + Math.floor((timeleft % (1000 * 60)) / 1000)).slice(-2);
        }else{
            getCurrentTime();
        }

        updateOutput();

    }, 1000);

};

export default { init };
