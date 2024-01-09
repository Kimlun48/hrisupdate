
<!-- Check Box -->
<script>
function getcheckboxes() {
    var node_list = document.getElementsByTagName('input');
    var checkboxes = [];
    for (var i = 0; i < node_list.length; i++) {
      var node = node_list[i];
      if (node.getAttribute('type') == 'checkbox') {
        checkboxes.push(node);
        
      }
    }
    return checkboxes;
    console.log('cccbbbbbb');
  }
  
  function pilihsemua(source) {
    checkboxes = getcheckboxes();
    for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
      console.log('iniiiiiiii',checkboxes[i])
    }
    tampilkanForm();
  };
  
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


</script>

<script>
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
</script>

<script>
  // var sortDirections = ["asc", "asc"];
  // var sortIcons = document.getElementsByClassName("sort-icon");

  // function sortTableAngka(columnIndex) {
  //   var table, rows, switching, i, x, y, shouldSwitch;
  //   table = document.getElementById("myTable");
  //   switching = true;

  //   var sortIcon = sortIcons[columnIndex];
  //   sortIcon.classList.remove("asc", "desc");

  //   if (sortDirections[columnIndex] === "asc") {
  //     sortIcon.classList.add("asc");
  //     sortDirections[columnIndex] = "desc";
  //   } else {
  //     sortIcon.classList.add("desc");
  //     sortDirections[columnIndex] = "asc";
  //   }

  //   while (switching) {
  //     switching = false;
  //     rows = table.rows;

  //     for (i = 1; i < rows.length - 1; i++) {
  //       shouldSwitch = false;
  //       x = parseInt(rows[i].getElementsByTagName("td")[columnIndex].innerHTML);
  //       y = parseInt(rows[i + 1].getElementsByTagName("td")[columnIndex].innerHTML);

  //       if (sortDirections[columnIndex] === "asc") {
  //         if (x > y) {
  //           shouldSwitch = true;
  //           break;
  //         }
  //       } else {
  //         if (x < y) {
  //           shouldSwitch = true;
  //           break;
  //         }
  //       }
  //     }

  //     if (shouldSwitch) {
  //       rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
  //       switching = true;
  //     }
  //   }
  // }


  // function sortTable(columnIndex) {
  //   var table, rows, switching, i, x, y, shouldSwitch;
  //   table = document.getElementById("myTable");
  //   switching = true;

  //   var sortIcon = sortIcons[columnIndex];
  //   sortIcon.classList.remove("asc", "desc");

  //   if (sortDirections[columnIndex] === "asc") {
  //     sortIcon.classList.add("asc");
  //     sortDirections[columnIndex] = "desc";
  //   } else {
  //     sortIcon.classList.add("desc");
  //     sortDirections[columnIndex] = "asc";
  //   }

  //   while (switching) {
  //     switching = false;
  //     rows = table.rows;

  //     for (i = 1; i < rows.length - 1; i++) {
  //       shouldSwitch = false;
  //       x = rows[i].getElementsByTagName("td")[columnIndex].innerHTML;
  //       y = rows[i + 1].getElementsByTagName("td")[columnIndex].innerHTML;

  //       if (sortDirections[columnIndex] === "asc") {
  //         if (x > y) {
  //           shouldSwitch = true;
  //           break;
  //         }
  //       } else {
  //         if (x < y) {
  //           shouldSwitch = true;
  //           break;
  //         }
  //       }
  //     }

  //     if (shouldSwitch) {
  //       rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
  //       switching = true;
  //     }
  //   }
  // }

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

  /* .asc {
    transform: rotate(180deg);
  }

  .desc {
    transform: rotate(0);
  } */
  /* Untuk Modal Hide Show */
  .check {
    height: 200px;
    overflow-y: auto;
    z-index: 999;
  }
  .btn-custom { 
  color: #ffffff; 
  background-color: #ffffff; 
  border-color: #ffffff; 
} 
/* Akhir Modal Hide Show */

</style>

<!-- Script Untuk Sticky Ke td ke 1,2 dan td yang terakhir -->
<script>  
// Function to freeze the first and last cells of each row
function freezeTable() {
  var table = document.getElementById('myTable');
  var rows = table.rows;

  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].cells;

    if (cells.length > 2) {
      cells[0].style.position = 'sticky';
      cells[0].style.left = '0';
      cells[0].style.background = 'white'; // Add white background color
      cells[0].style.borderTop = '1px solid #e2e7eb'; // Add top border
      cells[0].style.borderBottom = '1px solid #e2e7eb'; // Add bottom border

      cells[1].style.position = 'sticky';
      cells[1].style.left = '54px'; // Adjust the value as needed
      cells[1].style.background = 'white'; // Add white background color
      cells[1].style.borderTop = '1px solid #e2e7eb'; // Add top border
      cells[1].style.borderBottom = '1px solid #e2e7eb'; // Add bottom border

      cells[cells.length - 1].style.position = 'sticky';
      cells[cells.length - 1].style.right = '0';
      cells[cells.length - 1].style.background = 'white'; // Add white background color
      cells[cells.length - 1].style.borderTop = '1px solid #BFBFBF'; // Add top border
      cells[cells.length - 1].style.borderBottom = '1px solid #BFBFBF'; // Add bottom border
    }
  }
}

// Call the freezeTable function when the document is ready
document.addEventListener('DOMContentLoaded', function() {
  freezeTable();
});
</script>


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


    // <!-- script buat filter multipel -->
  
    // Define table names and their corresponding data
    // var tables = {
    //   "level_jabatans": {
    //     "nama": ["Data 1-1", "Data 1-2", "Data 1-3"],
    //     "kode": ["Data 2-1", "Data 2-2", "Data 2-3"],
    //     "status": ["Data 3-1", "Data 3-2", "Data 3-3"]
    //   },
    //   // Add more tables here if needed
    // };
  
    // // Get the table dropdown menu element
    // var tableDropdown = document.getElementById("table-dropdown");
  
    // // Create the table filter dropdown
    // var tableFilter = document.createElement("select");
    // tableFilter.classList.add("dropdown-item", "dropdown-toggle");
    // tableFilter.setAttribute("data-toggle", "dropdown");
    // tableFilter.innerHTML = "Filter by Table";
    // tableDropdown.appendChild(tableFilter);
  
    // // Create a submenu for each table
    // Object.keys(tables).forEach(function(tableName) {
    //   var tableItem = document.createElement("a");
    //   tableItem.classList.add("dropdown-item", "dropdown-toggle");
    //   tableItem.href = "#";
    //   tableItem.setAttribute("role", "button");
    //   tableItem.setAttribute("data-toggle", "dropdown");
    //   tableItem.innerHTML = tableName;
    //   tableDropdown.appendChild(tableItem);
  
    //   var submenu = document.createElement("div");
    //   submenu.classList.add("dropdown-menu");
  
    //   // Create a submenu item for each column in the table
    //   Object.keys(tables[tableName]).forEach(function(columnName) {
    //     var columnItem = document.createElement("a");
    //     columnItem.classList.add("dropdown-item");
    //     columnItem.href = "#";
    //     columnItem.innerHTML = columnName;
    //     columnItem.addEventListener("click", function() {
    //       displayTableData(tableName, columnName);
    //     });
    //     submenu.appendChild(columnItem);
    //   });
  
    //   tableItem.appendChild(submenu);
    // });
  
    // Function to display table data
    // function displayTableData(tableName, columnName) {
    //   var data = tables[tableName][columnName];
  
    //   // Clear previous data
    //   var tableDataElement = document.getElementById("table-data");
    //   tableDataElement.innerHTML = "";
  
    //   // Create new data elements
    //   data.forEach(function(item) {
    //     var dataItem = document.createElement("div");
    //     dataItem.classList.add("dropdown-item");
    //     dataItem.innerHTML = item;
    //     tableDataElement.appendChild(dataItem);
    //   });
    // }
  
  // <!-- akhir dari multipel -->

  
  
  // <!-- ini buat according myinfo -->
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
$(document).ready(function(){
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        
        // Menemukan semua baris dalam tabel
        var rows = $('#myTable tbody tr');
        
        rows.each(function() {
            var employeeName = $(this).find('.nama').text().toLowerCase();
            // Memeriksa apakah nama pegawai cocok dengan nilai pencarian
            if (employeeName.includes(value)) {
                $(this).show(); // Menampilkan baris jika cocok
            } else {
                $(this).hide(); // Menyembunyikan baris jika tidak cocok
            }
        });
    });
});



</script>

<script>
    // Script untuk mengambil ID dari datalist saat pengguna memilih opsi
    document.addEventListener("DOMContentLoaded", function() {
        const dataListCabang = document.getElementById('list-cabang');
        const dataListJabatan = document.getElementById('list-jabatan');

        const inputCabang = document.querySelector('input[name="cabang[]"]');
        const inputJabatan = document.querySelector('input[name="jabatan[]"]');

        inputCabang.addEventListener('input', function(e) {
            const selectedOption = Array.from(dataListCabang.options).find(option => option.value === e.target.value);
            if (selectedOption) {
                const cabangIdInput = document.querySelector('input[name="cabang_id[]"]');
                cabangIdInput.value = selectedOption.dataset.value;
            }
        });

        inputJabatan.addEventListener('input', function(e) {
            const selectedOption = Array.from(dataListJabatan.options).find(option => option.value === e.target.value);
            if (selectedOption) {
                const jabatanIdInput = document.querySelector('input[name="jabatan_id[]"]');
                jabatanIdInput.value = selectedOption.dataset.value;
            }
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
      // Tambahkan event listener pada tombol "Apply"
      $('.dropdown-item').on('click', filterTable);

      function filterTable() {
        // Dapatkan nilai checkbox untuk cabang
        const selectedCabangs = [];
        $('.cabangCheckbox:checked').each(function() {
          selectedCabangs.push($(this).val());
        });

        // Dapatkan nilai checkbox untuk bagian
        const selectedBagians = [];
        $('.tableCheckbox:checked').each(function() {
          selectedBagians.push($(this).val());
        });

        // Dapatkan semua baris data
        const rows = $('#myTable tbody tr');

        // Loop melalui setiap baris data
        rows.each(function() {
          const row = $(this);
          const cabang = row.find('.cabang').text();
          const bagian = row.find('.bagian').text();

          // Reset tampilan baris data
          row.show();

          // Lakukan filtering berdasarkan nilai checkbox
          if (selectedCabangs.length > 0 && !selectedCabangs.includes(cabang)) {
            row.hide();
          } else if (selectedBagians.length > 0 && !selectedBagians.includes(bagian)) {
            row.hide();
          }
        });
      }
    });

    $(document).ready(function() {
  $(".dropdown-menu").scroll(function() {
    var dropdownHeight = $(".dropdown-menu").height();
    var menuHeight = $(".dropdown-menu .dropdown-menu-checkbox").height();
    var footerHeight = $(".dropdown-footer").height();
    var scrollTop = $(".dropdown-menu").scrollTop();

    if (menuHeight > dropdownHeight - footerHeight) {
      if (scrollTop + dropdownHeight >= menuHeight + footerHeight) {
        $(".dropdown-footer").addClass("fixed-footer");
      } else {
        $(".dropdown-footer").removeClass("fixed-footer");
      }
    } else {
      $(".dropdown-footer").removeClass("fixed-footer");
    }
  });
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

.pagination {
  display: inline-block;
  margin-top: 10px;
}

.pagination a {
  color: #000000;
  background-color: #ffffff;
  border: 1px solid #6c757d;
  padding: 5px 12px;
  text-decoration: none;
  margin: 0 0px;
  border-radius: 5px;
}

.pagination a.active {
  background-color: #348ee3;
  border-color: #348ee3;
  color: #000000;
}

.pagination a:hover:not(.active) {
  background-color: #00897b;
  color: #333;
}

.show-entries-container {
  margin-top: 10px;
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

.dropdown-menu {
  max-height: 200px;
  overflow-y: auto;
}

.dropdown .dropdown-menu {
  overflow-y: auto;
  max-height: 230px; /* Atur tinggi maksimum yang sesuai */
}

.dropdown-footer {
  position: sticky;
  bottom: -8px;
  background-color: #6c757d;
  padding: 0px;
  text-align: center;
}


/* .container.headtext {
  min-width: 1351px;
  background-color: #f1f5f9;
  background-size: auto;
  margin-left: -3%;
  padding: 10px 39px 10px 61px;
} */

/* .custombtn{
  float: right;
  border: 1px #000 solid;
} */


.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}




</style>



<!-- Add Font Awesome library -->
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>



