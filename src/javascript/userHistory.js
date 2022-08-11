const request = new XMLHttpRequest();

    request.onload = () => {
        let responseObject = null;

        try{
            responseObject = JSON.parse(request.responseText);

        }catch(e){
            console.error("Could not parse JSON");
        }

        if (responseObject){
            responseHandle(responseObject);
            
        }
    };

    const requestData = ``;
    
    request.open('post', '../php/userHistoryRequest.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);

    let place = Array();
    let placetmstmp = Array();
    let cvdtmstmp = Array();
    
    function responseHandle(responseObject){
        var table = document.getElementById("table");
        
        for (let i = 0; i < responseObject.place.length; i++) {
            
            place[i] = responseObject.place[i];
            placetmstmp[i] = responseObject.placetmstmp[i];
            var row = table.insertRow(i+1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = place[i];
            cell2.innerHTML = placetmstmp[i];
            
        }


        // covid timestamp table
        var table2 = document.getElementById("tablea");
        for (let i= 0; i< responseObject.cvdtmstmp.length; i++){
            cvdtmstmp[i] = responseObject.cvdtmstmp[i];
            
            var row = table2.insertRow(i+1);
            var cell = row.insertCell(0);
            cell.innerHTML = cvdtmstmp[i];
        }
    
    }
    
        
    

    