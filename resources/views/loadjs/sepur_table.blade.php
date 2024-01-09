
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
// Untuk Sort Table dari a ke z dan dari z ke a
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
/* 
  .asc {
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
      cells[0].style.background = 'white'; // Add red background color

      cells[1].style.position = 'sticky';
      cells[1].style.left = '54px'; // Adjust the value as needed
      cells[1].style.background = 'white'; // Add red background color

      cells[cells.length - 1].style.position = 'sticky';
      cells[cells.length - 1].style.right = '0';
      cells[cells.length - 1].style.background = 'white'; // Add red background color
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

  
</script>
<style>

.pagination {
  display: inline-block;
  margin-top: 10px;
}

.pagination a {
  color: #fff;
  background-color: #4dd0e1;
  border: 1px solid #4dd0e1;
  padding: 2px 4px;
  text-decoration: none;
  margin: 0 4px;
  border-radius: 4px;
}

.pagination a.active {
  background-color: #1b5e20;
  border-color: #1b5e20;
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

</style>




<!-- Multi Filter -->
<!-- Filter Checkbox -->

<script>
var expanded = True;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>
<style>
.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>
<!-- AKhir Filter Checkbox -->