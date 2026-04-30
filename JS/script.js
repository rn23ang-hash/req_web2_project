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

    loginForm.addEventListener('input', (e) => {

    const field = e.target;
    
    field.classList.remove('border-red-500', 'bg-red-50');
    
    });

    const hasEmptyFields = [emailValue, passwordValue].some(v => v === "");

    if (hasEmptyFields) {

        const inputs = [loginEmail, loginPassword];
        inputs.forEach(input => {
            if (input.value.trim() === "") {
                input.classList.add('border-red-500', 'bg-red-50');
            }
        });
        alert("Please fill in all fields.");
        return;
    }

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

    const emailValue = signupEmail.value.trim();
    const passwordValue = signupPassword.value.trim();
    const confPassValue = signupConfirmPassword.value.trim();
    const firstNameValue = signupFirstName.value.trim();
    const lastNameValue = signupLastName.value.trim();
    const dobValue = signupDob.value;
    const today = new Date();
    const birthDate = new Date(dobValue);

    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    signupForm.addEventListener('input', (e) => {

    const field = e.target;
    
    field.classList.remove('border-red-500', 'bg-red-50');
    
    });


    const hasEmptyFields = [emailValue, passwordValue, confPassValue, firstNameValue, lastNameValue].some(v => v === "");

if (hasEmptyFields) {
    // If you want to highlight EVERY empty field at once:
    const inputs = [signupEmail, signupPassword, signupConfirmPassword, signupFirstName, signupLastName];
    inputs.forEach(input => {
        if (input.value.trim() === "") {
            input.classList.add('border-red-500', 'bg-red-50');
        }
    });
    alert("Please fill in all fields.");
    return;
}

     if (!emailPattern.test(emailValue)) {
            console.log("Invalid email format");
            signupEmail.classList.add('border-red-500', 'bg-red-50');
            alert("Please enter a valid email address (e.g., name@example.com)");
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


    if (age < 18) {
        console.log("User is underage");
        signupDob.classList.add('border-red-500', 'bg-red-50');
        alert("You must be at least 18 years old to sign up");
        return;
    }

    signupForm.submit();

}

signupForm.addEventListener("submit", signupValidate);

}