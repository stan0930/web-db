document.addEventListener('DOMContentLoaded', function() {
    const registrationForm = document.getElementById('registrationForm');
    registrationForm.addEventListener('submit', async function(event) {
        event.preventDefault();
    
        const firstname = document.getElementById('firstname').value;
        const lastname = document.getElementById('lastname').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
    
       if (!firstname || !lastname || !email || !password || !confirmPassword) {
            alert('Please fill in all fields.');
            return false;
        }
    
        if (password !== confirmPassword) {
            alert('Passwords do not match.');
            return false;
        }
    
        try {
            const response = await fetch('/api/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ firstname, lastname, email, password })
            });
    
            const data = await response.json();
    
            if (response.ok) {
                alert(data.message);
              window.location.href = 'thankyou.html';
    
            } else {
                alert('Registration failed: ' + data.error);
            }
        } catch (error) {
            console.error('Fetch error:', error);
            alert('An error occurred during registration.');
        }
    });
});