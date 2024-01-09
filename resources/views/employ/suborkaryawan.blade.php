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
                <tbody id="employ-list">
                @forelse($subordinate as $index => $det)
                <tr class="isi">
                  <td class="nomor">{{ $subordinate->firstItem() + $index }}.</td>
                  <td class="nik">{{ $det->nomor_induk_karyawan }}</td>
                  <td class="name">{{ $det->nama_lengkap }}</td>
                  <td class="posisi">{{ $det->jabatan->nama }}</td>
                  <td class="expired_kontrak">{{ $det->expired_kontrak }}</td>
                  <td class="btn-action">
                    <a href="/resignterm/qpi/{{$det->id}}" target="_blank" class="btn btn-sm btn-info mb-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="QPI Download"> QPI
                    <i class="fas fa-download" style="color:#fff; "></i></a>
                    <button class="btn btn-sm btn-warning mb-2" onClick="showsp({{$det->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="SP">
                    <i class="fas fa-exclamation-triangle"></i></i></button>
                  </td>
                </tr>
                @empty
                <tr class="text-center"> <td colspan="6"> No Data </td> </tr>
                @endforelse
                </tbody>
            </table>
          <!--End Table-->
          <div class="d-flex">
            {{ $subordinate->links() }}
          </div>
          <div class="mb-2">
            Showing
            {{$subordinate->firstItem()}}
            to
            {{$subordinate->lastItem()}}
            of
            {{$subordinate->total()}}
            entries
          </div>
       </div>            
     </div>

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

