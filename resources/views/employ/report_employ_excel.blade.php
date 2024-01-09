<table >
    <thead>
      <tr>
        <th>No</th>
        <th>No Induk Karyawan</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Nomor Induk Kependudukan</th>
        <th>Alamat KTP</th>
        <th>Alamat Domisili</th>
        <th>Tanggal Lahir</th>
        <th>Nomor HP</th>
        <th>Nomor Rumah</th>
        <th>Jenis Kelamin</th>
        <th>Status Nikah</th>
        <th>Agama</th>
        <th>Nama Organisasi</th>
        <th>Jabatan</th>
        <th>Level Jabatan</th>
        <th>Status Karyawan</th>
        <th>tanggal bergabung</th>
        <th>tanggal berakhir</th>
        <th>NPWP</th>
        <th>PTKP Status</th>
        <th>Nama Bank</th>
        <th>BPJS Kesehatan</th>
        <th>Cabang</th>
        <th>Salary Config</th>
        <th>Blood Type</th>
        <th>Length Of Service</th>
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
       <td>{{ $employ->no_telp }}</td>
       <td>{{ $employ->gender }}</td>
       <td>{{ $employ->status_pernikahan }}</td>
       <td>{{ $employ->agama }}</td>
       <td>{{ $employ->bagian->nama }}</td>
       <td>{{ $employ->jabatan->nama}}</td>
       <td>{{ $employ->cabang->nama}}</td>
       <td>{{ $employ->status_karyawan }}</td>
       <td>{{ $employ->tahun_gabung }}</td>
       <td>{{ $employ->tahun_keluar }}</td>
       <td>{{ $employ->npwp }}</td>
       <td>{{ $employ->ptpk_status }}</td>
       <td>{{ $employ->bank1 }}</td>
       <td>{{ $employ->bpjs_tenaga_kerja }}</td>
       <td>{{ $employ->cabang->nama}}</td>
       <td>{{ $employ->upah }}</td>
       <td>{{ $employ->golongan_darah }}</td>
       <td>{{ $employ->get_masakerja() }}</td>
     </tr>
     @empty
     <p>Data Tidak Tersedia</p>
     @endforelse
   </tbody>
 </table>
