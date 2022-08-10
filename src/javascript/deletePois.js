deleteButton = document.getElementById("delete");

deleteButton.addEventListener('click', (event) =>{
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
            closebtn = document.getElementById("closebtn");
            closebtn.parentElement.style.display='block';
            text = document.getElementById("text");
            text.innerText = "POIs data have been succesfully deleted from the database!";
            // closebtn.parentElement.
            // style.background-color = '#04aa6db5';

            
        }
    };

    const requestData = ``;
    
    request.open('post', '../php/deletePois.php');
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send(requestData);
});

