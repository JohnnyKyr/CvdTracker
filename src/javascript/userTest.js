

const form = {
form : document.getElementById("form"),
date : document.getElementById("date"),
submit : document.getElementById("submit")

};


form.submit.addEventListener('click', (event) =>{
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
            console.log("ok");
            
        }
    };

    const requestData = `date=${form.date.value}`;
    
    request.open('post', '../php/userTestRequest.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
});