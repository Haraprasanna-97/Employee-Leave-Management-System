const registerValidateEmail = (e) => {
    const email = e.target.value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const errorMessage = document.getElementById('register-error-message');
    const registerButton = document.getElementById('register-btn');

    if (emailPattern.test(email)) {
        errorMessage.textContent = 'Valid email address.';
        errorMessage.style.color = 'green';
        registerButton.disabled = false
    } else {
        errorMessage.textContent = 'Please enter a valid email address.';
        errorMessage.style.color = 'red';
        registerButton.disabled = true
    }
}

const loginValidateEmail = (e) => {
    const email = e.target.value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const errorMessage = document.getElementById('login-error-message');
    const loginButton = document.getElementById('login-btn');

    if (emailPattern.test(email)) {
        errorMessage.textContent = 'Valid email address.';
        errorMessage.style.color = 'green';
        loginButton.disabled = false
    } else {
        errorMessage.textContent = 'Please enter a valid email address.';
        errorMessage.style.color = 'red';
        loginButton.disabled = true
    }
}

const registerValidatePassword = (e) => {
    let password = e.target.value
    const message = document.getElementById('register-password-message');
    const registerButton = document.getElementById('register-btn');
    // Criteria for validation
    const minLength = 8;
    const uppercaseRegex = /[A-Z]/;
    const lowercaseRegex = /[a-z]/;
    const numberRegex = /[0-9]/;
    const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
    
    if (password.length < minLength) {
        message.textContent = `Password must be at least ${minLength} characters long.`;
        message.style.color = 'red';
        registerButton.disabled = true;
    }
    else if (!uppercaseRegex.test(password)) {
        message.textContent = 'Password must contain at least one uppercase letter.';
        message.style.color = 'red';
        registerButton.disabled = true;
    }
    else if (!lowercaseRegex.test(password)) {
        message.textContent = 'Password must contain at least one lowercase letter.';
        message.style.color = 'red';
        registerButton.disabled = true;
    }
    else if (!numberRegex.test(password)) {
        message.textContent = 'Password must contain at least one number.';
        message.style.color = 'red';
        registerButton.disabled = true;
    }
    else if (!specialCharRegex.test(password)) {
        message.textContent = 'Password must contain at least one special character.';
        message.style.color = 'red';
        registerButton.disabled = true;
    }
    else {
        message.textContent = 'Password is valid.';
        message.style.color = 'green';
        registerButton.disabled = false;
    }
};

const loginValidatePassword = (e) => {
    let password = e.target.value
    const message = document.getElementById('login-password-message');
    const loginButton = document.getElementById('login-btn');
    // Criteria for validation
    const minLength = 8;
    const uppercaseRegex = /[A-Z]/;
    const lowercaseRegex = /[a-z]/;
    const numberRegex = /[0-9]/;
    const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;

    if (password.length < minLength) {
        message.textContent = `Password must be at least ${minLength} characters long.`;
        message.style.color = 'red';
        loginButton.disabled = true;
    }
    else if (!uppercaseRegex.test(password)) {
        message.textContent = 'Password must contain at least one uppercase letter.';
        message.style.color = 'red';
        loginButton.disabled = true;
    }
    else if (!lowercaseRegex.test(password)) {
        message.textContent = 'Password must contain at least one lowercase letter.';
        message.style.color = 'red';
        loginButton.disabled = true;
    }
    else if (!numberRegex.test(password)) {
        message.textContent = 'Password must contain at least one number.';
        message.style.color = 'red';
        loginButton.disabled = true;
    }
    else if (!specialCharRegex.test(password)) {
        message.textContent = 'Password must contain at least one special character.';
        message.style.color = 'red';
        loginButton.disabled = true;
    }
    else {
        message.textContent = 'Password is valid.';
        message.style.color = 'green';
        loginButton.disabled = false;
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const startDateInput = document.getElementById('start-date');
    const endDateInput = document.getElementById('end-date');
    const message = document.getElementById('message');
    const button = document.getElementById('form-btn');

    const validateDates = () => {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (startDateInput.value && endDateInput.value) {
            if (endDate >= startDate) {
                message.textContent = "";
                button.disabled = false
            } else {
                message.textContent = "End date must be ahead of start date.";
                message.style.color = "red";
                button.disabled = true
            }
        } else {
            message.textContent = "";
        }
    };

    startDateInput.addEventListener('input', validateDates);
    endDateInput.addEventListener('input', validateDates);
});

const toggleRegisterPasswordVisibility = (e) => {   
    console.log("event fired") 
    e.preventDefault()
    if (document.getElementById('show-hide-icon').innerText === "visibility") {
        document.getElementById('show-hide-icon').innerText = "visibility_off"
        document.getElementById('register-password').type = "text"
    }
    else {
        document.getElementById('register-password').type = "password"
        document.getElementById('show-hide-icon').innerText = "visibility"
    }
}

const toggleLoginPasswordVisibility = (e) => {   
    console.log("event fired") 
    e.preventDefault()
    if (document.getElementById('show-hide-icon').innerText === "visibility") {
        document.getElementById('show-hide-icon').innerText = "visibility_off"
        document.getElementById('login-password').type = "text"
    }
    else {
        document.getElementById('login-password').type = "password"
        document.getElementById('show-hide-icon').innerText = "visibility"
    }
}