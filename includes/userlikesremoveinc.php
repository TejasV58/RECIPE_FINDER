<?php
    session_start();
    require "dbh.php";
    if(!$_SESSION['userid']){
        header("Location: ../home.php?error=singinrequired");
        exit();
    }
    else{
        if(isset($_POST["userlikesremove-btn"])){
            $recipeid=$_GET['recipeid'];
            $sql = "DELETE FROM userlikes WHERE recipeid=? and userid=?";
            $statement = mysqli_stmt_init($conn);  
            if(!mysqli_stmt_prepare($statement, $sql)){
                $_SESSION['error-message']="Error deleting from Favourites";
                header("Location: ../more details.php?recipeid=$recipeid");
                exit();
            }
            else{
                mysqli_stmt_bind_param($statement,"ss",$recipeid,$_SESSION['userid']);
                mysqli_stmt_execute($statement);
                $_SESSION['success-message']="Removed from Favourites";
                header("Location: ../more details.php?recipeid=$recipeid");
                exit();
            }
        }
    }
    
?>