<div class="border-body">
  <div class="row">
      <div class="col-md-9 justify-content-start">
          {{-- <button class="btn btn-sm btn-add" onclick="create()"><a  class="text-decoration-none text-light" >Create Change Shift</a></button> --}}
      </div>
      <div class="col-md-3 d-flex justify-content-end">
          <div class="form-group has-search">
              <span class="fa fa-search form-control-feedback"></span>
              <input type="text" class="form-control" placeholder="Search" id="search" name="search">
          </div>
      </div>
  </div>
  <div class="table-responsive">
    <table class="table data-table" id="myTable">
      <thead class="table-head">
        <tr class="judul">
          <th scope="col">No</th>
          <th scope="col">Nik</th>
          <th scope="col">Employee Name</th>
          <th scope="col">Date</th>
          <th scope="col">Shift</th>
        </tr>
      </thead>
      <tbody>            
        @forelse ($data as $sh)
          <tr class="isi">
            <td class="nomor">{{ $loop->iteration }}.</td>
            <td class="nama">{{ $sh->nomor_induk_karyawan}}</td>
            <td class="nama">{{ $sh->nama_lengkap}}</td>
            <td class="nama">{{ $sh->tanggal}}</td>
            <td class="nama">{{ $sh->jenis_shift}}</td>
          </tr>
        @empty
          <tr class="alert alert-danger">
            <td colspan="8" class="alert alert-danger text-center">Data not yet available.</td>
          </tr>
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





<!-- Modal -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="changeshift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" onClick="Close()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="pagechange" class="p-2"></div>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal Untuk (Detail Transfer, Create Transfer)-->
