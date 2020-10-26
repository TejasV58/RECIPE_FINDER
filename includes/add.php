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
            $recipearray=[];
            if($_FILES['recipe-image']['size']>0)
            {
                for($i=0;$i<4;$i++)
                {
                    if(isset($_FILES['recipe-image']['name'][$i]))
                    {
                        $recipeimg=$title."_".$i."_".$_FILES['recipe-image']['name'][$i];
                        if(!(move_uploaded_file($_FILES['recipe-image']['tmp_name'][$i],'../recipe-images/'.$recipeimg)))
                        {
                            $_SESSION['error-message'] = "Failed to uplaod";
                            header("Location:../AddRecipes.php?error=sqlerror");
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
    
            $sql = "INSERT INTO recipe(userid, recipetitle, description, ingredients, directions, preptime, cooktime, readyin, servings,img1,img2,img3,img4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $statement = mysqli_stmt_init($conn);  
            if(!mysqli_stmt_prepare($statement, $sql)){
                $_SESSION['error-message'] = "Error!";
                header("Location: ../AddRecipes.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($statement,"sssssssssssss",$_SESSION['userid'], $title, $description, $ingredients, $directions, $preptime, $cooktime, $readyin, $serves,$recipearray[0],$recipearray[1],$recipearray[2],$recipearray[3]);
                mysqli_stmt_execute($statement);
                $_SESSION['success-message'] = "Item added successfully!";
                header("Location: ../profile.php?recipeadd=success");
                exit();
            }
        }
        else{
            $_SESSION['error-message'] = "Error!";
            header("Location: ../AddRecipes.php?error");
            exit();
        }
    }

    
?>