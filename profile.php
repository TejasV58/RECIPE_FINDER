<?php
    session_start();
    if(!$_SESSION['userid']){
        header("Location: ./home.php?error0");
        $_SESSION['error-message'] = "Error!";
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
    <title>Recipe Finder | Profile</title>

     <!-- Stylesheet -->
     <link rel="stylesheet" href="homecss.css">
     <link rel="stylesheet" href="stylesheet.css">
     <link rel="stylesheet" href="profilecss.css"> 
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

    <style>
        .results{
            width:21.5%;
            height:39vh;
        }
        .image{
            width:100%;
            height:30vh;
        }
    </style>
</head>

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
            $aboutme = $details_row['aboutme'];
            $connect = $details_row['connection'];
            $profileimg = $details_row['profileimg'];
        }
    }
?>


<body>

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


    <!-- NAVBAR -->

    <div class='navbar'>
        <div >
            <a href="home.php"><img src="images/logo.png" width="60px" height="58px" alt="logo" class="logo"></a>
        </div>
        <div class="name nav-item nohover">Recipe Finder</div>
        <div class="nav" >
            <a href="#"><h2 class="nav-item">Help</h2></a>
            <?php
                    if(isset($_SESSION['userid'])){
                        echo '<a href="includes\logout.php"><h2 class="nav-item nav-btn"><button class="signup-nav">Logout</button></h2></a>';
                    }
                    else{
                        header("Location: ./home.php?error=singinrequired");
                        exit();
                    }
                ?>
        </div>
    </div>

    <!--PROFILE-->
    <div class=profile>
        <div class=profilebox>
            <div class=profilepicdiv>
                    <?php  if(isset($profileimg)): ?>
                        <img src="profile-images/<?php echo $profileimg; ?>" alt="profile-img" class=profilepic>
                    <?php else:?>
                        <img src="profile-images/<?php echo "defaultprofilepic1.png"; ?>" alt="profile-img" class=profilepic>
                    <?php endif;?>
            </div>
            <div class=profilecontents>
                <p class=profilename>
                    <?php  
                        $sql = "SELECT * FROM user WHERE userid=?";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql))
                        {
                            header("Location: ./profile.php?error=sqlerror");
                            exit();
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt,"s",$_SESSION['userid']);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            if($row = mysqli_fetch_assoc($result)){
                                $name = $row['name'];
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
                 <span><?php echo $resultCheck ?>   <i class="fas fa-utensils"></i></span><button class=recipe-btn ><a href="AddRecipes.php">Add Recipe</a></button>
            </div>
            <div class=editprofile>
                <button class=editprofile-btn onclick=editopen()>Edit Profile</button>
            </div>
        </div>

        <div class=profilenavbox>
            <div class=aboutmebox>
                <div class=aboutme>
                    <p><b>About Me</b></p>
                    <?php if(isset($aboutme)){
                        echo "<p class=abtme-box>".$aboutme."</p>";
                    }
                    else{
                        echo "<p>Introduce Yourself</p>";
                    }   
                    ?>
                    
                    <p><b>Connect With Me</b></p>
                    <?php if(isset($connect)){
                        echo "<p class=abtme-box>".$connect."</p>";
                    }
                    else{
                        echo "<p>Let people connect with you</p>";
                    }   
                    ?>
                    
                </div>
            </div>
            <div class=profilesections>
                <div class=navsections >
                    <div class=navsection id=recipenav onclick=recipedisplay()>
                        Personal Recipes
                    </div>
                    <div class=navsection id=favnav onclick=favdisplay()> 
                        Favourites
                    </div>
                    <div class=navsection id=reviewnav onclick=reviewdisplay()>
                        Reviews
                    </div>
                </div>
                <div class=sectioncontent id=recipe>
                    <?php  
                        $sql = "SELECT * FROM recipe WHERE userid=?";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql))
                        {
                            header("Location: ./profile.php?error=sqlerror");
                            $_SESSION['error-message'] = "error1!";
                            exit();
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt,"s",$_SESSION['userid']);
                            mysqli_stmt_execute($stmt);
                            $reciperesult = mysqli_stmt_get_result($stmt);
                            while($reciperow = mysqli_fetch_assoc($reciperesult)){
                                $recipeid = $reciperow['recipeid'];
                                $recipetitle = $reciperow['recipetitle'];
                                $img1 = $reciperow['img1'];
                                echo "
                                        <a href='more details.php?recipeid=$recipeid' class=recipe-links>
                                            <div class='results'>
                                                <img src='recipe-images/$img1' alt='' class='image'>
                                                <div class='title-icon'>
                                                    <div class='recipe-desc'>$recipetitle</div>
                                                    <a href='includes/user-del.php?rid=$recipeid'><div class='delete_icon'><i class='fas fa-trash-alt'></i></div></a>
                                                </div>
                                                <p class='rating'>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star star-null' aria-hidden='true'></i>
                                                </p>
                                            </div>
                                        </a>
                                    ";
                                }
                        }
                    ?>  
                </div>
                <div class=sectioncontent id=fav>
                <?php  
                        $sql2 = "SELECT * FROM userlikes u JOIN recipe r ON u.recipeid=r.recipeid WHERE u.userid=?";
                        $stmt2 = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt2,$sql2))
                        {
                            header("Location: ./profile.php?error=sqlerror");
                            $_SESSION['error-message'] = "error2!";
                            exit();
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt2,"s",$_SESSION['userid']);
                            mysqli_stmt_execute($stmt2);
                            $reciperesult2 = mysqli_stmt_get_result($stmt2);
                            while($reciperow = mysqli_fetch_assoc($reciperesult2)){
                                $recipeid = $reciperow['recipeid'];
                                $recipetitle = $reciperow['recipetitle'];
                                $img1 = $reciperow['img1'];
                                echo "
                                        <a href='more details.php?recipeid=$recipeid' class=recipe-links>
                                            <div class='results'>
                                                <img src='recipe-images/$img1' alt='' class='image'>
                                                <div class='recipe-desc'>$recipetitle</div>
                                                <p class='rating'>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star star-null' aria-hidden='true'></i>
                                                </p>
                                            </div>
                                        </a>
                                    ";
                                }
                        }
                    ?>  
                </div>
                <div class=sectioncontent id=review>
                    <?php  
                        $sql3= "SELECT * FROM review WHERE userid=?";
                        $stmt3 = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt3,$sql3))
                        {
                            header("Location: ./profile.php?error=sqlerror");
                            $_SESSION['error-message'] = "error3!";
                            exit();
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt3,"s",$_SESSION['userid']);
                            mysqli_stmt_execute($stmt3);
                            $reviewresult= mysqli_stmt_get_result($stmt3);
                            while($reviewrow = mysqli_fetch_assoc($reviewresult)){
                                $review=$reviewrow['review'];
                                $recipeid=$reviewrow['recipeid'];
                                $ratings=$reviewrow['ratings'];
                                echo " <a href='more details.php?recipeid=$recipeid'>
                                            <div class='results'>
                                                <p>$review</p>
                                                <p class='rating'>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star' aria-hidden='true'></i>
                                                    <i class='fa fa-star star-null' aria-hidden='true'></i>
                                                </p>
                                            </div>
                                        </a>
                                    ";
                                }
                        }
                    ?>  
                </div>
            </div>
        </div>
    </div>
    

    <!--EDIT PROFILE-->
    <div class=editprofilebackground id=editprofileback>
        <div class=editprofileblock>
            <form action="./includes/updateprofile.php" method="POST" enctype="multipart/form-data">
                <center>
                    <div  id=profilepicdiv onmouseenter=changeprofilepic() onmouseleave=changeprofilepicstop()                    
                    ><img src='./profile-images/
                    <?php  if(isset($profileimg)): ?>
                        <?php echo $profileimg; ?>
                    <?php else:?>
                        <?php echo "defaultprofilepic1.png"; ?>
                    <?php endif;?>' 
                    alt="profile-img" class=profilepic >
                    <input type="file" id=profilephoto accept="image/*" name="profilephoto">
                    <label id=editprofilepic for="profilephoto"><i class="fas fa-camera"></i> &nbsp; <br>Change Profile Photo</label>
                    </div>
                </center>
                <br>

                <label class="editlabel">Name</label><br><span onclick="editclose()" id=crossedit>X</span>
                <input class="editinput editinputname" type="text" value="<?php echo $name ?>" name="name"><br><br>

                <label class="editlabel">About Me</label><br>
                <textarea class="editinput editinputabout" placeholder="Introduce Yourself" name="aboutme" 
                ><?php if(isset($aboutme)){echo $aboutme;} ?></textarea><br><br>

                <label class="editlabel">Connect With Me</label><br>
                <textarea class="editinput  editinputconnect" placeholder="Let people connect with you" name="connectme"
                 ><?php if(isset($connect)){echo $connect;} ?></textarea><br><br>

                <button class=submit-btn name="save-profile">Save</button>

            </form>
        </div>
    </div>
    <!--FOOTER-->
    <div class=footer>
        <p></p>
    </div>
</body>
</html>