<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


<script>
var toggleBtns = document.querySelectorAll('.tombol');
for (var i = 0; i < toggleBtns.length; i++) {
  toggleBtns[i].addEventListener('click', function() {
    // get parent row
    var parentRow = this.closest('tr');
    // check if child-row element already exists
    var childRow = parentRow.nextSibling;
    if (childRow && childRow.classList.contains('child-row')) {
      // if it does, remove it and remove the 'active' class from the parent row
      parentRow.parentNode.removeChild(childRow);
      parentRow.classList.remove('active');
      // change button icon
      this.innerHTML = '<i class="fas fa-plus"></i>';
    } else {
      // if it doesn't exist, create the child-row element and add it to the DOM
      childRow = document.createElement('tr');
      var childCell = document.createElement('td');
      childCell.colSpan = 20;
      childCell.innerHTML = 
        '<table class="child">'+
          '<tr class="judul">'+
            '<td class="cabangs2">Branch</td>'+
            '<td class="posisis2">Position</td>'+
            '<td class="tahuns2">Years of service</td>'+
          '</tr>'+
          '<tr class="isi">'+
            '<td class="cabang2">'+ parentRow.cells[5].innerText +'</td>'+
            '<td class="posisi2">'+ parentRow.cells[6].innerText +'</td>'+
            '<td class="tahun2">'+ parentRow.cells[7].innerText +'</td>'+
          '</tr>'+
        '</table>';
      childRow.appendChild(childCell);
      childRow.classList.add('child-row');
      parentRow.parentNode.insertBefore(childRow, parentRow.nextSibling);
      parentRow.classList.add('active');
      // change button icon
      this.innerHTML = '<i class="fas fa-minus"></i>';
    }
  });
}

	</script>