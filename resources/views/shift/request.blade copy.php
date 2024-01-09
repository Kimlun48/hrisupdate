<table class="table data-table">
   <thead>
   <tr class="judul">
      <th scope="col">No</th>
      <th scope="col">When</th>
      <th scope="col">First Shift</th>
      <th scope="col">To</th>
      <th scope="col">Second Shift</th>
      <th scope="col">Status</th>
   </tr>
   </thead>
   <tbody>
   @forelse ($data as $sh)
   <tr class="isi">
      <td class="nomor">{{ $loop->iteration }}.</td>
      <td class="nama">{{ $sh->tanggal_awal}}</td>
      <td class="nama">{{ $sh->shift_awal}}</td>
      <td class="nama">{{ $sh->tanggal_akhir}}</td>
      <td class="nama">{{ $sh->shift_akhir}}</td>
      <td class="nama">{{ $sh->status_approve}}</td>
   </tr>
   @empty
      <div class="alert alert-danger">
         Tidak ada request.
      </div>
   @endforelse
   </tbody>
</table>
