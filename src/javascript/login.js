const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

document.addEventListener("mousemove", parallax)
function parallax(e){
    document.querySelectorAll("img").forEach(function(move){

        var moving_value = move.getAttribute("data-value");
        var x = (e.clientX * moving_value) / 150;
        var y = (e.clientY * moving_value) / 90;

    move.style.transform = "translateX(" + x + "px) translateY(" + y + "px)";
    });
}

const form = document.getElementById("form");
const username = document.getElementById("username");
const password = document.getElementById("password");
const email = document.getElementById("email");


form.addEventListener('submit', function(event){
    event.preventDefault();

    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    var passwordLenght = passwordValue.length;
    let sumbmitArray = [false,false,false];

    if(usernameValue === ''){
   
        setErrorFor(username, 'Username cannot be blank');
        sumbmitArray[0] = false;
    } else{
        
        setSuccessFor(username);
        sumbmitArray[0] = true;
        submitCheck(sumbmitArray);
        
    }
    
    if(emailValue ===''){
        setErrorFor(email,'Email cannot be blank');
        sumbmitArray[1] = false;
    }else if(!isEmail(emailValue)){
        setErrorFor(email,'Email is not valid');
        sumbmitArray[1] = false;
    } else{
        setSuccessFor(email);
        sumbmitArray[1] = true;
        submitCheck(sumbmitArray);
    }
    
    if(passwordValue === ''){
        sumbmitArray[2] = false;
        setErrorFor(password,'Password cannot be blank');
        
    }else if(passwordLenght < 8){
        sumbmitArray[2] = false;
        setErrorFor(password,'Password must be at least 8 characters');
    }else if(!containsCapital(passwordValue)){
        sumbmitArray[2] = false;
        setErrorFor(password,'Password must contain capital letter');
    }else{
        // TODO το πότε γίνεται το submit
        setSuccessFor(password);
        sumbmitArray[2] = true;
        submitCheck(sumbmitArray);
        
    }

    function submitCheck(array){
        if (array[0] === true && array[1] === true && array[2]== true){
            event.currentTarget.submit();
        }
       
    }

});


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


function isEmail(email) {
    return /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email);
}

function containsCapital(password){
    return /^([a-z]*([A-Z]+)[a-z]*)+$/.test(password);
}

