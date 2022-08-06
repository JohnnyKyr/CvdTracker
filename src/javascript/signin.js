const si_form = {
    form : document.getElementById("si-form"),
    si_username : document.getElementById("si-username"),
    si_password : document.getElementById("si-password"),
    si_submit : document.getElementById("si-submit")

};

si_form.si_submit.addEventListener('click', (event) =>{
    event.preventDefault();
    console.log(si_form.si_username.value);
    console.log(si_form.si_password.value);
    const request = new XMLHttpRequest();

    request.onload = () => {
        let responseObject = null;

        try{
            responseObject = JSON.parse(request.responseText);

        }catch(e){
            console.error("Could not parse JSON");
        }

        if (responseObject){
            si_handleErrors(responseObject);
        }
    };

    const requestData = `si_username=${si_form.si_username.value}&si_password=${si_form.si_password.value}`;
    
    request.open('post', '../php/signin.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
});

function si_handleErrors(responseObject) {
    if (responseObject.ok){
        location.href = '../html/user.php';
    }else{
        if(responseObject.messages[0] === 0){
            console.log(responseObject);
            setErrorFor(si_form.si_username, 'Username cannot be blank');
        }

        if(responseObject.messages[1] === 0){
            setErrorFor(si_form.si_password, 'Password cannot be blank');
        }
    
        if(responseObject.messages[2] === 0){
            setErrorFor(si_form.si_password, 'Not a matching combination');
            setErrorFor(si_form.si_username, 'Not a matching combination');
            
        }
    
    
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