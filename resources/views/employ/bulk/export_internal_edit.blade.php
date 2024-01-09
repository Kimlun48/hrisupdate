<table >
    <thead>
      <tr>
        <th>NOMOR_INDUK_KARYAWAN</th>
        <th>NAMA LENGKAP </th>
        <th>NAMA PANGGILAN</th>
        <th>NOMOR KTP</th>
        <th>TANGGAL LAHIR</th>
        <th>AGAMA</th>
        <th>JENIS KELAMIN</th>
        <th>STATUS MARITAL</th>
        <th>ALAMAT KTP</th>
        <th>RT</th>
        <th>RW</th>
        <th>DESA</th>
        <th>KECAMATAN</th>
        <th>KOTA KABUPATEN</th>
        <th>PROVINSI</th>
        <th>KODE POS</th>
        <th>STATUS_RUMAH</th>
        <th>NO_HP</th>
        <th>NO_TELP</th>
        <th>PHOTO</th>
        <th>CABANG</th>
        <th>BAGIAN</th>
        <th>LEVEL JABATAN</th>
        <th>STATUS KARYAWAN</th>
        <th>NAMA PERUSAHAAN</th>
        <th>TAHUN GABUNG</th>
        <th>JENIS KARYAWAN</th>
        <th>UPAH</th>   
        <th>TEMPAT LAHIR</th>
        <th>EXPIRED KONTRAK</th>
        <th>MASA KERJA</th>
        <th>ALAMAT DOMISILI</th>
        <th>PTPK STATUS</th>
        <th>PENDIDIKAN TERAKHIR</th>
        <th>GRADE</th>
        <th>NAMA INSTITUSI</th>
        <th>JURUSAN</th>
        <th>TAHUN MASUK PENDIDIKAN</th>
        <th>TAHUN LULUS</th>
        <th>GPA</th>
        <th>Alamat Email</th>
        <th>NO DARURAT</th>
        <th>MEDSOS</th>
        <th>NPWP</th>
        <th>GOLONGAN DARAH</th>
        <th>NO REK1</th>
        <th>BANK1</th>
        <th>NO REK2</th>
        <th>BANK2</th>
        <th>NAMA IBU KANDUNG</th>
        <th>BPJS KESEHATAN</th>
        <th>KETERANGAN BPJS</th>
        <th>NO BPJS KESEHATAN</th>
        <th>BPJS TENAGA KERJA</th>
        <th>KETERANGAN BPJS TENAGA KERJA</th>
        <th>NO BPJS TENAGA KERJA</th>
        <th>JAMKES LAINNYA</th>
        <th>NO IJAZAH</th>
        <th>INSTANSI IJAZAH</th>
        <th>NO FINGER</th>
        <th>NO ID</th>
      </tr>
    </thead>
    
    <tbody>
      @forelse ($employes as $employ)
      <tr>
        <td>{{ $employ->nomor_induk_karyawan }}</td>
        <td>{{ $employ->nama_lengkap }}</td>
        <td>{{ $employ->nama_panggilan }}</td>
        <td>{{ $employ->no_identitas }}</td>
        <td>{{ $employ->tgl_lahir }}</td>
        <td>{{ $employ->agama }}</td>
        <td>{{ $employ->gender }}</td>
        <td>{{ $employ->status_pernikahan }}</td>
        <td>{{ $employ->alamat }}</td>
        <td>{{ $employ->rt }}</td>
        <td>{{ $employ->rw }}</td>
        <td>{{ $employ->desa }}</td>
        <td>{{ $employ->kecamatan }}</td>
        <td>{{ $employ->kota }}</td>
        <td>{{ $employ->provinsi }}</td>
        <td>{{ $employ->kodepos }}</td>
        <td>{{ $employ->status_rumah }}</td>
        <td>{{ $employ->no_hp }}</td>
        <td>{{ $employ->no_telp }}</td>
        <td>{{ $employ->photo }}</td>
        <td>{{ $employ->cabang->nama}}</td>
        <td>{{ $employ->bagian->nama}}</td>
        <td>{{ $employ->jabatan->nama}}</td>
        <td>{{ $employ->status_karyawan }}</td>
        <td>{{ $employ->cabang->perusahaan->nama }}</td>
        <td>{{ date('Y-m-d', strtotime($employ->tahun_gabung)) }}</td>
        <td>{{ $employ->jenis_karyawan }}</td>
        <td>{{ $employ->upah }}</td>
        <td>{{ $employ->tempat_lahir }}</td>
        <td>{{ date('Y-m-d', strtotime($employ->expired_kontrak)) }}</td>
        <td>{{ $employ->get_masakerja() }}</td>
        <td>{{ $employ->alamat_domisili}}</td>
        <td>{{ $employ->ptpk_status}}</td>
        <td>{{ $employ->pendidikan_terakhir }}</td>
        <td>{{ $employ->grade}}</td>
        <td>{{ $employ->nama_institusi}}</td>
        <td>{{ $employ->jurusan}}</td>
        <td>{{ $employ->tahun_masuk_pendidikan}}</td>
        <td>{{ $employ->tahun_lulus}}</td>
        <td>{{ $employ->gpa}}</td>
        <td>{{ $employ->email }}</td>
        <td>{{ $employ->kontak_darurat }}</td>
        <td>{{ $employ->medsos }}</td>
        <td>{{ $employ->npwp }}</td>
        <td>{{ $employ->golongan_darah }}</td>
        <td>{{ $employ->no_rek1 }}</td>
        <td>{{ $employ->bank1 }}</td>
        <td>{{ $employ->no_rek2 }}</td>
        <td>{{ $employ->bank2 }}</td>
        <td>{{ $employ->nama_ibu_kandung }}</td>
        <td>{{ $employ->bpjs_kesehatan }}</td>
        <td>{{ $employ->keterangan_bpjs }}</td>
        <td>{{ $employ->no_bpjs_kesehatan }}</td>
        <td>{{ $employ->bpjs_tenaga_kerja }}</td>
        <td>{{ $employ->keterangan_bpjs_tenaga_kerja }}</td>
        <td>{{ $employ->no_bpjs_tenaga_kerja }}</td>
        <td>{{ $employ->jamkes_lainnya}}</td>
        <td>{{ $employ->no_ijazah}}</td>
        <td>{{ $employ->instansi_ijazah}}</td>
        <td>{{ $employ->no_finger}}</td>
        <td>{{ $employ->id }}.</td>
      </tr>
      @empty
      <p>Data Tidak Tersedia</p>
      @endforelse
    </tbody>
 </table>

