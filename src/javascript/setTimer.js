const request = new XMLHttpRequest();

request.onload = () => {
    let responseObject = null;

    try{
        responseObject = JSON.parse(request.responseText);

    }catch(e){
        console.error("Could not parse JSON");
    }

    if (responseObject){
        if(responseObject.day != ''){
            console.log(responseObject.day);
            setTimer(responseObject);
        }
        
        
    }
};

const requestData = ``;

request.open('post', '../php/setTimer.php');
request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
request.send(requestData);



function setTimer(responseObject){
    var countDownDate = new Date(responseObject.day).getTime();
    var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDate - now;

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("freedom").innerHTML = days + "<strong>days</strong> " + hours + "<strong>hours</strong> "
    + minutes + "<strong>minutes</strong> " + seconds + "<strong>seconds</strong> ";
    

    if (distance < 0) {
        clearInterval(x);
        document.getElementById("freedom").style.display = "none";
        document.getElementById("qText").style.display = "none";
    }
    }, 1000);}