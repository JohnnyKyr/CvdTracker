var percentage = Array();


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
    percentage[0] = responseObject.total;
    percentage[1] = responseObject.ccNumber;
    doughnutChart.data.datasets[0].data = percentage;

    doughnutChart.update();
  }
};

const requestData = ``;

request.open('post', '../php/chartTwo.php');
request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
request.send(requestData);



var ctx = document.getElementById('doughnut').getContext('2d');
var doughnutChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Total Users', 'Total of Positive Users'],
        datasets: [{
            label: '# of Votes',
            data: percentage,
            backgroundColor: [
                'rgba(50, 200, 130,0.6)',
                'rgba(255,0,0,0.6)',
                
            ],
            borderColor: [
                'rgba(41, 155, 99,0.6)',
                'rgba(255,0,0,0.6)',
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});
