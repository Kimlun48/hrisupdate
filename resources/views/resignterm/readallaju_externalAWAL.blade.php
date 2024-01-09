<div id="paginate-content">

    <div class="col-md-11">
        <div class="search-employ">
            <form id="searchForm" method="GET" class="search-resign">
                <input type="text" class="search__input" placeholder="Type your text" id="search" name="search" required>
                <button disabled class="search__button">
                    <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                        </g>
                    </svg>
                </button>
            </form>
        </div>
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
                            <a href="/storage/resign/{{$tm->dokumen}}" target="_blank" class="btn btn-sm btn-info" style="width: 40px"title="Download">
                            <i class="fas fa-download" style="color:#fff; "></i></a>
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
</div>

@include('resignterm.partials.scriptsearch')
@include('resignterm.partials.paginate')


