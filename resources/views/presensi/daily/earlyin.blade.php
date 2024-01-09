<!-- Modal Karyawan EarlyIn-->
<div class="table-responsive">
  <table class="table data-table text-nowrap table-hover table-responsive ">
    <thead class="table-head">
      <tr class="judul">
        <th scope="col" width="35%">NIK</th>
        <th scope="col" width="25%">Name</th>
        <th scope="col" width="15%">Cabang</th>
        <th scope="col" width="15%">Shift</th>
        <th scope="col" width="20%">Clock In</th>
      </tr>
    </thead>
    <tbody class="table-content">
    @forelse($earlyintoday as $early)
      <tr class="isi">
        <td class="id">{{$early->preskaryawan->nomor_induk_karyawan }}</td>
        <td class="name" >{{$early->preskaryawan->nama_lengkap }}</td>
        <td class="cabang" >{{$early->preskaryawan->cabang->nama }}</td>
        <td class="name">{{$early->parampresensi->jenis_shift}} {{ substr ($early->parampresensi->jam_masuk, 0, 5) }} - {{ substr ($early->parampresensi->jam_masuk, 0, 5) }}</td>
        <td class="foto"> 
          <img src="{{ asset('storage/presensi/' . $early->image_masuk) }}" class="rounded-circle" width="25" height="25">
           &emsp; {{substr($early->jam_masuk, 10, 20)}} 
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