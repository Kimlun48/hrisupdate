<div id="paginate-content">

    <div class="col-md-12 d-flex justify-content-end align-items-center">
      <form class="search" id="searchForm" style="margin-top: -35px;">
        <div class="form-group has-search">
          <span class="fa fa-search form-control-feedback"></span>
          <input type="text" class="form-control" placeholder="Search" id="search" name="search">
        </div>
      </form>
    </div> 

    <table id="myTable" class="table mt-3 data-table text-uppercase table-sort">
        <thead>
            <tr class="judul">
                <th scope="col">No</th>
                <th scope="col">Number of employees</th>
                <th scope="col">Name</th>
                <th scope="col">No Identity</th>
                <th scope="col">Branch</th>
                <th scope="col">Position</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $tm)
            <tr class="isi">
                <td class="nomor">{{ $loop->iteration }}.</td>
                <td>{{ $tm->nomor_induk_karyawan }}</td>
                <td>{{$tm->nama_lengkap}}</td>
                <td class="id">{{ $tm->no_identitas }}</td>
                <td class="cabang">{{ $tm->cabang->nama }}</td>
                <td class="posisi">{{ $tm->jabatan->nama}}</td>
                <td class="posisi">{{ $tm->status_karyawan }}</td>
                <td class="btn-action">
                    <!-- <button type="button" data-toggle="modal" data-target="#exampleModalCenter2{{ $tm->id }}" data-id="{{ $tm->id }}" class="btn btn-sm btn-info" data-whatever="@mdo">
                        <i class="fas fa-eye" style="color:#fff;"></i>
                    </button> -->
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


