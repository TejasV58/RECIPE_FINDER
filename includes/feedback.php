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
                $_SESSION['error-message'] = "Error!";
                header("Location: ../more details.php?recipeid=$recipeid&error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($statement,"ss", $recipeid, $userid);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $resultCheck = mysqli_stmt_num_rows($statement);
                if($resultCheck > 0){
                    $_SESSION['error-message'] = 'Feedback Already Given';
                    header("Location: ../more details.php?recipeid=$recipeid&error=feedbackalreadygiven");
                    exit();
                }
                else{
                    $sql = "INSERT INTO review(userid, recipeid, ratings, review) VALUES (?,?,?,?)";
                    $statement = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($statement, $sql)){
                        header("Location: ../more details.php?recipeid=$recipeid&error=sqlerror");
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($statement,"ssss", $_SESSION['userid'], $_GET['recipeid'], $rating, $feedback);
                        mysqli_stmt_execute($statement);
                        $sql1="SELECT AVG(ratings) as avg_ratings,COUNT(*) as total_ratings FROM review GROUP BY recipeid HAVING recipeid=?";
                        $stmt1 = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt1,$sql1))
                        {
                            $_SESSION['error-message'] = 'Error!';
                            header("Location: ../more details.php?recipeid=$recipeid&error=sqlerror");
                            exit();
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt1,"s",$recipeid);
                            mysqli_stmt_execute($stmt1);
                            $result1 = mysqli_stmt_get_result($stmt1);
                            if($row1 = mysqli_fetch_assoc($result1))
                            {
                                $avgratings = $row1['avg_ratings'];
                                $totalratings = $row1['total_ratings'];
                                $sql2="UPDATE recipe SET avg_ratings=?,total_reviews=? WHERE recipeid=?";
                                $stmt2=mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt2,$sql2))
                                {
                                    $_SESSION['error-message'] = "Error!";
                                    header("Location: ../more details.php?recipeid=$recipeid&error=sqlerror");
                                    exit();
                                }
                                else
                                {
                                    mysqli_stmt_bind_param($stmt2,"sss",$avgratings,$totalratings,$recipeid);
                                    mysqli_stmt_execute($stmt2);
                                    $_SESSION['success-message'] = "Review added successfully!";
                                    header("Location: ../more details.php?recipeid=$recipeid&feedback=success");
                                    exit();
                                }                          
                            }
                        }
                    }
                }
            }
        }
        else{
            $_SESSION['error-message'] = 'Error!';
            header("Location: ../home.php?abcd=abcd");
            exit();
        }
    }
?>