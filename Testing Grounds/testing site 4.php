<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4</title>
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

        table {
          border-collapse: collapse;
        }

        th, td {
          border: 1px solid white;
          padding: 5px;
          text-align: center;
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
  <h1>Number Sorter</h1>
  
  <label for="numbers">Angka: </label>
  <input type="text" id="numbers" placeholder="e.g., 5,6,3,4,8,1,2,9,8,10">
  
  <br><br>
  
  <label>Sort: </label>
  <input type="radio" id="ascending" name="sortOrder" value="ascending" checked>
  <label for="ascending">Ascending</label>
  <input type="radio" id="descending" name="sortOrder" value="descending">
  <label for="descending">Descending</label>
  
  <button onclick="sortNumbers()">Sort</button>
  
  <br><br>
  
  <table>
    <thead>
      <tr>
        <th>Angka</th>
      </tr>
    </thead>
    <tbody id="resultTable">
    </tbody>
  </table>
  
  <script>
    function sortNumbers() {
      const input = document.getElementById('numbers').value;
      let numbers = input.split(',').map(num => parseInt(num.trim()));
      
      const sortOrder = document.querySelector('input[name="sortOrder"]:checked').value;
      
      if (sortOrder === 'ascending') {
        numbers.sort((a, b) => a - b);
      } else {
        numbers.sort((a, b) => b - a);
      }
      
      const resultTable = document.getElementById('resultTable');
      resultTable.innerHTML = '';
      
      numbers.forEach(number => {
        const row = document.createElement('tr');
        const cell = document.createElement('td');
        cell.textContent = number;
        row.appendChild(cell);
        resultTable.appendChild(row);
      });
    }
  </script>

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>


    <?php

    ?>
    
</body>
</html>