<?php
include("signup.php"); // Include only if needed for specific functionality on this page
include("login.php"); // Include only if needed for specific functionality on this page

if (isset($_SESSION['firstLogin']) && $_SESSION['firstLogin']) {
    echo "<script>var showFirstLoginModal = true;</script>";
    $_SESSION['firstLogin'] = false; // Reset the flag
} else {
    echo "<script>var showFirstLoginModal = false;</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimplyDelicious Homepage</title>
    <link rel="stylesheet" href="homepagestyle.css">
    <link rel="stylesheet" href="preferenceModal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Damion&display=swap" rel="stylesheet">
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
          <h4 style='font-family: "Abril Fatface", serif; font-weight: 800; font-style: normal; font-size: 30px;'>General Information</h4>
          <input type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $firstName;?>" required>
          <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $lastName;?>" required>
          <p class="error" id="nameError"><?php echo $nameError;?></p>
          <h4 style='font-family: "Abril Fatface", serif; font-weight: 800; font-style: normal; font-size: 30px;'>Contact Information</h4>
          <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email;?>" required>
          <p class="error" id="emailError"><?php echo $emailError;?></p>
          <h4 style='font-family: "Abril Fatface", serif; font-weight: 800; font-style: normal; font-size: 30px;'>Account Information</h4>
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

<div id="preferenceModal" class="preferenceModal" style='display:none;'>
  <!-- Modal content -->
  <div class="preference-modal-content">
    <div class="preference-modal-header">Your Preferences</div>
    <div class="preference-category dietary-preferences">
        <h3>Dietary Preferences</h3>
        <button class="preference-tag">Vegan</button>
        <button class="preference-tag">Vegetarian</button>
        <button class="preference-tag">Pescatarian</button>
        <button class="preference-tag">Paleolithic</button>
        <button class="preference-tag">Low Carb</button>
        <button class="preference-tag">Gluten-Free</button>
        <button class="preference-tag">Dairy-Free</button>
        <button class="preference-tag">Nut-Free</button>
        <button class="preference-tag">Sugar-Free</button>
        <!-- ... more tags -->
    </div>
    <div class="preference-category cuisine-preferences">
        <h3>Cuisine Preferences (select 3)</h3>
        <button class="preference-tag">Italian</button>
        <button class="preference-tag">Mexican</button>
        <button class="preference-tag">Chinese</button>
        <button class="preference-tag">Indian</button>
        <button class="preference-tag">Japanese</button>
        <button class="preference-tag">Thai</button>
        <button class="preference-tag">Mediterranean</button>
        <button class="preference-tag">French</button>
        <button class="preference-tag">American</button>
        <button class="preference-tag">Greek</button>
        <div class="cuisine-group" data-index="0" style="display: none;">
        <button class="preference-tag">Korean</button>
        <button class="preference-tag">Vietnamese</button>
        <button class="preference-tag">Spanish</button>
        <button class="preference-tag">Middle Eastern</button>
        <button class="preference-tag">Caribbean</button>
        <button class="preference-tag">African</button>
        <button class="preference-tag">Scandinavian</button>
        <button class="preference-tag">Eastern European</button>
        <button class="preference-tag">Central American</button>
        <button class="preference-tag">South American</button>
    </div>
    <div class="cuisine-group" data-index="1" style="display: none;">
        <button class="preference-tag">Australian</button>
        <button class="preference-tag">New Zealand</button>
        <button class="preference-tag">Canadian</button>
        <button class="preference-tag">British</button>
        <button class="preference-tag">Irish</button>
        <button class="preference-tag">Scottish</button>
        <button class="preference-tag">Welsh</button>
        <button class="preference-tag">German</button>
        <button class="preference-tag">Dutch</button>
        <button class="preference-tag">Belgian</button>
    </div>
</div>
<button class="load-more-cuisines">Load More</button>
    <div class="preference-category ingredient-preferences">
    <div class="header-with-search">
        <h3>Preferred Ingredients (select 5)</h3>
        <input type="text" id="ingredientSearch" class="ingredient-search" placeholder="Search ingredients...">
    </div>
    <div id="ingredients-container">
    </div>
    <button id="loadMoreIngredients" class="load-more-btn">Load More</button>
    <button id="showLessIngredients" class="load-more-btn" style="display: none;">Show Less</button>
</div>
    <div class="preference-category cooking-experience">
        <h3>Cooking Experience</h3>
        <button class="preference-tag">Beginner</button>
        <button class="preference-tag">Intermediate</button>
        <button class="preference-tag">Experienced</button>
    <div class="modal-footer">
        <button id="savePreferences" class="save-preferences-btn" style="margin-top: 15px;"></button>
    </div>
</div>
<!-- Profile Picture Display and Upload -->
<div id="profilePicInput" class="profile-info" style='display: none;'>
    <h3>Profile Picture</h3>
    <!-- Image element for displaying profile picture -->
    <img id="profilePicDisplay" src="profile-icon.jpg" alt="Profile Picture" class="profile-pic-display">
    <!-- File input for uploading profile picture -->
    <input type="file" id="profilePicUpload" class="profile-pic-upload" accept="image/*">
</div>

<div id="bioInput" class="profile-info" style="display: none;">
  <h3>Your Bio</h3>
  <textarea id="bio" class="bio" placeholder="Tell us about yourself..."></textarea>
</div>

<div class="modal-footer">
  <button id="completeProfile" class="save-preferences-btn" style="display: none; margin-top: 15px;">Complete Profile</button>
</div>
</div>
</div>

<!-- Recipe Highlight -->
<div class="recipe-highlight" style="cursor: pointer">
  <div class="recipe-link" data-recipe-url="recipeHighlight.php">
    <div class="row">
      <div class="recipe-highlight-image col-lg-7 col-sm-12 p-0">
        <img src="cheesecake.png" class="img-fluid" alt="Mighty Super Cheesecake">
      </div>
      <div class="col-lg-5 col-sm-12 recipe-highlight-details">
        <h2 class="recipe-highlight-title">
          <span class="star-container">
            <span class="star">&#127775;</span>
            <span class="star">&#127775;</span>
            <span class="star">&#127775;</span>
          </span>
          Mighty Super Cheesecake
        </h2>
        <p class="recipe-highlight-description">Look no further for a creamy and ultra smooth classic cheesecake recipe! No one can deny its simple decadence.</p>
      </div>
    </div>
  </div>
</div>
  
<body data-user-id="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
<section class="recipe-section">
  <h2>Super Delicious</h2>
  <div class="recipes-container">
    <div class="recipe-card easy">
      <span class="recipe-difficulty">Easy Recipe</span>
      <img src="spinach-pasta.jpg" alt="Spinach and Cheese Pasta">
      <div class="recipe-info">
        <h3>Spinach and Cheese Pasta</h3>
        <div class="recipe-interactions">
          <span class="comments">
            <i class="fa fa-comment"></i> 34 comments
          </span>
          <div class="voting-buttons">
          <button class="upvote">
            <i class="fa-solid fa-up-long"></i>
          </button>
          <button class="downvote">
            <i class="fa-solid fa-down-long"></i>
          </button>
          </div>
        </div>
      </div>
    </div>
    <div class="recipe-card medium">
      <span class="recipe-difficulty">Medium Recipe</span>
      <img src="glazed-donuts.jpg" alt="Glazed Donuts">
      <div class="recipe-info">
        <h3>Glazed Donuts</h3>
        <div class="recipe-interactions">
          <span class="comments">
            <i class="fa fa-comment"></i> 44 comments
          </span>
          <div class="voting-buttons">
          <button class="upvote">
            <i class="fa-solid fa-up-long"></i>
          </button>
          <button class="downvote">
            <i class="fa-solid fa-down-long"></i>
          </button>
          </div>
        </div>
      </div>
    </div>
    <div class="recipe-card hard">
      <span class="recipe-difficulty">Hard Recipe</span>
      <img src="breakfast-burger.jpg" alt="Breakfast Burger">
      <div class="recipe-info">
        <h3>Breakfast Burger</h3>
        <div class="recipe-interactions">
          <span class="comments">
            <i class="fa fa-comment"></i> 107 comments
          </span>
          <div class="voting-buttons">
          <button class="upvote">
            <i class="fa-solid fa-up-long"></i>
          </button>
          <button class="downvote">
            <i class="fa-solid fa-down-long"></i>
          </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h2>Sweet Tooth</h2>
  <div class="recipes-container">
    <div class="recipe-card easy">
      <span class="recipe-difficulty">Easy Recipe</span>
      <img src="strawberry-milkshake.jpg" alt="Caramel Strawberry Milkshake">
      <div class="recipe-info">
        <h3>Caramel Strawberry Milkshake</h3>
        <div class="recipe-interactions">
          <span class="comments">
            <i class="fa fa-comment"></i> 25 comments
          </span>
          <div class="voting-buttons">
          <button class="upvote">
            <i class="fa-solid fa-up-long"></i>
          </button>
          <button class="downvote">
            <i class="fa-solid fa-down-long"></i>
          </button>
        </div>
        </div>
      </div>
    </div>
    <div class="recipe-card medium">
      <span class="recipe-difficulty">Medium Recipe</span>
      <img src="banana-jar-cake.jpg" alt="Banana Jar Cake">
      <div class="recipe-info">
        <h3>Chocolate & Banana Jar Cake</h3>
        <div class="recipe-interactions">
          <span class="comments">
            <i class="fa fa-comment"></i> 12 comments
          </span>
          <div class="voting-buttons">
          <button class="upvote">
            <i class="fa-solid fa-up-long"></i>
          </button>
          <button class="downvote">
            <i class="fa-solid fa-down-long"></i>
          </button>
        </div>
        </div>
      </div>
    </div>
    <div class="recipe-card hard">
      <span class="recipe-difficulty">Hard Recipe</span>
      <img src="blueberry-buscuit.jpg" alt="Blueberry Biscuits">
      <div class="recipe-info">
        <h3>Berry Maddness Biscuits</h3>
        <div class="recipe-interactions">
          <span class="comments">
            <i class="fa fa-comment"></i> 73 comments
          </span>
          <div class="voting-buttons">
          <button class="upvote">
            <i class="fa-solid fa-up-long"></i>
          </button>
          <button class="downvote">
            <i class="fa-solid fa-down-long"></i>
          </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="popular-categories-section">
  <h2>Popular Categories</h2>
  <div class="categories-container">
      <div class="category-card">
        <a href="category.html" style="text-decoration: none;">
          <img src="pasta.jpg" alt="Pasta" class="category-image"/>
          <h3 class="category-name">Pasta</h3>
        </a>
      <a href="category.html" style="text-decoration: none;">
        <img src="pizza.png" alt="Pizza" class="category-image"/>
        <h3 class="category-name">Pizza</h3>
      </a>
      <a href="category.html" style="text-decoration: none;">
        <img src="vegan.jpg" alt="Vegan" class="category-image"/>
        <h3 class="category-name">Vegan</h3>
      </a>
      <a href="category.html" style="text-decoration: none;">
        <img src="dessert.jpeg" alt="Dessert" class="category-image"/>
        <h3 class="category-name">Dessert</h3>
      </a>
      <a href="category.html" style="text-decoration: none;">
        <img src="smoothie.jpg" alt="Smoothies" class="category-image"/>
        <h3 class="category-name">Smoothies</h3>
      </a>
      <a href="category.html" style="text-decoration: none;">
        <img src="breakfast.jpg" alt="Breakfast" class="category-image"/>
        <h3 class="category-name">Breakfast</h3>
      </a>
    </div>
  </div>
</section>

<h2 class='latestrecipestitle'>Latest Recipes</h2>
  <div class="recipes-container">
    <div class="recipe-card">
      <img src="jamwafflebreakfast.jpg" alt="Healthy Waffle Jam Breakfast">
      <div class="recipe-info">
        <h3>Healthy Waffle Jam Breakfast</h3>
        <div class="recipe-interactions">
          <span class="comments">
            <i class="fa fa-comment"></i> 12 comments
          </span>
          <div class="voting-buttons">
          <button class="upvote">
            <i class="fa-solid fa-up-long"></i>
          </button>
          <button class="downvote">
            <i class="fa-solid fa-down-long"></i>
          </button>
        </div>
        </div>
      </div>
    </div>
    <div class="recipe-card">
      <img src="cashewveganrice.jpg" alt="Cashew Vegan Rice">
      <div class="recipe-info">
        <h3>Cashew Vegan Rice</h3>
        <div class="recipe-interactions">
          <span class="comments">
            <i class="fa fa-comment"></i> 8 comments
          </span>
          <div class="voting-buttons">
          <button class="upvote">
            <i class="fa-solid fa-up-long"></i>
          </button>
          <button class="downvote">
            <i class="fa-solid fa-down-long"></i>
          </button>
        </div>
        </div>
      </div>
    </div>
    <div class="recipe-card">
      <img src="smokedsalmonsaladsandwich.jpg" alt="Smoked Salmon Salad Sandwich">
      <div class="recipe-info">
        <h3>Smoked Salad Sandwich</h3>
        <div class="recipe-interactions">
          <span class="comments">
            <i class="fa fa-comment"></i> 33 comments
          </span>
          <div class="voting-buttons">
          <button class="upvote">
            <i class="fa-solid fa-up-long"></i>
          </button>
          <button class="downvote">
            <i class="fa-solid fa-down-long"></i>
          </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <button class="load-more">Load More</button>
</section>

<script src="homepagescript.js"></script>
<script src="preferenceModalScript.js"></script>
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

$(document).ready(function() {
        // Check the flag set by PHP and show the modal if true
        if (showFirstLoginModal) {
          $('#preferenceModal').modal({backdrop: 'static', keyboard: false});
          $('#preferenceModal').modal('show');
          localStorage.setItem('preferencesNeeded', 'true');
        }
    });
</script>
</body>
</html>