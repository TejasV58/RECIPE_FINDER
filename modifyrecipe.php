<?php
    session_start();
    if(!$_SESSION['userid']){
        header("Location: ./home.php?error=singinrequired");
        exit();
    }
    else{
        require 'includes/dbh.php';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Finder | Edit Recipe</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="AddRecipes.css">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Lato&display=swap" rel="stylesheet">

    <!-- LOGO -->
    <link rel="icon" href="images/logo1.png">  

    <!-- SCRIPT -->
    <script src="Script.js"></script>
    <script src="https://kit.fontawesome.com/a77f5500d1.js" crossorigin="anonymous"></script>
    <script>
            setTimeout(() => {
                let msg = document.querySelector(".msg-outerbox");
                msg.remove();
            }, 3000);
    </script>

</head>
<body>

    <!-- MESSAGE -->
    <?php if(isset($_SESSION['error-message'])): ?>
        <div class='msg-outerbox'>
            <center><div class='msg-container danger'>
                <?php 
                    echo $_SESSION['error-message'];
                    unset($_SESSION['error-message']);
                ?>
            </div></center>
        </div>
        <?php elseif(isset($_SESSION['success-message'])): ?>
            <div class='msg-outerbox'>
                <center><div class='msg-container success'>
                    <?php 
                        echo $_SESSION['success-message'];
                        unset($_SESSION['success-message']);
                    ?>   
            </div></center>
        </div> 
    <?php endif; ?>


     <!-- NAVBAR START -->
     <div class='navbar'>
        <div>
            <a href="home.php"><img src="images/logo.png" width="60px" height="58px" alt="logo" class="logo"></a>
        </div>
        <div class="name nav-item nohover">Recipe Finder</div>
        <div class="nav" >
            <a href="#"><h2 class="nav-item">Help</h2></a>
            <?php
                    if(isset($_SESSION['userid'])){
                        echo '<a href="profile.php"><h2 class="nav-item ">Profile</h2></a>';
                        echo '<a href="includes\logout.php"><h2 class="nav-item nav-btn"><button class="signup-nav">Logout</button></h2></a>';
                    }
                    else{
                        header("Location: ./home.php?error=singinrequired");
                        exit();
                    }
                ?>
        </div>
    </div>
    <!-- NAVBAR END -->

    <!-- Add Recipe Form Start -->

    <?php  
        $sql2 = "SELECT * FROM userdetails WHERE userid=?";
        $stmt2 = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt2,$sql2))
        {
            header("Location: ./profile.php");
            $_SESSION['error-message'] = "Error!";
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt2,"s",$_SESSION['userid']);
            mysqli_stmt_execute($stmt2);
            $details_result = mysqli_stmt_get_result($stmt2);
            if($details_row = mysqli_fetch_assoc($details_result)){
                $profileimg = $details_row['profileimg'];
            }
        }
    ?>
        <div class="recipedetailspage">
            <?php  if(isset($profileimg)): ?>
                <img src="profile-images/<?php echo $profileimg; ?>" alt="profile-img" class=profilepic>
            <?php else:?>
                <img src="profile-images/<?php echo "defaultprofilepic1.png"; ?>" alt="profile-img" class=profilepic>
            <?php endif;?>
            <div class="background-div">
                <img class="profile-img" src="images/defaultprofilepic1.png">
                <div class=profilecontents>
                    <p class=profilename>
                    <?php  
                        $sql = "SELECT * FROM user WHERE userid=?";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql))
                        {
                            header("Location: ./home.php?error=sqlerror");
                            exit();
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt,"s",$_SESSION['userid']);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            if($row = mysqli_fetch_assoc($result)){
                                echo $row['name'];
                            }
                        }

                        //Counting total recipes uploaded by user.
                        $sql = "SELECT * FROM recipe WHERE userid=?";
                        $statement = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($statement, $sql)){
                            header("Location: ../signup.html?error=sqlerror");
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($statement,"s", $_SESSION['userid']);
                            mysqli_stmt_execute($statement);
                            mysqli_stmt_store_result($statement);
                            $resultCheck = mysqli_stmt_num_rows($statement);
                            }
                    ?>
                    </p>
                    <span><?php echo $resultCheck ?>   <i class="fas fa-utensils"></i></span>
                </div>
            </div>
            <?php  

                $recipeid = $_GET['recipeid'];
                //echo $recipeid;
                $sql = "SELECT * FROM recipe WHERE recipeid=?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql))
                {
                    header("Location: ./profile.php?error=sqlerror");
                    $_SESSION['error-message'] = "error!";
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($stmt,"s",$recipeid);
                    mysqli_stmt_execute($stmt);
                    $reciperesult = mysqli_stmt_get_result($stmt);
                    if($reciperow = mysqli_fetch_assoc($reciperesult)){
                        $recipetitle = $reciperow['recipetitle'];
                        $description = $reciperow['description'];
                        $ingredients = $reciperow['ingredients'];
                        $directions = $reciperow['directions'];
                        $preptime = $reciperow['preptime'];
                        $cooktime = $reciperow['cooktime'];
                        $servings = $reciperow['servings'];
                        $readyin = $reciperow['readyin'];
                    }
                }
            ?> 
            <form action="includes/editrecipe.php?recipeid=<?php echo $recipeid; ?>" method="POST">
            <div class="recipe-details">
                <div class="main-details">
                    <label for="name" class="label ">Recipe Title</label>
                    <input class="input-box title" type="text" id="name" name="name" value="<?php echo $recipetitle; ?>">
                    <label for="description" class="label">Description</label>
                    <textarea name="description" class="input-box" id="description" rows="5" placeholder="Description"><?php echo $description; ?></textarea>
                    <label for="ingredients" class="label">Ingredients</label>
                    <textarea name="ingredients" class="input-box" id="ingredients" rows="10" placeholder="Enter Each ingredients on new line"><?php echo $ingredients; ?></textarea>
                    <label for="directions" class="label">Directions</label>
                    <textarea name="directions" id="directions" class="input-box" rows="10" placeholder="Enter each step on new line"><?php echo $directions; ?></textarea>
                    <input class="submit-btn" type="submit" value="Save" name="save-recipe">
                </div>

                <div class="small-details">

                    <div class="image-input">
                        <div class="addimgdiv">
                            <input id="uploadImage" type="file" accept="image/*" onchange="PreviewImage();" multiple />
                            <label id=uploadimglabel for="uploadImage"><i class="fas fa-camera"></i> &nbsp; <br>Add a Image</label>
                        </div>
                        <div class="previews"><img id="uploadPreview" style="width: 100px; height: 100px; display:none;" ></div>
                    </div>

                    <div class="outersmalldetails">
                        <div class="smalldetailsdiv">
                            <div class="sml-details">
                                <label class="label">Prep Time</label>
                                <input class="input-box2" type="text" name="preptime" value="<?php echo $preptime; ?>">
                            </div>
                            <div class="sml-details">
                                <label class="label">Cook Time</label>
                                <input class="input-box2" type="text" name="cooktime" value="<?php echo $cooktime; ?>">
                            </div>
                        </div>
                        <div class="smalldetailsdiv">
                            <div class="sml-details">
                                <label class="label">Ready in</label>
                                <input class="input-box2" type="text" name="readyin" value="<?php echo $readyin; ?>">
                            </div>
                            <div class="sml-details">
                                <label class="label">Number of serves</label>
                                <input class="input-box2" type="text" name="serves" value="<?php echo $servings; ?>">
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </form>
    </div>

    <!-- Add Recipe Form End -->

</body>
</html>

