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
                    <th scope="col" >Overtime date</th>
                    <th scope="col" >Employee ID</th>
                    <th scope="col" >Employee</th>
                    <th scope="col" >Compensation</th>
                    <th scope="col" >Start</th>
                    <th scope="col" >End</th>
                    <th scope="col" >Duration</th>
                    <th scope="col" >Status</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($data as $ot)
                    
                <tr class="isi">
                    <td class="nomor">{{ $ot->tanggal_overtime }}</td>
                    <td class="nomor">{{$ot->getkar->nomor_induk_karyawan}}</td>
                    <td class="name" >{{$ot->getkar->nama_lengkap}}</td>
                    <td class="name">{{ $ot->kompensasi }}</td>
                    <td class="name">{{ $ot->mulai }}</td>
                    <td class="name">{{ $ot->akhir }}</td>
                    <td class="name">{{ $ot->durasi }}</td>
                    <td class="name">{{ $ot->status_approve}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="alert alert-danger text-center">Data not yet available.</td>
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