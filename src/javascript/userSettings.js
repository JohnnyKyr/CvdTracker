const form = {
    form : document.getElementById("form"),
    username : document.getElementById("username"),
    password : document.getElementById("password"),
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
            console.log(responseObject);
            errorHandle(responseObject);
            
        }
    };

    const requestData = `username=${form.username.value}&password=${form.password.value}`;
    
    request.open('post', '../php/userSettingsRequest.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
});


function errorHandle(responseObject){
    if(responseObject.messages[0] === 0){
        setErrorFor(username,'Username already exists');
    }

    if(responseObject.messages[1] === 0){
        setWarningFor(username,'Username did not change!');
    }

    if(responseObject.messages[0] === 1 && responseObject.messages[1] === 1 ){
        setSuccessFor(username);
    }

    if(responseObject.messages[2] === 0){
        setWarningFor(password,'Password did not change!');
    }

    if(responseObject.messages[3] === 0){
        setErrorFor(password,'Password is too small');
    }

    if(responseObject.messages[4] === 0){
        setErrorFor(password,'Invalid password');
    }

    if(responseObject.messages[2] === 0){
        setWarningFor(password,'Password did not change!');
    }
    
    if(responseObject.messages[2] === 1 && responseObject.messages[3] === 1 && responseObject.messages[4] === 1 ){
        setSuccessFor(password);
    }
}


function setErrorFor(input, message){
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    small.innerText = message;
    formControl.className = 'form_control error';
}

function setSuccessFor(input){
    const formControl = input.parentElement;
    formControl.className = 'form_control success';
    
}

function setWarningFor(input, message){
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    small.innerText = message;
    formControl.className = 'form_control warning';
}
