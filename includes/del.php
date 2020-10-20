<?php
    session_start();
    if(isset($_POST['delete'])){
        require "dbh.php";
        
        

        $recipeid = $_GET['rid'];
        //echo $recipeid;
        //mysqli_query($conn,"DELETE FROM recipe WHERE recipeid=$recipeid");
        $sql = "DELETE FROM recipe WHERE recipeid=?";
        $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            echo "error";
            header("Location: ../home.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($statement,"s", $recipeid);
            mysqli_stmt_execute($statement);
            echo "success";
            header("Location: ../delete_recipe.php?deletion=success");
            exit();
        } 
    //mysqli_stmt_close($statement);
    //mysqli_close($conn);
    }
?>