<style>
    table {
        table-layout: fixed; /* Menggunakan layout tetap untuk menghindari pematahan baris */
        width: 100%; /* Lebar tabel 100% agar sesuai dengan parent */
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center; /* Mengatur teks menjadi berada di tengah */
        vertical-align: middle; /* Mengatur tinggi baris/row */
        white-space: nowrap; /* Hindari pematahan baris teks */
        overflow: hidden; /* Sembunyikan teks yang melewati batas sel */
        text-overflow: ellipsis; /* Tambahkan elipsis (...) untuk teks yang melewati batas sel */
    }

    th {
        background-color: #f2f2f2;
    }
</style>


<table class="table table-bordered">
    <thead> 
        <tr style="background-color: #f2f2f2;">
            <th style="text-align: center; vertical-align: middle;">Nama</th>
            <th style="text-align: center; vertical-align: middle;">NIK</th>
            @foreach($dateRange as $date)
                <th style="text-align: center; vertical-align: middle;">
                    {{ date('d-m-Y', strtotime($date)) }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @forelse ($shift as $sh)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{ $sh->nama_lengkap }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $sh->nomor_induk_karyawan}}</td>
                @foreach ($absen as $item)
                    @if ($item->nomor_induk_karyawan == $sh->nomor_induk_karyawan)
                        <td style="text-align: center; vertical-align: middle;">
                            @if ($item->shift == 'Off')
                                <div style="text-align: center; vertical-align: middle;">
                                    {{ $item->shift }}
                                    <br>
                                    {{ substr($item->parampresensi->jam_masuk, 0, 5) }} - {{ substr($item->parampresensi->jam_pulang, 0, 5) }}
                                </div>
                            @elseif ($item->jam_masuk && $item->jam_pulang)
                                <div style="text-align: center; vertical-align: middle;">
                                    {{ $item->shift }}
                                    <br>
                                    {{ substr($item->parampresensi->jam_masuk, 0, 5) }} - {{ substr($item->parampresensi->jam_pulang, 0, 5) }}
                                    <br>
                                    In - Out
                                    <br>
                                    {{ substr($item->jam_masuk, 11, 5) }} - {{ substr($item->jam_pulang, 11, 5) }}
                                </div>
                            @else
                                <div style="text-align: center; vertical-align: middle;">
                                    {{ $item->shift }}
                                    <br>
                                    {{ substr($item->parampresensi->jam_masuk, 0, 5) }} - {{ substr($item->parampresensi->jam_pulang, 0, 5) }}
                                </div>
                            @endif
                        </td>
                    @endif
                @endforeach
            </tr>
            @empty
            <tr>
                <td colspan="{{ count($dateRange) + 1 }}" style="text-align: center; vertical-align: middle;">
                    <div class="alert alert-danger">
                        Data belum Tersedia.
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>