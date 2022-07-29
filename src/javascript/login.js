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

    const usernameValue = username.value;
    const emailValue = email.value;
    const passwordValue = password.value;

    if(usernameValue === ''){
   
        setErrorFor(username);
    } else{
        
        setSuccessFor(username);
    }
    // TODO περιορισμούς για λάθος email
    if(emailValue ===''){
        setErrorFor(email);
    } else{

        setSuccessFor(email);
    }
    
    if(passwordValue === ''){
        
        setErrorFor(password);
    } else{
        // TODO το πότε γίνεται το submit
        setSuccessFor(password);
        event.currentTarget.submit();
    }

});


    
    

function setErrorFor(input){
    const formControl = input.parentElement;
    formControl.className = 'form_control error';
}

function setSuccessFor(input){
    const formControl = input.parentElement;
    formControl.className = 'form_control success';
    
}