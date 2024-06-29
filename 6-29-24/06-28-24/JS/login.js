    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const toggleOn = document.getElementById('togglePassword');
        const toggleOff = document.getElementById('togglePasswordOff');
        
        passwordInput.type = 'text';
        toggleOn.style.display = 'none';
        toggleOff.style.display = 'inline';
    });

    document.getElementById('togglePasswordOff').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const toggleOn = document.getElementById('togglePassword');
        const toggleOff = document.getElementById('togglePasswordOff');
        
        passwordInput.type = 'password';
        toggleOn.style.display = 'inline';
        toggleOff.style.display = 'none';
    });
