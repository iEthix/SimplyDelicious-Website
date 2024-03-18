<?php
include("signup.php");
include("login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes Page</title>
    <link rel="stylesheet" href="recipesPageStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Damion&family=Dancing+Script:wght@400..700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Damion&family=Dancing+Script:wght@400..700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<header>
  <div class="header">
    <!-- Logo -->
    <div class="header-logo">
      <a href="homepage.php">
        <img src="SimplyDeliciousLogo.png" alt="SimplyDelicious Logo">
      </a>
    </div>

    <!-- Navigation -->
    <div class="header-nav">
      <a href="recipesPage.php" class="ml-5">Recipes Page</a>
      <a href="pages.html">Pages</a>
      <div class="search-container">
        <button id="searchBtn" class="search-btn">
            <i class="fas fa-search"></i>
        </button>
        <input type="text" id="searchInput" class="search-input" placeholder="Search...">
    </div>     
  </div>

<div class="profile-container">
  <input id="toggler" type="checkbox">
  <label for="toggler">
    <img style='width: 80px; height: 80px;' src="profile-icon.jpg" alt="">
  </label>
  <div class="dropdown">
    <a href="logout.php">Logout</a>
  </div>
</div>

  <div class="auth-buttons">
    <!-- Login Button -->
    <button type="button" id="loginButtonNav" class="btn-auth" data-toggle="modal" data-target="#loginModal" style='margin-top: 32px;'>
      Login
    </button>
  
    <!-- Signup Button -->
    <button type="button" id="signupButtonNav" class="btn-auth" data-toggle="modal" data-target="#signupModal" style='margin-top: 32px;'>
      Sign Up
    </button>
  </div>
  </div>
</header>

<!-- Login Modal -->
<div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-custom-height">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Log In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Social Login Options -->
        <button id="googleLogin">
          <i class="fab fa-google" style="margin-right: 10px"></i>
          Continue with Google
        </button>
        <hr/>
        <!-- Manual Login Form -->
        <form id="loginForm" action="" method="POST">
          <input type="text" id="username" name="loginUsername" placeholder="Email or username *" required>
          <div class="form-group">
            <input id="password" name="loginPassword" type="password" placeholder="Enter your password" required>
            <span class="show-login-pass" onclick="toggleLoginPassword()">
              <i class="far fa-eye" onclick="myFunction(this)"></i>
            </span>
          </div>
          <div class="login-options">
          <p class="error" id="loginError"><?php echo $loginError;?></p>
            <p class="forgot-username-password">Forgot your
            <a id="forgotUsernameAnchor" href="#" data-toggle="modal" data-target="#forgotUsernameModal">username</a>
            or
            <a id="forgotPasswordAnchor" href="#" data-toggle="modal" data-target="#forgotPasswordModal">password?</a>
            </p>
            <p>Don't have an account?
            <a id="loginSignupButton" href="#" data-toggle="modal" data-target="#signupModal">Sign Up</a>
          </p>
          </div>
          <button class="loginButton" type="submit">Log In</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Signup Modal -->
<div class="modal" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Signup Form -->
        <form id="signupForm" action="signup.php" method="POST">
          <h4 style='font-family: "Merriweather", serif; font-weight: 400; font-style: normal; font-size: 30px;'>General Information</h4>
          <input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $firstName;?>" required>
          <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $lastName;?>" required>
          <p class="error" id="nameError"><?php echo $nameError;?></p>
          <h4 style='font-family: "Merriweather", serif; font-weight: 400; font-style: normal; font-size: 30px;'>Contact Information</h4>
          <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email;?>" required>
          <p class="error" id="emailError"><?php echo $emailError;?></p>
          <h4 style='font-family: "Merriweather", serif; font-weight: 400; font-style: normal; font-size: 30px;'>Account Information</h4>
          <input type="text" id="signupUsername" name="signupUsername" placeholder="Username" value="<?php echo $email;?>" required>
          <p class="error" id="usernameError"><?php echo $usernameError;?></p>
          <div class="form-group">
            <input id="signupPassword" name="signupPassword" type="password" placeholder="Enter your password" required>
            <span class="show-pass" onclick="toggle()">
              <i class="far fa-eye" onclick="myFunction(this)"></i>
            </span>
            <div id="popover-password">
              <p><span id="result"></span></p>
              <div class="progress">
                <div id="password-strength" class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
              </div>
              <ul class="list-unstyled">
                <li class="">
                  <span class="low-upper-case" style="font-size: 20px">
                    <i class="fas fa-circle" aria-hidden="true"></i>
                    &nbsp;Lowercase &amp; Uppercase
                  </span>
                </li>
                <li class="">
                  <span class="one-number" style="font-size: 20px">
                    <i class="fas fa-circle" aria-hidden="true"></i>
                    &nbsp;Number (0-9)
                  </span> 
                </li>
                <li class="">
                  <span class="one-special-char" style="font-size: 20px">
                    <i class="fas fa-circle" aria-hidden="true"></i>
                    &nbsp;Special Character (!@#$%^&*)
                  </span>
                </li>
                <li class="">
                  <span class="eight-character" style="font-size: 20px">
                    <i class="fas fa-circle" aria-hidden="true"></i>
                    &nbsp;At least 8 Characters
                  </span>
                </li>
              </ul>
            </div>
          </div>
          <button class="signupButton" type="submit">Sign Up</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="forgotUsernameModal" tabindex="-1" role="dialog" aria-labelledby="forgotUsernameModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-back" data-target="#loginModal" aria-label="Back">
          <span aria-hidden="true">&larr;</span>
        </button>
        <h5 class="modal-title">Forgot Username</h5>
        <p class="modal-subtitle" style="font-size: 20px; margin-top: 10px;">Tell us the email address associated with your SimplyDelicious account, and we’ll send you an email with your username.</p>
        <button type="button" style="margin-top: 0px" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="forgotUsernameForm">
          <input type="email" id="forgotUsernameEmail" placeholder="Enter your email address" required>
          <button type="submit" style="padding: 10px; border-radius: 10px; margin-top: 15px; background-color: white; font-size: 20px;">Send Username</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-back" data-target="#loginModal" aria-label="Back">
          <span aria-hidden="true">&larr;</span>
        </button>
        <h5 class="modal-title">Forgot Password</h5>
        <p class="modal-subtitle" style="font-size: 20px; margin-top: 10px;">Tell us the username and email associated with your SimplyDelicious account, and we’ll send you an email with your password.</p>
        <button type="button" style="margin-top: 0px" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="forgotPasswordForm">
          <input type="text" id="forgotPassUsernameInput" placeholder="username" required>
          <input type="email" id="forgotPassEmailInput" placeholder="email" required>
          <button type="submit" style="padding: 10px; border-radius: 10px; margin-top: 15px; background-color: white; font-size: 20px;">Send Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<body>
    
<div class="recipes-page-description">
  <p style="margin: 50px 0px 0px 50px;">Recipes curated just for you, that can only be described as simply delicious.</p>
</div>

</body>
<script src="recipesPageScript.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Check if the user is logged in
    var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    var loginState = false;

    if (isLoggedIn) {
      // Hide login and signup buttons if logged in
      document.getElementById("loginButtonNav").style.display = "none";
      document.getElementById("signupButtonNav").style.display = "none";
      // Show profile container
      document.querySelector(".profile-container").style.display = "block";
  } else {
      // Show login and signup buttons
      document.getElementById("loginButtonNav").style.display = "block";
      document.getElementById("signupButtonNav").style.display = "block";
      // Hide profile container
      document.querySelector(".profile-container").style.display = "none";
  }
    
    // Add click event to all elements with the class 'recipe-link'
    var recipeLinks = document.querySelectorAll('.recipe-link');
    recipeLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            if (!isLoggedIn) {
                event.preventDefault(); // Prevent the default link behavior
                $('#loginModal').modal('show'); // Show signup modal
            } else {
                // If logged in, you can navigate to the recipe page.
                window.location.href = link.getAttribute('data-recipe-url');
            }
        });
    });

    function toggleLoginPassword() {
        var passwordInput = document.getElementById("password");
        if (loginState) {
            passwordInput.setAttribute("type", "password");
            loginState = false;
        } else {
            passwordInput.setAttribute("type", "text");
            loginState = true;
        }
    }
    window.toggleLoginPassword = toggleLoginPassword;
});
</script>
</html>