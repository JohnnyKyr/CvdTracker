filter = document.getElementById("filter");
reset = document.getElementById("reset");
startDate = document.getElementById("start");
endDate = document.getElementById("end");

var dates = Array();
var datapoints = Array();


filter.addEventListener('click', (event) =>{
    event.preventDefault();
    console.log(startDate);
    const request = new XMLHttpRequest();

    request.onload = () => {
        var responseObject = null;

        try{
            responseObject = JSON.parse(request.responseText);

        }catch(e){
            console.error("Could not parse JSON");
        }

        if (responseObject){
            console.log(responseObject);
            datapointsParser(responseObject);
            datesPareser(responseObject);
        }
    };

    const requestData = `startDate=${startDate.value}&endDate=${endDate.value}`;
    
    request.open('post', '../php/chartOne.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
});

// get the latest data
filter.click();

function datapointsParser(responseObject){
    for (let i = 0; i < responseObject.values.length; i++) {
            
        datapoints[i] = responseObject.values[i];
        
    }
    
    
}

function datesPareser(responseObject){

    for (let i = 0; i < responseObject.dates.length; i++) {
        dates[i] = responseObject.dates[i];
    }

    visitChart.data.datasets[0].data = datapoints;
    visitChart.data.labels= dates;
    visitChart.update();
    clearLists();
}


function clearLists(){
    datapoints = [];
    dates = [];
}



var ctx = document.getElementById('lineChart').getContext('2d');

var visitChart = new Chart(ctx, {
    
    type: 'bar',
    data: {
        labels: dates,
        datasets: [{
            label: 'Number of Visits',
            data: datapoints,
            backgroundColor: [
                'rgba(255, 135, 55, 0.84)'
            ],
            borderColor: [
                'rgba(255, 135, 55, 0.84)'
            ],
            
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            x :{
                type: 'time',
                time: {
                    unit: 'day'
                }
            },

            y :{
                beginAtZero: true
            },

        },
        
        responsive: true
    }
});
