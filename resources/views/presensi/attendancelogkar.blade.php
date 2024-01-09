@extends('layouts.app-master')

@section('content')
    <div class="attendance">
      
      <h5 class="title-vacancy">Log Attendance</h5>
      <hr class="border"></hr>
      <div class="content-attendance">
        <div class="table-body">
          <h5 class="list-attendance">List Log Attendance</h5>

            <div class="export-attendance">
            <form action="/presensi" method="GET" class="report">
            <div class="input-group group-export">
            <input type="date" class="form-control form-control-sm col-form-input-1" name="startdate" value="{{request('startdate')}}" required>
                <input type="date" class="form-control form-control-sm col-form-input-2" name="enddate" value="{{request('enddate')}}" required>
                
            <select class="custom form-control form-control-sm col-form-input-4" name="format" value="{{request('format')}}" required>
                    <option value="">Select Option</option>
                    <option value="view">View</option>
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                  </select>
                <input type="submit" class="btn form-control-sm btn-sm btn-process" value="Process" name="report">
            </div>
        </form>
        </div>
      <br>
      <br>  
			    <table class="table  data-table">
            
            <thead class="table-head">
              <tr class="judul">
                <th scope="col" >No</th>
                <th scope="col" >Employee Name</th>
                <th scope="col" >NIK</th>
                <th scope="col" >Branch</th>
                <th scope="col" >Position</th>
                <th scope="col" >Date</th>
                <th scope="col" >Note Clock In</th>
                <th scope="col" >Clock In</th>
                <th scope="col" >Clock Out</th>
                <th scope="col" >Description</th>
              </tr>
            </thead>
         
            <tbody class="table-content">
              @forelse ($prs as $presensi)
              <tr class="isi" @if($presensi->presensi_status === 'Off') style="color: red;" @endif>

                  <td class="nomor">{{ $loop->iteration }}.</td>
                  <td class="name" ><a href="{{ Storage::disk('ftp_server')->url('1230215003_2023-09-05_09:54:52.png') }}">Download File</a></td>
                  <td><img src="{{ Storage::disk('ftp_server')->url('/tesfirman/1230215003_2023-09-05_09:54:42.png') }}" class="img-attendance" ></td>

                  <td class="name" >{{ $presensi->preskaryawan->nama_lengkap}}</td>
                  <td class="nik">{{ $presensi->preskaryawan->nomor_induk_karyawan }}</td>
                  <td class="branch">{{ $presensi->preskaryawan->cabang->nama }}</td>
                  <td class="position">{{ $presensi->preskaryawan->jabatan->nama }}</td>
                  <td class="position">{{ date('d-m-Y',strtotime($presensi->tanggal)) }}</td>
                  <td class="position">{{$presensi->keterangan}}</td>
                  <td class="clock-in">
                  <div class="row row-clock-in">
			<div class="col-4 col-img-attendance">
			 @if(empty($presensi->jam_masuk))
                    @else
                    <img src="{{ asset('storage/presensi/' . $presensi->image_masuk) }}" class="img-attendance" >
                        </div>
                        <div class="col-7 col-text">
			{{substr($presensi->jam_masuk, 10, 20)}}
			@endif
                        </div>
                    </div>
                  </td>
                  <td class="clock-out">
                  <div class="row row-clock-out">
			<div class="col-4 col-img-attendance">
			 @if(empty($presensi->jam_pulang))
                    @else
                    <img src="{{ asset('storage/presensi/' . $presensi->image_pulang) }}" class="img-attendance" >
                        </div>
                        <div class="col-7 col-text">
			{{substr($presensi->jam_pulang, 10, 20)}}
			@endif
                        </div>
                    </div>
                  </td>
                  <td class="desk">{{ $presensi->presensi_status }}</td>
                  @empty
                  <div class="alert alert-danger">
                      Data belum Tersedia.
                  </div>
             @endforelse
            </tbody>
            </div>
          </table>
          <div class="mb-2">
                    showing
                    {{$prs->firstItem()}}
                    to
                    {{$prs->lastItem()}}
                    of
                    {{$prs->total()}}
                    entries
                  </div>
                <div class="d-flex">
                    {!! $prs->links() !!}
                </div>
            </div>
        </div>
      </div>

      <!--Modal-->
    <div class="modal fade" id="todayPresensi" tabindex="-1" role="dialog" aria-labelledby="todayLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id=todayLabel></h4>
          </div>
            <div class="modal-body modal-daily" id="todaydata">

            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">Close</button>
          </div>
        </div>
      </div>     
	  </div>
    </div>
    
    @include('presensi.partials.scripts')
    
@endsection



