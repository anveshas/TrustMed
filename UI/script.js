function validateForm() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var mobile = document.getElementById('mobile').value;

    if (name.trim() === '') {
        alert('Please enter your name.');
        return false;
    }

    if (email.trim() === '') {
        alert('Please enter your email.');
        return false;
    }

    if (password.trim() === '') {
        alert('Please set a password.');
        return false;
    }

    if (mobile.trim() === '' ) {
        alert('Please enter your mobile number.');
        return false;
    }
    if (mobile.length !== 10) {
        alert('Mobile number must be exactly 10 digits.');
        return false;
    }
    
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    
    alert('Sign-up successful!'); 
    return true;
}
