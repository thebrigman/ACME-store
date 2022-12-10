let password = document.getElementById('create-password');
let passCheck = document.getElementById('check-psswd');




password.addEventListener('keyup', validate);
passCheck.addEventListener('keyup', validate);



function validate(event){
    let passRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    let pin = document.getElementById('pin');
    let number = document.getElementById('number');
    
    pin.innerText = ((passRegex.test(password.value)) ? "" : "Password must be 8 characters long");
    number.innerText = ((passRegex.test(password.value)) ? "" : "Password must contain a number");
    
    pin.className = ((passRegex.test(password.value)) ? "valid" : "invalid");
    number.className = ((passRegex.test(password.value)) ? "valid" : "invalid");

}

console.log("PIN :", pin);



let formCreate = document.querySelectorAll('form#form-create > input[type="password"]');
console.log(formCreate);

for(item of formCreate){
    item.addEventListener('keyup', checkPass);
}

function checkPass(){
    let password = document.getElementById('create-password');
    let passCheck = document.getElementById('check-psswd');
    let msg = document.getElementById('verify');
    let but = document.getElementById('create-button');
    console.log("passcheck: ", passCheck.value.length);
    
    if(passCheck.value.length >= 1 ){
        if(password.value == passCheck.value){
        
            msg.className = "valid";
            msg.innerText = "";
            but.disabled = false;
    
        }else
    
            msg.innerText = "Password and \"Verify Password\" do not match.";
            msg.className = "invalid";
            but.diabled = true;
        }
    }
    


