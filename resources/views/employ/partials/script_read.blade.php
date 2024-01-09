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



</script>


{{-- <script>
  // Menghitung jumlah checkbox yang dipilih dan menampilkan pada tombol
  function updateSelectedCount() {
    console.log('updateSelectedCount dipanggil');

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
  document.getElementById('exportForm').addEventListener('submit', function(event) {
    alert('Formulir dikirim');

    var employStatusSelected = document.getElementById('employStatusSelectedText').textContent;
    var branchSelected = document.getElementById('branchSelectedText').textContent;
    var organizationSelected = document.getElementById('organizationSelectedText').textContent;

    if (employStatusSelected === 'Select Employment status' || branchSelected === 'Select Branch' || organizationSelected === 'Select Organization') {
      event.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please fill in all the fields!',
      });
    }
  });
</script> --}}


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

