<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Project 10 BimBim</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body style="color: white; background-color: black;">
    <div class="input-group">
      <label>Nama Buah</label>
      <input type="text" id="namaBuah" />
    </div>
    <div class="input-group">
      <label>Jumlah Kg</label>
      <input type="number" id="jumlah" />
    </div>
    <div class="input-group">
      <label>Gambar</label>
      <input type="text" id="gambar" />
    </div>
    <button id="addButton" onclick="tambahBuah()">Add</button>
    <br><br><br>
    
  <label for="rowsPerPage">Rows per Page: </label>
  <select id="rowsPerPage" onchange="updateRowsPerPage()">
    <option value="5">5</option>
    <option value="10" selected>10</option>
    <option value="15">15</option>
    <option value="20">20</option>
  </select>

    <table>
      <thead>
        <tr>
          <th class="col-no">No</th>
          <th class="col-nama">Nama Buah</th>
          <th class="col-berat">Berat</th>
          <th class="col-gambar">Gambar</th>
          <th class="col-action">Action</th>
        </tr>
      </thead>
      <tbody id="tabelBuah"></tbody>
    </table>
    <img src="test.png" alt="none" height="25px" width="25px" />

    <br><br><br>
    
    
  <div class="pagination">
    <button onclick="prevPage()">Prev</button>
    <span id="pageInfo"></span>
    <button onclick="nextPage()">Next</button>
  </div>

    <script>
      let dataBuah = [];
      let nomor = 1;

      function tambahBuah() {
        const nama = document.getElementById("namaBuah").value;
        const jumlah = document.getElementById("jumlah").value;
        const gambar = document.getElementById("gambar").value;

        if (nama && jumlah && gambar) {
          if (!isValidImageUrl(gambar)) {
            alert("URL gambar harus valid (harus dimulai dengan http:// atau https://)");
            return;
          }

          const buah = {
            no: nomor,
            nama: nama,
            jumlah: jumlah,
            gambar: gambar,
            sedangEdit: false,
          };

          dataBuah.push(buah);
          nomor++;
          tampilkanData();
          bersihkanForm();
        } else {
          alert("Semua field harus diisi!");
        }
      }

      function tampilkanData() {
        const tabel = document.getElementById("tabelBuah");
        tabel.innerHTML = "";

        dataBuah.forEach((buah, index) => {
          const row = document.createElement("tr");
          const beratClass = parseFloat(buah.jumlah) > 5 ? "berat-merah" : "";

          if (buah.sedangEdit) {
            row.innerHTML = `
              <td>${buah.no}</td>
              <td><input type="text" value="${buah.nama}" id="editNama${index}" style="width: 90%;"></td>
              <td><input type="number" value="${buah.jumlah}" id="editJumlah${index}" style="width: 50%;"></td>
              <td><input type="text" value="${buah.gambar}" id="editGambarInput${index}" style="width: 90%;" oninput="updateImagePreview(${index})"></td>
              <td><img src="${buah.gambar}" id="editGambarPreview${index}" width=100%; height=100%; alt="no img";></td>
              <td class="action-buttons">
                <button onclick="hapusBuah(${index})">Hapus</button>
                <button onclick="simpanEdit(${index})">Save</button>
              </td>
            `;
          } else {
            row.innerHTML = `
              <td>${buah.no}</td>
              <td>${buah.nama}</td>
              <td class="${beratClass}">${buah.jumlah}</td>
              <td><img src="${buah.gambar}" width=25px; height=25px; alt="no img";></td>
              <td class="action-buttons">
                <button onclick="hapusBuah(${index})">Hapus</button>
                <button onclick="mulaiEdit(${index})">Edit</button>
              </td>
            `;
          }

          tabel.appendChild(row);
        });
      }

      function bersihkanForm() {
        document.getElementById("namaBuah").value = "";
        document.getElementById("jumlah").value = "";
        document.getElementById("gambar").value = "";
      }

      function hapusBuah(index) {
        if (confirm("Apakah Anda yakin ingin menghapus buah ini?")) {
          dataBuah.splice(index, 1);
          // Update row numbers
          dataBuah.forEach((buah, i) => {
            buah.no = i + 1;
          });
          nomor = dataBuah.length + 1;
          tampilkanData();
        }
      }

      function mulaiEdit(index) {
        dataBuah[index].sedangEdit = true;
        document.getElementById("addButton").disabled = true;
        tampilkanData();
      }

      function simpanEdit(index) {
        const nama = document.getElementById(`editNama${index}`).value;
        const jumlah = document.getElementById(`editJumlah${index}`).value;
        const gambar = document.getElementById(`editGambarInput${index}`).value;

        if (nama && jumlah && gambar) {
          if (!isValidImageUrl(gambar)) {
            alert("URL gambar harus valid (harus dimulai dengan http:// atau https://)");
            return;
          }

          dataBuah[index].nama = nama;
          dataBuah[index].jumlah = jumlah;
          dataBuah[index].gambar = gambar;
          dataBuah[index].sedangEdit = false;
          document.getElementById("addButton").disabled = false;
          tampilkanData();
        } else {
          alert("Semua field harus diisi!");
        }
      }

      function updateImagePreview(index) {
        const imageUrl = document.getElementById(`editGambarInput${index}`).value;
        document.getElementById(`editGambarPreview${index}`).src = imageUrl;
      }

      function isValidImageUrl(url) {
        return url.startsWith("http://") || url.startsWith("https://");
      }
      
    function updateRowsPerPage() {
      rowsPerPage = parseInt(document.getElementById('rowsPerPage').value, 10);
      currentPage = 1; // Reset to the first page
      renderTable();
    }

    function prevPage() {
      if (currentPage > 1) {
        currentPage--;
        renderTable();
      }
    }

    function nextPage() {
      if (currentPage < Math.ceil(fruitList.length / rowsPerPage)) {
        currentPage++;
        renderTable();
      }
    }

    function updatePageInfo() {
      const pageInfo = document.getElementById('pageInfo');
      const totalPages = Math.ceil(fruitList.length / rowsPerPage);
      pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
    }

    renderTable();
    </script>
  </body>
</html>