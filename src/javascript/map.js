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


let marker = Array();

function HandleResponse(responseObject){
   
    for (let i = 0; i < responseObject.lat.length; i++) {
        marker[i] = {"lat":responseObject.lat[i],"lng": responseObject.lng[i],
        "id":responseObject.id[i],"name":responseObject.name[i],"rating":responseObject.rating[i],
        "data":responseObject.data[i],"address":responseObject.address[i]}
       // L.marker([responseObject.lat[i],responseObject.lng[i]]).bindPopup("Hello").addTo(markerLayer);
      }
      const date = new Date(); 
      SetMarkers(date.getHours());
}


function SetMarkers(hour){
    
    for(let i=0;i<marker.length;i++){
        data = marker[i].data.match(/\d+/g);
        coords = [marker[i].lat,marker[i].lng];
        if (data[hour]<=32)
        L.marker(coords,{icon:greemarker}).addTo(map)
        if (data[hour]>=32 &&data[hour]<= 65)
        L.marker(coords,{icon:yellowmarker}).addTo(map)
        if (data[hour]>=66)
        L.marker(coords,{icon:redmarker}).addTo(map)
        
    }
}
markerLayer.addEventListener("click",(event)=>{
    let popup = L.popup()
    .setContent("I am a standalone popup.");
});


