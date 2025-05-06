<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3</title>
    <link rel="stylesheet" href=".css">
    <style>
        *{
            background-color: black  ;
            color: white;
            font-size:20px;
            margin: 1rem;
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
      
        body {
          font-family: Arial, sans-serif;
          margin: 20px;
        }
      
        input {
          padding: 10px;
          font-size: 16px;
          margin-right: 10px;
        }
      
        button {
          padding: 10px 20px;
          font-size: 16px;
          cursor: pointer;
        }
      
        table {
          margin: 20px auto;
          border-collapse: collapse;
          width: 50%;
        }
      
        th, td {
          border: 1px solid #ccc;
          padding: 10px;
          text-align: center;
        }
      
        th {
          background-color: #f4f4f4;
          color: rgb(155,0,155);

        }

        hr{
          margin-left: 0rem;
          margin-right: 0rem;
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

    <script>

    </script>
    <!--
    <?php
    function isPrime($num) {
        if ($num <= 1) return false;
        for ($i = 2; $i <= sqrt($num); $i++) {
            if ($num % $i == 0) return false;
        }
        return true;
    }
    
    function generatePrimes($limit) {
        $primes = [];
        for ($i = 2; $i <= $limit; $i++) {
            if (isPrime($i)) {
                $primes[] = $i;
            }
        }
        return $primes;
    }
    
    $limit = 100;
    $primeNumbers = generatePrimes($limit);
    echo "Prime numbers up to $limit: " . implode(", ", $primeNumbers);
    ?>
  -->
    <br><br><br><br><br><br><br><br><br><br>
<body><h1>Pencari Angka Prima</h1>
<div>
  <label for="lowlimit">Masukan batas bawah</label>
  <input type="number" id="lowlimit" placeholder="angka awal disini"/>
  <label for="highlimit">Masukan batas atas</label>
  <input type="number" id="highlimit" placeholder="angka batas disini"/>
  <button onclick="generatePrimes()">eksekusi</button>
</div>
<div id="result">
  <!--hasilnya nih-->
</div>

<script>
  function generatePrimes() {
    const lowlimit = parseInt(document.getElementById('lowlimit').value);
    const highlimit = parseInt(document.getElementById('highlimit').value);
    const resultDiv = document.getElementById('result');
    
    if (isNaN(lowlimit) || isNaN(highlimit)) {
      resultDiv.innerHTML = '<p><b style="color:red;">ERROR</b>, masukan angka yang valid</p>';
      return;
    }
    else if (lowlimit < 2 || highlimit < 2) {
      resultDiv.innerHTML = '<p><b style="color:red;">ERROR</b>, masukan angka sama dengan atau lebih dari 2</p>';
      return;
    }
    else if (lowlimit >= highlimit){
      resultDiv.innerHTML = '<p><b style="color:red;">ERROR</b>, masukan angka batas lebih dari angka awal</p>';
      return;
    }

    const primes = [];
    for (let num = lowlimit; num <= highlimit; num++) {
      let isPrime = true;
      for (let i = 2; i <= Math.sqrt(num); i++) {
        if (num % i === 0) {
          isPrime = false;
          break;
        }
      }
      if (isPrime && num >= 2) {
        primes.push(num);
      }
    }

    let table = '<table><tr><th>list angka prima</th></tr>';
    primes.forEach(prime => {
      table += `<tr><td>${prime}</td></tr>`;
    });
    table += '</table>';

    resultDiv.innerHTML = table;
  }
</script>
    
</body>
</html>