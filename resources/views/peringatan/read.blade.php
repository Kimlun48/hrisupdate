<div class="border-body">
    <div class="table-responsive">

        <table class="table data-table " id="myTable">
            <thead class="table-head">
                <tr class="judul">
                    <th class="no" scope="col">No</th>
                    <th class="id" scope="col">Employees ID</th>
                    <th class="name" scope="col">Name</th>
                    <th class="date" scope="col">Date Of Filling</th>
                    <th class="type" scope="col">Type</th>
                    <th class="chapter" scope="col">Chapter</th>
                    <th class="actions" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($data as $tm)
                <tr class="isi">
                    <td class="no">{{ $loop->iteration }}.</td>
                    <td class="id">{{ $tm->karyawan->nomor_induk_karyawan }}</td>
                    <td class="name">{{ $tm->karyawan->nama_lengkap }}</td>
                    <td class="date">{{ $tm->created_at}}</td>
                    <td class="type">{{ $tm->jenis_peringatan }}</td>
                    <td class="chapter">{{ $tm->pasal->pasal }} ayat {{ $tm->pasal->ayat }}</td>
                    <td class="actions">
                        <button class="btn btn-sm btn-success " onClick="showapp({{$tm->id}})">
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


@include('loadjs.pagination') 
@include('loadjs.searchtable')

