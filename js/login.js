class LoginForm {
    constructor() {
        this.form = document.getElementById('loginForm');
        this.initEventListeners();
    }

    initEventListeners() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        
        const forgotPasswordLink = document.querySelector('.forgot-password');
        forgotPasswordLink?.addEventListener('click', (e) => {
            e.preventDefault();
            this.handleForgotPassword();
        });
    }

    handleSubmit(e) {
        e.preventDefault();

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        if (!email || !password) {
            alert('Please enter both email and password');
            return;
        }

        // Typically, this would involve an API call to authenticate
        const loginData = { email, password };
        console.log('Login attempt:', loginData);

        // Simulated login
        if (this.validateLogin(loginData)) {
            alert('Login successful!');
            // Redirect to dashboard or home page
            window.location.href = 'index.html';
        } else {
            alert('Invalid email or password');
        }
    }

    validateLogin(loginData) {
        // In a real application, this would be handled by backend authentication
        // This is a simple mock validation
        return loginData.email.includes('@') && loginData.password.length >= 6;
    }

    handleForgotPassword() {
        const email = prompt('Please enter your email address:');
        if (email) {
            // Typically, this would trigger a password reset flow
            alert('A password reset link has been sent to ' + email);
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new LoginForm();
});