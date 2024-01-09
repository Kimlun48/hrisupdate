<table >
    <thead>
      <tr>
        <th>NO ID EXTERNALLLLLLLL</th>
        <th>NIK</th>
        <th>NO FINGER</th>
        <th>STATUS KERJA</th>
        <th>NAMA LENGKAP KTP</th>
        <th>NAMA DEPAN</th>
        <th>MASUK KERJA</th>
        <th>MASA KERJA</th>
        <th>NAMA CABANG</th>
        <th>BRAND</th>
        <th>VENDOR / NAMA PT</th>
        <th>JABATAN</th>
        <th>JENIS KELAMIN</th>
        <th>TEMPAT LAHIR</th>
        <th>TANGGAL LAHIR</th>
        <th>NOMOR KTP</th>
        <th>ALAMAT KTP</th>
        <th>KOTA KABUPATEN</th>
        <th>KODE POS</th>
        <th>ALAMAT DOMISILI</th>
        <th>AGAMA</th>
        <th>Status Marital</th>
        <th>Pendidikan Terakhir</th>
        <th>Nama Institusi</th>
        <th>Alamat Email</th>
        <th>NO HP</th>
        <th>KETERANGAN</th>
      </tr>
    </thead>

   <tbody>
     @forelse ($employes as $employ)
      <tr>
        <td>{{ $employ->id }}.</td>
        <td>{{ $employ->nomor_induk_karyawan }}</td>
        <td>{{ $employ->no_finger }}</td>
        <td>{{ $employ->status_karyawan }}</td>
        <td>{{ $employ->nama_lengkap }}</td>
        <td>{{ $employ->nama_panggilan }}</td>
        <td>{{ date('Y-m-d', strtotime($employ->tahun_gabung)) }}</td>
        <td>{{ $employ->get_masakerja() }}</td>
        <td>{{ $employ->cabang->nama}}</td>
        <td>{{ $employ->brand}}</td>
        <td>{{ $employ->vendor}}</td>
        <td>{{ $employ->jabatan->nama}}</td>
        <td>{{ $employ->gender }}</td>
        <td>{{ $employ->tempat_lahir }}</td>
        <td>{{ $employ->tgl_lahir }}</td>
        <td>{{ $employ->no_identitas }}</td>
        <td>{{ $employ->alamat }}</td>
        <td>{{ $employ->kota }}</td>
        <td>{{ $employ->kodepos }}</td>
        <td>{{ $employ->alamat_domisili }}</td>
        <td>{{ $employ->agama }}</td>
        <td>{{ $employ->status_pernikahan }}</td>
        <td>{{ $employ->pendidikan_terakhir }}</td>
        <td>{{ $employ->instansi_ijazah }}</td>
        <td>{{ $employ->email }}</td>
        <td>{{ $employ->no_hp }}</td>
        <td>-</td>
      </tr>
     @empty
     <p>Data Tidak Tersedia</p>
     @endforelse
   </tbody>
 </table>

