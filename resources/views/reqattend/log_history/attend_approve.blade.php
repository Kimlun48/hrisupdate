<div class="border-body" id="tes">
    {{-- <div class="col-md-3 clm-search" >
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control" placeholder="Search" id="search" name="search">
        </div>
    </div> --}}
    <div class="table-responsive">
        <table class="table data-table" id="myTable">
            <thead class="table-head">
                <tr class="judul">
                    <th scope="col">No</th>
                    <th scope="col">No Induk Karyawan</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Di Ajukan</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Tanggal Approve</th>
                    <th scope="col">Status Aprrove</th>
                    <th scope="col">Reason</th>
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
                        <td>{{ $tm->tanggal }}</td>
                        <td>{{ $tm->tanggal_approve }}</td>
                        <td>{{ $tm->status_approve }}</td>
                        <td>{{ $tm->notes }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="alert alert-danger text-center">Data not yet available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6 pagination-length">
                <label for="length">Showing </label>
                <select name="length" id="length">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <!-- Add other options as needed -->
                </select>
                <span class="total-records">From {{ $alldata->firstItem() }} to {{ $alldata->lastItem() }} of {{ $alldata->total() }} Rows</span>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                {{ $alldata->links() }}
            </div>
        </div>  
    </div>
</div>


<script>
    $(document).ready(function () {
        let isloading = false; // Flag untuk menunjukkan apakah permintaan sedang berlangsung
    
        $("#search").on("keyup", function () {
            if (!isloading) {
                isloading = true; // Set flag menjadi true saat permintaan dimulai
                let searchValue = $(this).val();
                searchAttendanceAdmin(searchValue);
            }
        });
    });
    
    function searchAttendanceAdmin(searchValue) {
        // Tampilkan indikator loading di sini (gunakan isloading)
        // ...
    
        $.ajax({
            url: '{{ route("reqattend.log_attendance_approve") }}',
            type: "GET",
            data: { search: searchValue },
            success: function (data) {
                // Update tampilan tabel dengan data hasil pencarian
                $("#tes").html(data);
    
                // Set flag menjadi false setelah permintaan selesai
                isloading = false;
            },
            error: function (error) {
                console.log("Error:", error);
                
                // Set flag menjadi false setelah permintaan selesai (menggunakan isloading)
                isloading = false;
            }
        });
    }
    
</script>
    
    
<script>
    $(document).ready(function() {
        // Mengirim permintaan AJAX saat perubahan pagination
        $('.pagination a').on('click', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page, $('#length').val());
        });
    
        $(document).on('change', '#length', function () {
            var rowsPerPage = parseInt($('#showEntries').val());
            var coba = $("#length").val();
            fetch_data(1, coba);
        })
    
    
    
        function fetch_data(page, length) {
            var coba = $("#length").val();

            $.ajax({
                url: '{{ route("reqattend.log_attendance_approve") }}',
                type: 'GET',
                data: { page: page, length: length },
                success: function (response) {
                    // Manipulate or display data here
                    $('#tes').html(response);
                    $("#length").val(coba);
    
                    // Display page range information
                    var firstItem = parseInt(response.match(/First Item: (\d+)/)[1]);
                    var lastItem = parseInt(response.match(/Last Item: (\d+)/)[1]);
                    var totalCount = parseInt(response.match(/Total Records: (\d+)/)[1]);
    
                    $('#totalRecords').text('Showing ' + firstItem + ' to ' + lastItem + ' of ' + totalCount + ' Rows');
                },
                error: function (xhr, status, error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        }
    
        
    
    
    });
</script>