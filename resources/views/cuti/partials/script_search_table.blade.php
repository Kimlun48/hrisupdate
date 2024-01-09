
<!--
//Di Blade Yang Akan Di pasangkan Sort Data Asc(Ascending) & Dsc (Descending) Table Masukan Koding ini di Bawah Table 

    <input type="text" id="searchInput" placeholder="Cari data..." class="form-control col-sm-2"> 

//setelah  di masukan di blade yang akan di pasang tinggal masukan

    @ include('folderapa.scriptpage_row') 
//di blade yang di pasangnya
-->
<script>
  var currentPage = 1; // Menyimpan halaman terakhir yang aktif

  // Fungsi untuk melakukan pencarian data
  function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    
    // Cek jika ada karakter pencarian
    if (filter.trim() === "") {
      showRows(currentPage); // Kembali ke halaman terakhir
      return;
    }

    var matchedRows = []; // Array untuk menyimpan indeks baris yang cocok

    // Loop melalui semua baris tabel, mulai dari 1 untuk menghindari header
    for (i = 1; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td");
      var rowMatched = false; // Tandai apakah baris ini cocok atau tidak
      for (var j = 0; j < td.length; j++) {
        var cell = td[j];
        if (cell) {
          txtValue = cell.textContent || cell.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            rowMatched = true;
            break; // Keluar dari loop jika ada yang cocok
          }
        }
      }
      if (rowMatched) {
        matchedRows.push(i); // Simpan indeks baris yang cocok
      }
    }

    // Loop melalui semua baris dan sembunyikan yang tidak cocok
    for (i = 1; i < tr.length; i++) {
      if (matchedRows.includes(i)) {
        tr[i].style.display = ""; // Tampilkan baris jika cocok
      } else {
        tr[i].style.display = "none"; // Sembunyikan baris jika tidak cocok
      }
    }
  }

  // Tambahkan event listener ke elemen input pencarian
  document.getElementById("searchInput").addEventListener("input", searchTable);

  // Fungsi untuk menampilkan baris berdasarkan halaman terakhir yang aktif
  function showRows(currentPage) {
    // ... (fungsi showRows yang sebelumnya)
  }
</script>