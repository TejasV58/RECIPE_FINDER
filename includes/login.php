<?php

if(isset($_POST['signin-btn'])){

    require "dbh.php";

    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $sql = "SELECT * FROM user WHERE emailid=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("Location: ../home.php?error=sqlerror");
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $pwdCheck = password_verify($password,$row['password']);
            if($pwdCheck == false){
                header("Location: ../home.php?error=wrongpwd");
                exit();
            }
            else if($pwdCheck == true){
                session_start();
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['emailid'] = $row['emailid'];
                
                header("Location: ../home.php?login=success");
                exit();

            }
            else{
                header("Location: ../home.php?error=wrongpwd");
                exit();
            }
        }
        else
        {
            header("Location: ../home.php?error=nouser");
            exit();
        }
    }
}   
else{
    header("Location:../home.php");
    exit();
 }
