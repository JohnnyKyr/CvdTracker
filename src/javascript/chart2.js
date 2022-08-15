console.log("edw");
var ctx = document.getElementById('doughnut').getContext('2d');
var doughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Negative', 'Positive'],
        datasets: [{
            label: '# of Votes',
            data: [30,1],
            backgroundColor: [
                'rgba(41, 155, 99,0.8)',
                'rgba(255, 206, 86,0.8)',
                
            ],
            borderColor: [
                'rgba(41, 155, 99,0.8)',
                'rgba(255, 206, 86,0.8)',
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});
