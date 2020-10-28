<?php
    require "dbh.php";
    session_start();
    $var = $_GET['j'];
    $item = json_decode($var);
    //for($i=0; $i<count($item); $i++){
    //    echo $item[$i]."\n";
    //}

    $sql = "SELECT * FROM recipe";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("Location: ./home.php?error=sqlerror");
            $_SESSION['error-message'] = "error!";
            exit();
        }
        else{
            mysqli_stmt_execute($stmt);
            $reciperesult = mysqli_stmt_get_result($stmt);
            while($reciperow = mysqli_fetch_assoc($reciperesult)){
                $matching = 0;
                $nonmatching = 0;
                $temp = $item;
                $matcharr = [];
                $nonmatcharr = [];
                $ingredients = strtolower($reciperow['ingredients']);
                //echo $ingredients;  
                $array_ingredients = explode("\n", $ingredients);
                for($i=0; $i<count($array_ingredients); $i++){
                    $colon_separated = explode(":",$array_ingredients[$i]);
                    //print_r($colon_separated);
                    //echo $colon_separated[0];
                    echo array_search($colon_separated[0], $item);
                    if(in_array($colon_separated[0], $item)){
                        $matching++;
                        //echo $matching;
                    }
                    else{
                        $nonmatching++;
                        echo $nonmatching;
                    }
                }
                if($matching >= 0.5*count($item)){
                        array_push($matcharr, array("R"+$reciperow['recipeid'] => $matching));
                        array_push($nonmatcharr,array("R"+$reciperow['recipeid'] => $nonmatching));
                }
            }
                print_r($matcharr);    
                array_multisort($matcharr, SORT_DESC, $nonmatcharr, SORT_ASC);
                
                foreach($matcharr as $x => $x_value) {
                $id = substr($x, 1);
                echo $id;
                $sql = "SELECT * FROM recipe WHERE recipeid=$id";
                $stmt1 = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt1,$sql))
                {
                    header("Location: ./home.php?error=sqlerror");
                    $_SESSION['error-message'] = "error!";
                    exit();
                }
                else{
                    mysqli_stmt_execute($stmt1);
                    $reciperesult = mysqli_stmt_get_result($stmt1);
                    if($reciperow = mysqli_fetch_assoc($reciperesult)){
                        echo $reciperow['recipetitle'];
                    }
                }
              }
        }
            
    
?>