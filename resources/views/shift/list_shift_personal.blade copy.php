@extends('layouts.app-master')

@section('content')
<div class="branch">
  <div class="container">
    <h5 class="title-branch">Shifting</h5>
    <hr class="border"></hr>
    <div class="table-body">
      <div class="mb-1 tab">
        <div id="nav_atas" style="display: block;">
            <ul class="nav text-dark">
              <li class="nav-item">
                  <a class="nav-link tablinks" onclick="tabGeneral(event, 'request')" id="defaultOpen">Request</a>
              </li> 
              <li class="nav-item">
                  <a class="nav-link tablinks" onclick="tabGeneral(event, 'history')">History Request</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link tablinks"  onclick="tabGeneral(event, 'shift')">Shift</a>
              </li>
            </ul>
        </div>
      </div>

      <div class="tabcontent" id="shift">
        <div class="container">
          <div class="row">
            <div class="srcl-branch">
              <table class="table data-table">
                <thead>
                  <tr class="judul">
                    <th scope="col">No</th>
                    <th scope="col">Nik</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Shift</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($data as $sh)
                  <tr class="isi">
                    <td class="nomor">{{ $loop->iteration }}.</td>
                    <td class="nama">{{ $sh->nomor_induk_karyawan}}</td>
                    <td class="nama">{{ $sh->nama_lengkap}}</td>
                    <td class="nama">{{ $sh->tanggal}}</td>
                    <td class="nama">{{ $sh->jenis_shift}}</td>
                  </tr>
                  @empty
                    <div class="alert alert-danger">
                      Data belum Tersedia.
                    </div>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="tabcontent" id="request">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-sm btn-add mb-3" onClick="create()">Change Shift</button>
            </div>
            <div class="col-md-12">
              <div id="change" class="mt-3"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="tabcontent" id="history">
        <div class="container">
          <div class="row">
            <div id="historyrequest" class="mt-3"></div>
          </div>
        </div>
      </div>

      

      <!-- Modal -->
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <div class="modal fade" id="changeshift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" onClick="Close()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="pagechange" class="p-2"></div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
<script type="text/javascript">

$(document).ready(function(){
read();
requestshift();
});

//Membuat Halaman Modal Dan Form Create
function create() {
  $.get("{{ url('/shift/karcreate') }}",{}, 
  function(data,status){
    $("#exampleModalLabel").html('Change Shift');
    $("#pagechange").html(data);
    $("#changeshift").modal('show');    
  });
} 
//Membuat Halaman Read Data
function read() {
    $.get("{{ url('/shift/shiftkar') }}",{},
  function(data,status){
    $("#pagechange").html(data);
  });
}

function requestshift() {
$.get("{{ url('/shift/requestshift') }}",{}, 
    function(data,status){
$("#change").html(data);
    });
}

// Close odal
function Close() {
  $("#changeshift").modal("hide");
} 
//Membuat Untuk Simpan Data Dari Modal Form Create
function store(){
  event.preventDefault();
    var form = $('#myform')[0];
    var formData = new FormData(form);
    console.log("ini datanya = ", formData)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      url:"{{ url('shift/storechangeshift') }}",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      type: 'POST',
      success:function(data){
        //$("#close-button").click();
        $("#pagechange").html('');
        $("#changeshift").modal("hide");
        requestshift();
        alert(data.message);
      },
        error:function(request, error){
         var err = JSON.parse(request.responseText);
         alert(err.message);
      }
    });
}
</script>

<script> 
// Tab
document.getElementById("request").style.display="block"
document.getElementById("defaultOpen").click(); 

function tabGeneral(evt, tab) {
  var i, tabcontent, tablinks, hide_nav, nav_atas;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tab).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection
