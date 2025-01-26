class SignupForm {
    constructor() {
        this.form = document.getElementById('signupForm');
        this.initEventListeners();
    }

    initEventListeners() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        
        confirmPasswordInput.addEventListener('input', () => this.validatePasswordMatch());
        passwordInput.addEventListener('input', () => this.validatePassword());
    }

    validatePassword() {
        const passwordInput = document.getElementById('password');
        const password = passwordInput.value;
        const isValid = this.isPasswordValid(password);
        
        if (!isValid) {
            passwordInput.classList.add('is-invalid');
        } else {
            passwordInput.classList.remove('is-invalid');
        }
        
        return isValid;
    }

    validatePasswordMatch() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        
        if (passwordInput.value !== confirmPasswordInput.value) {
            confirmPasswordInput.classList.add('is-invalid');
            return false;
        } else {
            confirmPasswordInput.classList.remove('is-invalid');
            return true;
        }
    }

    isPasswordValid(password) {
        // At least 8 characters, contains uppercase, lowercase, and number
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        return passwordRegex.test(password);
    }

    handleSubmit(e) {
        e.preventDefault();

        // Validate all fields
        const fullName = document.getElementById('fullName').value.trim();
        const email = document.getElementById('email').value.trim();
        const termsCheckbox = document.getElementById('termsCheckbox');

        const isPasswordValid = this.validatePassword();
        const isPasswordMatching = this.validatePasswordMatch();

        if (!fullName || !email || !isPasswordValid || !isPasswordMatching || !termsCheckbox.checked) {
            alert('Please fill in all fields correctly and accept the terms.');
            return;
        }

        // Prepare user data
        const userData = {
            fullName,
            email,
            password: document.getElementById('password').value
        };

        // Here you would typically send data to backend
        console.log('User Registration Data:', userData);
        alert('Sign up successful!');

        // Reset form
        this.form.reset();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new SignupForm();
});