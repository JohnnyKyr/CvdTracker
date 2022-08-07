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
    if(responseObject.message === 0){
        setErrorFor(username,'Username already exists');
    }else if(responseObject.message == 1){
        setSuccessFor(username);
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