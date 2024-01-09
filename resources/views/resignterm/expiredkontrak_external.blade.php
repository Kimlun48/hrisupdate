<div id="paginate-content">

    <div class="col-md-12 d-flex justify-content-end align-items-center">
      <form class="search" id="searchForm" style="margin-top: -35px;">
        <div class="form-group has-search">
          <span class="fa fa-search form-control-feedback"></span>
          <input type="text" class="form-control" placeholder="Search" id="search" name="search">
        </div>
      </form>
    </div> 

    <table id="myTable" class="table data-table text-uppercase mt-3 table-sort">
        <thead>
            <tr class="judul">
            <th scope="col">No</th>
            <th scope="col">Number of employees</th>
            <th scope="col">Name</th>
            <th scope="col">Expired Kontrak</th>
            <th scope="col">Document</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $tm)
            <tr class="isi">
                <td class="nomor">{{ $loop->iteration }}.</td>
                <td>{{ $tm->nomor_induk_karyawan}}</td>
                <td>{{$tm->nama_lengkap}}</td>
                <td>{{$tm->expired_kontrak}}</td>
    
                <td>
                    <a href="/resignterm/qpi/{{$tm->id}}" target="_blank" class="btn btn-sm btn-info" style="width: 40px"title="QPI Download">
                    QPI</a>
                </td>
                <td>
                <!-- <button class="btn btn-sm btn-success " onClick="approve({{$tm->id}})"><i class="fas fa-calendar-check"></i></button>
                <button class="btn btn-sm btn-danger btn-reject" onClick="showreject({{$tm->id}})"><i class="fas fa-window-close"></i></button>    
                 -->
            
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="alert alert-danger text-center">Data not yet available.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

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
</div>

@include('resignterm.partials.scriptsearch')
@include('loadjs.pagination')