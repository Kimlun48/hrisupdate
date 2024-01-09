<!-- Modal Karyawan Time Off Today-->
<div class="table-responsive">
  <table class="table data-table table-responsive table-striped">
    <thead class="table-head">
      <tr class="judul">
        <th scope="col" width="auto">NIK</th>
        <th scope="col" width="auto">Name</th>
        <th scope="col" width="auto">Cabang</th>
        <th scope="col" width="auto">Shift</th>
        <th scope="col" width="auto">ClockIn</th>
        <th scope="col" width="auto">Description</th>
      </tr>
    </thead>
    <tbody class="table-content">
    @forelse($noclockoutofftoday as $timeoff)
      <tr class="isi">
        <td class="id">{{$timeoff->preskaryawan->nomor_induk_karyawan }}</td>
        <td class="name" >{{$timeoff->preskaryawan->nama_lengkap }}</td>
        <td class="cabang" >{{$timeoff->preskaryawan->cabang->nama }}</td>
        <td class="name">{{$timeoff->parampresensi->jenis_shift}} {{ substr ($timeoff->parampresensi->jam_masuk, 0, 5) }} - {{ substr ($timeoff->parampresensi->jam_masuk, 0, 5) }}</td>
        <td class="foto"> 
          <img src="{{ asset('storage/presensi/' . $timeoff->image_masuk) }}" class="rounded-circle" width="25" height="25">
          &emsp; {{substr($timeoff->jam_masuk, 10, 20)}} 
        </td>
        <td class="keterangan"> {{$timeoff->presensi_status}}</td>
      </tr>                          
    @empty
      <tr class="text-center"> <td colspan="4"> No Data </td> </tr>  
    @endforelse
    </tbody>
  </table>
</div>


<script>
  function Close() {
    $("#todayPresensi").modal("hide");
  }
</script>