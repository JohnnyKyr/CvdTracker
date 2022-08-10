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
    //Button for recentering the map in the default coords
};

const user_form = {
    form : document.getElementById("map"),
    map_user : document.getElementById("center")
    //Center and zoom the map in user location and display pois
};


const bot_form = {
    form : document.getElementById("map"),
    moving_bot : document.getElementById("bot")
    //Note: Bot button 
    //It's only use is to simulate the user movement
    //It is not a feature of the map
};


var defaultPos = {coords :[38.25, 21.745] , zoom :12};  //Default coords => Init Map
var userLocation = {coords :[38.25,21.745] , zoom :17}; //User deafault position =>Init User Marker

var circle = L.circle(userLocation.coords, {
    color: '#00bfff',
    fillColor: '#00bfff',
    weight:1,
    opacity: 0.25,
    fillOpacity: 0.20,
    radius: 20
    //Circle's purpose is to surround user marker and give a brief idea of the 20m radius
}).addTo(map);


user = L.marker(userLocation.coords,{icon:usermarker}).addTo(map); // Init User marker

//Global variables
currentSelectedLocation = {"lat":0,"lng":0};
poiname = "";
var popup = L.popup();
let marker = Array();
const date = new Date();


var layerGroup = L.featureGroup();
let markerLayer = L.featureGroup().addTo(map);

layerGroup.addLayer(markerLayer);

map.addLayer(layerGroup);

var username = "";

/* A XMLHttp request, asking for loged in user's username */
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

const requestData = ``;

request.open('post', '../php/session.php');
request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
request.send(requestData);

/*********************************************************/


function getDistance(x1, y1, x2, y2){
    let y = x2 - x1;
    let x = y2 - y1;
    
    return Math.sqrt(x * x + y * y);
}


bot_form.moving_bot.addEventListener('click', (e) =>{
    /* Moving bot's eventListner */
    map.on("click",(event)=>{
        
        userLocation.coords[0] = event.latlng.lat;
        userLocation.coords[1] = event.latlng.lng;
        
        user.setLatLng(event.latlng); 
        circle.setLatLng(event.latlng);
        });
    
   
});



map_form.map_submit.addEventListener('click', (event) =>{
    /* Recenter the map */
    map.setView(new L.LatLng(defaultPos.coords[0],defaultPos.coords[1]), defaultPos.zoom);
    layerGroup.removeLayer(markerLayer);
});



user_form.map_user.addEventListener('click', (event) =>{
    //Event Listener for the markers
    map.setView(new L.LatLng(userLocation.coords[0],userLocation.coords[1]), userLocation.zoom);//Zoom into user's dif location
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





function HandleResponse(responseObject){
    //Init the markers based on the estimated traffic of a poi
    //Different color for each estimation 
    hour = date.getHours();
    for (let i = 0; i < responseObject.lat.length; i++) {
        
        coords = [responseObject.lat[i],responseObject.lng[i]];
        popularity = responseObject.data[i].match(/\d+/g);
        if (popularity[hour]<=32)
        L.marker(coords,{icon:greemarker}).addTo(markerLayer);
        if (popularity[hour]>=32 &&popularity[hour]<= 65)
        L.marker(coords,{icon:yellowmarker}).addTo(markerLayer);
        if (popularity[hour]>=66)
        L.marker(coords,{icon:redmarker}).addTo(markerLayer);

      }
      
}





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
    //Display marker's data that are further than 20m
    console.log(responseObject.data);
    console.log(responseObject.numofp);
    popularity = responseObject.data.match(/\d+/g);

    if (date.getHours()===22)
    popestimation = parseInt( popularity[date.getHours()+1])+ parseInt(popularity[0]);
    if (date.getHours()===23)
        popestimation = parseInt( popularity[0])+ parseInt(1);
    else
        popestimation = parseInt( popularity[date.getHours()+1])+ parseInt(popularity[date.getHours()+2]);

    popup
        .setLatLng(event.latlng)
        .setContent( responseObject.name +"  "+ responseObject.rating + "<br>"+ responseObject.address+"<br>" +"Expected traffic (2h ahead): "+ Math.round(popestimation/3)+"<br>"+"People visited this place(Past 2 h):"+ responseObject.numofp +"<br>")
        .openOn(map);
        
}

function visitReg(responseObject,event){
    //Display marker's data that are closer than 20m
    //Added number box and button, in order to register the visit in a certain place
    poiname = responseObject.id;
    popularity = responseObject.data.match(/\d+/g);
           
        if (date.getHours()===22)
            popestimation = parseInt( popularity[date.getHours()+1])+ parseInt(popularity[0]);
        if (date.getHours()===23)
            popestimation = parseInt( popularity[0])+ parseInt(1);
        else
            popestimation = parseInt( popularity[date.getHours()+1])+ parseInt(popularity[date.getHours()+2]);

        popup
            .setLatLng(event.latlng)
            .setContent( responseObject.name +"  "+ responseObject.rating + "<br>"+ responseObject.address+"<br>"  +"Expected traffic (2h ahead): "+ Math.round(popestimation/3)+"<br>"+"People visited this place(Past 2 h):"+ responseObject.numofp + "<br>"+ "<input type='number' id = 'number' min='0' > <button onclick = 'submitVisit()'>Visit Register</button> ")
            .openOn(map);
        
   
    
}

function submitVisit(){
    //Sends the visit data {num of people(optional)} via XMLHTTP request to the server
    var num = document.getElementById("number");
    console.log(num.value);
    const request = new XMLHttpRequest(); 

        const requestData = `poiID=${poiname}&userID=${username}&numOfP=${num.value}`;

        request.open('post', '../php/visitRegister.php');
        request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        request.send(requestData);
}
