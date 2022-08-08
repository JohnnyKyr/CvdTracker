var greemarker=L.icon({
    iconUrl: '../images/green.png',
    iconSize:     [25, 25], // size of the icon
    iconAnchor:   [22, 37], // point of the icon which will correspond to marker's location
});

var redmarker=L.icon({
    iconUrl: '../images/red.png',
    iconSize:     [25,25], // size of the icon
    iconAnchor:   [22, 37], // point of the icon which will correspond to marker's location
});

var yellowmarker=L.icon({
    iconUrl: '../images/orange.png',
    iconSize:     [25,25], // size of the icon
    iconAnchor:   [22, 37], // point of the icon which will correspond to marker's location
});

const map_form = {
    form : document.getElementById("map"),
    map_submit : document.getElementById("submit")

};

var username = "";

const request = new XMLHttpRequest();

request.onload = () => {
    let responseObject = null;

    try{
        responseObject = JSON.parse(request.responseText);

    }catch(e){
        console.error("Could not parse JSON");
    }

    if (responseObject){
        
        username = responseObject.username;
        console.log('enadyo');
        console.log(username);
        
    }
};


const requestData = ``;

request.open('post', '../php/session.php');
request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
request.send(requestData);


map_form.map_submit.addEventListener('click', (event) =>{
    
    event.preventDefault();
    const request = new XMLHttpRequest();

    request.onload = () => {
        let responseObject = null;

        try{
            responseObject = JSON.parse(request.responseText);

        }catch(e){
            console.error("Could not parse JSON");
        }

        if (responseObject){
            HandleResponse(responseObject);
        }
    };

    const requestData = ``;
    
    request.open('post', '../php/map.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
});

//ADD Place for past 2hours
//ADD Poi esimations for next two hours
//Fetch Name
//Fetch rating


let markerLayer = L.featureGroup().addTo(map);

var popup = L.popup();
let marker = Array();
const date = new Date();
function HandleResponse(responseObject){
    hour = date.getHours();
    for (let i = 0; i < responseObject.lat.length; i++) {
        coords = [responseObject.lat[i],responseObject.lng[i]];
        popularity = responseObject.data[i].match(/\d+/g)
        if (popularity[hour]<=32)
        L.marker(coords,{icon:greemarker}).addTo(markerLayer);
        if (popularity[hour]>=32 &&popularity[hour]<= 65)
        L.marker(coords,{icon:yellowmarker}).addTo(markerLayer);
        if (popularity[hour]>=66)
        L.marker(coords,{icon:redmarker}).addTo(markerLayer);



      
       // L.marker([responseObject.lat[i],responseObject.lng[i]]).bindPopup("Hello").addTo(markerLayer);
      }
      
}




currentSelectedLocation = {"lat":0,"lng":0};
poiname = "";
markerLayer.addEventListener("click",(event)=>{

   currentSelectedLocation = {"lat":event.latlng.lat,"lng":event.latlng.lng}


    const request = new XMLHttpRequest();

    request.onload = () => {
        let responseObject = null;

        try{
            responseObject = JSON.parse(request.responseText);

        }catch(e){
            console.error("Could not parse JSON");
        }

        if (responseObject){
            poiname = responseObject.id[0];
            
            popestimation = parseInt( responseObject.data[date.getHours()]) +parseInt( responseObject.data[date.getHours()+1])+ parseInt(responseObject.data[date.getHours()+2])
            popup
                .setLatLng(event.latlng)
                .setContent( responseObject.name +"  "+ responseObject.rating + "<br>"+ responseObject.address+"<br>" +"Estimation: "+ Math.round(popestimation/3)+"<br>" + "<button onclick = 'visitReg()'>Visit Register</button>")
                .openOn(map);
        
        }
    };

    
    const requestData = `lat=${event.latlng.lat}&lng=${event.latlng.lng}`;

    request.open('post', '../php/dispData.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
    
    
});



function visitReg(){
    console.log(poiname);
    
    const request = new XMLHttpRequest();

        request.onload = () => {
            let responseObject = null;

        }

        const requestData = `poiID=${poiname}&userID=${username}`;

        request.open('post', '../php/visitRegister.php');
        request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        request.send(requestData);
    
}
