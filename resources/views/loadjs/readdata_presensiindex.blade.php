<script>
    function freezeTable() {
  var table = document.getElementById('myTable');
  var rows = table.rows;

  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].cells;

    if (cells.length > 2) {
      cells[0].style.position = 'sticky';
      cells[0].classList.add('testing1');
      cells[0].style.left = '0';
      cells[0].style.background = 'white'; // Add white background color
      // cells[0].style.borderTop = '1px solid #e2e7eb'; // Add top border
      // cells[0].style.borderBottom = '1px solid #e2e7eb'; // Add bottom border

      // cells[1].style.position = 'sticky';
      // cells[1].classList.add('testing2');
      // cells[1].style.left = '43px'; // Adjust the value as needed
      // cells[1].style.background = 'white'; // Add white background color
      // cells[1].style.borderTop = '1px solid #e2e7eb'; // Add top border
      // cells[1].style.borderBottom = '1px solid #e2e7eb'; // Add bottom border

      cells[cells.length - 1].style.position = 'sticky';
      cells[cells.length - 1].classList.add('desk');
      cells[cells.length - 1].style.right = '-21px';
      cells[cells.length - 1].style.background = 'white'; // Add white background color
      // cells[cells.length - 1].style.borderTop = '1px solid #BFBFBF'; // Add top border
      // cells[cells.length - 1].style.borderBottom = '1px solid #BFBFBF'; // Add bottom border
    }
  }
}

// Call the freezeTable function when the document is ready
document.addEventListener('DOMContentLoaded', function() {
  freezeTable();
});
</script>