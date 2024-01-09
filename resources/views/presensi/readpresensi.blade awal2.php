@include('loadjs.ical_table')
<table id="myTable" class="table data-table">
  <thead class="table-head">
    <tr class="judul">
      <th scope="col" class="Employee name col1 sticky-col-name" onclick="sortTable(1)">Employee name <span class="sort-icon" id="sortIcon1"></span></th>
      <th scope="col" class="Employee-Id col2 sticky-col-id" onclick="sortTable(2)">Employee Id <span class="sort-icon" id="sortIcon2"></span></th>
      <th scope="col" class="Branch col3" onclick="sortTable(3)">Branch <span class="sort-icon" id="sortIcon3"></span></th>
      <th scope="col" class="Organization col4" onclick="sortTable(4)">Organization <span class="sort-icon" id="sortIcon4"></span></th>
      <th scope="col" class="Job Position col5" onclick="sortTable(5)">Job Position <span class="sort-icon" id="sortIcon5"></span></th>
      <th scope="col" class="Job Level col6" onclick="sortTable(6)">Job Level <span class="sort-icon" id="sortIcon6"></span></th>
      <th scope="col" class="Employment Status col7" onclick="sortTable(7)">Employment Status <span class="sort-icon" id="sortIcon7"></span></th>
      <th scope="col" class="dates col8" onclick="sortTable(8)">Date <span class="sort-icon" id="sortIcon8"></span></th>
      <th scope="col" class="shift Status col9" onclick="sortTable(9)">Shift <span class="sort-icon" id="sortIcon9"></span></th>
      <th scope="col" class="col10" onclick="sortTable(10)">Schedule In <span class="sort-icon" id="sortIcon10"></span></th>
      <th scope="col" class="col11" onclick="sortTable(11)">Schedule Out <span class="sort-icon" id="sortIcon11"></span></th>
      <th scope="col" class="clock-ins col12" onclick="sortTable(12)">Clock In <span class="sort-icon" id="sortIcon12"></span></th>
      <th scope="col" class="clock-outs col13" onclick="sortTable(13)">Clock Out <span class="sort-icon" id="sortIcon13"></span></th>
      <th scope="col" class="desks col14" onclick="sortTable(14)">Attendance Code <span class="sort-icon" id="sortIcon14"></span></th>
      <th scope="col" class="desks col15" onclick="sortTable(15)">Time Off Code <span class="sort-icon" id="sortIcon15"></span></th>
      <th scope="col" class="desks col16" onclick="sortTable(16)">Overtime <span class="sort-icon" id="sortIcon16"></span></th>
      <th scope="col" class="desks col17 zui-sticky-col" onclick="sortTable(17)">Action</th>
    </tr>
  </thead>
  <tbody class="table-content">
    @forelse ($prs as $presensi)
      <tr class="isi" @if($presensi->presensi_status === 'Off') style="color: red;" @endif>
        <td class="name hover-column col1 sticky-col-name" onclick="toprofilepresensi({{ $presensi->id_karyawan  }})">{{ $presensi->preskaryawan->nama_lengkap }}</td>
        <td class="nik col2 sticky-col-id">{{ $presensi->preskaryawan->nomor_induk_karyawan }}</td>
        <td class="cabang col3 " id="cabang" data-cabang="{{ $presensi->preskaryawan->cabang->nama }}">{{ $presensi->preskaryawan->cabang->nama }}</td>
        <td class="bagian col4" id="bagian" data-bagian="{{ $presensi->preskaryawan->bagian->nama }}">{{ $presensi->preskaryawan->bagian->nama }}</td>
        <td class="jabatan col5" id="jabatan" data-jabatan="{{ $presensi->preskaryawan->jabatan->nama }}">{{$presensi->preskaryawan->jabatan->nama}}</td>
        <td class="position col6">{{ $presensi->preskaryawan->jabatan->paramlevel->nama }}</td>
        <td class="position col7">{{ $presensi->preskaryawan->status_karyawan }}</td>
        <td class="date col8">{{ date('d F Y', strtotime($presensi->tanggal)) }}</td>
        <td class="position col9">{{ $presensi->parampresensi->jenis_shift }}</td>
        <td class="position col10">{{ substr ($presensi->parampresensi->jam_masuk, 0, 5) }}</td>
        <td class="position col11">{{ substr ($presensi->parampresensi->jam_pulang, 0, 5) }}</td>
        <td class="clock-in col12 ">
          <div class="row row-clock-in">
            <div class="col-4 col-img-attendance">
              @if(empty($presensi->jam_masuk))
                <div class="col-4 text-center">-</div>
              @else
                <img src="{{ asset('storage/presensi/' . $presensi->image_masuk) }}" class="img-attendance">
              @endif
            </div>
            <div class="text-center">
              @if(!empty($presensi->jam_masuk))
                {{ substr($presensi->jam_masuk, 11, 5) }}
              @endif
            </div>
          </div>
        </td>
        <td class="clock-out col13">
          <div class="row row-clock-out">
            <div class="col-4 col-img-attendance">
              @if(empty($presensi->jam_pulang))
                <div class="col-4 text-center">-</div>
              @else
                <img src="{{ asset('storage/presensi/' . $presensi->image_pulang) }}" class="img-attendance">
              @endif
            </div>
            <div class="text-center">
              @if(!empty($presensi->jam_pulang))
                {{ substr($presensi->jam_pulang, 11, 5) }}
              @endif
            </div>
          </div>
        </td>
        <td class="keterangan col14">{{ $presensi->keterangan }}</td>
        <td class="desk col15">{{ $presensi->presensi_status }}</td>
        <td class="keterangan text-center col16">-</td>
        <td class="keterangan text-center zui-sticky-col" onClick="edit({{$presensi->id}}, '{{$presensi->preskaryawan->nama_lengkap}}')" style="cursor: pointer;">
          <i class="fas fa-edit"></i> Edit
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="18">
          <div class="alert alert-danger" style="margin-top:50px;">Data belum Tersedia.</div>
        </td>
      </tr>
    @endforelse
  </tbody>
</table>



<select id="showEntries" onchange="cekdatashow()">
  <option value="25">25</option>
  <option value="50">50</option>
  <option value="100">100</option>
</select>

<div class="pagination" id="pagination">
  <a href="#" id="prevPage">Previous</a>
  <a href="#" id="nextPage">Next</a>
</div>

<div id="dataCount"></div>
   
<br><br>
<div id="table-data"></div><!-- Menampilkan isi tabel yang difilter -->

