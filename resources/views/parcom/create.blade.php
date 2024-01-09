<div class="modal-body">
        <form id="createForm">
          <div class="form-group">
              <label for="nama">Nama Tunjangan</label>
              <input type="text" class="form-control" id="nama" name="nama">
          </div>

          <div class="form-group">
            <label for="jenis">Jenis</label>
            <select class="form-control"  name="jenis">
            <option selected disabled>---Pilih---</option>
            <option value="Penambah">Penambah</option>
            <option value="Pengurang">Pengurang</option>
        </select>
          </div>
          <div class="form-group">
            <label for="status_tunjangan">Status Tunjangan</label>
            <select class="form-control"  name="status_tunjangan">
            <option selected disabled>---Pilih---</option>
            <option value="Sementara">Sementara</option>
            <option value="Tunjangan Tetap">Tunjangan Tetap</option>
        </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="createparam()">Save</button>
      </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.all.min.js" integrity="sha512-LXVbtSLdKM9Rpog8WtfAbD3Wks1NSDE7tMwOW3XbQTPQnaTrpIot0rzzekOslA1DVbXSVzS7c/lWZHRGkn3Xpg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function()
{
    $('#nama').keyup(function()
    {
        $(this).val($(this).val().toUpperCase());
    });
});


    //Cek Data Jika Ada
    $('#nama').on('change', function() {
    var nama = $(this).val();
    $.ajax({
        url: '/parcom/cekinputparcom',
        method: 'get',
        data: {nama: nama},
        success: function(data) {
          if(data.message){
            Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Yes',
                    // timer: 1500
                });
            $('input[type="text"],textarea').val('');
        }
        },
        error: function(xhr) {
          var data = JSON.parse(xhr.responseText);
          var message = data.message;
          Swal.fire({
              icon: 'error',
              title: message,
              showDenyButton: false,
              showCancelButton: false,
              confirmButtonText: 'Yes',
              // timer: 1500
          });
          $('input[type="text"],textarea').val('');
        }
    });
});
</script>
