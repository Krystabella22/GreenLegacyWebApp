<<<<<<< HEAD
const loginBtn = document.querySelector("#login");
const registerBtn = document.querySelector("#register");
const loginForm = document.querySelector(".login-form");
const registerForm = document.querySelector(".register-form");

// Function to switch forms
function switchForm(showLogin) {
    if (showLogin) {
        loginForm.style.left = '50%'; // Set login form to center
        registerForm.style.left = '150%'; // Move register form out of view to the right
        loginForm.style.zIndex = '2'; // Ensure login form is above
        registerForm.style.zIndex = '1'; // Ensure register form is below
        loginForm.style.visibility = 'visible'; // Show login form
        registerForm.style.visibility = 'hidden'; // Hide register form
        loginForm.style.pointerEvents = 'auto'; // Enable pointer events for login form
        registerForm.style.pointerEvents = 'none'; // Disable pointer events for register form
    } else {
        loginForm.style.left = '-50%'; // Move login form out of view to the left
        registerForm.style.left = '50%'; // Set register form to center
        registerForm.style.zIndex = '2'; // Ensure register form is above
        loginForm.style.zIndex = '1'; // Ensure login form is below
        loginForm.style.visibility = 'hidden'; // Hide login form
        registerForm.style.visibility = 'visible'; // Show register form
        loginForm.style.pointerEvents = 'none'; // Disable pointer events for login form
        registerForm.style.pointerEvents = 'auto'; // Enable pointer events for register form
    }
}

// Updated: Prevent the default form submission behavior
loginBtn.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default action
    switchForm(true);
});

registerBtn.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default action
    switchForm(false);
});

// Function to handle form submission and redirect to homepage
function handleSubmit(event) {
    event.preventDefault(); // Prevent form submission
    window.location.href = 'index.html'; // Redirect to homepage
}

// Ensure correct form is displayed based on window size on load
window.addEventListener('load', () => {
    if (registerBtn.classList.contains('active')) {
        switchForm(false);
    } else {
        switchForm(true);
    }
});
=======
null
>>>>>>> 039097d0beb5d307abd0b8c3780644f93e7e2927
