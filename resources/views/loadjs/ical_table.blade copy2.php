<!-- Untuk  -->
<script>
    $(document).ready(function() {
        var uniqueValues = [];
        $('.statusCheckbox').each(function() {
            var checkboxValue = $(this).val().toLowerCase();
            if (uniqueValues.indexOf(checkboxValue) === -1) {
                uniqueValues.push(checkboxValue);
            } else {
                $(this).parent().remove(); // Hapus elemen parent (label dan input) yang sama
            }
        });
    });
</script>

<script>

  function getcheckboxes() {
    var td_list = document.querySelectorAll('td input[type="checkbox"]');
    var checkboxes = [];
    for (var i = 0; i < td_list.length; i++) {
      checkboxes.push(td_list[i]);
    }
    return checkboxes;
  }

  function pilihsemua(source) {
    var checkboxes = getcheckboxes();
    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = source.checked;
      checkboxes[i].checked = source.checked;
      if (source.checked) {
        checkboxes[i].setAttribute("checked", "checked");
        // console.log('ideuuuuu',checkboxes[i].value);
      } else {
        checkboxes[i].removeAttribute("checked");
        // console.log('ideuuuuu',checkboxes[i].value);
      }
    }
    tampilkanForm();
  }
  
  function tampilkanForm() {
    var checkboxes = getcheckboxes();
    var selectedCount = 0;
    for (var i = 0, n = checkboxes.length; i < n; i++) {
      if (checkboxes[i].checked) {
        selectedCount++;
      }
    }
    
    var formContainer = document.getElementById('formContainer');
    if (selectedCount > 1) {
      formContainer.style.display = 'block';
    } else {
      formContainer.style.display = 'none';
    }
  }

  function cekPilihan() {
        var checkboxes = getcheckboxes();
        var checkedCount = 0;

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
              checkboxes[i].setAttribute("checked", "checked");
                checkedCount++;
                
            }else {
              checkboxes[i].removeAttribute("checked");
              checkedCount++;
            }
        }

        // Menampilkan kembali elemen dengan id "formContainer"
        document.getElementById("formContainer").style.display = "flex";
        document.getElementById("formContainer").style.visibility = "visible";

        var formContainer = document.getElementById('formContainer');


        if (checkedCount > 1) {
            formContainer.style.display = 'block';
        } else {
            formContainer.style.display = 'none';
        }
    };


  var counter = 0;
  function updateCounter(checkbox) {
    if (checkbox.checked) {
      counter++;
    } else {
      counter--;
    }
    document.getElementById('counter').textContent = counter;
    tampilkanForm();
  }


  // Untuk Sort Table dari a ke z dan dari z ke a
    var currentPage = 1;
    var rowsPerPage = parseInt($('#showEntries').val());
    var table = document.getElementById("myTable");
    var tbody = table.getElementsByTagName("tbody")[0];
    var rows = tbody.getElementsByTagName("tr");
    var totalPages = Math.ceil(rows.length / rowsPerPage);

    function showRows() {
      var startIndex = (currentPage - 1) * rowsPerPage;
      var endIndex = startIndex + rowsPerPage;

      for (var i = 0; i < rows.length; i++) {
        if (i >= startIndex && i < endIndex) {
          rows[i].style.display = "table-row";
        } else {
          rows[i].style.display = "none";
        }
      }
    }

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

        if (aValue < bValue) {
          return -1 * sortOrder;
        } else if (aValue > bValue) {
          return 1 * sortOrder;
        } else {
          return 0;
        }
      });

      for (var i = 0; i < rowsArray.length; i++) {
        tbody.appendChild(rowsArray[i]);
      }

      showRows();
    }
  // Akhir Untuk Sort Tbale dari a ke z dan dari z ke a
  // Untuk mempeprtahankan page tetep bisa di clik setelah sort table
    function prevPage() {
      if (currentPage > 1) {
        currentPage--;
        showRows();
      }
    }

    function nextPage() {
      if (currentPage < totalPages) {
        currentPage++;
        showRows();
      }
    }

    showRows();
    // Akhir Untuk mempeprtahankan page tetep bisa di clik setelah sort table
</script>
<!-- Akhir Check Box -->


<script>
  
var currentPage = 1;
var rowsPerPage = parseInt($('#showEntries').val());
// $('#showEntries').val();
// console.log('hahah',rowsPerPage);

// Function to show the rows based on the current page and rows per page
function showRows() {
  var table = document.getElementById('myTable');
  var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
  
  // Hide all rows
  for (var i = 0; i < rows.length; i++) {
    rows[i].style.display = 'none';
  }
  
  // Calculate the start and end index of the current page
  var startIndex = (currentPage - 1) * rowsPerPage;
  var endIndex = startIndex + rowsPerPage;

  // Show the rows for the current page
  for (var j = startIndex; j < endIndex && j < rows.length; j++) {
    rows[j].style.display = 'table-row';
  }
}


// Untuk Show Rows
// Function to update the table rows based on the selected number of entries
function updateTableRows() {
  var table = document.getElementById('myTable');
  var showEntriesSelect = document.getElementById('showEntries');
  var selectedValue = parseInt(showEntriesSelect.value, 10);
  var tableRows = table.getElementsByTagName('tr');
  
  rowsPerPage = selectedValue;

  for (var i = 1; i < tableRows.length; i++) {
    if (i <= selectedValue) {
      tableRows[i].style.display = 'table-row';
    } else{
      tableRows[i].style.display = 'none';
    }
  }

  currentPage = 1;
  renderPagination();
  updateDataCount();
}
</script>
<!-- Untuk Pagination -->
<script>
  // Function to render the pagination
  function renderPagination() {
  var table = document.getElementById('myTable');
  var numRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr').length;
  var paginationContainer = document.getElementById('pagination');

  // Clear the pagination container
  paginationContainer.innerHTML = '';

  // Calculate the total number of pages
  var totalPages = Math.ceil(numRows / rowsPerPage);

  // Generate pagination links
  var prevLink = document.createElement('a');
  prevLink.href = '#';
  prevLink.textContent = 'Previous';
  prevLink.addEventListener('click', function(event) {
    event.preventDefault();
    if (currentPage > 1) {
      currentPage--;
      showRows();
      renderPagination();
      updateDataCount();
    }
  });
  paginationContainer.appendChild(prevLink);

  var ellipsis1 = document.createElement('span');
  ellipsis1.className = 'ellipsis';
  ellipsis1.textContent = '...';
  paginationContainer.appendChild(ellipsis1);

  var startPage = currentPage > 2 ? currentPage - 2 : 1;
  var endPage = currentPage < totalPages - 2 ? currentPage + 2 : totalPages;

  for (var i = startPage; i <= endPage; i++) {
    var link = document.createElement('a');
    link.href = '#';
    link.textContent = i;

    // Highlight the current page
    if (i === currentPage) {
      link.classList.add('active');
    }

    // Add click event listener to change the current page
    link.addEventListener('click', function(event) {
      event.preventDefault();
      currentPage = parseInt(this.textContent);
      showRows();
      renderPagination();
      updateDataCount();
    });

    paginationContainer.appendChild(link);
  }

  var ellipsis2 = document.createElement('span');
  ellipsis2.className = 'ellipsis';
  ellipsis2.textContent = '...';
  paginationContainer.appendChild(ellipsis2);

  var nextLink = document.createElement('a');
  nextLink.href = '#';
  nextLink.textContent = 'Next';
  nextLink.addEventListener('click', function(event) {
    event.preventDefault();
    if (currentPage < totalPages) {
      currentPage++;
      showRows();
      renderPagination();
      updateDataCount();
    }
  });
  paginationContainer.appendChild(nextLink);
}


  </script>


<!-- Show Data Count  -->

<script>
  
// Function to count and display the number of rows being shown
// Function to count and display the number of rows being shown
function updateDataCount() {
  var table = document.getElementById('myTable');
  var numRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr').length;
  var startIndex = (currentPage - 1) * rowsPerPage + 1;
  var endIndex = startIndex + rowsPerPage - 1;
  if (endIndex > numRows) {
    endIndex = numRows;
  }
  var dataCountContainer = document.getElementById('dataCount');
  dataCountContainer.textContent = 'Showing ' + startIndex + ' to ' + endIndex + ' of ' + numRows + ' entries';
}

// Call the necessary functions when the page is loaded
document.addEventListener('DOMContentLoaded', function() {
  showRows();
  renderPagination();
  updateDataCount();
});

// Event listener for the "Show Entries" select
document.getElementById('showEntries').addEventListener('change', function() {
  updateTableRows();
});

// Event listeners for the "Previous" and "Next" links
document.getElementById('prevPage').addEventListener('click', function(event) {
  event.preventDefault();
  if (currentPage > 1) {
    currentPage--;
    showRows();
    renderPagination();
    updateDataCount();
  }
});

document.getElementById('nextPage').addEventListener('click', function(event) {
  event.preventDefault();
  var table = document.getElementById('myTable');
  var numRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr').length;
  var totalPages = Math.ceil(numRows / rowsPerPage);
  if (currentPage < totalPages) {
    currentPage++;
    showRows();
    renderPagination();
    updateDataCount();
  }
});



$(document).ready(function() {
  // Fungsi untuk mengatur tinggi .table-body
  function setTableBodyHeight() {
    var visibleRowCount = $('#myTable tr[style*="display: table-row"]').length;
    var tableBody = $('.table-body');

    if (visibleRowCount <= 6) {
      tableBody.css("height", "380px");
      tableBody.css("overflow-y", "auto");
    } else {
      tableBody.css("height", "auto");
      tableBody.css("overflow-y", "hidden");
      renderPagination();
      updateDataCount();
      cekdatashow();
    }
  }

  $('#btnchg').on('click', function() {
    // Panggil fungsi untuk mengatur tinggi .table-body
    setTableBodyHeight();

  });

  // Ketika elemen dengan ID "search" menerima input dari pengguna
  $("#search").on("keyup", function () {
    // Panggil fungsi untuk mengatur tinggi .table-body
    setTableBodyHeight();


    // Lakukan tindakan lain yang Anda inginkan ketika pengguna mengetik dalam kotak pencarian.
  });
});



function cekdatashow(){
  // $(document).ready(function(){
  var table = document.getElementById('myTable');
  var numRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr').length;
  var startIndex = (currentPage - 1) * rowsPerPage + 1;
  var endIndex = startIndex + rowsPerPage - 1;
  var sh = document.getElementById('showEntries').options[document.getElementById('showEntries').selectedIndex].value; 
  var ss = startIndex + rowsPerPage - 1;

  if (endIndex > numRows) {
    endIndex = numRows;
  }
  var dataCountContainer = document.getElementById('dataCount');
  dataCountContainer.textContent = 'Showing ' + startIndex + ' to ' + sh + ' of ' + numRows + ' entries'; 
}
</script>

<!-- Hide Sow TH TD -->
<script>
  function toggleColumn(column) {
    var checkbox = document.getElementById(column + "Checkbox");
    var table = document.getElementById("myTable");
    var thElements = table.getElementsByClassName(column);
    var tdElements = table.getElementsByClassName(column);

    for (var i = 0; i < thElements.length; i++) {
      thElements[i].style.display = checkbox.checked ? "" : "none";
    }

    for (var i = 0; i < tdElements.length; i++) {
      tdElements[i].style.display = checkbox.checked ? "" : "none";
    }
  }


  function toprofile(id) {
    location.href = '/myinfo/'+id;
    var currentURL = window.location.href;
    var newURL = currentURL.replace(/\/\d+$/, '/' + id);
    history.replaceState(null, 'aaaaaaaaaaaa', newURL);
    
  }

</script>

<script>
  // Menghitung jumlah checkbox yang dipilih dan menampilkan pada tombol
  function updateSelectedCount() {
    var employStatusCheckboxes = document.querySelectorAll('input[name="employ_status[]"]');
    var branchCheckboxes = document.querySelectorAll('input[name="branch[]"]');
    var organizationCheckboxes = document.querySelectorAll('input[name="organization[]"]');
    var employStatusSelectedText = document.getElementById('employStatusSelectedText');
    var branchSelectedText = document.getElementById('branchSelectedText');
    var organizationSelectedText = document.getElementById('organizationSelectedText');

    var employStatusCheckedCount = 0;
    employStatusCheckboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        employStatusCheckedCount++;
      }
    });

    var branchCheckedCount = 0;
    branchCheckboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        branchCheckedCount++;
      }
    });

    var organizationCheckedCount = 0;
    organizationCheckboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        organizationCheckedCount++;
      }
    });

    employStatusSelectedText.innerHTML = employStatusCheckedCount > 0 ? '(' + employStatusCheckedCount + ') Selected employment status' : 'Select employment status';
    branchSelectedText.innerHTML = branchCheckedCount > 0 ? '(' + branchCheckedCount + ') Selected Branch' : 'Select Branch';
    organizationSelectedText.innerHTML = organizationCheckedCount > 0 ? '(' + organizationCheckedCount + ') Selected Organization' : 'Select Organization';

    if (employStatusCheckedCount === employStatusCheckboxes.length && employStatusCheckedCount !== 1) {
      employStatusSelectedText.innerHTML = 'All Employment Status';
    }

    if (branchCheckedCount === branchCheckboxes.length && branchCheckedCount !== 1) {
      branchSelectedText.innerHTML = 'All Branch';
    }

    if (organizationCheckedCount === organizationCheckboxes.length && organizationCheckedCount !== 1) {
      organizationSelectedText.innerHTML = 'All Organization';
    }
  }

  // Memanggil fungsi updateSelectedCount setiap kali checkbox diubah
  var employStatusCheckboxes = document.querySelectorAll('input[name="employ_status[]"]');
  var branchCheckboxes = document.querySelectorAll('input[name="branch[]"]');
  var organizationCheckboxes = document.querySelectorAll('input[name="organization[]"]');
  var employStatusCheckboxAll = document.getElementById('employStatusCheckboxAll');
  var branchCheckboxAll = document.getElementById('branchCheckboxAll');
  var organizationCheckboxAll = document.getElementById('organizationCheckboxAll');

  employStatusCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', updateSelectedCount);
  });
  branchCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', updateSelectedCount);
  });
  organizationCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', updateSelectedCount);
  });

  employStatusCheckboxAll.addEventListener('change', function() {
    var employStatusCheckboxes = document.querySelectorAll('input[name="employ_status[]"]');
    employStatusCheckboxes.forEach(function(checkbox) {
      checkbox.checked = employStatusCheckboxAll.checked;
    });
    updateSelectedCount();
  });

  branchCheckboxAll.addEventListener('change', function() {
    var branchCheckboxes = document.querySelectorAll('input[name="branch[]"]');
    branchCheckboxes.forEach(function(checkbox) {
      checkbox.checked = branchCheckboxAll.checked;
    });
    updateSelectedCount();
  });

  organizationCheckboxAll.addEventListener('change', function() {
    var organizationCheckboxes = document.querySelectorAll('input[name="organization[]"]');
    organizationCheckboxes.forEach(function(checkbox) {
      checkbox.checked = organizationCheckboxAll.checked;
    });
    updateSelectedCount();
  });
</script>





<script>
// // JavaScript
// $(document).ready(function () {
//   $("#search").on("keyup", function () {
//     var value = $(this).val().toLowerCase();

//     // Menemukan semua baris dalam tabel
//     var rows = $("#myTable tbody tr");

//     rows.each(function () {
//       var employeeName = $(this).find(".nama").text().toLowerCase();
//       var branch = $(this).find(".cabang").text().toLowerCase();
//       var position = $(this).find(".jabatan").text().toLowerCase();
//       var bagian = $(this).find(".bagian").text().toLowerCase();
//       var status = $(this).find(".status_karyawan").text().toLowerCase();
//       var tahun = $(this).find(".tahun_gabung").text().toLowerCase();
//       var expired = $(this).find(".expired_kontrak").text().toLowerCase();
//       var sign = $(this).find(".sign").text().toLowerCase();
//       var tahunkeluar = $(this).find(".tahun_keluar").text().toLowerCase();

//       // Memeriksa apakah data pegawai, cabang, atau jabatan cocok dengan nilai pencarian
//       if (employeeName.includes(value) || branch.includes(value) || position.includes(value)) {
//         $(this).show(); // Menampilkan baris jika cocok
//       } else {
//         $(this).hide(); // Menyembunyikan baris jika tidak cocok
//       }
//     });
//   });
// });

$(document).ready(function () {
  $("#search").on("keyup", function () {
    var value = $(this).val().toLowerCase();

    // Menemukan semua baris dalam tabel
    var rows = $("#myTable tbody tr");

    rows.each(function () {
      var employeeData = $(this)
        .find(".nama, .id, .cabang, .jabatan, .posisi, .bagian, .status_karyawan, .tahun_gabung, .expired_kontrak, .sign, .tahun_keluar, .no_finger, .email, .tgl_lahir, .tempat_lahir, .alamat, .no_hp, .agama, .gender, .status_pernikahan")
        // .addBack(".nama, .cabang, .jabatan")
        .text()
        .toLowerCase();

      // Memeriksa apakah data pegawai, cabang, atau jabatan cocok dengan nilai pencarian
      if (employeeData.includes(value)) {
        $(this).show(); // Menampilkan baris jika cocok
      } else {
        $(this).hide(); // Menyembunyikan baris jika tidak cocok
      }
    });
  });
});
</script>

<script>
    document.getElementById('exportForm').addEventListener('submit', function(event) {
    var employStatusSelected = document.getElementById('employStatusSelectedText').innerText;
    var branchSelected = document.getElementById('branchSelectedText').innerText;
    var organizationSelected = document.getElementById('organizationSelectedText').innerText;

    if (employStatusSelected === 'Select Employment status' || branchSelected === 'Select Branch' || organizationSelected === 'Select Organization') {
      event.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please fill in all the fields!',
      });
    }
  });
  
  
$(document).ready(function() {
  // console.log("filterTable function called."); // Debug console log
  // Tambahkan event listener pada tombol "Apply"
  // $('.dropdown-item').on('click', filterTable);
  $('#employmentCheckbox1, #employmentCheckbox2, .cabangCheckbox, .statusCheckbox, .tableCheckbox, .jabatanCheckbox, .levelCheckbox, .brandCheckbox, .vendorCheckbox').on('change', filterTable);
  filterTable();
  showRows(); // Call the showRows function when filters change

    


  function filterTable() {
    // Dapatkan nilai checkbox untuk status
    const checkboxAktif = $('#employmentCheckbox1');
    const checkboxResign = $('#employmentCheckbox2');


  // console.log("Checkbox 'aktif' checked:", checkboxAktif.is(':checked'));
  // console.log("Checkbox 'resign' checked:", checkboxResign.is(':checked'));

  // Dapatkan nilai checkbox untuk cabang
  const selectedStatus = [];
  
  if (checkboxAktif.is(':checked')) {
    selectedStatus.push('aktif');
  }
  
  if (checkboxResign.is(':checked')) {
    selectedStatus.push('resign');
  }

  const selectedCabangs = [];
  $('.cabangCheckbox:checked').each(function() {
    selectedCabangs.push($(this).val());
  });

  const selectedemploystat = [];
  $('.statusCheckbox:checked').each(function() {
    selectedemploystat.push($(this).val());
  });

  const selectedbrand = [];
  $('.brandCheckbox:checked').each(function() {
    selectedbrand.push($(this).val());
  });
    // console.log("Checkbox", selectedbrand);


  const selectedvendor = [];
  $('.vendorCheckbox:checked').each(function() {
    selectedvendor.push($(this).val());
  });


  const selectedBagians = [];
  $('.tableCheckbox:checked').each(function() {
    selectedBagians.push($(this).val());
  });

  const selectedJabatan = [];
  $('.jabatanCheckbox:checked').each(function() {
    selectedJabatan.push($(this).val());
  });

  const selectedLevel = [];
  $('.levelCheckbox:checked').each(function() {
    selectedLevel.push($(this).val());
  });

  const rows = $('#myTable tbody tr');

    rows.each(function() {
      const row = $(this);
      const posisi = row.find('.posisi').data('posisi'); // Dapatkan nilai dari data-posisi
      const cabang = row.find('.cabang').text();
      const bagian = row.find('.bagian').text();
      const jabatan = row.find('.jabatan').text();
      const brand = row.find('.brand').text();
      const vendor = row.find('.vendor').text();
      const level = row.find('.level').text();
      const empoystat = row.find('.posisi').text();

      // console.log("Checkbox 'data' checked:", posisi);

      row.show();

      if (selectedCabangs.length > 0 && !selectedCabangs.includes(cabang)) {
        row.hide();
      } else if (selectedBagians.length > 0 && !selectedBagians.includes(bagian)) {
        row.hide();
      } else if (selectedJabatan.length > 0 && !selectedJabatan.includes(jabatan)) {
        row.hide();
      } else if (selectedbrand.length > 0 && !selectedbrand.includes(brand)) {
        row.hide();
      } else if (selectedvendor.length > 0 && !selectedvendor.includes(vendor)) {
        row.hide();
      } else if (selectedemploystat.length > 0 && !selectedemploystat.includes(empoystat)) {
        row.hide();
      } else if (selectedLevel.length > 0 && !selectedLevel.includes(level)) {
        row.hide();
      } else {
      if (checkboxAktif.is(':checked') && checkboxResign.is(':checked')) {
        // Kedua checkbox dipilih, jadi tampilkan baris tanpa memeriksa status atau posisi
      } else {
        if (selectedStatus.length > 0) {
          // Kondisi status yang sudah ada
          if (
            (selectedStatus.includes('aktif') && posisi !== 'Permanent' && posisi !== 'Probation' && posisi !== 'PHL' && posisi !== 'aktif' && posisi !== 'AKTIF' && posisi !== 'Contract') ||
            (selectedStatus.includes('resign') && posisi !== 'phk' && posisi !== 'PHK' && posisi !== 'Resign')
          ) {
            row.hide();
          }
        }
      }
    }
  });
  }
});


</script>


<script>
  function toggleMenu(menuId) {
    var menu = document.getElementById(menuId);
    if (menu.style.display === "none") {
      menu.style.display = "block";
    } else {
      menu.style.display = "none";
    }
  }

</script>

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

  .hover-column:hover {
    color: blue;
    cursor: pointer;
    text-decoration: underline;
  }
  
  /* .asc {
    transform: rotate(180deg);
  }
  
  .desc {
    transform: rotate(0);
  } */
  
  .halaman, .export{
     background-color: white;
      border: 0px;
  }




.dropdown.col-md-6.mb-2.cstm-drp {
    margin-right: 13%;
}

.custom-dropdown .dropdown-toggle::after {
    content: none;
  }

  .custom-dropdown .dropdown-toggle {
    position: relative;
    padding-right: 30px;
  }

  .custom-dropdown .dropdown-toggle::before {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    content: "";
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 5px 5px 0 5px;
    border-color: #999 transparent transparent transparent;
    pointer-events: none;
  }

  .custom-dropdown-menu {
    padding: 10px;
    max-height: 200px;
    overflow-y: auto;
  }

  .scrollable-menu {
  max-height: 200px;
  overflow-y: auto;
}

.dropdown-menu-scroll {
  max-height: auto;
  overflow-y: auto;
}

.dropdown-menu {
  overflow-y: auto;
  /* max-height: 230px; Atur tinggi maksimum yang sesuai */
  margin-left: -25px;
}

.dropdown-footer {
  position: sticky;
  bottom: -8px;
  background-color: #6c757d;
  padding: 0px;
  text-align: center;
}

button.dropdown-item.btnczmy {
  background-color: #dc3545;
}

button.dropdown-item.btn-pry {
    background-color: #348fe2;
}







.sticky-col-name,
.sticky-col-id,
.sticky-col-ckbx {
  position: sticky;
  background-color: #E2E7FB !important; /* Warna kuning mencolok dengan !important */
  z-index: 2;
}

.sticky-col-name {
  left: 43px ;
  padding-left: 0px; /* Beri jarak padding agar isi tetap terlihat */
}
.sticky-col-ckbx {
  left: 0 ;
  padding-left: 0px; /* Beri jarak padding agar isi tetap terlihat */
}

.sticky-col-id {
  left: 197px; /* Sesuaikan jarak untuk membuat tampilan lebih baik */
}

.zui-sticky-col{
  right: 0;
  border-left: 1px solid #A7A7A7;

}


.zui-sticky-col {
position: sticky;
z-index: 2;
border-left: 1px solid #A7A7A7;
background-color: #E2E7FB !important; /* Warna kuning mencolok dengan !important */
}


</style>



<!-- Add Font Awesome library -->
<!-- <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script> -->

