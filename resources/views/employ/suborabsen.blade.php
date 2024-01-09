<div id="subabsen">
    <div class="export-attendance">
        <h6 class="export-list" style="font-size: 14px;">Export Employees Attendance</h6>
        <form id="export-form" class="report">
            <div class="input-group group-export">
                <input type="date" class="form-control form-control-sm col-form-input-1" name="startdate" value="{{ request('startdate') }}" required>
                <input type="date" class="form-control form-control-sm col-form-input-2" name="enddate" value="{{ request('enddate') }}" required>
                <input type="submit" class="btn form-control-sm btn-sm btn-process" value="Process" name="report">
            </div>
        </form>
    </div>

    <table class="table data-table table-striped">
        <thead>
            <tr class="judul">
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Clock-in</th>
                <th scope="col">Rest out</th>
                <th scope="col">Rest in</th>
                <th scope="col">Clock-out</th>
            </tr>
        </thead>
        <tbody >
            @forelse($subordinate as $index => $det)
            <tr class="isi">
                <td class="nomor">{{ $subordinate->firstItem() + $index }}.</td>
                <td class="name">{{ $det->preskaryawan->nama_lengkap }}</td>
                <td class="date">{{ date('d-m-Y', strtotime($det->tanggal)) }}</td>
                <td class="clock-in">
                    <div class="row row-clock-in">
                        <div class="col-4 col-img-attendance">
                            @if(empty($det->jam_masuk))
                            @else
                            <img src="{{ asset('storage/presensi/' . $det->image_masuk) }}" class="img-attendance">
                        </div>
                        <div class="col-text">
                            {{ substr($det->jam_masuk, 10, 20) }}
                            @endif
                        </div>
                    </div>
                </td>

                <td class="nomor">{{ $det->istirahat_keluar }}</td>
                <td class="nomor">{{ $det->istirahat_masuk }}</td>
                <td class="clock-out">
                    <div class="row row-clock-out">
                        <div class="col-4 col-img-attendance">
                            @if(empty($det->jam_pulang))
                            @else
                            <img src="{{ asset('storage/presensi/' . $det->image_pulang) }}" class="img-attendance">
                        </div>
                        <div class="col-7 col-text">
                            {{ substr($det->jam_pulang, 10, 20) }}
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="7">No Data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-links">
        {!! $subordinate->links() !!}
    </div>
</div>       

@include('employ.partials.scriptstylesuborabsen')
<script>
$(document).ready(function() {
    // AJAX form submit
    $('#export-form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: '/employ/suborabsen', // URL endpoint of the controller method
            type: 'GET',
            data: formData,
            success: function(response){
                var tbody = $(response).find("tbody"); // Menemukan elemen tbody dalam tanggapan HTML
                $('#subabsen tbody').html(tbody.html()); // Menempatkan konten tbody ke dalam elemen dengan ID "employee-content"
                $('.pagination-links').html(response.pagination); // Update the pagination links

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors to the console
            }
        });
    });
});
</script>

