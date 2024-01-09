
<div id=sub>
    <table class="table data-table table-striped">
    <thead>
        <tr class="judul">
        <th scope="col">No</th>
        <th scope="col">Number of employees</th>
        <th scope="col">Name</th>
        <th scope="col">Position</th>
        <th scope="col">Expired Kontrak</th>
        <th scope="col">Actions</th>
        </tr>
      </thead>
        <tbody id="">
        @forelse($subordinate as $index => $det)
        <tr class="isi">
        <td class="nomor custom-td">{{ $subordinate->firstItem() + $index }}.</td>
        <td class="nik custom-td">{{ $det->nomor_induk_karyawan }}</td>
        <td class="nik custom-td">{{ $det->nama_lengkap }}</td>
        <td class="posisi custom-td">{{ $det->jabatan->nama }}</td>
        <td class="posisi custom-td">{{ $det->expired_kontrak }}</td>
        <td class="btn-action custom-td">
          <a href="/resignterm/qpi/{{$det->id}}" target="_blank" class="btn btn-sm btn-info mb-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="QPI Download">
            QPI
            <i class="fas fa-download" style="color:#fff;"></i>
          </a>
          <button class="btn btn-sm btn-warning mb-2" onClick="showsp({{$det->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="SP">
            <i class="fas fa-exclamation-triangle"></i>
          </button>
        </td>
        </tr>
        @empty
        <tr class="text-center"> <td colspan="6"> No Data </td> </tr>
        @endforelse
        </tbody>
    </table>
    <!--End Table-->
    <div class="pagination-links">
    {!! $subordinate->links() !!}
    </div>
</div>            


<script>
    var isLoaded = true;

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        if (!isLoaded) return; // prevent multiple clicks while the data is still loading
        isLoaded = false;
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'get',
            success: function (data) {
                $('#sub').html(data);
                isLoaded = true;
            },
            error: function () {
                isLoaded = true;
            }
        });
    });
</script>

  <!-- Modal SP -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="modal fade" id="ModalSP" tabindex="-1" role="dialog" aria-labelledby="ModalSPLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalSPLabel"></h5>
          <button type="button" class="close" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="pagesp" class="p-2"></div>
        </div>
      </div>
    </div>
  </div>


