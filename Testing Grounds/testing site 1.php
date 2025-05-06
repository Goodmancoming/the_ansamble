<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1</title>
    <link rel="stylesheet" href=".css">
    <style>
        *{
            background-color: black  ;
            color: white;
            font-size:20px;
        }
        a{
            text-decoration: none;
            margin: 20px;
        }
        a:hover{
            color: green;
            font-size: 30px;
            transition: 500ms;  
        }
    </style>
</head>
<body>


    <br>
    <hr>
    <b><a href="Facility gate.php"><=</a></b>
    <br>
    <hr>
    <hr>
    <br>

    <div class= "speciment_container">
        <?php

        $bool= true;
        $variable= '';

        if (!$bool){
            echo "You are not allowed to access this page";
        }
        else{
            echo "You are allowed to access this page";
        }
        echo "<br>";
        switch ($variable) {
            case '1':
                echo "its 1";
                break;
            
            case '2':
                echo "its 2";
                break;

            case '3':
                echo "its 3";
                break;

            default:
                echo "default";
                break;
        }































        ?>
    </div>
    
    
</body>
</html>