document.getElementById('searchBtn').addEventListener('click', function() {
    var searchInput = document.getElementById('searchInput');
    var searchContainer = document.querySelector('.search-container');
    searchContainer.style.flexBasis = '600px'; // Expand to the designated space
    searchInput.style.borderColor = "#000000";
    searchInput.style.opacity = '1';
    searchInput.style.visibility = 'visible';
    searchInput.focus();
  });
  
  document.getElementById('searchInput').addEventListener('blur', function(event) {
    var searchContainer = document.querySelector('.search-container');
    if (!event.target.value) {
        searchContainer.style.flexBasis = '250px'; // Shrink back to the default size
        event.target.style.opacity = '0';
        event.target.style.visibility = 'hidden';
    }
  });

  $(document).ready(function() {
    // Event listener for login button to open the modal
    $('forgotUsernameAnchor').click(function() {
      $('#forgotUsernameModal').modal('show');
    });
  
    // Event listener for form submission
    $('#forgotUsernameModal').submit(function(event) {
      event.preventDefault();
      // Logic to handle the login, potentially making an AJAX call to your server
    });
  
    // Additional event listeners for social login buttons
  });

  $(document).ready(function() {
    // Event listener for login button to open the modal
    $('forgotPasswordAnchor').click(function() {
      $('#forgotPasswordModal').modal('show');
    });
  
    // Event listener for form submission
    $('#forgotPasswordModal').submit(function(event) {
      event.preventDefault();
      // Logic to handle the login, potentially making an AJAX call to your server
    });
  
    // Additional event listeners for social login buttons
  });

  $(document).ready(function() {
    // Event listener for login button to open the modal
    $('loginSignupButton').click(function() {
      $('#signupModal').modal('show');
    });
  });

  // Handle the back button functionality
  $(document).ready(function() {
    $('.btn-back').click(function() {
        var targetModal = $(this).data('target');
        // Close the current modal
        $(this).closest('.modal').modal('hide');
        // Open the target modal
        $(targetModal).modal('show');
    });
  });

  // Handle when user opens forgot username modal
  $('#forgotUsernameAnchor').click(function(event) {
    event.preventDefault();
    event.stopPropagation();
    $('#loginModal').modal('hide'); // Hide login modal so there is no overlay
    setTimeout(function() {
        $('#forgotUsernameModal').modal('show');
    }, 100);
});

// Same here, but for forgot password modal
$('#forgotPasswordAnchor').click(function(event) {
  event.preventDefault();
  event.stopPropagation();
  $('#loginModal').modal('hide');
  setTimeout(function() {
      $('#forgotPasswordModal').modal('show');
  }, 100);
});

$('#loginSignupButton').click(function(event) {
  event.preventDefault();
  event.stopPropagation();
  $('#loginModal').modal('hide');
  setTimeout(function() {
      $('#signupModal').modal('show');
  }, 100);
});

let isFirstNameValid = false;
let isLastNameValid = false;
let isEmailValid = false;
let isUsernameValid = false;

document.getElementById('firstName').addEventListener('input', function(e) {
    var value = e.target.value;
    var errorElement = document.getElementById('nameError');
    if (value.includes(" ")) {
        errorElement.textContent = 'Only enter one word!';
        isFirstNameValid = false;
    } else if (/^[a-zA-Z]*$/.test(value)) {
        errorElement.textContent = '';
        isFirstNameValid = true;
    } else {
        errorElement.textContent = 'Only letters allowed!';
        isFirstNameValid = false;
    }
});

document.getElementById('lastName').addEventListener('input', function(e) {
  var value = e.target.value;
  var errorElement = document.getElementById('nameError');

  if (value.includes(" ")) {
      errorElement.textContent = 'Only enter one word!';
      isLastNameValid = false;
  } else if (/^[a-zA-Z]*$/.test(value)) {
      errorElement.textContent = '';
      isLastNameValid = true;
  } else {
      errorElement.textContent = 'Only letters allowed!';
      isLastNameValid = false;
  }
});

document.getElementById('email').addEventListener('input', function(e) {
  var value = e.target.value;
  var errorElement = document.getElementById('emailError');

  if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(value)) {
      errorElement.textContent = '';
      isEmailValid = true;
  } else {
      errorElement.textContent = 'Invalid email!';
      isEmailValid = false;
  }
});

document.getElementById('signupUsername').addEventListener('input', function(e) {
  var value = e.target.value;
  var errorElement = document.getElementById('usernameError');

  if (/^[a-zA-Z0-9]*$/.test(value)) {
      errorElement.textContent = '';
      isUsernameValid = true;
  } else {
      errorElement.textContent = 'Only letters and numbers allowed within username';
      isUsernameValid = false;
  }
});

  document.getElementById('signupForm').addEventListener('submit', function(event) {
    if (!isFirstNameValid || !isLastNameValid || !isEmailValid || !isUsernameValid) {
        event.preventDefault();
        alert('Please correct the errors before submitting.');
    }
});

    let signUpstate = false;
    let password = document.getElementById("signupPassword");
    let passwordStrength = document.getElementById("password-strength");
    let lowUpperCase = document.querySelector(".low-upper-case i");
    let number = document.querySelector(".one-number i");
    let specialChar = document.querySelector(".one-special-char i");
    let eightChar = document.querySelector(".eight-character i");

    password.addEventListener("keyup", function(){
        let pass = document.getElementById("signupPassword").value;
        checkStrength(pass);
    });

    function toggle() {
      if (signUpstate) {
          document.getElementById("signupPassword").setAttribute("type", "password");
          signUpstate = false;
      } else {
          document.getElementById("signupPassword").setAttribute("type", "text");
          signUpstate = true;
      }
  }  

    function myFunction(show){
        show.classList.toggle("fa-eye-slash");
    }

    function checkStrength(password) {
        let strength = 0;

        // If password contains both lower and uppercase characters
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
            strength += 1;
            lowUpperCase.classList.remove('fa-circle');
            lowUpperCase.classList.add('fa-check');
        } else {
            lowUpperCase.classList.add('fa-circle');
            lowUpperCase.classList.remove('fa-check');
        }
        // If it has numbers and characters
        if (password.match(/([0-9])/)) {
            strength += 1;
            number.classList.remove('fa-circle');
            number.classList.add('fa-check');
        } else {
            number.classList.add('fa-circle');
            number.classList.remove('fa-check');
        }
        // If it has one special character
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
            strength += 1;
            specialChar.classList.remove('fa-circle');
            specialChar.classList.add('fa-check');
        } else {
            specialChar.classList.add('fa-circle');
            specialChar.classList.remove('fa-check');
        }
        // If password is greater than 7
        if (password.length > 7) {
            strength += 1;
            eightChar.classList.remove('fa-circle');
            eightChar.classList.add('fa-check');
        } else {
            eightChar.classList.add('fa-circle');
            eightChar.classList.remove('fa-check');   
        }

        // If value is less than 2
        if (strength < 2) {
            passwordStrength.classList.remove('progress-bar-warning');
            passwordStrength.classList.remove('progress-bar-success');
            passwordStrength.classList.add('progress-bar-danger');
            passwordStrength.style = 'width: 10%';
        } else if (strength == 3) {
            passwordStrength.classList.remove('progress-bar-success');
            passwordStrength.classList.remove('progress-bar-danger');
            passwordStrength.classList.add('progress-bar-warning');
            passwordStrength.style = 'width: 60%';
        } else if (strength == 4) {
            passwordStrength.classList.remove('progress-bar-warning');
            passwordStrength.classList.remove('progress-bar-danger');
            passwordStrength.classList.add('progress-bar-success');
            passwordStrength.style = 'width: 100%';
        }
    }

    document.getElementById('signupForm').addEventListener('submit', function(event) {
      let pass = document.getElementById("signupPassword").value;
      if (!isPasswordStrong(pass)) {
          event.preventDefault();
      }
  });
  
  function isPasswordStrong(password) {
      // Reuse your password strength logic here
      let strength = 0;
  
      if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
          strength += 1;
      }
      if (password.match(/([0-9])/)) {
          strength += 1;
      }
      if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
          strength += 1;
      }
      if (password.length > 7) {
          strength += 1;
      }
  
      return strength >= 4;
  }

  $(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        var login = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            type: "POST",
            url: "login.php",
            data: {loginUsername: login, loginPassword: password},
            success: function(response) {
                if (response.error) {
                    // If there is an error, display it
                    $('#loginError').text(response.errorMessage);
                } else {
                    // If login is successful, redirect or close modal
                    window.location.href = "recipesPage.php";
                }
            }
        });
    });
});