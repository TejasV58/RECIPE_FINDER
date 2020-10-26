<?php
    session_start();
    require "dbh.php";
    if(!$_SESSION['userid']){
        header("Location: ../home.php?error=singinrequired");
        exit();
    }
    else{
        if(isset($_POST["userlikesadd-btn"])){
            $recipeid=$_GET['recipeid'];
            $sql = "INSERT INTO userlikes(recipeid,userid) VALUES (?, ?)";
            $statement = mysqli_stmt_init($conn);  
            if(!mysqli_stmt_prepare($statement, $sql)){
                $_SESSION['error-message']="Error adding to Favourites";
                header("Location: ../more details.php?recipeid=$recipeid");
                exit();
            }
            else{
                mysqli_stmt_bind_param($statement,"ss",$recipeid,$_SESSION['userid']);
                mysqli_stmt_execute($statement);
                $_SESSION['success-message']="Added to Favourites";
                header("Location: ../more details.php?recipeid=$recipeid");
                exit();
            }
        }
    }
    
?>