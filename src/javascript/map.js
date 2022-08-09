//Check Radius Distance and Set the UI
//Fix estimations
//

var greemarker=L.icon({
    iconUrl: '../images/green.png',
    iconSize:     [25, 25], // size of the icon
    iconAnchor:   [12,18], // point of the icon which will correspond to marker's location
});

var redmarker=L.icon({
    iconUrl: '../images/red.png',
    iconSize:     [25,25], // size of the icon
    iconAnchor:   [12,18], // point of the icon which will correspond to marker's location
});

var yellowmarker=L.icon({
    iconUrl: '../images/orange.png',
    iconSize:     [25,25], // size of the icon
    iconAnchor:   [12,18], // point of the icon which will correspond to marker's location
});


var usermarker=L.icon({
    iconUrl: '../images/userl.svg',
    iconSize:     [25,25], // size of the icon
    iconAnchor:   [12,18], // point of the icon which will correspond to marker's location
});



const map_form = {
    form : document.getElementById("map"),
    map_submit : document.getElementById("submit")

};

const user_form = {
    form : document.getElementById("map"),
    map_user : document.getElementById("center")

};


const bot_form = {
    form : document.getElementById("map"),
    moving_bot : document.getElementById("bot")

};


var defaultPos = {coords :[38.25, 21.745] , zoom :12};
var userLocation = {coords :[38.25,21.745] , zoom :17};

var circle = L.circle(userLocation.coords, {
    color: '#00bfff',
    fillColor: '#00bfff',
    weight:1,
    opacity: 0.25,
    fillOpacity: 0.20,
    radius: 20
}).addTo(map);


user = L.marker(userLocation.coords,{icon:usermarker}).addTo(map);


var layerGroup = L.featureGroup();
let markerLayer = L.featureGroup().addTo(map);

layerGroup.addLayer(markerLayer);

map.addLayer(layerGroup);

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
        
        
    }
};

function getDistance(x1, y1, x2, y2){
    let y = x2 - x1;
    let x = y2 - y1;
    
    return Math.sqrt(x * x + y * y);
}

bot_form.moving_bot.addEventListener('click', (e) =>{
    map.on("click",(event)=>{
        
        userLocation.coords[0] = event.latlng.lat;
        userLocation.coords[1] = event.latlng.lng;
        
        user.setLatLng(event.latlng); 
        circle.setLatLng(event.latlng);
        });
    
   
});



    


map_form.map_submit.addEventListener('click', (event) =>{
    map.setView(new L.LatLng(defaultPos.coords[0],defaultPos.coords[1]), defaultPos.zoom);
    layerGroup.removeLayer(markerLayer);
});



const requestData = ``;

request.open('post', '../php/session.php');
request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
request.send(requestData);


user_form.map_user.addEventListener('click', (event) =>{
    map.setView(new L.LatLng(userLocation.coords[0],userLocation.coords[1]), userLocation.zoom);
    layerGroup.addLayer(markerLayer)
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





var popup = L.popup();
let marker = Array();
const date = new Date();
function HandleResponse(responseObject){
    
    hour = date.getHours();
    for (let i = 0; i < responseObject.lat.length; i++) {
        marker[i] = {"lat":responseObject.lat[i],"lng":responseObject.lng[i]};
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
            
            
            res = getDistance(userLocation.coords[0], userLocation.coords[1],event.latlng.lat,event.latlng.lng);
                
            console.log(circle.radius);
            console.log(res* 111140);
            if(res*111139<24.5)
            visitReg(responseObject,event);
            else
            dispData(responseObject,event);
            
            
            
        }
        
    };

    //20 m degrees =>0.000191
    const requestData = `lat=${event.latlng.lat}&lng=${event.latlng.lng}`;

    request.open('post', '../php/dispData.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
    
    
});

function dispData(responseObject,event){
    popestimation = parseInt( responseObject.data[date.getHours()]) +parseInt( responseObject.data[date.getHours()+1])+ parseInt(responseObject.data[date.getHours()+2])
            popup
                .setLatLng(event.latlng)
                .setContent( responseObject.name +"  "+ responseObject.rating + "<br>"+ responseObject.address+"<br>" +"Estimation: "+ Math.round(popestimation/3)+"<br>")
                .openOn(map);
        
}

function visitReg(responseObject,event){
    poiname = responseObject.id[0];
            
            popestimation = parseInt( responseObject.data[date.getHours()]) +parseInt( responseObject.data[date.getHours()+1])+ parseInt(responseObject.data[date.getHours()+2])
            popup
                .setLatLng(event.latlng)
                .setContent( responseObject.name +"  "+ responseObject.rating + "<br>"+ responseObject.address+"<br>" +"Estimation: "+ Math.round(popestimation/3)+"<br>" + "<input type='number'> <button onclick = 'submitVisit()'>Visit Register</button> ")
                .openOn(map);
        
   
    
}

function submitVisit(){
    
    const request = new XMLHttpRequest(); 

        const requestData = `poiID=${poiname}&userID=${username}`;

        request.open('post', '../php/visitRegister.php');
        request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        request.send(requestData);
}
