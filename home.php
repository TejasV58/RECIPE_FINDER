<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recipe Finder | Homepage</title>
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