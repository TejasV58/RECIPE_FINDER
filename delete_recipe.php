    <?php
        require "header.php";
        //session_start();
        if(!$_SESSION['userid']){
            header("Location: ./home.php?error0");
            $_SESSION['error-message'] = "Error!";
            exit();
        }
        else{
            require 'includes/dbh.php';
            
            
        }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="delete_recipe.css">
        <title>Delete Recipe</title>
    </head>

    <body>
        <?php
            $sql = "SELECT * FROM recipe";
            $result = $conn->query($sql);
        ?>
        
        <div class="bucket">
            <img src="images/signin.jpg" width="94%" height="300px" class="top-image">
            <div class=container>
                <center><h1>Delete Recipe<center></h1>
                <table>
                    <tr>
                        <th>Recipe Title</th>
                        <th>Delete Recipe</th>
                    </tr>
                    <?php
                        while($row = $result->fetch_assoc()){
                            $id = $row['recipeid'];
                            echo "<tr>
                                    <td>".$row['recipetitle']."</td>".
                                    "<td><form action='includes/del.php?rid=$id' method='POST'><button class='del' name='delete'>Delete</button></form></a></td>
                                </tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
    </html>