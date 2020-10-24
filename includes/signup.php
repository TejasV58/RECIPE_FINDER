<?php

session_start();

if(isset($_POST['signup-btn']))
{
   require 'dbh.php';

   $fullname=$_POST['fullname'];
   $email=$_POST['email'];
   $password=$_POST['pwd'];
   $confirmpassword=$_POST['confirm-pwd'];

   if($password!==$confirmpassword)
   {
      $_SESSION['error-message'] = "Your Password do not match!";
      header("Location:../home.php");      
      exit();
   }
   else
   {
      $sql="SELECT emailid FROM user WHERE emailid=?";
      $stmt=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql))
      {  
         $_SESSION['error-message'] = "error!";
         header("Location:../home.php?error=sqlerror");
         exit();
      }
      else
      {
         mysqli_stmt_bind_param($stmt,"s",$email);
         mysqli_stmt_execute($stmt);
         mysqli_stmt_store_result($stmt);
         $resultCheck=mysqli_stmt_num_rows($stmt);
         if($resultCheck>0)
         {  
            $_SESSION['error-message'] = "Email is already taken!";
            header("Location:../home.php?error=emailtaken&fullname=".$fullname);            
            exit();
         }
         else
         {
               $sql="INSERT INTO user (password,emailid,name) VALUES(?,?,?)";
               $stmt=mysqli_stmt_init($conn);
               if(!mysqli_stmt_prepare($stmt,$sql))
               {  
                  $_SESSION['error-message'] = "error!";
                  header("Location:../home.php?error=sqlerror");                 
                  exit();
               }
               else
               {
                  $hashedPwd=password_hash($password, PASSWORD_DEFAULT);
                  mysqli_stmt_bind_param($stmt,"sss",$hashedPwd,$email,$fullname);
                  mysqli_stmt_execute($stmt);
                  $_SESSION['success-message'] = "signed up successfully!";
                  header("Location:../home.php?success=signup");
                  exit();
                }
          }
      }
   }
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
}
else{
   header("Location:../home.php");
   exit();
}