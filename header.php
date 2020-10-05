<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Finder | Homepage</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="homecss.css">  
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne&display=swap" rel="stylesheet">
    
    <!-- LOGO -->
    <link rel="icon" href="images/logo1.png">  

    <!-- SCRIPT -->
    <script src="Script.js"></script>
    <script src="https://kit.fontawesome.com/a77f5500d1.js" crossorigin="anonymous"></script>
       
</head>
<body>
        
        <!-- NAVBAR START -->
        <div class='navbar'>
            <div >
                <a href="home.php"><img src="images/logo.png" width="60px" height="58px" alt="logo" class="logo"></a>
            </div>
            <div class="name nav-item nohover">Recipe Finder</div>
            <div class="nav" >
                <a href="#"><h2 class="nav-item" onclick="popup()">Profile</h2></a>
                <a href="#"><h2 class="nav-item">Help</h2></a>
            </div>
        </div>

        <!--Popup Sign in start-->
        <div class=popupdiv id=popupid>
            <div class="box">
                <form action="">
                    <h1 class="heading">Sign In</h1><span class="cross" onclick="popupclose()">X</span>
                    <input class=forminput type="email" placeholder="E-mail id" id="email" required>
                    <input class=forminput type="password" placeholder="Password" id="password" required>
                    <br>
                    <button class=popup type="submit">Sign In</button>
                    <div class="small">Don't have an account? <a href="#" class=popuplink onclick="popupsignup()">Create account</a></div>
                </form> 
            </div>
        </div> 
        <!--Popup Sign in end-->

        <!--Popup Sign up start-->
        <div class=popupdiv id=popupid2>
            <div class="box" id=signupbox>
                <form action="">
                    <h1 class="heading">Sign Up</h1><span class="cross" onclick="popupsignupclose()" id=crosssignup>X</span>
                    <input class=forminput type="text" placeholder="Full Name" id="fullname" required>
                    <input class=forminput type="email" placeholder="E-mail id" id="email" required>
                    <input class=forminput type="password" placeholder="Password" id="password" required>
                    <input class=forminput type="password" placeholder="Confirm Password" id="password" required>
                    <br>
                    <button class=popup type="submit">Sign Up</button>
                    <div class="small">Already have an account?<a href="#" class=popuplink onclick="popup()">Sign In</a></div>
                </form> 
            </div>
        </div>
        <!--Popup Sign up end-->
