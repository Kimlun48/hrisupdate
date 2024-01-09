<!-- <script>
$(document).ready(function(){
  $('#search').on('keyup', function(){
    $value=$(this).val();
    $.ajax({
      type : 'get',
      url : '{{URL::to('employ')}}',
      data:{'search':$value},
      success:function(data){
        $('#employ').html(data);
      }
    });
  })
});

$(document).ready(function() {
  $('#search').on('keyup', function() {
    $value=$(this).val();
    $.ajax({
      type : 'get',
      url : "/employ",
      data:{'search':$value},
      success:function(response) {
        $('#employ-list').empty();
        var number = 1;
        $.each(response.data, function(index, employ){
            $('#employ-list').append(
            '<tr class="isi">' +
              '<td>' + number + '</td>' +
              '<td>' + employ.nomor_induk_karyawan + '</td>' +
              '<td>' + employ.nama_lengkap + '</td>' +
              '<td>' + employ.no_identitas + '</td>' +
              '<td>' + employ.cabang.nama + '</td>' +
              '<td>' + employ.jabatan.nama + '</td>' +
              '<td>' + employ.jenis_karyawan + '</td>' +
              '<td>' + employ.masa_kerja + '</td>' +
              '<td class="btn-action">' +
                "<button class='btn btn-sm btn-info me-1' onClick='showdetail("+ employ.id +")'><i class='fas fa-eye' style='color:#fff;'></i></button>" +
                '<div class="btn-group">' +
                '<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">More</button>' +
                '<div class="dropdown-menu">' +
                  "<div class='ms-2'>" +
                    '<h6 class="dropdown-header">Action</h6>' +
                    "<button class='btn btn-sm btn-danger mb-2' onClick='show("+ employ.id+")'><i class='fas fa-id-card'></i></button> PHK" +
                    '<br>' +
                    "<button class='btn btn-sm btn-success mb-2' onClick='showedit("+ employ.id+")'><i class='fas fa-edit'></i></button> Edit Karyawan" +
                    '<br>' +
                    "<button class='btn btn-sm btn-primary mb-2' onClick='showtransfer("+ employ.id+")'><i class='fas fa-exchange-alt'></i></button> Transfer" +
                    '<br>' +
                    "<button class='btn btn-sm btn-warning mb-2' onClick='showsp("+ employ.id+")'><i class='fas fa-exclamation-triangle'></i></button> SP" +
                    '<br>' +
                  '</div>' +
                  '<div class="dropdown-divider"></div>' +
                    '<div class="ms-auto">' +
                      '<h6 class="dropdown-header">Document</h6>' +
                      '<a href="/employ/kontrak/{{$employ->id}}" target="_blank" class="btn btn-sm btn-info" style="width: 60px"title="SPHK Download">Kontrak</a>' + 
                      '<a href="/employ/pkwt/{{$employ->id}}" target="_blank" class="btn btn-sm btn-info" style="width: 60px"title="PKWT Download">PKWT</a>' +
                      '<a href="/employ/sp/{{$employ->id}}" target="_blank" class="btn btn-sm btn-info" style="width: 60px"title="SP Download">SP</a>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</td>' +
            '</tr>' +
            number++
            )
        });
        
        // $("#pagination-links").html(data.pagination_links);
        $('#pagination_links').twbsPagination({
          totalPages: data.last_page,
          visiblePages: 10,
          onPageClick: function(event, page) {
            $.ajax({
              url: '/employ',
              type: 'GET',
              data: { page: page, search: $('input[name=search]').val() },
              success: function(data) {
                // Display search results for selected page
                $('#semploy-list').html(data);
              }
            });
          }
        });
      },
      error: function(xhr) {
        $('#errorEmploy').show();
        var errorMessage = 'An error occurred: ' + xhr.status + ' ' + xhr.statusText;
        $('#errorEmploy').text(errorMessage);
      }

    });
  })

});



</script>
 -->
