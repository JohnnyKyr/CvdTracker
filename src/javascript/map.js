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

let markerLayer = L.featureGroup().addTo(map);
let popup = L.popup()
.setContent("I am a standalone popup.");

let marker = Array();

function HandleResponse(responseObject){
   let data  =new Date();
   
    console.log(data.getHours());
    for (let i = 0; i < responseObject.lat.length; i++) {
        marker[i] = {"lat":responseObject.lat[i],"lng": responseObject.lng[i], "id":responseObject.id[i]}
        L.marker([responseObject.lat[i],responseObject.lng[i]]).addTo(markerLayer).bindPopup(popup);
      } 
}

markerLayer.addEventListener("click",(event)=>{
    marker_id = marker.find(marker => marker.lat === event.latlng.lat,marker.lng===event.latlng.lng)["id"];
    
    
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


    const requestData = `id =${marker_id}`;
    
    request.open('post', '../php/popularityHandle.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
   
});


