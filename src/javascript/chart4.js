storeTypes = Array();
values = Array();
covidStoreTypes = Array();
covidValues = Array();

const request = new XMLHttpRequest();

request.onload = () => {
  var responseObject = null;

  try{
      responseObject = JSON.parse(request.responseText);

  }catch(e){
      console.error("Could not parse JSON");
  }

  if (responseObject){
    rankedTypes(responseObject);
    covidRankedTypes(responseObject);
  }
};

const requestData = ``;

request.open('post', '../php/storeTypes.php');
request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
request.send(requestData);


function rankedTypes(responseObject){
  console.log(responseObject);

  var temp=0;
  storeTypes = Object.keys(responseObject.types).slice(0,10);
  values = Object.values(responseObject.types).slice(0,10);
  tempArr = Object.values(responseObject.types).slice(10);

  for(let i =0;i<tempArr.length;i++){
    temp+= tempArr[i];
  }
  values[10] = temp;
  storeTypes[10] = 'Others';
  
 
  typeBar.data.labels = storeTypes;
  typeBar.data.datasets[0].data = values;
  typeBar.update();
}

var ctx = document.getElementById('types').getContext('2d');
var typeBar = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: storeTypes,
        datasets: [{
            label: '# of Votes',
            data: values,
            backgroundColor: [
              'rgba(255, 99, 132, 0.4)',
              'rgba(54, 162, 235, 0.4)',
              'rgba(255, 206, 86, 0.4)',
              'rgba(75, 192, 192, 0.4)',
              'rgba(153, 102, 255, 0.4)',
              'rgba(255, 159, 64, 0.4)'
                
            ],
            borderColor: [
              'rgba(255, 99, 132, 0.6)',
              'rgba(54, 162, 235, 0.6)',
              'rgba(255, 206, 86, 0.6)',
              'rgba(75, 192, 192, 0.6)',
              'rgba(153, 102, 255, 0.6)',
              'rgba(255, 159, 64, 0.6)'
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
              grid: {
                display: false
              }
            },
            y: {
              grid: {
                display: false
              }
            }
          }
    }
});



// CHART 5

function covidRankedTypes(responseObject){
  
  var temp=0;
  covidStoreTypes = Object.keys(responseObject.covidtypes).slice(0,10);
  covidValues = Object.values(responseObject.covidtypes).slice(0,10);
  tempArr = Object.values(responseObject.covidtypes).slice(10);

    for(let i =0;i<tempArr.length;i++){
     temp+= tempArr[i];
   }
  
   covidValues[10] = temp;
   covidStoreTypes[10] = 'Others';
  
 
  covidTypeBar.data.labels = covidStoreTypes;
  covidTypeBar.data.datasets[0].data = covidValues;
  
  covidTypeBar.update();
 
}

var ctx = document.getElementById('covidTypes').getContext('2d');
var covidTypeBar = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: covidStoreTypes,
        datasets: [{
            label: '# of Votes',
            data: covidValues,
            backgroundColor: [
              'rgba(255, 99, 132, 0.4)',
              'rgba(54, 162, 235, 0.4)',
              'rgba(255, 206, 86, 0.4)',
              'rgba(75, 192, 192, 0.4)',
              'rgba(153, 102, 255, 0.4)',
              'rgba(255, 159, 64, 0.4)'
                
            ],
            borderColor: [
              'rgba(255, 99, 132, 0.6)',
              'rgba(54, 162, 235, 0.6)',
              'rgba(255, 206, 86, 0.6)',
              'rgba(75, 192, 192, 0.6)',
              'rgba(153, 102, 255, 0.6)',
              'rgba(255, 159, 64, 0.6)'
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
              grid: {
                display: false
              }
            },
            y: {
              grid: {
                display: false
              }
            }
          }
    }
});
