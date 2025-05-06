<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2</title>
    <link rel="stylesheet" href=".css">
    <style>
        * {
            background-color: black;
            color: white;
            font-size: 20px;
        }
        a {
            text-decoration: none;
            margin: 20px;
        }
        a:hover {
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
    <h1>Specimen 1</h1>
    <p>Calculator</p>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
        <input type="number" name="var1" id="var1" placeholder="variable 1 here" required>
        <select name="operator1" id="operator1" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="number" name="var2" id="var2" placeholder="variable 2 here" required>
        <select name="operator2" id="operator2" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="number" name="var3" id="var3" placeholder="variable 3 here" required>
        <input type="submit" value="Calculate">
    </form>

    <p id="result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['var1']) && isset($_GET['var2']) && isset($_GET['var3']) && isset($_GET['operator1']) && isset($_GET['operator2'])) {
            $var1 = floatval($_GET['var1']);
            $var2 = floatval($_GET['var2']);
            $var3 = floatval($_GET['var3']);
            $operator1 = $_GET['operator1'];
            $operator2 = $_GET['operator2'];
            $result1 = 0;
            $result2 = 0;

            switch ($operator1) {
                case '+':
                    $result1 = $var1 + $var2;
                    break;
                case '-':
                    $result1 = $var1 - $var2;
                    break;
                case '*':
                    $result1 = $var1 * $var2;
                    break;
                case '/':
                    if ($var2 != 0) {
                        $result1 = $var1 / $var2;
                    } else {
                        $result1 = "<b style= 'color:red;'> Cannot divide by zero </b>";
                    }
                    break;
                default:
                    $result1 = "Invalid operator";
            }
            switch ($operator2) {
                case '+':
                    $result2 = $result1 + $var3;
                    break;
                case '-':
                    $result2 = $result1 - $var3;
                    break;
                case '*':
                    $result2 = $result1 * $var3;
                    break;
                case '/':
                    if ($var2 != 0) {
                        $result2 = $result1 / $var3;
                    } else {
                        $result2 = "<b style= 'color:red;'> Cannot divide by zero </b>";
                    }
                    break;
                default:
                    $result2 = "Invalid operator";
            }

            echo "Result 1: " . $result1 . " " . $operator2 . " " . $var3;
            echo "<br>";
            echo "Result 2: " . $result2;
        }
        ?>
    </p>

    </div>

    <div class= "speciment_container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
        <input type="number" name="degree" id="degree" placeholder="enter degree here" required>
        <br>
        <select name="from" id="from" required>
            <option value="C">C</option>
            <option value="F">F</option>
            <option value="K">K</option>
        </select>
        <h1>To</h1>
        <select name="to" id="to" required>
            <option value="C">C</option>
            <option value="F">F</option>
            <option value="K">K</option>
        </select>
        <input type="submit" value="Calculate">
    </form>

        <?php
        /*
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['var1']) && isset($_GET['operator2'])) {
            $degree = floatval($_GET['degree']);
            $from = $_GET['from'];
            $deg_result = 0;
            
                if () {

            } else if {

            }
        }
        */

        
        ?>

    </div>

    
</body>
</html>