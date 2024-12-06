const closeAlert = (e) => {
    e.target.parentElement.style.display = 'none'
}

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