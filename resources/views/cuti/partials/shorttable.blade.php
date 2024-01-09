<!--
//Di Blade Yang Akan Di pasangkan Sort Data Asc(Ascending) & Dsc (Descending) Table Masukan Koding ini di Bawah Table
    <thead class="table-head">
      <tr class="judul">
        <th scope="col" onclick="sortTable(0)">No</th>
        <th scope="col" onclick="sortTable(1)" >Employee Name </th>
        <th scope="col" onclick="sortTable(2)" >Employee ID </th>
        <th scope="col" onclick="sortTable(3)" >Quota Cuti </th>
        <th scope="col" onclick="sortTable(4)" >Sisa Cuti </th>
        <th scope="col" onclick="sortTable(5)" >Mulai Cuti </th>
        <th scope="col" onclick="sortTable(6)" >Akhir Cuti </th>
        <th scope="col" onclick="sortTable(7)" >Tahun Periode </th>
        <th scope="col" onclick="sortTable(8)" >action </th>                
      </tr>
    </thead>
//setelah  di masukan di blade yang akan di pasang tinggal masukan

    @ include('folderapa.shorttable') 

//di blade yang di pasangnya
-->

<style>
  .sort-icon {
    margin-left: 5px;
    display: inline-block;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 5px 4px 0 4px;
    border-color: #999 transparent transparent transparent;
    transition: transform 0.2s;
  }
</style>
<!-- Sort Untuk ANgka dan Text -->
<script>
  var currentPage = 1;
  var rowsPerPage = parseInt($('#showEntries').val());
  var table = document.getElementById("myTable");
  var tbody = table.getElementsByTagName("tbody")[0];
  var rows = tbody.getElementsByTagName("tr");
  var totalPages = Math.ceil(rows.length / rowsPerPage);

  function sortTable(columnIndex) {
    var sortOrder = 1;
    if (table.rows[0].cells[columnIndex].classList.contains("asc")) {
      table.rows[0].cells[columnIndex].classList.remove("asc");
      table.rows[0].cells[columnIndex].classList.add("desc");
      sortOrder = -1;
    } else {
      table.rows[0].cells[columnIndex].classList.remove("desc");
      table.rows[0].cells[columnIndex].classList.add("asc");
    }

    var rowsArray = Array.prototype.slice.call(rows);
    rowsArray.sort(function(a, b) {
      var aValue = a.cells[columnIndex].textContent.trim();
      var bValue = b.cells[columnIndex].textContent.trim();
      var isNumericA = !isNaN(aValue);
      var isNumericB = !isNaN(bValue);

      if (isNumericA && isNumericB) {
        var numA = parseFloat(aValue);
        var numB = parseFloat(bValue);
        return (numA - numB) * sortOrder;
      } else if (isNumericA) {
        return -1 * sortOrder;
      } else if (isNumericB) {
        return 1 * sortOrder;
      } else {
        return aValue.localeCompare(bValue) * sortOrder;
      }
    });

    for (var i = 0; i < rowsArray.length; i++) {
      tbody.appendChild(rowsArray[i]);
    }

    showRows();
  }
</script>
<!-- Akhir Sort Untuk ANgka dan Text -->