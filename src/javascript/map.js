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
   
    for (let i = 0; i < responseObject.lat.length; i++) {
        marker[i] = {"lat":responseObject.lat[i],"lng": responseObject.lng[i],
        "id":responseObject.id[i],"name":responseObject.name[i],"rating":responseObject.rating[i],
        "data":responseObject.data[i].match(/\d+/g),"address":responseObject.address[i]}
       // L.marker([responseObject.lat[i],responseObject.lng[i]]).bindPopup("Hello").addTo(markerLayer);
      }
      
      SetMarkers(date.getHours());
}


function SetMarkers(hour){
    map.setView(new L.LatLng(38.25, 21.745),12);
    
    console.log(username);
    for(let i=0;i<marker.length;i++){
        
        coords = [marker[i].lat,marker[i].lng];
        if (marker[i].data[hour]<=32)
        L.marker(coords,{icon:greemarker}).addTo(markerLayer);
        if (marker[i].data[hour]>=32 &&marker[i].data[hour]<= 65)
        L.marker(coords,{icon:yellowmarker}).addTo(markerLayer);
        if (marker[i].data[hour]>=66)
        L.marker(coords,{icon:redmarker}).addTo(markerLayer);
        
    }
}


markerLayer.addEventListener("click",(event)=>{
    
    
    popupmarker = marker.find(marker => marker.lat === event.latlng.lat,marker.lng===event.latlng.lng);
    
    popestimation = parseInt( popupmarker.data[date.getHours()]) +parseInt( popupmarker.data[date.getHours()+1])+ parseInt(popupmarker.data[date.getHours()+2])
    

    popup
        .setLatLng(event.latlng)
        .setContent( popupmarker["name"] +"  "+ popupmarker["rating"] + "<br>"+ popupmarker["address"]+"<br>" +"Estimation: "+ Math.round(popestimation/3)+"<br>" + "<button type='button' id='visit_reg'>Visit Register</button>")
        .openOn(map);
});


// var visit_reg = document.getElementById("visit_reg");
document.getElementById("visit_reg").innerText = 'kaka';
document.getElementById("visit_reg").addEventListener("click",(event)=>{
    place = marker.find(marker => marker.lat === event.latlng.lat,marker.lng===event.latlng.lng);
        const request = new XMLHttpRequest();

        request.onload = () => {
            let responseObject = null;

            try{
                responseObject = JSON.parse(request.responseText);

            }catch(e){
                console.error("Could not parse JSON");
            }

            if (responseObject){
                dataResponse(responseObject);
            }
                };

        const requestData = `poiID=${place.id}&userID=${username}&tmstmp=${NULL}&numofp=${NULL}`;

        request.open('post', '../php/visitRegister.php');
        request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        request.send(requestData);
    });


