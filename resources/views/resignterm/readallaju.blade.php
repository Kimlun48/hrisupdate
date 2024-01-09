<div id="paginate-content">

    <div class="col-md-12 d-flex justify-content-end align-items-center">
      <form class="search" id="searchForm" style="margin-top: -35px;">
        <div class="form-group has-search">
          <span class="fa fa-search form-control-feedback"></span>
          <input type="text" class="form-control" placeholder="Search" id="search" name="search">
        </div>
      </form>
    </div> 

    <table id="myTable" class="table data-table text-uppercase table-sort">
        <thead>
            <tr class="judul">
                <th scope="col">No</th>
                <th scope="col">Number of employees</th>
                <th scope="col">Name</th>
                <th scope="col">Date of filing</th>
                <th scope="col">Last date</th>
                <th scope="col">Reason</th>
                <th scope="col">Document</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($data->isEmpty())
                <tr class="text-center">
                    <td colspan="8" class="alert alert-danger text-center">Data not yet available.</td>
                </tr>
            @else
                @foreach ($data as $tm)
                    <tr class="isi">
                        <td class="nomor">{{ $loop->iteration }}.</td>
                        <td>{{ $tm->karyawan->nomor_induk_karyawan}}</td>
                        <td>{{ $tm->karyawan->nama_lengkap}}</td>
                        <td>{{ $tm->tanggal_pengajuan}}</td>
                        <td>{{ $tm->tanggal_akhirkerja}}</td>
                        <td>{{ $tm->notes}}</td>
                        <td>
                            <a href="/storage/resign/{{$tm->dokumen}}" target="_blank" class="" title="Download">
                                <svg width="90" height="28" viewBox="30 0 30 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M45.7371 25.4453C45.4319 25.4453 45.1408 25.317 44.9349 25.0918L39.137 18.7504C38.7319 18.3073 38.7626 17.6197 39.2057 17.2145C39.6488 16.8094 40.3365 16.8402 40.7416 17.2833L44.65 21.5582L44.65 5.51524C44.65 4.91488 45.1368 4.42815 45.7371 4.42815C46.3375 4.42815 46.8242 4.91488 46.8242 5.51524L46.8242 21.5582L50.7327 17.2833C51.1378 16.8402 51.8254 16.8094 52.2685 17.2145C52.7116 17.6197 52.7424 18.3073 52.3373 18.7504L46.5394 25.0918C46.3334 25.317 46.0424 25.4453 45.7371 25.4453Z" fill="#338A2C"/>
                                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M32.6921 21.7842C33.2925 21.7842 33.7792 22.2709 33.7792 22.8713C33.7792 24.9518 33.7815 26.4029 33.9287 27.4978C34.0717 28.5614 34.3332 29.1245 34.7344 29.5257C35.1355 29.927 35.6988 30.1884 36.7623 30.3315C37.8572 30.4786 39.3083 30.4809 41.3888 30.4809H50.0856C52.1661 30.4809 53.6172 30.4786 54.7121 30.3315C55.7757 30.1884 56.3389 29.927 56.7401 29.5257C57.1413 29.1245 57.4028 28.5614 57.5458 27.4978C57.6929 26.4029 57.6953 24.9518 57.6953 22.8713C57.6953 22.2709 58.182 21.7842 58.7823 21.7842C59.3827 21.7842 59.8694 22.2709 59.8694 22.8713V22.9508C59.8694 24.9331 59.8694 26.5309 59.7006 27.7876C59.5252 29.0922 59.1499 30.1906 58.2775 31.063C57.4049 31.9356 56.3065 32.3109 55.0019 32.4863C53.7452 32.6551 52.1474 32.6551 50.1652 32.6551H41.3093C39.327 32.6551 37.7293 32.6551 36.4726 32.4863C35.168 32.3109 34.0695 31.9356 33.197 31.0632C32.3245 30.1906 31.9493 29.0922 31.7739 27.7876C31.6049 26.5309 31.605 24.9331 31.605 22.9508C31.605 22.9243 31.605 22.8978 31.605 22.8713C31.605 22.2709 32.0917 21.7842 32.6921 21.7842Z" fill="#338A2C" fill-opacity="0.5"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success " onClick="approve({{$tm->id}})">
                                <i class="fas fa-calendar-check"></i></button>
                            <button class="btn btn-sm btn-danger btn-reject" onClick="showreject({{$tm->id}})">
                                <i class="fas fa-window-close"></i></button>    
                        </td>
                    </tr>
                @endforeach
            @endif
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


