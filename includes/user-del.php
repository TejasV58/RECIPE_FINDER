<?php
    session_start();

        require "dbh.php";
        
        

        $recipeid = $_GET['rid'];
        //echo $recipeid;
        $sql = "DELETE FROM review WHERE recipeid=?";
        $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            $_SESSION['error-message'] = 'Error!';
            header("Location: ../home.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($statement,"s", $recipeid);
            mysqli_stmt_execute($statement);  
        } 

        $sql = "DELETE FROM userlikes WHERE recipeid=?";
        $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            $_SESSION['error-message'] = 'Error!';
            header("Location: ../home.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($statement,"s", $recipeid);
            mysqli_stmt_execute($statement);
        } 

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
            header("Location: ../profile.php?deletion=success");
            exit();
        } 
    
    
?>