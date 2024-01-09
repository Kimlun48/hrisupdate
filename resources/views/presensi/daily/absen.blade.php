<!-- Modal Karyawan Time Off Today-->
<div class="table-responsive">
  <table class="table data-table text-nowrap table-hover table-responsive ">
    <thead class="table-head">
      <tr class="judul">
        <th scope="col" width="auto">NIK</th>
        <th scope="col" width="auto">Name</th>
        <th scope="col" width="auto">Cabang</th>
        <th scope="col" width="auto">Shift</th>
        <th scope="col" width="auto">ClockIn</th>
        <th scope="col" width="auto">ClockOut</th>
      </tr>
    </thead>
    <tbody class="table-content">
    @forelse($absenofftoday as $absen)
    <tr class="isi">
        <td class="id">{{$absen->preskaryawan->nomor_induk_karyawan }}</td>
        <td class="name" >{{$absen->preskaryawan->nama_lengkap }}</td>
        <td class="cabang" >{{$absen->preskaryawan->cabang->nama }}</td>
        <td class="name">{{$absen->parampresensi->jenis_shift}} {{ substr ($absen->parampresensi->jam_masuk, 0, 5) }} - {{ substr ($absen->parampresensi->jam_masuk, 0, 5) }}</td>
        <td class="foto_in"> <img src="{{ asset('storage/presensi/' . $absen->image_masuk) }}" class="rounded-circle" width="25" height="25"> {{substr($absen->jam_masuk, 10, 20)}}
        </td>
        @if(empty($absen->jam_pulang))
        <td class="foto_out">-</td>  
        @else
        <td class="foto_out"><img src="{{ asset('storage/presensi/' . $absen->image_pulang) }}" class="rounded-circle" width="25" height="25"> {{substr($absen->jam_pulang, 10, 20)}}</td>
        @endif
      @empty
        <tr> <td colspan="6"> No Data </td> </tr>                          
      @endforelse
    </tbody>
  </table>
</div>

<script>
  function Close() {
    $("#todayPresensi").modal("hide");
  }
</script>