<div class="border-body" id="tes">

    <div class="table-responsive">
        <table class="table data-table" id="myTable">
            <thead class="table-head">
                <tr class="judul">
                    <th scope="col">No</th>
                    <th scope="col">No Induk Karyawan</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Di Ajukan</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($alldata as $tm)
                    <tr class="isi">
                        <td class="nomor">{{ $loop->iteration }}.</td>
                        <td>{{ $tm->nomor_induk_karyawan }}</td>
                        <td>{{ $tm->nama_lengkap }}</td>
                        <td>
                            @if ($tm->created_at)
                                {{ \Carbon\Carbon::parse($tm->created_at)->format('d-m-Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($tm->tanggal)) }}</td>
                        <td>{{ $tm->notes }}</td>

                        <td>
                            <button class="btn btn-sm btn-success " onClick="showattend({{$tm->id}})">
                                <i class="fas fa-calendar-check"></i>
                            </button>
                            <button class="btn btn-sm btn-danger btn-reject" onClick="showrejectattend({{$tm->id}})">
                                <i class="fas fa-window-close"></i>
                            </button>
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

<!-- Include Bootstrap stylesheets -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Include DataTables library -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<style>
    /* Custom search style */
    #myTable_filter label {
        display: none; /* Hide the default search label */
    }

    #myTable_filter .has-search {
        position: relative;
    }

    #myTable_filter input {
        padding-left: 2.375rem;
        border-radius: 10px;
    }

    #myTable_filter .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }

    /* Adjust DataTables sorting icons */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:active {
        color: #007bff !important; /* Set the color for the current page */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: #007bff !important; /* Set the color for hovered pages */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
        color: #007bff !important; /* Set the color for active pages */
    }
</style>

<div class="border-body" id="tes">
    <div class="table-responsive">
        <table class="table data-table" id="myTable">
            <!-- your table content here -->
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        var dataTable = $('#myTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "lengthMenu": [10, 20],
            "language": {
                "search": "", // Remove the default search label
            }
        });

        // Move search input and icon into a new container
        var searchContainer = $('<div class="has-search">');
        var searchInput = $('#myTable_filter input').detach();
        var searchIcon = $('<span class="fa fa-search form-control-feedback"></span>');

        searchContainer.append(searchIcon);
        searchContainer.append(searchInput);
        $('#myTable_filter').append(searchContainer);
    });
</script>
