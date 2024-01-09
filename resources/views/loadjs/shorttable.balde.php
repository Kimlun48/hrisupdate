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