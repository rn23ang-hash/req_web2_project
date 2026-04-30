//login input

const loginForm = document.getElementById('login-form');
const loginConfirm = document.getElementById('confirm-login');

let loginEmail = document.getElementById("username-login");
let loginPassword = document.getElementById("password-login");

const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if (loginForm) {

function loginValidate(e) {

    e.preventDefault();

    const emailValue = loginEmail.value.trim();
    const passwordValue = loginPassword.value.trim();

    console.log("This function was clicked");
    console.log(emailValue);
    console.log(passwordValue);

    if (emailValue === "" || passwordValue === "") {
        alert("Fields cannot be left empty");
        return;
    }


    // 3. Test the emailValue against the pattern
    if (!emailPattern.test(emailValue)) {
        alert("Please enter a valid email address (e.g., name@example.com)");
        return;
    } else {
        loginForm.submit();
    }


}

loginForm.addEventListener("submit", loginValidate);

}

//initial signup input


const signupForm = document.getElementById('signup-form');
const signupConfirm = document.getElementById('confirm-signup');

let signupEmail = document.getElementById('email-signup');
let signupPassword = document.getElementById('password-signup');
let signupConfirmPassword = document.getElementById('confirm-password-signup');
let signupFirstName = document.getElementById('firstname-signup');
let signupLastName = document.getElementById('lastname-signup');
let signupDob = document.getElementById('dob-signup');


if (signupForm) {


function signupValidate(e) {

    e.preventDefault();

    console.log("The function is triggered.");

    const emailValue = signupEmail.value.trim();
    const passwordValue = signupPassword.value.trim();
    const confPassValue = signupConfirmPassword.value.trim();
    const firstNameValue = signupFirstName.value.trim();
    const lastNameValue = signupLastName.value.trim();
    const dobValue = new Date(signupDob.value);


    let signupArray = [emailValue, passwordValue, confPassValue, firstNameValue, lastNameValue, dobValue];

    const hasEmptyFields = signupArray.some(value => value === "");

     if (!emailPattern.test(emailValue)) {
            console.log("Invalid email format");
            signupEmail.classList.add(('border-red-500', 'bg-red-50'));
            alert("Please enter a valid email address (e.g., name@example.com)");
            return;
    }

    if (hasEmptyFields) {
        console.log("Empty fields found!");
        signupEmail.classList.add('border-red-500', 'bg-red-50');
        alert("Please fill in all fields.");
        return;
    } 
    
    if (emailValue === "") {
        signupEmail.classList.add('border-red-500', 'bg-red-50');
        alert("Email is required");
        return;
    }

    if (passwordValue.length < 10) {
        signupPassword.classList.add('border-red-500', 'bg-red-50');
        alert("Password must be at least 10 characters");
        return;
    }

    if (passwordValue !== confPassValue) {
        signupConfirmPassword.classList.add('border-red-500', 'bg-red-50');
        alert("Passwords do not match");
        return;
    }



}

signupForm.addEventListener("submit", signupValidate);

}