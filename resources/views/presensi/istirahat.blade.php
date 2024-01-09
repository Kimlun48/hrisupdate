@extends('layouts.app-master')

@section('content')
    <div class="attendance">
      
      <h5 class="title-vacancy">Employees Break Time</h5>
      <hr class="border"></hr>

      <div class="card card-attendance">
      <div class="container container-card-attendance">
        <div class="row row-card-attendance">

          <div class="col-sm-5 col-card-attendance">
            <h5 class="text-title-1">This shows daily data in real-time</h5>
            <h5 class="text-title-2"><span id="time"></span></h5>
          </div>

          <div class="col-sm col-card-attendance">
            <div class="card card-content">
              <h5 class="text-content-1">Out</h5>
              <h5 class="text-content-3">{{$out}}</h5>
            </div>
          </div>
          <div class="col-sm col-card-attendance">
            <div class="card card-content">
              <h5 class="text-content-1">In</h5>
              <h5 class="text-content-3">{{$in}}</h5>
            </div>
          </div>
        
        </div>
      </div>
    </div>
      
      <div class="content-attendance">
        <div class="table-body">
          <h5 class="list-attendance">List Employees Break Time</h5>

              <div class="search-attendance">
                <form action="/presensi" method="GET" class="search">
                  <h6 class="list-applicant" style="font-size: 14px;">Search Break Time</h6>
                  <div class="input-group group-search">
                    <input type="text" class="custom form-control form-control-sm col-form-input-4" name="search" value="{{request('search')}}" placeholder="Search Employees Attendance" required>
                    <input type="submit" class="btn btn-primary btn-sm btn-search col-auto" value="search">
                  </div>
                </form>
              </div>

              <div class="export-attendance">
              <h6 class="export-list" style="font-size: 14px;">Export Employees Break Time</h6>
              <form action="/presensi" method="GET" class="report">
                <div class="input-group group-export">
                  <input type="date" class="form-control form-control-sm col-form-input-1" name="startdate" value="{{request('startdate')}}" required>
                  <input type="date" class="form-control form-control-sm col-form-input-2" name="enddate" value="{{request('enddate')}}" required>
                    <select class="form-control form-control-sm col-form-input-3 " id="cabang" name="cabang" required>
                      <option value="">Select Branch</option>
                      @foreach($cabang as $cbg)
                      <option value="{{$cbg->id}}">{{$cbg->nama}}</option>
                      @endforeach
                    </select> 
                    <input class="form-control form-control-sm col-form-input-5" type="text" list="nama-datalist" placeholder="Search Name Employees" id="cari" name="cari" value="{{request('cari')}}">
                      <datalist id="nama-datalist">
                        @foreach (session('nama-datalist') as $krs)
                        <option value="{{$krs->preskaryawan->nama_lengkap}}">{{$krs->preskaryawan->nama_lengkap}}</option>
                        @endforeach
                      </datalist>
                        <select class="custom form-control form-control-sm col-form-input-4" name="format" value="{{request('format')}}" required>
                          <option option value="">Select Option</option>
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
                <th scope="col" class="tambah"></th>
                <th scope="col" >No</th>
                <th scope="col" >Employee Name</th>
                <th scope="col" >NIK</th>
                <th scope="col" >Branch</th>
                <th scope="col" >Position</th>
                <th scope="col" class="dates" >Date</th>
                <th scope="col" class="clock-ins">In</th>
                <th scope="col" class="clock-outs">Out</th>
                <th scope="col" class="desks" hidden>fotomasuk</th>
                <th scope="col" class="desks" hidden>fotokeluar</th>
              </tr>
            </thead>
         
            <tbody class="table-content">
              @forelse ($prs as $key => $presensi)
                <!-- <tr class="isi"> -->
                <tr class="isi">
                  <td class="tambah">
                     <button class="tombol">
                        <i class="fas fa-plus"></i>
                     </button>
                  </td>
                  <td class="nomor">{{ $prs->firstItem() + $key }}.</td>
                  <td class="name" >{{$presensi->preskaryawan->nama_lengkap}}</td>
                  <td class="nik">{{ $presensi->preskaryawan->nomor_induk_karyawan }}</td>
                  <td class="branch">{{ $presensi->preskaryawan->cabang->nama }}</td>
                  <td class="position">{{ $presensi->preskaryawan->jabatan->nama }}</td>
                  <td class="date">{{ date('d-m-Y',strtotime($presensi->tanggal)) }}</td>
                  <td class="clock-in">
                     <div class="row row-clock-in">
                        <div class="col-text">
                           {{substr($presensi->istirahat_keluar, 10, 20)}}
                        </div>
                     </div>
                  </td>
                  <td class="clock-out">
                     <div class="row row-clock-out">
                        <div class="col-7 col-text">
                           {{substr($presensi->istirahat_masuk, 10, 20)}}
                        </div>
                     </div>
                  </td>
               @empty
               <div class="alert alert-danger" style="margin-top:50px;">
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
    


    <style>

table tr.child-row td {
   display: none;  
   
}

table tr.active + tr.child-row td {
   display: table-cell;
   width: 15%;
}

table.child {
 caption-side: bottom;
 border-collapse: collapse;
 margin-left: 77px;
}

.tombol{
     background-color: #0b3ab1;
      color: #fff;      
      font-size: 6px;
      padding: 0px 5px;
      margin-top: 2px;
   }

.id{
padding-top: 15px;
}
.nik{
padding-top: 15px;
}
.c{
   padding-top: 15px;
}
.posisi{
   padding-top: 15px;
}

.images {
    height: 40px;
    width: 40px;
    border: 1px solid #999999;
    border-radius: 50%;
}
.table>tbody>tr.active>td{
  background: none;
  font-family: "Nunito Sans";
    font-style: normal;
    font-weight: 400;
    font-size: 13px;
    line-height: 19px;
    color: #000000;
    
}  


@media screen and (min-width: 1181px) {

table tr.child-row td {
display: none;  

}

table tr.active + tr.child-row td {
display: table-cell;

}

.tambah{
   display: none;
}

.tombols{
   display: none;
}

.child {
   display: none;
}

.table>tbody>tr.active>td{
   background: none;
}

.table tr.active + tr.child-row td {
display: none;
background: none;
}

} 

</style>
<script>
var toggleBtns = document.querySelectorAll('.tombol');
for (var i = 0; i < toggleBtns.length; i++) {
toggleBtns[i].addEventListener('click', function() {
 // get parent row
 var parentRow = this.closest('tr');
 // check if child-row element already exists
 var childRow = parentRow.nextSibling;
 if (childRow && childRow.classList.contains('child-row')) {
   // if it does, remove it and remove the 'active' class from the parent row
   parentRow.parentNode.removeChild(childRow);
   parentRow.classList.remove('active');
   // change button icon
   this.innerHTML = '<i class="fas fa-plus"></i>';
 } else {
   // if it doesn't exist, create the child-row ele
              
   childRow = document.createElement('tr');
   var childCell = document.createElement('td');
   childCell.colSpan = 20;
   childCell.innerHTML = 
     '<table class="child">'+
       '<tr class="judul">'+
         '<td class="dates2">Date</td>'+
         '<td class="keterangans2">Note Clock In</td>'+
         '<td class="clock-ins2">Clock in</td>'+
         '<td class="clock-outs2">Clock Out</td>'+
         '<td class="desks2">Description</td>'+
       '</tr>'+
       '<tr class="isi">'+
         '<td class="date2">'+ parentRow.cells[6].innerText +'</td>'+
         '<td class="keterangan2">'+ parentRow.cells[7].innerText +'</td>'+
         '<td class="clock-in2"><img class="images" src='+"/storage/presensi/"+parentRow.cells[11].innerText+'>'+ parentRow.cells[8].innerText +'</td>'+
         '<td class="clock-in2"><img class="images" src='+"/storage/presensi/"+parentRow.cells[12].innerText+'>'+ parentRow.cells[9].innerText +'</td>'+
        //  '<td class="clock-out2">'+ parentRow.cells[9].innerText +'</td>'+
         '<td class="desk">'+ parentRow.cells[10].innerText +'</td>'+
         '</td>'+
       '</tr>'+
     '</table>';
   childRow.appendChild(childCell);
   childRow.classList.add('child-row');
   parentRow.parentNode.insertBefore(childRow, parentRow.nextSibling);
   parentRow.classList.add('active');
   // change button icon
   this.innerHTML = '<i class="fas fa-minus"></i>';
 }
});
}

</script>

@endsection
