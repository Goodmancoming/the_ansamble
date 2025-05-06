<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5</title>
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

    
  <h1>Number Analyzer</h1>
  
  <label for="numbers">Angka: </label>
  <input type="text" id="numbers" placeholder="e.g., 5,6,3,4,5,1,2,9,8,10">
  
  <button onclick="analyzeNumbers()">Find</button>
  
  <table>
    <thead>
      <tr>
        <th>Min</th>
        <th>Max</th>
        <th>Average</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td id="minValue"></td>
        <td id="maxValue"></td>
        <td id="averageValue"></td>
      </tr>
    </tbody>
  </table>
  
  <script>
    function analyzeNumbers() {
      const input = document.getElementById('numbers').value;
      let numbers = input.split(',').map(num => parseFloat(num.trim()));
      
      const min = Math.min(...numbers);
      const max = Math.max(...numbers);
      const average = numbers.reduce((sum, num) => sum + num, 0) / numbers.length;
      
      document.getElementById('minValue').textContent = min;
      document.getElementById('maxValue').textContent = max;
      document.getElementById('averageValue').textContent = average.toFixed(2);
    }
  </script>
    <?php

    ?>
    
</body>
</html>