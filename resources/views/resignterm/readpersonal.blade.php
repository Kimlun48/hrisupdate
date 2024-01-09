<div class="border-body">
    <div class="row">
        <div class="col-md-9 justify-content-start">
            <button class="btn btn-sm btn-add" onClick="create()"><a  class="text-decoration-none text-light" >Add Request</a></button>
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
                <th scope="col">No Induk Karyawan</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Tanggal terakhir</th>
                <th scope="col">Reason</th>
                <th scope="col">Dokumen</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data as $tm)
                <tr class="isi">
                    <td class="nomor">{{ $loop->iteration }}.</td>
                    <td>{{ $tm->karyawan->nomor_induk_karyawan}}</td>
                    <td>{{ $tm->karyawan->nama_lengkap}}</td>
                    <td>{{ $tm->tanggal_pengajuan}}</td>
                    <td>{{ $tm->tanggal_akhirkerja}}</td>
                    <td>{{ $tm->notes}}</td>
                    <td>
                        <a href="/storage/resign/{{$tm->dokumen}}" target="_blank" class="btn btn-sm btn-info" style="width: 40px"title="Download">
                        <i class="fas fa-download" style="color:#fff; "></i></a>
                    </td>
                </tr>
            @endforeach
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
