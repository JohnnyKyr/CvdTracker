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
    
    request.open('post', '../php/userSettingsRequest.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);


    function responseHandle(responseObject){


    }