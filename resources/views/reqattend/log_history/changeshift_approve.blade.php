<div class="border-body">
    <div class="col-md-3 clm-search" >
       <div class="form-group has-search">
             <span class="fa fa-search form-control-feedback"></span>
             <input type="text" class="form-control" placeholder="Search" id="search" name="search">
       </div>
    </div>
    <div class="table-responsive">
       <table class="table data-table" id="myTable">
          <thead class="table-head">
             <tr class="judul">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">When</th>
                <th scope="col">First Shift</th>
                <th scope="col">To</th>
                <th scope="col">Second Shift</th>
                <th scope="col">Status Request</th>
                <th scope="col">Reason</th>
             </tr>
          </thead>
          <tbody>
             @forelse ($data as $sh)
             <tr class="isi">
                <td class="nomor">{{ $loop->iteration }}.</td>
                <td class="nama">{{ $sh->nama_lengkap }}</td>
                <td class="nama">{{ $sh->tanggal_awal}}</td>
                <td class="nama">{{ $sh->shift_awal}}</td>
                <td class="nama">{{ $sh->tanggal_akhir}}</td>
                <td class="nama">{{ $sh->shift_akhir}}</td>
                <td class="nama">{{ $sh->status_approve}}</td>
                <td class="nama">{{ $sh->keterangan}}</td>
             </tr>
             @empty
                <tr>
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