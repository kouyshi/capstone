function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const visibilityIcon = document.getElementById('visibility-icon');
    const visibilityOffIcon = document.getElementById('visibility-off-icon');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      visibilityIcon.style.display = 'none';
      visibilityOffIcon.style.display = 'inline';
    } else {
      passwordInput.type = 'password';
      visibilityIcon.style.display = 'inline';
      visibilityOffIcon.style.display = 'none';
    }
  }