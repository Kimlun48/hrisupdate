<div class="srcl-branch">
<table class="table data-table">
   <thead>
   <tr class="judul">
      <th scope="col">No</th>
      <th scope="col">Nik</th>
      <th scope="col">Employee Name</th>
      <th scope="col">Date</th>
      <th scope="col">Shift</th>
   </tr>
   </thead>
   <tbody>
   @forelse ($data as $sh)
   <tr class="isi">
      <td class="nomor">{{ $loop->iteration }}.</td>
      <td class="nama">{{ $sh->nomor_induk_karyawan}}</td>
      <td class="nama">{{ $sh->nama_lengkap}}</td>
      <td class="nama">{{ $sh->tanggal}}</td>
      <td class="nama">{{ $sh->jenis_shift}}</td>
   </tr>
   @empty
      <div class="alert alert-danger">
         Data belum Tersedia.
      </div>
   @endforelse
   </tbody>
</table>
</div>
