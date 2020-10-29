<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Finder | More Details</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="more details.css">  
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ruda:wght@900&display=swap" rel="stylesheet">
</head>

<?php
    require "header.php";
    require "./includes/dbh.php";
?>

<body>
    <?php 
        $recipeid = $_GET['recipeid'];  
        $sql = "SELECT * FROM recipe WHERE recipeid=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("Location: ./profile.php?error=sqlerror");
            $_SESSION['error-message'] = "error!";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$recipeid);
            mysqli_stmt_execute($stmt);
            $reciperesult = mysqli_stmt_get_result($stmt);
            $reciperow = mysqli_fetch_assoc($reciperesult);
            $recipeid = $reciperow['recipeid'];
            $recipetitle = $reciperow['recipetitle'];
            $description = $reciperow['description'];
            $ingredients = $reciperow['ingredients'];
            $directions = $reciperow['directions'];
            $preptime = $reciperow['preptime'];
            $cooktime = $reciperow['cooktime'];
            $readyin = $reciperow['readyin'];
            $servings = $reciperow['servings'];
            $avgratings = $reciperow['avg_ratings'];
            $totalreviews = $reciperow['total_reviews'];
            $img1 = $reciperow['img1'];
            $img2 = $reciperow['img2'];
            $img3 = $reciperow['img3'];
            $img4 = $reciperow['img4'];

            $array_ingredients = explode("\n", $ingredients);
            $array_directions = explode("\n", $directions);
        }
        $sql2 = "SELECT * FROM recipe r JOIN user u ON r.userid = u.userid WHERE recipeid=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql2))
        {
            header("Location: ./home.php?error=sqlerror");
            $_SESSION['error-message'] = "error!";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$recipeid);
            mysqli_stmt_execute($stmt);
            $authorresult = mysqli_stmt_get_result($stmt);
            $authorrow = mysqli_fetch_assoc($authorresult);
            $name = $authorrow['name'];
        }
    ?>

    <div class="more-details">
        <div class="time-image">
            <div class="start-details">
                <div class="flexdiv">
                    <?php echo "<h1 class=recipe-title>".$recipetitle."</h1>"; ?>
                    <a href="modifyrecipe.php?recipeid=<?php echo $recipeid; ?>" class=editicon style='margin:0%;'><i class="fas fa-edit"></i></a>
                </div>
                <div class="reciperating">
                    <span class="rating">
                    <?php
                        for($i=1;$i<=$avgratings;$i++)
                        {
                            echo "<i class='fa fa-star star-icon' aria-hidden='true'></i>";
                        }
                        for($i=1;$i<=5-$avgratings;$i++)
                        {
                            echo "<i class='fa fa-star star-null star-icon'  aria-hidden='true'></i>";
                        }
                    ?>
                    </span>
                    <span class=small-txt2><?php echo $totalreviews; ?> Reviews</span>
                </div>
                <div class="desc-div">
                    <img src='images\left-quotes-sign.png' class=quotes>
                    <?php
                        echo "<p class=recipe-description> ".$description."</p>";
                    ?>
                </div>
                
                
                <div class=profilepicdiv2>
                    <?php
                        $sql4="SELECT * from userdetails where userid=?";
                        $stmt4= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt4,$sql4))
                        {
                            header("Location: ./profile.php?error=sqlerror");
                            $_SESSION['error-message'] = "error!";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($stmt4,"s",$_SESSION['userid']);
                            mysqli_stmt_execute($stmt4);
                            $profilepicresult = mysqli_stmt_get_result($stmt4);
                            $profilepicrow = mysqli_fetch_assoc($profilepicresult);
                            $profileimg=$profilepicrow['profileimg'];
                            echo"<img src='./profile-images/$profileimg' class=profilepic1>";
                        }
                    ?>
                    <h2 class="author-name"> <span class="small-txt2">By</span> <?php echo $name ?></h2>
                </div>
                <div class="image-time">
                    <div class="dish-image" id=bigpicdiv style='background:url("<?php echo "./recipe-images/".$img1; ?>")'>
                        
                    </div>
                    <div class="time">
                        <p><b>Prep :</b> <?php echo $preptime?></p>
                        <p><b>Cook :</b> <?php echo $cooktime?></p>
                        <p><b>Total :</b> <?php echo $readyin?></p>
                        <p><b>Serving :</b> <?php echo $servings?></p>
                        <!--<p><b>Yield :</b> 8 servings</p> -->
                    </div>
                    <div>
                        <img src="images/chronometer.png" class="clock">
                    </div>
                </div>
            </div>

            <div class='smallpicdiv'>
                <div><img  src="<?php echo "./recipe-images/".$img1; ?>" onclick='picboxdisplay("smallpicid1","smallpicid2","smallpicid3","smallpicid4")' id=smallpicid1 class=smallpic></div>
                <div><img  src="<?php echo "./recipe-images/".$img2; ?>" onclick='picboxdisplay("smallpicid2","smallpicid1","smallpicid3","smallpicid4")' id=smallpicid2 class=smallpic></div>
                <div><img  src="<?php echo "./recipe-images/".$img3; ?>" onclick='picboxdisplay("smallpicid3","smallpicid2","smallpicid1","smallpicid4")' id=smallpicid3 class=smallpic></div>
                <div><img  src="<?php echo "./recipe-images/".$img4; ?>" onclick='picboxdisplay("smallpicid4","smallpicid2","smallpicid3","smallpicid1")' id=smallpicid4 class=smallpic></div>
            </div>
            <hr>
             
        <div class="ingridents-container">
            <div class="flexdiv">
                <img src="images/list.png" alt="" style="height:50px;width:50px;margin:15px 5px" class="details-icon" >
                <h1 class=greenheading>Ingredients</h1>
                <a href="modifyrecipe.php?recipeid=<?php echo $recipeid; ?>" class=editicon><i class="fas fa-edit"></i></a>
            </div>  

            <?php for ($i=0; $i<count($array_ingredients); $i++){
                echo'
                <div class="ingridents">
                    <input type="checkbox" id="'.$i.'" name = "'.$i.'">
                    <label for="'.$i.'"><h3>'.$array_ingredients[$i].'</h3></label>
                </div>' ;
                }
            ?>
            
        </div>
            <br><hr><br>
            
            
            <div class="directions">
                <div class="flexdiv">
                    <img src="images/recipe.png" alt="" class="details-icon" >
                    <h1 class=greenheading>Directions</h1>               
                    <a href="modifyrecipe.php?recipeid=<?php echo $recipeid; ?>" class=editicon><i class="fas fa-edit"></i></a>
                </div>
                <?php
                    for($i=0; $i<count($array_directions); $i++){
        
                        echo 
                        '<h2 class=steps-head><i class="fa fa-check-circle" aria-hidden="true"></i>Step '.($i+1).'</h2>
                        <p class=text-contain>'.$array_directions[$i].'</p>';
                    }
                ?>
                
            </div>
            <hr>
        
        
        <div class="feedback-container">
                <div class=profilepicdiv>
                <?php
                        $sql4="SELECT * from recipe r JOIN userdetails u ON r.userid=u.userid where recipeid=?";
                        $stmt4= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt4,$sql4))
                        {
                            header("Location: ./profile.php?error=sqlerror");
                            $_SESSION['error-message'] = "error!";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($stmt4,"s",$recipeid);
                            mysqli_stmt_execute($stmt4);
                            $profilepicresult = mysqli_stmt_get_result($stmt4);
                            $profilepicrow = mysqli_fetch_assoc($profilepicresult);
                            if($profilepicrow!==null)
                            {
                                $profileimg=$profilepicrow['profileimg'];
                                echo"<img src='./profile-images/$profileimg' class=profilepic1>";
                            }  
                        }
                    if(isset($_SESSION['userid']))?>
                    <button class='review-btn' onclick="feedbackFormOpen()">Give Your Review!</button>
          
                    <span>
                        <?php
                            if(isset($_SESSION['userid']))
                            {
                                $sql2="SELECT * FROM userlikes WHERE recipeid=? and userid=?";
                                $stmt2= mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt2,$sql2))
                                {
                                    header("Location: ./profile.php?error=sqlerror");
                                    $_SESSION['error-message'] = "error!";
                                    exit();
                                }
                                else
                                {
                                    mysqli_stmt_bind_param($stmt2,"ss",$recipeid,$_SESSION['userid']);
                                    mysqli_stmt_execute($stmt2);
                                    $userlikesresult = mysqli_stmt_get_result($stmt2);
                                    $userlikesrow = mysqli_fetch_assoc($userlikesresult);
                                    if($userlikesrow===null)
                                    {
                                        echo "
                                                <form action='./includes/userlikesaddinc.php?recipeid=$recipeid' method='POST'>
                                                    <button class=like-btn type=submit name='userlikesadd-btn'><i class='fas fa-thumbs-up fa-2x addlikes'></i></button>
                                                </form>";
                                    }
                                    else
                                    {
                                        echo "
                                                <form action='./includes/userlikesremoveinc.php?recipeid=$recipeid' method=POST>
                                                    <button class=like-btn type=submit name='userlikesremove-btn'><i class='fas fa-thumbs-up fa-2x removelikes'></i></button>
                                                </form>";
                                    }
                                        
                                }
                            }
                        ?>
                    </span>
                </div>       
            <form action="includes/feedback.php?recipeid=<?php echo $recipeid; ?>" method="POST">
                <div class="rbox" id="review-box">
                    <div class="review-popup">
                        <center><h2 class="review-popup-title greenheading" >Review</h2></center><span class="rcross" onclick="feedbackFormClose()">X</span><hr>
                        <div class="rating-section">   
                            <label for="rate" class=rate-label>Rating</label>
                            <div class="stars" data-rating="3">
                                <span class="ratestar"></span>
                                <span class="ratestar"></span>
                                <span class="ratestar"></span>
                                <span class="ratestar"></span>
                                <span class="ratestar"></span>
                            </div>
                        </div>
                        <div>    
                            <input class="rate" type="hidden" name="rating" value="3">
                        </div>  
                        <div>
                            <textarea placeholder="What did you think about this recipe? Did you improvise it" class="review-text" name="comment"></textarea>
                        </div><br>
                        <center><button type="submit" class="submit_feedback"  name="submitFeedback">Submit</button></center>  
                    </div>
                </div>
            </form>
            <br>

            <h1 class="greenheading" style='margin:2.5%;'>Top Reviews</h1>
            <div class='feedback'>
            <?php
                $sql3="SELECT * FROM review r JOIN userdetails u ON r.userid=u.userid JOIN user u2 ON r.userid=u2.userid WHERE recipeid=?";
                $stmt3= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt3,$sql3))
                {
                    header("Location: ./profile.php?error=sqlerror");
                    $_SESSION['error-message'] = "error!";
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($stmt3,"s",$recipeid);
                    mysqli_stmt_execute($stmt3);
                    $reviewresult = mysqli_stmt_get_result($stmt3);
                    while($reviewrow = mysqli_fetch_assoc($reviewresult))
                    {
                        $review=$reviewrow['review'];
                        $profileimg=$reviewrow['profileimg'];
                        $name=$reviewrow['name'];
                        $ratings=$reviewrow['ratings'];
                            echo"
                            <div class='feedback-other'>
                                <div class=profilepicdiv>
                                    <img src='./profile-images/$profileimg' class=profilepic1>
                                    <div class='userinfo'>
                                        <h3 class='feedback-author'>$name</h3>
                                        <div class=review-rating>";
                                                for($i=1;$i<=$ratings;$i++)
                                                {
                                                    echo "<i class='fa fa-star star-icon' aria-hidden='true'></i>";
                                                }
                                                for($i=1;$i<=5-$ratings;$i++)
                                                {
                                                    echo "<i class='fa fa-star star-null star-icon'  aria-hidden='true'></i>";
                                                }
                                                echo "
                                        </div>
                                    </div> 
                                </div>
                                <div >     
                                    <p class='feedback-text'>$review</p>
                                </div>
                            </div>";
                        
                    }
                }     
            ?>
            </div>
        </div>
    </div>
</div>

<script>
        
        //initial setup
        document.addEventListener('DOMContentLoaded', function(){
            let stars = document.querySelectorAll('.ratestar');
            stars.forEach(function(star){
                star.addEventListener('click', setRating); 
            });
            
            let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
            let target = stars[rating - 1];
            target.dispatchEvent(new MouseEvent('click'));
        });

        function setRating(ev){
            let span = ev.currentTarget;
            let stars = document.querySelectorAll('.ratestar');
            let match = false;
            let num = 0;
            stars.forEach(function(star, index){
                if(match){
                    star.classList.remove('rated');
                }else{
                    star.classList.add('rated');
                }
                //are we currently looking at the span that was clicked
                if(star === span){
                    match = true;
                    num = index + 1;
                }
            });
            document.querySelector('.stars').setAttribute('data-rating', num);
            document.querySelector('.rate').setAttribute('value', num);
        }
    </script>
    
</body>
</html>