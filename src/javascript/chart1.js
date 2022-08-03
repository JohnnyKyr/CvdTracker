var ctx = document.getElementById('lineChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(85, 85, 85, 1)',
            ],
            borderColor: [
                'rgba(41, 155, 99)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});
