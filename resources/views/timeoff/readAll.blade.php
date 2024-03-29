<div class="border-body">
    <div class="col-md-12 d-flex justify-content-end align-items-center">
        <div class="form-group has-search" style="margin-top: -35px;">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control" placeholder="Search" id="search" name="search">
        </div>
    </div>
    <div class="table-responsive">
        <table id="myTable" class="table data-table text-uppercase table-sort" id="myTable">
            <thead class="table-head">
                <tr class="judul">
                    <th scope="col">No</th>
                    <th scope="col">No Induk Karyawan</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Status Off</th>
                    <th scope="col">Document</th>
                    <th scope="col">Status Approve</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($data as $tm)
                <tr class="isi">
                <td class="nomor">{{ $loop->iteration }}.</td>
                <td>{{ $tm->nomor_induk_karyawan }}</td>
                <td>{{ $tm->nama_lengkap }}</td>
                <td>{{ $tm->tanggal }}</td>
                <td>{{ $tm->statusoff }}</td>
                <td>
                <img src="/storage/berkastimeoff/{{$tm->dokumen}}" class="css-class" alt="alt text" width="50" hight="60">
                <a href="/storage/berkastimeoff/{{$tm->dokumen}}" download="{{$tm->dokumen}}">            
                <i class="fas fa-download"></i></p></a>   
                </td>
                <td>{{ $tm->status_approve }}</td>    
                    
                    <td>
                        <button class="btn btn-sm btn-success " onClick="show({{$tm->id}})">
                            <i class="fas fa-calendar-check"></i></button>
                        <button class="btn btn-sm btn-danger btn-reject" onClick="showreject({{$tm->id}})">
                            <i class="fas fa-window-close"></i></button>              
                    </td>
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

@include('loadjs.searchtable')
@include('loadjs.pagination')

