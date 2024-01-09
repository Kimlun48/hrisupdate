<div class="border-body">
  <div class="row">
    <div class="col-md-9 justify-content-start">
      <button class="btn btn-sm btn-add" onclick="showtransfer()"><a  class="text-decoration-none text-light" >Create Transfer</a></button>
    </div>
    <div class="col-md-3 d-flex justify-content-end">
      <div class="form-group has-search">
        <span class="fa fa-search form-control-feedback"></span>
        <input type="text" class="form-control" placeholder="Search" id="search" name="search">
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table data-table table-sort" id="myTable">
        <thead class="table-head">
            <tr class="judul">
            <th scope="col" onclick="sortTable(1)">Employee</th>
            <th scope="col" onclick="sortTable(2)">Employee ID</th>
            <th scope="col" onclick="sortTable(3)">Transfer Type</th>
            <th scope="col" onclick="sortTable(5)">Effective Date</th>
            <th scope="col" class="status" onclick="sortTable(6)">Status</th>
            <th scope="col" class="action" onclick="sortTable(7)" colspan="2">action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr class="isi">
                <td class="name">{{ $item->getkaryawan->nama_lengkap }}</td>
                <td class="name">{{ $item->getkaryawan->nomor_induk_karyawan }}</td>
                <td class="name">{{ $item->type }}</td>
                <td class="name">{{ $item->tanggal }}</td>
                <td class="status">
                  <div class="bg_status" data-status="{{ $item->status_approval }}">
                    {{ $item->status_approval }}
                  </div>
                </td>
                <td class="actions">
                  <div class="bg-detail" onclick="showmodaldetail({{ $item->id}})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                      <path opacity="0.5" d="M2.16602 13.1044C2.16602 14.8804 2.62639 15.4785 3.54715 16.6748C5.38564 19.0632 8.46897 21.7711 12.9993 21.7711C17.5297 21.7711 20.613 19.0632 22.4515 16.6748C23.3723 15.4785 23.8327 14.8804 23.8327 13.1044C23.8327 11.3284 23.3723 10.7303 22.4515 9.5341C20.613 7.1456 17.5297 4.43774 12.9993 4.43774C8.46897 4.43774 5.38564 7.1456 3.54715 9.5341C2.62639 10.7303 2.16602 11.3284 2.16602 13.1044Z" fill="#4A62B4"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.9375 13.1044C8.9375 10.8607 10.7563 9.0419 13 9.0419C15.2437 9.0419 17.0625 10.8607 17.0625 13.1044C17.0625 15.3481 15.2437 17.1669 13 17.1669C10.7563 17.1669 8.9375 15.3481 8.9375 13.1044ZM10.5625 13.1044C10.5625 11.7583 11.6538 10.6669 13 10.6669C14.3461 10.6669 15.4375 11.7583 15.4375 13.1044C15.4375 14.4506 14.3461 15.5419 13 15.5419C11.6538 15.5419 10.5625 14.4506 10.5625 13.1044Z" fill="white"/>
                    </svg>
                  </div>
                  <div class="btn btn-sm btn-cancel mb-2" onclick="canceltransfer({{ $item->id}})">Cancel</div>
                </td>
            </tr>
            @empty
                <div class="alert alert-danger">Data belum Tersedia.</div>
            @endforelse
        </tbody>
    </table>
  </div>
</div>

<div class="row mb-3 mt-3">
    <div class="col-md-6 d-flex justify-content-start">
        <label for="showEntries" class="">Showing</label>
        <select id="showEntries" class="show-entries form-control form-control-sm">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
        </select>
        <div id="dataCount"></div>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <div class="pagination" id="pagination">
            <a href="javascript:void(0)" id="prevPage">Previous</a>
            <a href="javascript:void(0)" id="nextPage">Next</a>
        </div>
    </div>
</div>

@include('loadjs.pagination')
@include('loadjs.searchtable')


<!-- Modal Untuk (Detail Transfer, Create Transfer)-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="ModalTrans" tabindex="-1" role="dialog" aria-labelledby="ModalTransLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
	      <h5 class="modal-title" id="ModalTransLabel"></h5>
        <button type="button" class="close" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="page" class="p-2"></div>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal Untuk (Detail Transfer, Create Transfer)-->
