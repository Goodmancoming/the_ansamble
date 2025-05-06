<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>7</title>
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

    <!-- Pagination Controls -->
    <div class="pagination">
      <button id="prevButton" onclick="previousPage()">Previous</button>
      <span id="pageInfo">Page 1 of 1</span>
      <button id="nextButton" onclick="nextPage()">Next</button>
      <select id="pagenumbering" onchange="changePageSize()">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="25">25</option>
      </select>
    </div>

    <script>
      let dataBuah = [];
      let nomor = 1;
      let currentPage = 1;
      let itemsPerPage = 5;

      // Function to handle page size change
      function changePageSize() {
        itemsPerPage = parseInt(document.getElementById("pagenumbering").value);
        currentPage = 1; // Reset to the first page
        tampilkanData();
        updatePaginationControls();
      }

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
          updatePaginationControls();
        } else {
          alert("Semua field harus diisi!");
        }
      }

      function tampilkanData() {
        const tabel = document.getElementById("tabelBuah");
        tabel.innerHTML = "";

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const itemsToDisplay = dataBuah.slice(startIndex, endIndex);

        itemsToDisplay.forEach((buah, index) => {
          const row = document.createElement("tr");
          const beratClass = parseFloat(buah.jumlah) > 5 ? "berat-merah" : "";

          if (buah.sedangEdit) {
            row.innerHTML = `
              <td>${buah.no}</td>
              <td><input type="text" value="${buah.nama}" id="editNama${index}" style="width: 90%;"></td>
              <td><input type="number" value="${buah.jumlah}" id="editJumlah${index}" style="width: 50%;"></td>
              <td><input type="text" value="${buah.gambar}" id="editGambarInput${index}" style="width: 90%;" oninput="updateImagePreview(${index})"></td>
              <td><img src="${buah.gambar}" id="editGambarPreview${index}" width=25px; height=25px; alt="no img";></td>
              <td class="action-buttons">
                <button onclick="hapusBuah(${index + startIndex})">Hapus</button>
                <button onclick="simpanEdit(${index + startIndex})">Save</button>
              </td>
            `;
          } else {
            row.innerHTML = `
              <td>${buah.no}</td>
              <td>${buah.nama}</td>
              <td class="${beratClass}">${buah.jumlah}</td>
              <td><img src="${buah.gambar}" width=25px; height=25px; alt="no img";></td>
              <td class="action-buttons">
                <button onclick="hapusBuah(${index + startIndex})">Hapus</button>
                <button onclick="mulaiEdit(${index + startIndex})">Edit</button>
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
          // Update numbers
          dataBuah.forEach((buah, i) => {
            buah.no = i + 1;
          });
          nomor = dataBuah.length + 1;
          tampilkanData();
          updatePaginationControls();
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

      // Pagination
      function previousPage() {
        if (currentPage > 1) {
          currentPage--;
          tampilkanData();
          updatePaginationControls();
        }
      }

      function nextPage() {
        const totalPages = Math.ceil(dataBuah.length / itemsPerPage);
        if (currentPage < totalPages) {
          currentPage++;
          tampilkanData();
          updatePaginationControls();
        }
      }

      function updatePaginationControls() {
        const totalPages = Math.ceil(dataBuah.length / itemsPerPage);
        document.getElementById("pageInfo").textContent = `Page ${currentPage} of ${totalPages}`;
        document.getElementById("prevButton").disabled = currentPage === 1;
        document.getElementById("nextButton").disabled = currentPage === totalPages;
      }
    </script>
  </body>
</html>