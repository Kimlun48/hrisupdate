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


