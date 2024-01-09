@extends('layouts.app-master')

@section('content')
    <div class="branch">
        <div class="container">
        <h5 class="title-branch">Lists Shifting</h5>
        <hr class="border"></hr>
		<div class="table-body">
            <h5 class="list-branch">Lists Shifting</h5>
            <div class="search-branch">
                <form action="/shift" method="GET" class="search">
                  <h6 class="list-applicant" style="font-size: 14px;">Search Employees</h6>
                  <div class="input-group group-search">
                    <input type="text" class="custom form-control form-control-sm col-form-input-4" name="search" value="{{request('search')}}" placeholder="Search Employees Attendance" required>
                    <input type="submit" class="btn btn-primary btn-sm btn-search col-auto" value="search">
                  </div>
                </form>
              </div>
            <button class="btn btn-sm btn-add mb-3 btn-export" data-toggle="modal" data-target="#exampleModalexport" data-whatever="@mdo"><i class="fas fa-upload"></i> Export Shift</button>
            <button class="btn btn-sm btn-add mb-3 mr-3 btn-import" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-download"></i> Import Shift</button>

            <div class="srcl-branch">
			<table class="table data-table">
				<thead>

				<tr class="judul">
				    <th scope="col">No</th>
				    <th scope="col">Dates</th>
				    <th scope="col">Employee Name</th>
				    
            @foreach($dateRange as $date)
				    <th scope="col">
              {{ date('d-m-Y', strtotime($date)) }}
            </th>
            @endforeach
				</tr>
				</thead>
@if($errors->any())
<h5 style="color:red"> Maaf Cek Data Anda,, Data Anda ada yang Kosong</h5>
@foreach ($errors->all() as $error)
<ol>
  <li>{{$error}}</li>
</ol>
@endforeach
@endif
  <tbody>

    @forelse ($shift as $sh)
        <tr class="isi">
            <td class="nomor">{{ $loop->iteration }}.</td>
            <td class="nama">{{ $sh->nama_lengkap}}</td>
            <td class="nama">{{ $sh->nomor_induk_karyawan}}</td>
              @foreach ($absen as $item)
                  @if($item->nomor_induk_karyawan == $sh->nomor_induk_karyawan)
                  <td>{{$item->shift}}</td>
                  @endif
              @endforeach
            
        </tr>
      @empty
          <div class="alert alert-danger">
              Data belum Tersedia.
          </div>
      @endforelse

<!--     
    @foreach($shift as $inf)
    
    @if(isset($absen))
     @if($inf->nomor_induk_karyawan == '108221485')
         ada
     @else
         No Match
     @endif
 @endif  
@endforeach -->
  </tbody>

				
		 </table>
	  <div class="d-flex">
              {!! $shift->links() !!}
          </div>
             </div>
                </div>
         </div>
    </div>
    


<!-- Modal Import -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Shift</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('shift.shiftimport') }}" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
            <div class="mb-3 row row-body"></div>
                <div class="input-group mb-3">
                    <div class="custom-file">
                    <input type="file"   accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="file" >
                        <!-- <input  type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  class="custom-file-input" id="inputGroupFile01" name="file">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label> -->
                    </div>
                </div>
            </div> 
        <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-md btn-primary">Import</button>
      </div>
    </div>
  </div>
</form>
</div>
<!-- Akhir Modal Import -->

<!-- Modal Export -->
<div class="modal fade" id="exampleModalexport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Shift</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/shift/shiftexport" method="GET" class="report">
      @csrf
      <div class="modal-body">
        <!-- Coba -->
        <div class="mb-3 row row-body">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">Start Date <span class="wajib">* :</span></label>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <input type="date" class="form-control form-control-sm col-form-input" name="startdate" value="{{request('startdate')}}">
            </div>
        </div>              
        <div class="mb-3 row row-body">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">End Date <span class="wajib">* :</span></label>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <input type="date" class="form-control form-control-sm col-form-input " name="enddate" value="{{request('enddate')}}">
            </div>
        </div>         
	<!-- Akhir Coba -->
        <div class="mb-3 row row-body">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">End Date <span class="wajib">* :</span></label>
          <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <select class="form-control form-control-sm col-form-input-1" id="cabang" name="cabang">
              @foreach ($cabang as $cab)
              <option value="{{ $cab->id }}">{{ $cab->nama }}</option>
              @endforeach
		        </select>
          </div>
        </div>         
 
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Export</button>
      </div>
    </div>
    <form>
  </div>
</div>
<!-- Akhir Modal Export -->



@endsection

