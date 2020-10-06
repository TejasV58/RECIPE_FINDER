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
    <title>Recipe Finder | Profile</title>

     <!-- Stylesheet -->
     <link rel="stylesheet" href="stylesheet.css">
     <link rel="stylesheet" href="profilecss.css"> 
     <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Lato&display=swap" rel="stylesheet">

     <!-- LOGO -->
     <link rel="icon" href="images/logo1.png">  
 
     <!-- SCRIPT -->
     <script src="Script.js"></script>
     <script src="https://kit.fontawesome.com/a77f5500d1.js" crossorigin="anonymous"></script>

     
</head>
<body>
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
                <img src="images/defaultprofilepic.png" alt="" class=profilepic>
            </div>
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
                                $name = $row['name'];
                                echo $row['name'];
                                }
                        }
                    ?>
                </p>
                 0 <span><i class="fas fa-utensils"></i></span><button class=recipe-btn ><a href="AddRecipes.php">Add Recipe</a></button>
            </div>
            <div class=editprofile>
                <button class=editprofile-btn onclick=editopen()>Edit Profile</button>
            </div>
        </div>

        <div class=profilenavbox>
            <div class=aboutmebox>
                <div class=aboutme>
                    <p><b>About Me</b></p>
                    <p>Introduce Yourself</p>
                    <p><b>Connect With Me</b></p>
                    <p>Let people connect with you</p>
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
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                </div>
                <div class=sectioncontent id=fav>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>

                </div>
                <div class=sectioncontent id=review>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                    <div class=sectiontile></div>
                </div>
            </div>
        </div>
    </div>
    
    <!--EDIT PROFILE-->
    <div class=editprofilebackground id=editprofileback>
        <div class=editprofileblock>
            <form action="">
                <center>
                    <div  id=profilepicdiv onmouseenter=changeprofilepic() onmouseleave=changeprofilepicstop()>
                    <input type="file" id=profilephoto accept="image/*">
                    <label id=editprofilepic for="profilephoto"><i class="fas fa-camera"></i> &nbsp; <br>Change Profile Photo</label>
                    </div>
                </center>
                <br>
                <label class="editlabel">Name</label><br><span onclick="editclose()" id=crossedit>X</span>
                <input class="editinput editinputname" type="text" value="<?php echo $name ?>"><br><br>
                <label class="editlabel">About Me</label><br>
                <textarea class="editinput editinputabout" placeholder="Introduce Yourself"></textarea><br><br>
                <label class="editlabel">Connect With Me</label><br>
                <textarea class="editinput  editinputconnect" placeholder="Let people connect with you"></textarea><br><br>
                <button class=submit-btn>Save</button>
            </form>
        </div>
    </div>
    <!--FOOTER-->
    <div class=footer>
        <p></p>
    </div>
</body>
</html>