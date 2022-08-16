filter = document.getElementById("filter");
startDate = document.getElementById("start");


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

        }
    };

    const requestData = `startDate=${startDate.value}`;
    
    request.open('post', '../php/chartThree.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
});

// get the latest data
filter.click();

startDate.addEventListener('change', (event) =>{
    filter.click();
});


function datapointsParser(responseObject){
    for (let i = 0; i < responseObject.allHours.length; i++) {
            
        datapoints[i] = responseObject.allHours[i];
        
        visiterChart.data.datasets[0].data = datapoints;
        visiterChart.update();
        
    }
    
    
}


var ctx = document.getElementById('perDayChart').getContext('2d');

var visiterChart = new Chart(ctx, {
    
    type: 'line',
    data: {
        labels: ['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'],
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

            },

            y :{
                beginAtZero: true
            },

        },
        
        responsive: true
    }
});
