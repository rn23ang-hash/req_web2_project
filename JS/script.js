//login input

const loginForm = document.getElementById('login-form');
const loginConfirm = document.getElementById('confirm-login');

let loginEmail = document.getElementById("username-login");
let loginPassword = document.getElementById("password-login");


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

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // 3. Test the emailValue against the pattern
    if (!emailPattern.test(emailValue)) {
        alert("Please enter a valid email address (e.g., name@example.com)");
        return;
    } else {
        loginForm.submit();
    }


}

loginConfirm.addEventListener("click", loginValidate);

//initial signup input

const signupForm = document.getElementById('signup-form');
const signupConfirm = document.getElementById('confirm-signup');

let signupEmail = document.getElementById('email-signup');
let signupPassword = document.getElementById('password-signup');
let signupConfirmPassword = document.getElementById('confirm-password-signup');
let signupFirstName = document.getElementById('firstname-signup');
let signupLastName = document.getElementById('lastname-signup');
let signupDobMonth = document.getElementById('dob-month-signup');
let signupDobDay = document.getElementById('dob-day-signup');
let signupDobYear = document.getElementById('dob-year-signup');

function signupValidate(e) {

    e.preventDefault();

    const emailValue = signupEmail.value.trim();
    const passwordValue = signupPassword.value.trim();
    const confPassValue = signupConfirmPassword.value.trim();
    const firstNameValue = signupFirstName.value.trim();
    const lastNameValue = signupLastName.value.trim();
    const monthValue = signupDobMonth.value.trim();
    const dayValue = signupDobDay.value.trim();
    const YearValue = signupDobYear.value.trim();

    //month array set

    const monthSetA = ['jan', 'mar', 'may', 'jul', 'aug', 'oct', 'dec'];
    const monthSetB = ['apr', 'jun', 'sep', 'nov'];
    const monthSetC = ['feb']

    if (monthValue === 'jan') {
        
    }

}

signupConfirm.addEventListener("click", signupValidate);