<?php
    session_start();
    if(!$_SESSION['userid']){
        header("Location: ./home.php?error=singinrequired");
        exit();
    }
    else{
        if(isset($_POST["create_recipe"])){

            require "dbh.php";
    
            $title = $_POST["name"];
            $description = $_POST["description"];
            $ingredients = $_POST["ingredients"];
            $directions = $_POST["directions"];
            $preptime = $_POST["preptime"];
            $cooktime = $_POST["cooktime"];
            $readyin = $_POST["readyin"];
            $serves = $_POST["serves"];
    
            $sql = "INSERT INTO recipe(userid, recipetitle, description, ingredients, directions, preptime, cooktime, readyin, servings) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $statement = mysqli_stmt_init($conn);  
            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: ../home.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($statement,"sssssssss",$_SESSION['userid'], $title, $description, $ingredients, $directions, $preptime, $cooktime, $readyin, $serves);
                mysqli_stmt_execute($statement);
                header("Location: ../home.php?recipeadd=success");
                exit();
            }
        }
        else{
            header("Location: ../home.php?");
            exit();
        }
    }

    
?>