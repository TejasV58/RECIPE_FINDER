<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Finder | Homepage</title>

    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <script>
    var itemList=[];
    function addItem()
    {
        var item = (document.getElementById('items').value).toLowerCase();
        if(item === "")
        {
            alert("Insert an ingredient!!");
        }
        else if(itemList.includes(item))
        {
            alert("Item already Added !!");
            document.getElementById('items').value = "";
        }
        else{
            var additem = document.getElementById('itemAdded');
            itemList.push(item);
            document.getElementById('items').value = "";
            additem.insertAdjacentHTML("afterend",`<span class="items" id="${item}">${item} <button onclick="removeItem('${item}')"    class="crossbtn">X</button></span>`);
        }
    }
    function passItems()
    {
        if(itemList.length==0)
        {
            alert("Insert an ingredient!!");
        }
        else
        {
            link = document.getElementById('searchBtn');
            var strItem =  JSON.stringify(itemList);
            window.location.href="http://localhost/RECIPE_FINDER/displayRecipes.php?j="+strItem;
            console.log(itemList);
            console.log(strItem);
        }
    }
    function removeItem(item)
    {
        document.getElementById(item).remove();
        var index = itemList.indexOf(item);
        itemList.splice(index,1);
    }
    </script>
</head>

<?php
    require "header.php";
    require "includes/dbh.php";
?>

<body>
        <!-- WALLPAPER START -->
        <div class="background">
            <div class="description">
                Recipe Finding Simplified
                <p class="small-desc description">Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <!-- WALLPAPER END -->

        <!-- SEARCHBOX START-->
        <div class="search-container">
            <form action="javascript:void(0)" autocomplete="off">
                    <input class=search type="text" id="items" placeholder="Input Ingredients to Search Recipes">
                    <button class="additem" onclick="addItem()">+</button>
                    <button class="searchbtn" onclick="passItems()" id="searchBtn">Search</button>
            </form>
            <div  class="items-list">
                <span class="items" id="itemAdded" style="display:none;">item<button onclick="removeItem('item')">X</button></span>
            </div>
        </div>
        <!-- SEARCHBOX END-->


        <!-- Search Result Start -->
        <div class="top-page">
            <div class="top-recipes">
                <h1 class="toprecipehead">
                Top recipes of Recipe Finder
                </h1>
                <div class="topcontainer">
                    <?php  
                            $sql = "SELECT * FROM recipe ORDER BY avg_ratings DESC LIMIT 5"; 
                            $reciperesult = mysqli_query($conn,$sql);
                            while($reciperow = mysqli_fetch_assoc($reciperesult)){
                                $recipeid = $reciperow['recipeid'];
                                $recipetitle = $reciperow['recipetitle'];
                                $img1 = $reciperow['img1'];
                                $avg_ratings=$reciperow['avg_ratings'];
                                $total_reviews=$reciperow['total_reviews'];
                                echo "
                                        <a href='more details.php?recipeid=$recipeid' class=recipe-links>
                                            <div class='results'>
                                                <img src='recipe-images/$img1' alt='' class='image'>
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
                                            </div>
                                        </a>
                                    ";
                                }
                            
                        ?>  
                </div>
            </div>
        </div>
        <!-- Search Result End -->
        
</body>
</html>