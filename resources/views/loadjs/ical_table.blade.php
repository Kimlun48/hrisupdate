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
    var currentPage = 1;
    var rowsPerPage = parseInt(document.getElementById('showEntries').value);
    var table = document.getElementById("myTable");
    var tbody = table.getElementsByTagName("tbody")[0];
    var rows = tbody.getElementsByTagName("tr");
    var totalPages = Math.ceil(rows.length / rowsPerPage);

    function showRows() {
        for (var i = 0; i < rows.length; i++) {
            rows[i].style.display = 'none';
        }

        var startIndex = (currentPage - 1) * rowsPerPage;
        var endIndex = startIndex + rowsPerPage;

        for (var j = startIndex; j < endIndex && j < rows.length; j++) {
            rows[j].style.display = 'table-row';
        }
    }

    function renderPagination() {
        var numRows = rows.length;
        var numPages = Math.ceil(numRows / rowsPerPage);

        var pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        if (currentPage > 1) {
            var firstPageLink = document.createElement('a');
            firstPageLink.href = 'javascript:void(0)';
            firstPageLink.textContent = '<<';
            firstPageLink.addEventListener('click', function () {
                currentPage = 1;
                showRows();
                renderPagination();
            });
            pagination.appendChild(firstPageLink);

            var prevPageLink = document.createElement('a');
            prevPageLink.href = 'javascript:void(0)';
            prevPageLink.textContent = 'Prev';
            prevPageLink.addEventListener('click', function () {
                currentPage--;
                showRows();
                renderPagination();
            });
            pagination.appendChild(prevPageLink);
        }

        // Menampilkan hanya 5 nomor halaman sekaligus
        var startPage = Math.max(1, currentPage - 2);
        var endPage = Math.min(numPages, currentPage + 2);

        for (var i = startPage; i <= endPage; i++) {
            var pageLink = document.createElement('a');
            pageLink.href = 'javascript:void(0)';
            pageLink.textContent = i;
            if (i === currentPage) {
                pageLink.classList.add('active');
            }
            pageLink.addEventListener('click', function (page) {
                return function () {
                    currentPage = page;
                    showRows();
                    renderPagination();
                };
            }(i));
            pagination.appendChild(pageLink);
        }

        if (currentPage < numPages) {
            var nextPageLink = document.createElement('a');
            nextPageLink.href = 'javascript:void(0)';
            nextPageLink.textContent = 'Next';
            nextPageLink.addEventListener('click', function () {
                currentPage++;
                showRows();
                renderPagination();
            });
            pagination.appendChild(nextPageLink);

            var endPageLink = document.createElement('a');
            endPageLink.href = 'javascript:void(0)';
            endPageLink.textContent = '>>';
            endPageLink.addEventListener('click', function () {
                currentPage = numPages;
                showRows();
                renderPagination();
            });
            pagination.appendChild(endPageLink);
        }

        var dataCount = document.getElementById('dataCount');
        dataCount.textContent = 'Page ' + currentPage + ' of ' + numPages;
    }

    function handleShowEntries() {
        rowsPerPage = parseInt(document.getElementById('showEntries').value, 10);
        currentPage = 1;
        showRows();
        renderPagination();
    }

    var showEntriesSelect = document.getElementById('showEntries');
    showEntriesSelect.addEventListener('change', handleShowEntries);

    showRows();
    renderPagination();
</script>

<style>
    .table-container {
        height: 200px;
        width: 1000px;
        overflow: auto;
    }

    .pagination {
        /* display: inline-block; */
        margin-top: 10px;
    }

    .pagination a {
        color: #000; /* Mengubah warna teks menjadi hitam */
        background-color: #fff; /* Mengubah latar belakang menjadi putih */
        border: 1px solid #b5b5b5;
        padding: 5px 8px;
        text-decoration: none;
        margin: 0 4px;
        border-radius: 4px;
    }

    .pagination a.active {
        background: #348ee3!important;
        border-color: #348ee3!important;
        color: #fff;
    }

    .pagination a:hover:not(.active) {
        background-color: #b5b5b5; /* Mengubah latar belakang menjadi biru saat dihover */
        color: #fff; /* Mengubah warna teks menjadi putih saat dihover */
    }

    .show-entries-container {
        margin-top: 10px;
    }

    select#showEntries {
        width: auto;
    }

    .show-entries-label {
        font-weight: bold;
    }

    .show-entries-select {
        padding: 4px;
    }

    .show-entries-option {
        padding: 4px;
    }

    .ellipsis {
        display: inline-block;
        width: 20px;
        text-align: center;
    }
</style>
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

// $(document).ready(function() {
//   $("#search").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
    
//     // Menemukan semua baris dalam tabel
//     var rows = $('#myTable tbody tr');
    
//     var anyRowMatches = false; // Apakah ada baris yang cocok
    
//     rows.each(function() {
//       // Mengambil semua teks dalam baris
//       var rowText = $(this).text().toLowerCase();
      
//       // Memeriksa apakah teks dalam baris cocok dengan nilai pencarian
//       if (rowText.includes(value)) {
//         $(this).show(); // Menampilkan baris jika cocok
//         anyRowMatches = true; // Setel flag menjadi true
//       } else {
//         $(this).hide(); // Menyembunyikan baris jika tidak cocok
//       }
//     });
    
//     // Memeriksa apakah ada baris yang cocok
//     if (!anyRowMatches) {
//       // Jika tidak ada baris yang cocok, tampilkan pesan
//       $("#myTable tbody").append('<tr id="no-data-row"><td colspan="7"><div class="alert alert-danger text-center">Data yang ada cari tidak tersedia.</div></td></tr>');
//     } else {
//       // Jika ada baris yang cocok, hapus pesan jika ada
//       $("#no-data-row").remove();
//     }
//   });
// });

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











.dropdown-menu-scroll {
  max-height: auto;
  overflow-y: auto;
}

/* .dropdown-menu {
  overflow-y: auto;
  height: 190px;
  width: 100%;
} */








</style>



<!-- Add Font Awesome library -->
<!-- <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script> -->

