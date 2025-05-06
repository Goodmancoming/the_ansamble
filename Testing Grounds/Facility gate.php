<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junction</title>
    <style>
        h1{
            font-size: 50px ;
        }
        *{
            background-color: black  ;
            color: white;
            font-size:20px;
            margin-left: 20px;
            font-family: courier
        }
        a{
            color: white;
            font-size: 20px;
            border:transparent 1px solid;
            transition: font-size 0.7s ease-in-out;
        }
        a:hover{
            color: green;
            font-size: 30px;
            border:lightgreen 1px solid;
            transition: font-size 0.3s ease-in-out;
        }
    </style>
</head>
<body>
<?php

/*
c = c
c1= c++
c2= c#
*/
$fileshtml = glob("*.html");
$filesphp  = glob("*.php");
$filesc1  = glob("*.c++") + glob("*.cpp");
$filesjs   = glob("*.js");


echo "<h2>Available Pages</h2>";
echo "<ul>";

echo "<br><br><br><br><h2>html files here</h2><br><br>";
foreach ($fileshtml as $filehtml) {
    echo "<li><a href='$filehtml'>$filehtml</a></li>";
}
echo "<br><br><h2>php files here</h2><br><br>";
foreach ($filesphp as $filephp) {
    echo "<li><a href='$filephp'>$filephp</a></li>";
}
echo "<br><br><h2>c++ files here</h2><br><br>";
foreach ($filesc1 as $filec1) {
    echo "<li><a href='$filec1'>$filec1</a></li>";
}
echo "<br><br><h2>js files here</h2><br><br>";
foreach ($filesjs as $filejs) {
    echo "<li><a href='$filejs'>$filejs</a></li>";
}

echo "</ul>";
?>
<br>
<br>
<br>
<br>
<br>
<a href="../all%20codes%20og/1%20junction.php">     [:Archive Junction:]</a>
    
</body>
</html>