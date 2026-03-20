// Redirect functions

console.log("Script loaded successfully");

const demonstrationMode = 'frontend-only';

//in index.html
const indexLogin = document.getElementById("login-button-index");
const indexSignup = document.getElementById("signup-button-index");
const redirectIndex = document.getElementById("return-main-page");

//in login.html
// const loginRedirectSignup = document.getElementById("redirect-to-signup");

const signUpInstead = document.getElementById("redirect-to-signup");
const loginInstead = document.getElementById("redirect-to-login");
const confirmLogin = document.getElementById("confirm-login");

console.log(typeof loginUsername);
console.log(typeof loginPassword);

switch (demonstrationMode) {
    case 'frontend-only':

        function redirectSignUp() {
            window.location.href = "signup.html";
             console.log("This button was pressed");
        }

        function redirectLogin() {
            window.location.href = "login.html";
             console.log("This button was pressed");
        }

        function redirectToIndex() {
            window.location.href = "index.html";
            console.log("This button was pressed");
        }

        function proceedLogin() {
            const loginUsername = document.getElementById("username-login").value;
            const loginPassword = document.getElementById("password-login").value;

            if (loginUsername === "" || loginPassword === "") {
                alert("For demonstration purposes, username and password fields cannot be empty. Any entry will do.");
                return;
            } else {
                window.location.href = "products.html";
            }
        }

        indexLogin.addEventListener("click", redirectLogin);
        indexSignup.addEventListener("click", redirectSignUp);
        redirectIndex.addEventListener("click", redirectToIndex);
        signUpInstead.addEventListener("click", redirectSignUp);
        confirmLogin.addEventListener("click", proceedLogin);

        // signUpInstead.addEventListener("click", function(e) {
        //     console.log("This button was pressed");
        //     window.location.href = "/signup.html";
        // });

        break;

    case 'full-features':
        //Includes proper credential and interactive functionality


        break;

    default:
        break;
}

