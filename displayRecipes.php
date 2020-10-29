<?php 
    session_start();
    require "./includes/dbh.php";
    $var = $_GET['j'];
    $item = json_decode($var);
    $matcharr = [];
    $nonmatcharr = [];
    //for($i=0; $i<count($item); $i++){
    //    echo $item[$i]."\n";
    //}
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
    <style>
        .searchnavbardiv
        {
            display:flex;
            height:68px;
            width:40%;
        }
        .name
        {
            left:0%;
            margin-left:65px;
        }
        .search-container
        {
            margin-top:5%;
        }
        .searchnavbardiv
        {
            width:80%;
            margin:0.5% 13%;
        }
        input[class="search"]{
            display:inline-block;
            width:100%;
            font-size: 115%;
            margin:2% 10.5%;
            margin-right:0;
            border-radius:5px;
            outline:none;
            border:1px solid #337279;
            box-shadow:none;
        }
        input[class="search"]:focus{
            outline:none;
            border:2px solid #337279;
        }
        .searchbtn{
            display:inline-block;
            padding:0.8%;
            font-size:105%;
            font-weight:10%;
            background-color:#f78e24;
            color:white;
            border-radius:5px;
            border:none;
        }
        .searchbtn:hover{
            background:#f8a047;
        }
        .searchbtn:focus{
            outline:none;
        }
        button.additem:focus{
            outline:none;
        }
        .additem{
            position:relative;
            top:-40px;
            left:380px;
            background:#337279;
            color:white;
            border:none;
            padding:0.5% 1%;
            font-size: 170%;
            font-weight:700;
            border-radius:40px;
            display:inline-block;
            margin:0.8%;
            margin-left:-14%; 
            z-index: 1;
        }
   </style>
</head>
<body>
        <!-- NAVBAR START -->
        <div class='navbar'>
            <div class=logotitle>
                <a href="home.php"><img src="images/logo.png" width="60px" height="58px" alt="logo" class="logo"></a>
                <a href="home.php"><span class="name nav-item nohover">Recipe Finder</span></a>
            </div>
            <div class=searchnavbardiv>
                <form action="javascript:void(0)" autocomplete="off">
                    <input class=search type="text" id="items" placeholder="Input Ingredients to Search Recipes">
                    <button class="additem" onclick="addItem()">+</button>
                    <button class="searchbtn" onclick="passItems()" id="searchBtn">Search</button>
                </form>
            </div>
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
                <form action="includes\login.php" method="POST">
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
                <form action="includes\signup.php" method="POST">
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
<!DOCTYPE html>
<html lang="en">
<!-- SEARCHBOX START-->
<div class="search-container">
    <div class=inline-search>
        <span class=heading1>Results for: </span>
        <div  class="items-list">
            <span class="items" id="itemAdded" style="display:none;">item<button onclick="removeItem('item')">X</button></span>
            <?php
                for($i=0;$i<count($item);$i++):?>
                    <span class='items' id=<?php echo $item[$i];?>><?php echo $item[$i];?> <button class="crossbtn" onclick="removeItem('<?php echo $item[$i];?>')">X</button></span>
            <?php endfor;?>
        </div>
    </div>
</div>
<!-- SEARCHBOX END-->

<!-- Search Result Start -->
<div class="page">
    <div class="search-result">
<?php
    $sql = "SELECT * FROM recipe";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("Location: ../home.php?error=sqlerror1");
        $_SESSION['error-message'] = "error!";
        exit();
    }
    else
    {
        mysqli_stmt_execute($stmt);
        $reciperesult = mysqli_stmt_get_result($stmt);
        while($reciperow = mysqli_fetch_assoc($reciperesult))
        {
            $id = $reciperow['recipeid'];
            $matching = 0;
            $nonmatching = 0;
            $temp = $item;
            $ingredients = strtolower($reciperow['ingredients']);
            $array_ingredients = explode("\n", $ingredients);
            for($i=0; $i<count($array_ingredients); $i++)
            {
                $colon_separated = explode(":",$array_ingredients[$i]);
                if(in_array(trim($colon_separated[0]), $item))
                {
                    $matching++;
                }
                else
                {
                    $nonmatching++;
                }
            }
            //>=0.4*count($array_ingredients)
            if($matching)
            {
                $newid = "R".$id;
                $matcharr = array_merge($matcharr, array($newid => $matching));
                $nonmatcharr = array_merge($nonmatcharr, array($newid => $nonmatching));
            }
        }
        array_multisort($matcharr, SORT_DESC, $nonmatcharr, SORT_ASC);
        foreach($matcharr as $x => $x_value)
        {
            $id = substr($x, 1);
            $sql1= "SELECT * FROM recipe WHERE recipeid=$id";
            $stmt1 = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt1,$sql1))
            {
                header("Location: ../home.php?error=sqlerror2");
                $_SESSION['error-message'] = "error!";
                exit();
            }
            else
            {
                mysqli_stmt_execute($stmt1);
                $reciperesult = mysqli_stmt_get_result($stmt1);
                while($reciperow = mysqli_fetch_assoc($reciperesult))
                {
                    $img1=$reciperow['img1'];
                    $recipetitle=$reciperow['recipetitle'];
                    $avg_ratings=$reciperow['avg_ratings'];
                    $total_reviews=$reciperow['total_reviews'];
                    $recipeid=$reciperow['recipeid'];
                    echo"<a href='more details.php?recipeid=$recipeid' class=recipe-links><div class='results'>
                        <img src='recipe-images/$img1' class='image'>
                        <div class='recipe-desc'>
                            <p class='recipe-name'>$recipetitle</p>
                            <span class='rating'>";
                                for($i=1;$i<=$avg_ratings;$i++)
                                {
                                    echo "<i class='fa fa-star' aria-hidden='true'></i>";
                                }
                                for($i=1;$i<=5-$avg_ratings;$i++)
                                {
                                    echo "<i class='fa fa-star star-null'  aria-hidden='true'></i>";
                                }
                                echo"
                            </span>
                            <span class=small-txt>$total_reviews Reviews</span>
                        </div>
                    </div></a>";
                }
            }
        }
    }         
?>
</div>
</div>
