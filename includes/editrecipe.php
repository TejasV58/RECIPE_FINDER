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
    
    $sql="UPDATE recipe SET recipetitle=?, description=?, ingredients=?, directions=?, preptime=?, cooktime=?,servings=?, readyin=? WHERE recipeid=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        $_SESSION['error-message'] = "Error!";
        header("Location: ../more details.php?recipeid=$recipeid&error=sqlerror");                   
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"sssssssss",$recipetitle,$description,$ingredients,$directions,$preptime,$cooktime,$servings,$readyin,$recipeid);
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
