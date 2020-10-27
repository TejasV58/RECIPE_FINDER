<?php

session_start();

if(isset($_POST['save-recipe'])){

    require "dbh.php";
    
    $userid = $_SESSION['userid'];
    $recipeid = $_GET['recipeid'];
    $recipetitle = $_POST['name'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $directions = $_POST['directions'];
    $preptime = $_POST['preptime'];
    $cooktime = $_POST['cooktime'];
    $servings = $_POST['serves'];
    $readyin = $_POST['readyin'];

    $recipearray=[];
    if($_FILES['recipe-image']['size']>0)
    {
        for($i=0;$i<4;$i++)
        {
            if(isset($_FILES['recipe-image']['name'][$i]))
            {
                $recipeimg=$title."_".$i.$i."_".$_FILES['recipe-image']['name'][$i];
                if(!(move_uploaded_file($_FILES['recipe-image']['tmp_name'][$i],'../recipe-images/'.$recipeimg)))
                {
                    $_SESSION['error-message'] = "Failed to uplaod";
                    header("Location:../AddRecipes.php?error=sqlerror1");
                    exit();
                }
            }
            else
            {
                $recipeimg="default.jpg";
            }
            array_push($recipearray,$recipeimg);
        }

    }
    
    $sql="UPDATE recipe SET recipetitle=?, description=?, ingredients=?, directions=?, preptime=?, cooktime=?,servings=?, readyin=?, img1 = ?,img2=? , img3=?, img4=? WHERE recipeid=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        $_SESSION['error-message'] = "Error!";
        header("Location: ../more details.php?recipeid=$recipeid&error=sqlerror");                   
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"sssssssssssss",$recipetitle,$description,$ingredients,$directions,$preptime,$cooktime,$servings,$readyin,$recipearray[0],$recipearray[1],$recipearray[2],$recipearray[3],$recipeid);
        mysqli_stmt_execute($stmt);      
        $_SESSION['success-message'] = "Recipe updated successfully!";
        header("Location:../more details.php?recipeid=$recipeid&success=editrecipe");
        exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location:../more details.php?recipeid=$recipeid&error");
    exit();
 }
