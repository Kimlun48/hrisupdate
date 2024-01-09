<script>
$(document).ready(function() {
  $('#searchs').on('keyup', function() {
    $value=$(this).val();
    $.ajax({
      type : 'get',
      url : "/search-employ",
      data:{'search':$value},
      success:function(response) {
        $('#employ-list').empty();
        $('#employ-list').html(response.data);
        $('#pagination_links').html(response.pagination);
      },
      error: function(xhr) {
        $('#errorEmploy').show();
        var errorMessage = 'An error occurred: ' + xhr.status + ' ' + xhr.statusText;
        $('#errorEmploy').text(errorMessage);
      }
    });
  });
});
</script>

