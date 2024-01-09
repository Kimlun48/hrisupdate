<!-- Modal Karyawan OnTime-->
<div class="table-responsive">
  <table class="table data-table text-nowrap table-hover table-responsive ">
    <thead class="table-head">
      <tr class="judul">
        <th scope="col" width="auto">NIK</th>
        <th scope="col" width="auto">Name</th>
        <th scope="col" width="auto">Cabang</th>
        <th scope="col" width="auto">Shift</th>
        <th scope="col" width="auto">Clock In</th>
      </tr>
    </thead>
    <tbody class="table-content">  
      @forelse($ontimetoday as $ontime)
      <tr class="isi">
        <td class="id">{{$ontime->preskaryawan->nomor_induk_karyawan }}</td>
        <td class="name" >{{$ontime->preskaryawan->nama_lengkap }}</td>
        <td class="name" >{{$ontime->preskaryawan->cabang->nama }}</td>
        <td class="name">{{$ontime->parampresensi->jenis_shift}} {{ substr ($ontime->parampresensi->jam_masuk, 0, 5) }} - {{ substr ($ontime->parampresensi->jam_masuk, 0, 5) }}</td>
        <td class="foto">
          <img src="{{ asset('storage/presensi/' . $ontime->image_masuk) }}" class="rounded-circle" width="25" height="25"> &emsp; {{substr($ontime->jam_masuk, 10, 20)}} 
        </td>
      </tr>  
      @empty
      <tr class="text-center"> <td colspan="5"> No Data </td> </tr>
      @endforelse
    </tbody>
  </table>
</div>

          
<script>
  function Close() {
    $("#todayPresensi").modal("hide");
  }
</script>