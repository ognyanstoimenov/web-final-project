const loginSwitch = document.getElementById("loginSwitch");

loginSwitch.onclick = function () {

    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const isSwitched = loginSwitch.checked;
    registerForm.style.display = isSwitched? "none" : "block";
    loginForm.style.display = isSwitched? "block" : "none";
}