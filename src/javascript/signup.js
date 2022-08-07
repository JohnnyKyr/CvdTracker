const forma = {
    form : document.getElementById("form"),
    username : document.getElementById("username"),
    password : document.getElementById("password"),
    email : document.getElementById("email"),
    submit : document.getElementById("submit")

};
console.log(forma);

forma.submit.addEventListener('click', (event) =>{
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
            handleErrors(responseObject);
            
        }
    };

    const requestData = `username=${forma.username.value}&password=${forma.password.value}&email=${forma.email.value}`;
    
    request.open('post', '../php/signup.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
});

function handleErrors(responseObject) {
    if (responseObject.ok){
        location.href = '../html/index.php';
    }else{
        //username is blank
        if(responseObject.messages[0] === 0){
            console.log(responseObject);
            setErrorFor(username, 'Username cannot be blank');
        }
        
        //invalid username
        if(responseObject.messages[1] === 0){
            console.log(responseObject);
            setErrorFor(username, 'Invalid username');
        }
        
        //username is taken
        if(responseObject.messages[2] === 0){
            console.log(responseObject);
            setErrorFor(username, 'Username already exists');
        }

        if(responseObject.messages[8] === 1){
            setSuccessFor(username);
        }


        //invalid email address
        if(responseObject.messages[4] === 0){
            console.log(responseObject);
            setErrorFor(email, 'Invalid email address');
        }
        //email is blank
        if(responseObject.messages[3] === 0){
            console.log(responseObject);
            setErrorFor(email, 'Email cannot be empty');
        }

        if(responseObject.messages[9] === 1){
            setSuccessFor(email);
        }



        //password is small
        if(responseObject.messages[6] === 0){
            console.log(responseObject);
            setErrorFor(password, 'Password is too small');
        }
         //invalid password
         if(responseObject.messages[7] === 0){
            console.log(responseObject);
            setErrorFor(password, 'Invalid password');
        }
        //password is empty
        if(responseObject.messages[5] === 0){
            console.log(responseObject);
            setErrorFor(password, 'Password cannot be empty');
        }

        if(responseObject.messages[10] === 1){
            setSuccessFor(password);
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