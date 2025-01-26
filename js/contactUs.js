document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const feedbackContainer = document.createElement('div');
    contactForm.appendChild(feedbackContainer);
    feedbackContainer.id = 'feedbackMessage';

    contactForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Form validation
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        // Basic validation
        if (!name || !email || !subject || !message) {
            showFeedback('Please fill out all fields', false);
            return;
        }

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showFeedback('Please enter a valid email address', false);
            return;
        }

        // Simulate form submission (replace with actual backend logic)
        simulateFormSubmission({
            name: name,
            email: email,
            subject: subject,
            message: message
        });
    });

    function showFeedback(message, isSuccess = true) {
        feedbackContainer.textContent = message;
        feedbackContainer.className = isSuccess ? 'success-message' : 'error-message';
        
        // Auto-clear message
        setTimeout(() => {
            feedbackContainer.textContent = '';
            feedbackContainer.className = '';
        }, 5000);
    }

    function simulateFormSubmission(formData) {
        // Simulating an async operation with setTimeout
        setTimeout(() => {
            // In a real-world scenario, you'd use fetch() to send data to a backend
            console.log('Form submitted:', formData);
            showFeedback('Your message has been sent successfully!');
            contactForm.reset();
        }, 1000);
    }
});