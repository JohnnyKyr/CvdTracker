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

function HandleResponse(responseObject){
   
    
    for (let i = 0; i < responseObject.lat.length; i++) {
        L.marker([responseObject.lat[i],responseObject.lng[i]]).addTo(map);
      } 
}
