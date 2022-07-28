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