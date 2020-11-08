<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Finder | Homepage</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="homecss.css">  
    <script src="https://kit.fontawesome.com/a77f5500d1.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    
    <!-- LOGO -->
    <link rel="icon" href="images/logo1.png">  

    <!-- SCRIPT -->
    <script src="Script.js"></script>
    <script>
        
        setTimeout(() => {
            let msg = document.querySelector(".msg-outerbox");
            msg.remove();
        }, 3000);
    </script>
</head>
<body>
        <!-- NAVBAR START -->
        <div class='navbar'>
            <div >
                <a href="home.php"><img src="images/logo.png" width="60px" height="58px" alt="logo" class="logo"></a>
            </div>
            <div class="name nav-item nohover">Recipe Finder</div>
            <div class="nav" >
                <a href="#"><h2 class="nav-item">Help</h2></a>
            <?php
                 if(isset($_SESSION['emailid'])){
                    if($_SESSION['emailid'] == 'admin@gmail.com'){
                        echo '<a href="delete_recipe.php"><h2 class="nav-item ">Delete Recipe</h2></a>';
                    }
                 }
                if(isset($_SESSION['userid'])){
                    echo '<a href="profile.php"><h2 class="nav-item ">Profile</h2></a>';
                    echo '<a href="includes\logout.php"><h2 class="nav-item nav-btn"><button class="signup-nav">Logout</button></h2></a>';
                }
                else{
                    echo '
                    <a href="#"><h2 class="nav-item nav-btn " onclick="popup()"><button class="login-nav">Signin</button></h2></a>
                    <a href="#"><h2 class="nav-item nav-btn" onclick="popupsignup()"><button class="signup-nav">Signup</button></h2></a>
                    ';
                }
            ?>
                
            </div>
        </div>

        <!--Popup Sign in start-->
        <div class=popupdiv id=popupid>

            <div class="box">
                <form autocomplete=off action="includes\login.php" method="POST">
                    <h1 class="heading">Sign In</h1><span class="cross" onclick="popupclose()">X</span>
                    <input class=forminput type="email" placeholder="E-mail id" id="email" name="email" required>
                    <input class=forminput type="password" placeholder="Password" id="password" name="pwd" required>
                    <br>
                    <button class=popup type="submit" name="signin-btn">Sign In</button>
                    <div class="small">Don't have an account? <a href="#" class=popuplink onclick="popupsignup()">Create account</a></div>
                </form> 
            </div>
        </div> 
        <!--Popup Sign in end-->

        <!--Popup Sign up start-->
        <div class=popupdiv id=popupid2>
            <div class="box" id=signupbox>
                <form autocomplete=off action="includes\signup.php" method="POST">
                    <h1 class="heading">Sign Up</h1><span class="cross" onclick="popupsignupclose()" id=crosssignup>X</span>
                    <input class=forminput type="text" placeholder="Full Name" id="fullname" name="fullname" pattern="[a-zA-Z ]*" title="Must contain only letters" required>
                    <input class=forminput type="email" placeholder="E-mail id" id="email" name="email" required>
                    <input class=forminput type="password" placeholder="Password" id="password" name="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <input class=forminput type="password" placeholder="Confirm Password" id="password" name="confirm-pwd" required>
                    <br>
                    <button class=popup type="submit" name="signup-btn">Sign Up</button>
                    <div class="small">Already have an account?<a href="#" class=popuplink onclick="popup()">Sign In</a></div>
                </form> 
            </div>
        </div>
        <!--Popup Sign up end-->

        <!-- MESSAGE -->
        <?php if(isset($_SESSION['error-message'])): ?>
            <div class='msg-outerbox'>
                <center><div class='msg-container'>
                    <p class="msg-danger">
                        <i class="fas fa-times-circle"></i>
                        <?php 
                            echo $_SESSION['error-message'];
                            unset($_SESSION['error-message']);
                        ?>
                    </p>
                </div></center>
            </div> 
        <?php elseif(isset($_SESSION['success-message'])): ?>
            <div class='msg-outerbox'>
                <center><div class='msg-container'>
                    <p class="msg-success">
                        <i class="fas fa-check-circle"></i>
                        <?php 
                            echo $_SESSION['success-message'];
                            unset($_SESSION['success-message']);
                        ?>
                    </p>
                </div></center>
            </div> 
        <?php endif; ?>

