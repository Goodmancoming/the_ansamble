<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>6</title>
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
          width: 100%;
          margin-top: 20px;
        }
        th, td {
          border: 1px solid white;
          padding: 8px;
          text-align: center;
        }
        input[type="text"], input[type="number"] {
          width: 90%;
        }
        button {
          margin: 2px;
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

  <h1>Fruit Inventory System</h1>
  
  <label for="fruitName">Nama Buah: </label>
  <input type="text" id="fruitName" placeholder="Nama Buah">
  <br>
  
  <label for="fruitWeight">Jumlah: </label>
  <input type="number" id="fruitWeight" placeholder="Berat"> Kg
  <br>
  
  <label for="fruitImage">Gambar: </label>
  <input type="text" id="fruitImage" placeholder="Image URL">
  <br>
  
  <button onclick="addFruit()">Add</button>
  
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Buah</th>
        <th>Berat</th>
        <th>Gambar</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="fruitTableBody">
      <!-- Dynamic rows will be added here -->
    </tbody>
  </table>
  
  <script>
    let fruitList = [];
    let counter = 0;

    function addFruit() {
      const name = document.getElementById('fruitName').value;
      const weight = document.getElementById('fruitWeight').value;
      const image = document.getElementById('fruitImage').value;

      if (!name || !weight || !image) {
        alert('Please fill in all fields!');
        return;
      }

      // Add the new fruit to the list
      fruitList.push({ name, weight, image });
      counter++;
      renderTable();
      clearInputs();
    }

    function clearInputs() {
      document.getElementById('fruitName').value = '';
      document.getElementById('fruitWeight').value = '';
      document.getElementById('fruitImage').value = '';
    }

    function renderTable() {
      const tableBody = document.getElementById('fruitTableBody');
      tableBody.innerHTML = '';

      fruitList.forEach((fruit, index) => {
        const row = document.createElement('tr');

        row.innerHTML = `
          <td>${index + 1}</td>
          <td><input type="text" value="${fruit.name}" onchange="updateFruit(${index}, 'name', this.value)"></td>
          <td><input type="number" value="${fruit.weight}" onchange="updateFruit(${index}, 'weight', this.value)"></td>
          <td><td><input type="text" value="${fruit.image}" onchange="updateFruit(${index}, 'image', this.value)"></td><td><img url="${fruit.image}"></td></td>
          <td>
            <button onclick="deleteFruit(${index})">Hapus</button>
          </td>
        `;

        tableBody.appendChild(row);
      });
    }

    function updateFruit(index, key, value) {
      fruitList[index][key] = value;
    }

    function deleteFruit(index) {
      fruitList.splice(index, 1);
      renderTable();
    }
  </script>

    <?php

    ?>
    
</body>
</html>