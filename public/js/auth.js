const loginForm = document.querySelector("#login");
const registrationForm = document.querySelector("#registration");
const loginButton = document.querySelector("#sign-in");
const registrationButton = document.querySelector("#sign-up");
const passwordInput = document.querySelector("#password");
const registerButton = document.querySelector("#register-button");

registerButton.style.backgroundColor ="rgba(92, 184, 92, 0.83)";

loginButton.addEventListener('click',(e)=>{
    registrationForm.style.display = "none";
    loginForm.style.display = "block";
});
registrationButton.addEventListener('click',(e)=>{
    loginForm.style.display = "none";
    registrationForm.style.display = "block";
});
function validatePassword(password){
    const hasLowerCase = /[a-z]/.test(password);
    const hasUpperCase = /[A-Z]/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?"{}|<>]/.test(password);
    const hasNumber = /\d/.test(password);
    return hasUpperCase && hasSpecialChar && hasNumber && hasLowerCase;
}
passwordInput.addEventListener("input",(e)=>{
    const errorMessage = document.querySelector("#error-message");
    errorMessage.style.color = "red";
    if (!validatePassword(document.querySelector("#password").value)){
        errorMessage.style.display = "block";
        errorMessage.textContent = "Пароль должен содержать: цифры,большие и маленькие латинские буквы,специальные символы";
        registerButton.style.backgroundColor ="rgba(92, 184, 92, 0.83)";
        registerButton.setAttribute("disabled","");
    }else if(document.querySelector("#password").value.length<8){
        errorMessage.textContent = "Пароль должен быть не менее 8 символов";
        registerButton.style.backgroundColor ="rgba(92, 184, 92, 0.83)";
        registerButton.setAttribute("disabled","");
    }else{
        errorMessage.style.display = "none";
        registerButton.style.backgroundColor ="rgb(92, 184, 92)";
        registerButton.removeAttribute("disabled");
    }
})
