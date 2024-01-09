<div class="tableling" id="employee-content">
  <table id="myTable" class="table tbl-cztm table-hover">
    <thead class="table-head">
      <tr class="judul">
        <th scope="col" class="date" onclick="sortTable(1)">Date</th>
        <th scope="col" class="shift" onclick="sortTable(2)">Shift</th>
        <th scope="col" class="schedule-in" onclick="sortTable(3)">Schedule In</th>
        <th scope="col" class="schedule-out" onclick="sortTable(4)">Schedule Out</th>
        <th scope="col" class="clock-in" onclick="sortTable(5)">Clock In</th>
        <th scope="col" class="clock-out" onclick="sortTable(6)">Clock Out</th>
        <th scope="col" class="attend" onclick="sortTable(7)">Attendance Code</th>
        <th scope="col" class="timeoff col8" onclick="sortTable(8)">Time Off Code</th>
        <th scope="col" class="overtime col9" onclick="sortTable(9)">Overtime</th>
        <th scope="col" class="actions">Action</th>
      </tr>
    </thead>
    <tbody class="table-content">
      @forelse ($presensiKaryawan as $presensi)
      <tr class="isi" @if($presensi->presensi_status === 'Off') style="color: red;" @endif>
        <td class="date" scope="row">{{ date('d-m-Y', strtotime($presensi->tanggal)) }}</td>
        <td class="shift">{{ $presensi->parampresensi->jenis_shift }}</td>
        <td class="schedule-in">{{ $presensi->parampresensi->jam_masuk }}</td>
        <td class="schedule-out">{{ $presensi->parampresensi->jam_pulang }}</td>
        <td class="clock-in" style="">
          <div class="row row-clock-in">
            <div class="col-4 col-img-attendance">
              @if(empty($presensi->jam_masuk))
              <div class="col-4 text-center">-</div>
              @else
              <img src="{{ asset('storage/presensi/' . $presensi->image_masuk) }}" class="img-attendance">
              @endif
            </div>
            <div class="col-text text-center">
              @if(!empty($presensi->jam_masuk))
              {{ substr($presensi->jam_masuk, 10, 20) }}
              @endif
            </div>
          </div>
        </td>
        <td class="clock-out">
          <div class="row row-clock-out">
            <div class="col-4 col-img-attendance">
              @if(empty($presensi->jam_pulang))
              <div class="col-4 text-center">-</div>
              @else
              <img src="{{ asset('storage/presensi/' . $presensi->image_pulang) }}" class="img-attendance">
              @endif
            </div>
            <div class="col-7 col-text">
              @if(!empty($presensi->jam_pulang))
              {{ substr($presensi->jam_pulang, 10, 20) }}
              @endif
            </div>
          </div>
        </td>
        <td class="attend">{{ $presensi->presensi_status }}</td>
        <td class="timeoff col8">-</td>
        <td class="overtime col9">-</td>
        <td class="actions" onClick="edit({{$presensi->id}}, '{{$presensi->preskaryawan->nama_lengkap}}')">
          <i class="fas fa-edit"></i> Edit
        </td>
      </tr>
      @empty
      <tr>
        <td class="alert alert-danger text-center"  colspan="10">No data available</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>