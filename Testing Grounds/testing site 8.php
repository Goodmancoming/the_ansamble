<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8</title>
    <script>
        function buatTrayek() {
            const teksMasukan = document.getElementById("inputTrayek").value; 
            const arrayTrayek = teksMasukan.split(","); 
            let hasilHTML = "<table><tr><th class='header'>Trayek</th></tr>";

            arrayTrayek.forEach(trayek => {
                const trayekBersih = trayek.trim(); 
                if (trayekBersih) {
                    const arrayKota = trayekBersih.split(" "); 
                    if (arrayKota.length >= 2) {
                        const kotaAwal = arrayKota[0]; 
                        const kotaAkhir = arrayKota[arrayKota.length - 1]; 
                        hasilHTML += `<tr><td>${kotaAwal} - ${kotaAkhir}</td></tr>`; 
                    }
                }
            });

            hasilHTML += "</table>";
            document.getElementById("hasilTrayek").innerHTML = hasilHTML;
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px; 
            background-color: black;
            color:white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ffffff; 
            padding: 8px;
            text-align: left; 
        }

        .header {
            background-color:rgb(179, 0, 255); 
            font-weight: bold;
        }

        #inputTrayek {
            width: 100%;
            padding: 10px; 
            margin-bottom: 10px; 
        }

        #hasilTrayek {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Generator Trayek</h1>
    <textarea id="inputTrayek" placeholder="Masukkan trayek, misal: KotaA KotaB, KotaC KotaD"></textarea>
    <button onclick="buatTrayek()">Generate Trayek</button>
    <div id="hasilTrayek"></div>
</body>
</html>