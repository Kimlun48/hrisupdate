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
            <th style="text-align: Center; vertical-align: middle;">NO</th>
            <th style="text-align: Center; vertical-align: middle;">Employee ID</th>
            <th style="text-align: Center; vertical-align: middle;">Name</th>
            <th style="text-align: Center; vertical-align: middle;">Department</th>
            <th style="text-align: Center; vertical-align: middle;">Job Position</th>
            <th style="text-align: Center; vertical-align: middle;">Job Level</th>
            <th style="text-align: Center; vertical-align: middle;">Join Date</th>
            <th style="text-align: Center; vertical-align: middle;">Resign Date</th>
            <th style="text-align: Center; vertical-align: middle;">Employment Status</th>
            

            @foreach($dateRange as $date)
                <th style="text-align: center; vertical-align: middle;">
                    {{ date('d-m-Y', strtotime($date)) }}
                </th>
            @endforeach
            <th style="text-align: Center; vertical-align: middle;">Total Present</th>
                <th style="text-align: Center; vertical-align: middle;">Total Dayoff</th>
                <th style="text-align: Center; vertical-align: middle;">Total Absence</th>
                <th style="text-align: Center; vertical-align: middle;">Total Sakit Dengan Surat Dokter</th>
                <th style="text-align: Center; vertical-align: middle;">Total Cuti Tahunan</th>
                <th style="text-align: Center; vertical-align: middle;">Total Cuti Opname</th>
                <th style="text-align: Center; vertical-align: middle;">Total Late In</th>
                <th style="text-align: Center; vertical-align: middle;">Total Early Out</th>
                <th style="text-align: Center; vertical-align: middle;">Total No Check In</th>
                <th style="text-align: Center; vertical-align: middle;">Total No Check Out</th>
                <th style="text-align: Center; vertical-align: middle;">Total Special Holiday</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($shift as $sh)
            <tr>
                <td style="text-align: left; vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="text-align: left; vertical-align: middle;">{{ $sh->nomor_induk_karyawan}}</td>
                <td style="text-align: left; vertical-align: middle;">{{ $sh->nama_lengkap }}</td>
                
                <td style="text-align: left; vertical-align: middle;">{{ $sh->bagian->nama }}</td>
                <td style="text-align: left; vertical-align: middle;">{{ $sh->jabatan->nama}}</td>
                <td style="text-align: left; vertical-align: middle;">{{ $sh->jabatan->paramlevel->nama}}</td>
                <td style="text-align: left; vertical-align: middle;">{{ date('d-m-Y', strtotime($sh->tahun_gabung)) }}</td>
                <td style="text-align: left; vertical-align: middle;">{{ date('d-m-Y', strtotime($sh->tahun_keluar)) }}</td>
                <td style="text-align: left; vertical-align: middle;">{{ $sh->status_karyawan}}</td>

              
                @foreach ($absen as $item)
                    @if($item->nomor_induk_karyawan == $sh->nomor_induk_karyawan)
                        @if($item)
                        <td style="text-align: left; vertical-align: middle;">{{$item->presensi_status}}</td>
                        @else
                        <td style="text-align: left; vertical-align: middle;">Tidak ada shift</td>
                        @endif
                    @endif
                @endforeach
 
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