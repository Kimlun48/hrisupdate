<html>
  <head>
    <style>
      body {
        font-family: Arial, sans-serif;
        font-size: 9pt;
      }
      
      .header {        
        padding: 20px;
        text-align: center;
      }
      
      .content {
        margin: 10px;
      }
      
      .table {
        border-collapse: collapse;
        width: 100%;
      }
      
      .table td, .table th {
        border: 1px solid #333;
        padding: 10px;
      }
      
      .footer {
        color: #fff;
        padding: 20px;
        text-align: center;
        background-color: #333;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <h2>Data Employees</h2>
    </div>
    <div class="content">
      <!-- isi halaman -->
      <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th>No Induk Karyawan</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Nomor Induk Kependudukan</th>
      <th>Alamat KTP</th>
      <th>Alamat Domisili</th>
      <th>Tanggal Lahir</th>
      <th>Nomor HP</th>
      <th>Jenis Kelamin</th>
      <th>Status Nikah</th>
      <th>Agama</th>
      <th>Jabatan</th>
      <th>Level Jabatan</th>
      <th>Status Karyawan</th>
      <th>tanggal bergabung</th>
      <th>tanggal berakhir</th>
      <th>Cabang</th>
      <th>Blood Type</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($employes as $employ)
    <tr>
      <td>{{ $loop->iteration }}.</td>
      <td>{{ $employ->nomor_induk_karyawan }}</td>
      <td>{{ $employ->nama_lengkap }}</td>
      <td>{{ $employ->email }}</td>
      <td>{{ $employ->no_identitas}}</td>
      <td>{{ $employ->alamat }}</td>
      <td>{{ $employ->alamat_domisili }}</td>
      <td>{{ $employ->tgl_lahir }}</td>
      <td>{{ $employ->no_hp }}</td>
      <td>{{ $employ->gender }}</td>
      <td>{{ $employ->status_pernikahan }}</td>
      <td>{{ $employ->agama }}</td>
      <td>{{ $employ->jabatan->nama}}</td>
      <td>{{ $employ->cabang->nama}}</td>
      <td>{{ $employ->status_karyawan }}</td>
      <td>{{ $employ->tahun_gabung }}</td>
      <td>{{ $employ->tahun_keluar }}</td>
      <td>{{ $employ->cabang->nama}}</td>
      <td>{{ $employ->golongan_darah }}</td>
    </tr>
    @empty
    <tr>
      <td colspan="19">
        <div class="alert alert-danger">
          Data belum Tersedia.
        </div>
      </td>
    </tr>
    @endforelse
  </tbody>
</table>
