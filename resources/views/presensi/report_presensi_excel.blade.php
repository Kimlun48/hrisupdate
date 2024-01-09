<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}
</style>
</head>

<table class="table table-bordered">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="text-align: center; vertical-align: middle;">No</th>
            <th style="text-align: center; vertical-align: middle;">NIK</th>
            <th style="text-align: center; vertical-align: middle;">Nama</th>
            <th style="text-align: center; vertical-align: middle;">Departemen</th>
            <th style="text-align: center; vertical-align: middle;">Status</th>
            <th style="text-align: center; vertical-align: middle;">Cabang</th>
            <th style="text-align: center; vertical-align: middle;">Jabatan</th>
            <th style="text-align: center; vertical-align: middle;">Job Level</th>
            <th style="text-align: center; vertical-align: middle;">Tanggal</th>
            <th style="text-align: center; vertical-align: middle;">Shift</th>
            <th style="text-align: center; vertical-align: middle;">Jam Masuk</th>
            <th style="text-align: center; vertical-align: middle;">Jam Keluar</th>
            <th style="text-align: center; vertical-align: middle;">keterangan</th>
            <th style="text-align: center; vertical-align: middle;">Jenis_Karyawan</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($prs as $presensi)

<tr>
  <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}.</td>
  <td style="text-align: center; vertical-align: middle;">{{ $presensi->preskaryawan->nomor_induk_karyawan  }}</td>
  <td style="text-align: left; vertical-align: middle;">{{ $presensi->preskaryawan->nama_lengkap }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $presensi->preskaryawan->bagian->nama }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $presensi->preskaryawan->status_karyawan}}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $presensi->preskaryawan->cabang->nama}}</td>
  <td style="text-align: left; vertical-align: middle;">{{ $presensi->preskaryawan->jabatan->nama }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $presensi->preskaryawan->bagian->nama}}</td>
  <!-- Tanggal -->
  <td style="text-align: center; vertical-align: middle;">{{ date('d-m-Y',strtotime($presensi->tanggal)) }}</td>
  <!-- Akhir Tanggal -->
  <td style="text-align: center; vertical-align: middle;">{{ $presensi->parampresensi->jenis_shift }}</td>
  
    <td style="text-align: center; vertical-align: middle;"> @if(empty($presensi->jam_masuk))
    @else
      {{ date('H:i:s',strtotime($presensi->jam_masuk)) }} 
    @endif 
  </td>
  <td style="text-align: center; vertical-align: middle;"> @if(empty($presensi->jam_pulang))
    @else
      {{ date('H:i:s',strtotime($presensi->jam_pulang)) }} 
    @endif 
  </td>
  
  <!-- @if(empty($presensi->jam_masuk))
    <td style="text-align: center; vertical-align: middle;">{{ date('d-m-Y',strtotime($presensi->tanggal)) }}</td>
  @else
    <td style="text-align: center; vertical-align: middle;">{{ date('d-m-Y',strtotime($presensi->jam_masuk)) }}</td>
  @endif
  <td style="text-align: center; vertical-align: middle;">{{ $presensi->parampresensi->jenis_shift }}</td>
  @if(empty($presensi->jam_masuk))
    <td></td>
    <td></td>
  @else
    <td style="text-align: center; vertical-align: middle;"> {{ date('H:i:s',strtotime($presensi->jam_masuk)) }} </td>
    <td style="text-align: center; vertical-align: middle;">{{ date('H:i:s',strtotime($presensi->jam_pulang)) }}</td>
  @endif  -->
  <td style="text-align: center; vertical-align: middle;">{{ $presensi->presensi_status }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $presensi->preskaryawan->jenis_karyawan }}</td>
</tr>
@empty
  <p>Data Tidak Tersedia</p>
@endforelse
    </tbody>
</table>

