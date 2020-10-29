<?php
    require "dbh.php";
    session_start();
    $var = $_GET['j'];
    $item = json_decode($var);
    $matcharr = [];
    $nonmatcharr = [];
    //for($i=0; $i<count($item); $i++){
    //    echo $item[$i]."\n";
    //}

    $sql = "SELECT * FROM recipe";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("Location: ../home.php?error=sqlerror1");
        $_SESSION['error-message'] = "error!";
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        $reciperesult = mysqli_stmt_get_result($stmt);
        while($reciperow = mysqli_fetch_assoc($reciperesult)){
            $id = $reciperow['recipeid'];
            $matching = 0;
            $nonmatching = 0;
            $temp = $item;
            $ingredients = strtolower($reciperow['ingredients']);
            $array_ingredients = explode("\n", $ingredients);
            for($i=0; $i<count($array_ingredients); $i++){
                $colon_separated = explode(":",$array_ingredients[$i]);
                if(in_array(trim($colon_separated[0]), $item)){
                    $matching++;
                }
                else{
                    $nonmatching++;
                }
            }
            if($matching){
                    $newid = "R".$id;
                    $matcharr = array_merge($matcharr, array($newid => $matching));
                    $nonmatcharr = array_merge($nonmatcharr, array($newid => $nonmatching));
            }
        }
            print_r($matcharr);  
            print_r($nonmatcharr);  
            array_multisort($matcharr, SORT_DESC, $nonmatcharr, SORT_ASC);
            
            foreach($matcharr as $x => $x_value) {
            $id = substr($x, 1);
            $sql = "SELECT * FROM recipe WHERE recipeid=$id";
            $stmt1 = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt1,$sql))
            {
                header("Location: ../home.php?error=sqlerror2");
                $_SESSION['error-message'] = "error!";
                exit();
            }
            else{
                mysqli_stmt_execute($stmt1);
                $reciperesult = mysqli_stmt_get_result($stmt1);
                if($reciperow = mysqli_fetch_assoc($reciperesult)){
                    echo "<br>";
                    echo $reciperow['recipetitle'];
                }
            }
            }
    }
            
    
?>