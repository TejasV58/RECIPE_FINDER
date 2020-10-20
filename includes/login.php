<?php

if(isset($_POST['signin-btn'])){

    require "dbh.php";

    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $sql = "SELECT * FROM user WHERE emailid=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        $_SESSION['error-message'] = "Error!";
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
                $_SESSION['error-message'] = "Wrong Password!";
                exit();
            }
            else if($pwdCheck == true){
                session_start();
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['emailid'] = $row['emailid'];
                $_SESSION['success-message'] = "Logged in successfully!";
                header("Location: ../home.php?success=login");
                exit();

            }
            else{
                $_SESSION['error-message'] = "Wrong Password!";
                header("Location: ../home.php?error=wrongpwd");
                exit();
            }
        }
        else
        {   
            $_SESSION['error-message'] = "User not found";
            header("Location: ../home.php?error=nouser");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}   
else{
    header("Location:../home.php");
    exit();
 }
