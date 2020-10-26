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

            $array = explode("\n", $ingredients);
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
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" ></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star star-null" aria-hidden="true"></i>
                    </span>
                    <span class=small-txt2>30 Reviews</span>
                </div>
                <div class="desc-div">
                    <img src='images\left-quotes-sign.png' class=quotes>
                    <?php
                        echo "<p class=recipe-description> ".$description."</p>";
                    ?>
                </div>
                
                
                <div class=profilepicdiv>
                    <img src="images/defaultprofilepic.png" alt="" class=profilepic>
                    <h2 class="author-name"> <span class="small-txt2">By</span> Author's Name</h2>
                </div>
                <div class="image-time">
                    <div class="dish-image">
                        <img src="images/dish 1.jpg" class="dish">
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
        
            <br><br><hr>
             
            <div class="ingridents-container">
                <div class="flexdiv">
                    <img src="images/list.png" alt="" style="height:50px;width:50px;margin:10px 0px" class="details-icon" >
                    <h1>Ingridents</h1>
                    <a href="modifyrecipe.php?recipeid=<?php echo $recipeid; ?>" class=editicon><i class="fas fa-edit"></i></a>
                </div>  
        <div class="ingridents-container">
            <div class="flexdiv">
                <img src="images/list.png" alt="" style="height:50px;width:50px;margin:15px 5px" class="details-icon" >
                <h1 class=greenheading>Ingridents</h1>
                <a href="modifyrecipe.php?recipeid=<?php echo $recipeid; ?>" class=editicon><i class="fas fa-edit"></i></a>
            </div>  

                <?php for ($i=0; $i<count($array); $i++){
                    echo'
                    <div class="ingridents">
                            <input type="checkbox" id="ig'.$i.'" >
                            <label for="ig'.$i.'"><h3 class=ingredient-item>'.$array[$i].'</h3></label>
                    </div>' ;
                    }
                ?>
                <!--<div class="ingridents">
                    <input type="checkbox" id="ig2" name = "ig2">
                    <label for="ig2"><h3>3 cloves garlic, minced</h3></label>
                </div>
                <div class="ingridents">
                    <input type="checkbox" id="ig3" name = "ig3">
                    <label for="ig3"><h3>½ teaspoon red pepper flakes</h3></label>
                </div>
                <div class="ingridents">
                    <input type="checkbox" id="ig4" name = "ig4">
                    <label for="ig4"><h3>½ teaspoon dried oregano</h3></label>
                </div> -->
            </div>
            <br><hr>
            
            
            <div class="directions">
                <div class="flexdiv">
                    <img src="images/recipe.png" alt="" class="details-icon" >
                    <h1 class=greenheading>Directions</h1>               
                    <a href="modifyrecipe.php?recipeid=<?php echo $recipeid; ?>" class=editicon><i class="fas fa-edit"></i></a>
                </div>
                <h2 class=steps-head><i class="fa fa-check-circle" aria-hidden="true"></i>Step 1</h2>
                <p class=text-contain>Heat olive oil over medium-low heat in a saucepan; stir anchovy fillets into olive oil and cook, stirring often, until the fillets begin to sizzle, about 1 minute. Mix garlic into oil and cook just until fragrant, 1 minute more. Add fresh oregano and reduce heat to low; cook until oregano is wilted, 2 or 3 more minutes.</p>

                <h2 class=steps-head><i class="fa fa-check-circle" aria-hidden="true"></i>Step 2</h2>
                <p class=text-contain>Mix red pepper flakes, dried oregano, and tomatoes into olive oil mixture. Bring sauce to a 
                    simmer and season with salt, sugar, and black pepper. Turn heat to low; simmer sauce until 
                    thickened and oil rises to the top, 35 to 40 minutes, stirring occasionally.</p>

                <h2 class=steps-head><i class="fa fa-check-circle" aria-hidden="true" ></i>Step 3</h2>
                <p class=text-contain>Stir baking soda into pizza sauce, mixing until thoroughly combined.</p>
            </div>
            <hr>
        
        
            <div class="feedback-container">
                <div class=profilepicdiv>
                    <img src="images/defaultprofilepic.png" alt="" class=profilepic>                
                    <button class="review-btn" onclick="feedbackFormOpen()">Give Your Review!</button>

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
                            <center><h2 class="review-popup-title">Review</h2></center><span class="rcross" onclick="feedbackFormClose()">X</span><hr>
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

            <h1 class=review-heading style='margin:2.5%;'>Top Reviews</h1>
            <div class="feedback">
                <div class="feedback-other">
                    <div class=profilepicdiv>
                        <img src="images/defaultprofilepic.png" alt="" class=profilepic>
                        <h2 class="feedback-author">Bill Gates</h2>
                    </div>
                    <div class="feedback-text">
                        <p>I used to go to a pizza joint in Dallas the made the best pizza ever.
                            Their sauce made the pizza. When they closed because of the death of the owner, 
                            I asked one of the son's what made their sauce to good.</p>
                    </div>
                </div>
                <div class="feedback-other">
                    <div class=profilepicdiv>
                        <img src="images/defaultprofilepic.png" alt="" class=profilepic>
                        <h2 class="feedback-author">Elon Musk</h2>
                    </div>
                    <div class="feedback-text">
                        <p>I used to go to a pizza joint in Dallas the made the best pizza ever.
                            Their sauce made the pizza. When they closed because of the death of the owner, 
                            I asked one of the son's what made their sauce to good.</p>
                    </div>
                </div>
                <div class="feedback-other">
                    <div class=profilepicdiv>
                        <img src="images/defaultprofilepic.png" alt="" class=profilepic>
                        <h2 class="feedback-author">Mark Zuckerberg</h2>
                    </div>
                    <div class="feedback-text">
                        <p>I used to go to a pizza joint in Dallas the made the best pizza ever.
                            Their sauce made the pizza. When they closed because of the death of the owner, 
                            I asked one of the son's what made their sauce to good.</p>
                    </div>
                </div>
                <div class="feedback-other">
                    <div class=profilepicdiv>
                        <img src="images/defaultprofilepic.png" alt="" class=profilepic>
                        <h2 class="feedback-author">Binod</h2>
                    </div>
                    <div class="feedback-text">
                        <p>I used to go to a pizza joint in Dallas the made the best pizza ever.
                            Their sauce made the pizza. When they closed because of the death of the owner, 
                            I asked one of the son's what made their sauce to good.</p>
                    </div>
                </div>
                <div class="feedback-other">
                    <div class=profilepicdiv>
                        <img src="images/defaultprofilepic.png" alt="" class=profilepic>
                        <h2 class="feedback-author">Pappu</h2>
                    </div>
                    <div class="feedback-text">
                        <p>I used to go to a pizza joint in Dallas the made the best pizza ever.
                            Their sauce made the pizza. When they closed because of the death of the owner, 
                            I asked one of the son's what made their sauce to good.</p>
                    </div>
                </div>
                <div class="feedback-other">
                    <div class=profilepicdiv>
                        <img src="images/defaultprofilepic.png" alt="" class=profilepic>
                        <h2 class="feedback-author">Baburao</h2>
                    </div>
                    <div class="feedback-text">
                        <p>I used to go to a pizza joint in Dallas the made the best pizza ever.
                            Their sauce made the pizza. When they closed because of the death of the owner, 
                            I asked one of the son's what made their sauce to good.</p>
                    </div>
                </div>
            </div>
            <h1 class=greenheading>Review</h1>
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
                            <div class='feedback'>
                                <div class='feedback-other'>
                                    <div class=profilepicdiv>
                                        <img src='./profile-images/$profileimg' class=profilepic>
                                        <h3 class='feedback-author'>$name</h3>
                                    </div>
                                    <p>";
                                            for($i=1;$i<=$ratings;$i++)
                                            {
                                                echo "<i class='fa fa-star star-icon' aria-hidden='true'></i>";
                                            }
                                            for($i=1;$i<=5-$ratings;$i++)
                                            {
                                                echo "<i class='fa fa-star star-null star-icon'  aria-hidden='true'></i>";
                                            }
                                            echo "
                                    </p>
                                    <div class='feedback-text'>
                                        <p>$review</p>
                                    </div>
                                </div>
                            </div>";
                    }
                }
                    
            ?>
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