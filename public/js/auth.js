const loginForm = document.querySelector("#login");
const registrationForm = document.querySelector("#registration");
const loginButton = document.querySelector("#sign-in");
const registrationButton = document.querySelector("#sign-up");
loginButton.addEventListener('click',(e)=>{
    registrationForm.style.display = "none";
    loginForm.style.display = "block";
});
registrationButton.addEventListener('click',(e)=>{
    loginForm.style.display = "none";
    registrationForm.style.display = "block";
});