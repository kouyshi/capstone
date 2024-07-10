function togglePasswordVisibility() {
  const passwordInput = document.getElementById('password');
  const visibilityIcon = document.getElementById('visibility-icon');
  const visibilityOffIcon = document.getElementById('visibility-off-icon');
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    visibilityIcon.style.display = 'inline';
    visibilityOffIcon.style.display = 'none';
  } else {
    passwordInput.type = 'password';
    visibilityIcon.style.display = 'none';
    visibilityOffIcon.style.display = 'inline';
  }
}


function closeModal() {
  document.getElementById("successModal").style.display = "none";
}


document.getElementById('password').addEventListener('input', function() {
  var password = this.value;
  var strengthText = document.getElementById('strength-text');
  var lengthCriteria = document.getElementById('length');
  var lowercaseCriteria = document.getElementById('lowercase');
  var uppercaseCriteria = document.getElementById('uppercase');
  var symbolsCriteria = document.getElementById('symbols');
  var numbersCriteria = document.getElementById('numbers');

  // Check password length
  if (password.length >= 12) {
      lengthCriteria.classList.remove('invalid');
      lengthCriteria.classList.add('valid');
  } else {
      lengthCriteria.classList.remove('valid');
      lengthCriteria.classList.add('invalid');
  }

  // Check for lowercase letters
  if (/[a-z]/.test(password)) {
      lowercaseCriteria.classList.remove('invalid');
      lowercaseCriteria.classList.add('valid');
  } else {
      lowercaseCriteria.classList.remove('valid');
      lowercaseCriteria.classList.add('invalid');
  }

  // Check for uppercase letters
  if (/[A-Z]/.test(password)) {
      uppercaseCriteria.classList.remove('invalid');
      uppercaseCriteria.classList.add('valid');
  } else {
      uppercaseCriteria.classList.remove('valid');
      uppercaseCriteria.classList.add('invalid');
  }

  // Check for symbols
  if (/[#?!@$%^&*-]/.test(password)) {
      symbolsCriteria.classList.remove('invalid');
      symbolsCriteria.classList.add('valid');
  } else {
      symbolsCriteria.classList.remove('valid');
      symbolsCriteria.classList.add('invalid');
  }

  // Check for numbers
  if (/\d/.test(password)) {
      numbersCriteria.classList.remove('invalid');
      numbersCriteria.classList.add('valid');
  } else {
      numbersCriteria.classList.remove('valid');
      numbersCriteria.classList.add('invalid');
  }

  // Determine overall strength
  var validCriteria = document.querySelectorAll('.valid').length;
  if (validCriteria === 5) {
      strengthText.textContent = 'STRONG';
      strengthText.style.color = 'green';
  } else {
      strengthText.textContent = 'WEAK';
      strengthText.style.color = 'red';
  }
});


// window.addEventListener(
//   'beforeunload',
//   event =>{
//     event.preventDefault();
//     event.returnValue = '';
//   }
// );
