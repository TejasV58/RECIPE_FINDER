<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recipe Finder | Homepage</title>
</head>

<?php
    require "header.php";
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
        <div class="page">
            
        </div>
        <!-- Search Result End -->

<?php
    require "footer.php";
?>
        
</body>
</html>