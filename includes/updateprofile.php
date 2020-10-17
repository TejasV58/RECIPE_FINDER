<?php

session_start();

if(isset($_POST['save-profile'])){

    require "dbh.php";

    $userid = $_SESSION['userid'];
    $name = $_POST['name'];
    $abtme = $_POST['aboutme'];
    $connect = $_POST['connectme'];
    $profileimg = $userid . '_' . $_FILES['profileimage']['name'];

    $target = '../profile-images/'.$profileimg;
    move_uploaded_file($_FILES['profileimage']['tmp_name'],$target)
    if(move_uploaded_file($_FILES['profileimage']['tmp_name'],$target))
    {
        $sql="SELECT emailid FROM user WHERE emailid=?";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            $_SESSION['error-message'] = "Error!";
            header("Location:../profile.php?error1");           
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
                $sql="UPDATE userdetails SET aboutme='$abtme', connection='$connect', profileimg='$profileimg' WHERE userid='$userid' ";
                $stmt=mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql))
                {
                    $_SESSION['error-message'] = "Error!";
                    header("Location: ../profile.php?error2");                   
                    exit();
                }
                else
                {
                    $sql2 = "UPDATE user SET name='$name' WHERE userid='$userid' ";
                    $stmt2 = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt2,$sql2))
                    {
                        $_SESSION['error-message'] = "Error!";
                        header("Location: ../profile.php?error3");                        
                        exit();
                    }
                    else
                    {
                        $_SESSION['success-message']="Profile updated successfully!";
                        header("Location:../profile.php?success1");
                        exit();
                    }
                }
            }
            else
            {
                $sql="INSERT INTO userdetails (userid,aboutme,connection,profileimg) VALUES(?,?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql))
                {
                    $_SESSION['error-message'] = "Error!";
                    header("Location:../profile.php?error4");                   
                    exit();
                }
                else
                {
                    mysqli_stmt_bind_param($stmt,"ssss",$userid,$abtme,$connect,$profileimg);
                    mysqli_stmt_execute($stmt);

                    $sql2 = "UPDATE user SET name='$name' WHERE userid='$userid' ";
                    $stmt2 = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt2,$sql2))
                    {
                        $_SESSION['error-message'] = "Error!";
                        header("Location: ../profile.php?error5");                     
                        exit();
                    }
                    else
                    {   
                        $_SESSION['success-message']="Profile updated successfully!";
                        header("Location:../profile.php?success2");                     
                        exit();
                    }
                    
                }
            }
        }
    }
    else{
        $_SESSION['error-message'] = "Failed to uplaod";
        echo print_r($_FILES);
        /*
        header("Location:../profile.php?error6");
        exit();*/
    }

    
    
}   
else{
    header("Location:../profile.php");
    exit();
 }
