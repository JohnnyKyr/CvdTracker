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
    
    request.open('post', '../php/userListRequest.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);

    let pdate = Array();
    let pname = Array();
    
    function responseHandle(responseObject){
        var table = document.getElementById("table");
        for (let i = 0; i < responseObject.name.length -1; i++) {
        pname[i] = responseObject.name[i];
        pdate[i] = responseObject.date[i];
        // console.log(username[i]);
        var row = table.insertRow(i+1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = pname[i];
        cell2.innerHTML = pdate[i];
        
    }
        
        // table.innerText = responseObject.users
    
    
    }
    
        
    

    