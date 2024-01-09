<div class="table-responsive" id="pagi" > 
    <table class="table text-uppercase tbl-cztm table-hover text-nowrap">
        <thead class="detail-th"> 
            <tr>
                <th scope="col" class="date" >Nama</th>
                <th scope="col" class="date">NIK</th>
                @foreach($dateRange as $date)
                    <th scope="col">
                        {{ date('d-m-Y', strtotime($date)) }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="detail-body">
            @forelse ($shift as $sh)
                <tr class="isi">
                    <td class="nama">{{ $sh->nama_lengkap }}</td>
                    <td class="nik">{{ $sh->nomor_induk_karyawan}}</td>
                    @foreach ($absen as $item)
                        @if ($item->nomor_induk_karyawan == $sh->nomor_induk_karyawan)
                            <td class="date">
                                @if ($item->shift == 'Off')
                                    <!-- Tampilan tambahan di atas card ketika shiftnya Off -->
                                    <div class="cards-schedule-off">
                                        <div class="frame">
                                            <div class="content-1">
                                                <div class="text-wrapper">{{$item->shift}}</div>
                                                <div class="text-wrapper-2">{{ substr($item->parampresensi->jam_masuk, 0, 5) }} - {{ substr($item->parampresensi->jam_pulang, 0, 5) }}</div>
                                            </div>
                                            <div class="content-1">
                                                <div class="text-wrapper">In / Out</div>
                                                <div class="text-wrapper-2">{{ substr($item->jam_masuk, 11, 5) }} - {{ substr($item->jam_pulang, 11, 5) }}</div>
                                            </div>
                                        </div>
                                        <div class="edit-button" onClick="edit({{$item->id}}, '{{$item->nama_lengkap}}', '{{$item->shift}}')"> Edit </div>
                                    </div>
                                @elseif ($item->jam_masuk && $item->jam_pulang)
                                    <div class="cards-schedule-in">
                                        <div class="frame">
                                            <div class="content-1">
                                                <div class="text-wrapper">{{$item->shift}}</div>
                                                <div class="text-wrapper-2">{{ substr($item->parampresensi->jam_masuk, 0, 5) }} - {{ substr($item->parampresensi->jam_pulang, 0, 5) }}</div>
                                            </div>
                                            <div class="content-1">
                                                <div class="text-wrapper">In / Out</div>
                                                <div class="text-wrapper-2">{{ substr($item->jam_masuk, 11, 5) }} - {{ substr($item->jam_pulang, 11, 5) }}</div>
                                            </div>
                                        </div>
                                        <div class="edit-button" onClick="edit({{$item->id}}, '{{$item->nama_lengkap}}', '{{$item->shift}}')"> Edit </div>
                                    </div>
                                @elseif(!empty($item->jam_masuk) && empty($item->jam_pulang))
                                    <div class="cards-schedule-no-one">
                                        <div class="frame">
                                            <div class="content-1">
                                                <div class="text-wrapper">{{$item->shift}}</div>
                                                <div class="text-wrapper-2">{{ substr($item->parampresensi->jam_masuk, 0, 5) }} - {{ substr($item->parampresensi->jam_pulang, 0, 5) }}</div>
                                            </div>
                                            <div class="content-1">
                                                <div class="text-wrapper">In / Out</div>
                                                <div class="text-wrapper-2">{{ substr($item->jam_masuk, 11, 5) }} - {{ substr($item->jam_pulang, 11, 5) }}</div>
                                            </div>
                                        </div>
                                        <div class="edit-button" onClick="edit({{$item->id}}, '{{$item->nama_lengkap}}', '{{$item->shift}}')"> Edit </div>
                                    </div>
                                @else
                                    <!-- Tampilan jika jam_masuk dan jam_pulang tidak ada -->
                                    <div class="cards-schedule-no-both">
                                        <div class="frame">
                                            <div class="content-1">
                                                <div class="text-wrapper">{{$item->shift}}</div>
                                                <div class="text-wrapper-2">{{ substr($item->parampresensi->jam_masuk, 0, 5) }} - {{ substr($item->parampresensi->jam_pulang, 0, 5) }}</div>
                                            </div>
                                            <div class="content-1">
                                                <div class="text-wrapper">In / Out</div>
                                                <div class="text-wrapper-2">{{ substr($item->jam_masuk, 11, 5) }} - {{ substr($item->jam_pulang, 11, 5) }}</div>
                                            </div>
                                        </div>
                                        <div class="edit-button" onClick="edit({{$item->id}}, '{{$item->nama_lengkap}}', '{{$item->shift}}')"> Edit </div>
                                    </div>
                                @endif
                            </td>
                        @endif
                    @endforeach
                </tr>
                @empty
                <tr>
                    <td colspan="{{ count($dateRange) + 1 }}">
                        <div class="alert alert-danger">
                            Data belum Tersedia.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    
    <div class="pagination-length">
        <label for="length">Row Per Page:</label>
        <select name="length" id="length">
            <option value="10">10</option>
            <option value="20">20</option>
            <!-- Tambahkan pilihan lain sesuai kebutuhan -->
        </select>
    </div>
    <div class="pagination">
        {{ $shift->links() }}
    </div>

</div>

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

    // function fetch_data(page, length) {
    //     var startDate = $("#dateRangeStart").val(); // Ganti dengan tanggal awal yang diinginkan
    //     var endDate = $("#dateRangeEnd").val();
    //     var coba = $("#length").val();

    //     // Tampilkan SweetAlert2 dengan progress bar
    //     Swal.fire({
    //         title: 'Loading...',
    //         html: '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%; background-color: red;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>',
    //         allowOutsideClick: false,
    //         didOpen: () => {
    //             // Mencegah penutupan modal selama request berlangsung
    //             Swal.showLoading();
    //         },
    //     });

    //     $.ajax({
    //         url: '{{ route("shift.read_data") }}?page=' + page + '&length=' + length,
    //         type: 'GET',
    //         xhr: function () {
    //             var xhr = new window.XMLHttpRequest();
    //             xhr.addEventListener("progress", function (evt) {
    //                 if (evt.lengthComputable) {
    //                     var percentComplete = (evt.loaded / evt.total) * 100;

    //                     console.log('Progress Event:', percentComplete);

    //                     if (percentComplete <= 30) {
    //                         $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'red');
    //                     } else if (percentComplete <= 60) {
    //                         $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'orange');
    //                     } else if (percentComplete <= 100) {
    //                         $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'green');
    //                     } else {
    //                         console.log('Persentase di luar rentang yang diharapkan:', percentComplete);
    //                     }
    //                 } else {
    //                     console.log('Tidak dapat menghitung panjang total.');
    //                 }
    //             }, false);
    //             return xhr;
    //         },
    //         data: {
    //             start: startDate,
    //             end: endDate,
    //         },
    //         success: function(response,length) {
    //             // Manipulasi atau tampilkan data di sini
    //             $('#pagi').html(response); // Mengganti isi elemen dengan id "pagi"
    //             $("#length").val(coba);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Terjadi kesalahan:', error);
    //         },
    //         complete: function() {
    //           Swal.close();
    //         }
    //     });
    // };

    function fetch_data(page, length) {
        var startDate = $("#dateRangeStart").val();
        var endDate = $("#dateRangeEnd").val();
        var coba = $("#length").val();
        // console.log(startDate, endDate);

        // Tampilkan SweetAlert2 dengan progress bar
        Swal.fire({
        title: 'Loading...',
        html: '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%; background-color: red;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>',
        allowOutsideClick: false,
        didOpen: () => {
            // Mencegah penutupan modal selama request berlangsung
            Swal.showLoading();
        },
        });

        $.ajax({
        url: '{{ route("shift.read_data") }}?page=' + page + '&length=' + length,
        type: 'GET',
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total) * 100;

                console.log('Progress Event:', percentComplete); // Tambahkan log untuk melihat progress

                // Update progress bar dan warna berdasarkan rentang persentase
                if (percentComplete <= 30) {
                $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'red');
                } else if (percentComplete <= 60) {
                $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'orange');
                } else if (percentComplete <= 100) {
                $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'green');
                } else {
                console.log('Persentase di luar rentang yang diharapkan:', percentComplete); // Tambahkan log untuk persentase di luar rentang
                }
            } else {
                console.log('Tidak dapat menghitung panjang total.'); // Tambahkan log jika tidak dapat menghitung panjang total
            }
            }, false);
            return xhr;
        },
        data: {
            start: startDate,
            end: endDate,
        },
        success: function(response) {
            // Manipulasi atau tampilkan data di sini
            $('#pagi').html(response); // Mengganti isi elemen dengan id "pagi"
            $("#length").val(coba);
        },
        error: function(xhr, status, error) {
            console.error('Terjadi kesalahan:', error);
        },
        complete: function() {
            // Tutup SweetAlert2 setelah request selesai
            Swal.close();
        }
        });
    }
});

</script> 

<script>
// Ambil elemen tabel
const scrollContainer = document.querySelector('#pagi');
const table = scrollContainer.querySelector('.table');

let isMouseDown = false;
let startX;
let scrollLeft;

table.addEventListener('mousedown', (e) => {
  isMouseDown = true;
  startX = e.pageX - scrollContainer.offsetLeft;
  scrollLeft = scrollContainer.scrollLeft;
});

table.addEventListener('mouseleave', () => {
  isMouseDown = false;
});

table.addEventListener('mouseup', () => {
  isMouseDown = false;
});

table.addEventListener('mousemove', (e) => {
  if (!isMouseDown) return;
  e.preventDefault();
  const x = e.pageX - scrollContainer.offsetLeft;
  const walk = (x - startX) * 3; // Ubah nilai 2 sesuai kecepatan pengguliran yang diinginkan
  scrollContainer.scrollLeft = scrollLeft - walk;
});


</script>
