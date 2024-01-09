
<script>
  
function CloseExternal() {
    $("#labeldetailexternal").modal("hide");
    $("#detailexternal").modal("hide");
    $("#modalDetailExternal").modal("hide");
}

// modal external show
function showexternal(id) {
  console.log('ini show akuu');
    $.get("{{ url('/employ/detail/') }}/"+id,{}, 
    function(data,status){
        $("#labeldetailexternal").html('Detail karyawan');
        $("#detailexternal").html(data);
        $("#modalDetailExternal").modal('show');
    });
}
</script>

<script>
$(document).on('click', '.tombol', function() {
  var parentRow = $(this).closest('tr');
  var childRow = parentRow.next('.child-row');

  if (childRow.length && childRow.hasClass('child-row')) {
    childRow.remove();
    parentRow.removeClass('active');
    $(this).html('<i class="fas fa-plus"></i>');
  } else {
    childRow = $('<tr>').addClass('child-row');
    var childCell = $('<td>').attr('colspan', '20').html(
      '<table class="child">' +
      '<tr class="judul">' +
      '<td class="cabangs2">Branch</td>' +
      '<td class="posisis2">Position</td>' +
      '<td class="tahuns2">Years of service</td>' +
      '</tr>' +
      '<tr class="isi">' +
      '<td class="cabang2">' + parentRow.find('.cabang').text() + '</td>' +
      '<td class="posisi2">' + parentRow.find('.posisi').text() + '</td>' +
      '<td class="tahun2">' + parentRow.find('.tahun').text() + '</td>' +
      '</tr>' +
      '</table>'
    );
    childRow.append(childCell);
    parentRow.after(childRow);
    parentRow.addClass('active');
    $(this).html('<i class="fas fa-minus"></i>');
  }
});
</script>
