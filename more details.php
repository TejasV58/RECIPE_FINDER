<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More Details</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="more details.css">  
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<?php
    require "header.php";
?>

<body>

    <div class="more-details">
        
        <div class="time-image">
            <h1> Recipe Title</h1>
            <div class=profilepicdiv>
                <img src="images/defaultprofilepic.png" alt="" class=profilepic>
                <h2 class="author-name">Author's Name</h2>
            </div>
            <div class="image-time">
                <div class="dish-image">
                    <img src="images/dish 1.jpg" class="dish">
                </div>
                <div class="time">
                    <p><b>Prep :</b> 10 min</p>
                    <p><b>Cook :</b> 45 min</p>
                    <p><b>Total :</b> 55 min</p>
                    <p><b>Serving :</b> 8 min</p>
                    <p><b>Serving :</b> 8 min</p>
                    <p><b>Yield :</b> 8 servings</p>
                </div>
                <div>
                    <img src="images/clock.jpg" class="clock">
                </div>
            </div>
        </div><br><br><hr>

            <br>
            <h1>Directions</h1>
            <div class="directions">
                <p>Heat olive oil over medium-low heat in a saucepan; stir anchovy fillets into olive oil and cook,
                stirring often, until the fillets begin to sizzle, about 1 minute. Mix garlic into oil and cook 
                just until fragrant, 1 minute more. Add fresh oregano and reduce heat to low; cook until oregano 
                is wilted, 2 or 3 more minutes.</p>
            </div>
            <hr><br>

        <h1>Ingridents</h1>
        <div class="ingridents-container">
            <div class="ingridents">
                <input type="checkbox" id="ig1" name = "ig1">
                <label for="ig1"><h3>anchovies anchovy fillets</h3></label>
            </div>
            <div class="ingridents">
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
            </div>
        </div>
            <br><hr><br>
            <h1>Directions</h1>
            <div class="directions">
                <h2>Step 1</h2>
                <p>Heat olive oil over medium-low heat in a saucepan; stir anchovy fillets into olive oil and cook,
                stirring often, until the fillets begin to sizzle, about 1 minute. Mix garlic into oil and cook 
                just until fragrant, 1 minute more. Add fresh oregano and reduce heat to low; cook until oregano 
                is wilted, 2 or 3 more minutes.</p>

                <h2>Step 2</h2>
                <p>Mix red pepper flakes, dried oregano, and tomatoes into olive oil mixture. Bring sauce to a 
                    simmer and season with salt, sugar, and black pepper. Turn heat to low; simmer sauce until 
                    thickened and oil rises to the top, 35 to 40 minutes, stirring occasionally.</p>

                <h2>Step 3</h2>
                <p>Stir baking soda into pizza sauce, mixing until thoroughly combined.</p>
            </div>
            <hr><br><br><br>
        
        <div class="feedback-container">
            <div class="user-review">
                <div class=profilepicdiv>
                    <img src="images/defaultprofilepic.png" alt="" class=profilepic>
                    <button class="review-btn" onclick="feedbackFormOpen()">Give Your Review!</button>
                </div>
            </div>
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
                    <div>    
                        <input class="rate" type="hidden" name="rating" value="3">
                    </div> 
                    <form> 
                        <div>
                            <textarea placeholder="What did you think about this recipe? Did you improvise it" class="review-text"></textarea>
                        </div>
                    </form> 
                </div>
            </div>

            <br><br>

            <h1>Review</h1>
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