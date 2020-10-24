<?php
    session_start();
    
    if(!$_SESSION['userid']){
        header("Location: ./home.php?error=singinrequired");
        exit();
    }
    else{
        if(isset($_POST["submitFeedback"])){
            require 'dbh.php';
            $rating = $_POST["rating"];
            $feedback = $_POST["comment"];
            $userid = $_SESSION['userid'];
            $recipeid = $_GET['recipeid'];
            $sql = "SELECT * FROM review WHERE recipeid=? AND userid=?";
            $statement = mysqli_stmt_init($conn);  
            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: ../home.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($statement,"ss", $recipeid, $userid);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $resultCheck = mysqli_stmt_num_rows($statement);
                if($resultCheck > 0){
                    header("Location: ../home.php?error=FeedbackAlreadyGiven");
                    exit();
                }
                else{
                    $sql = "INSERT INTO review(userid, recipeid, ratings, review) VALUES (?,?,?,?)";
                    $statement = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($statement, $sql)){
                        header("Location: ../home.php?error=sqlerror");
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($statement,"ssss", $_SESSION['userid'], $_GET['recipeid'], $rating, $feedback);
                        mysqli_stmt_execute($statement);
                        header("Location: ../home.php?feedback=success");
                        exit();
                    }
                }
            }
        }
        else{
            header("Location: ../home.php?abcd=abcd");
            exit();
        }
    }
?>