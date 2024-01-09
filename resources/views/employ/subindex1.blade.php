@extends('layouts.app-master')

@section('content')
<div class="employ">
  <div class="container">
    <h5 class="title-employ">List Subordinate</h5>
    <hr class="border">
    <div class="card card-attendance">
      <div class="container container-card-attendance">
        <div class="row row-card-attendance">
          <div class="col-sm-5 col-card-attendance">
            <h5 class="text-title-3">Summary Report</h5>
          </div>
          <div class="col-sm col-card-attendance">
            <div class="card card-content">
              <h5 class="text-content-1">In</h5>
              <h5 onClick="early()" class="text-content-3">0</h5>
            </div>
          </div>
          <div class="col-sm col-card-attendance">
            <div class="card card-content">
              <h5 class="text-content-1">Late</h5>
              <h5 onClick="late()" class="text-content-3">0</h5>
            </div>
          </div>
          <div class="col-sm col-card-attendance">
            <div class="card card-content">
              <h5 class="text-content-1">Attend</h5>
              <h5 onClick="attend()" class="text-content-3">0</h5>
            </div>
          </div>
          <div class="col-sm col-card-attendance">
            <div class="card card-content">
              <h5 class="text-content-1">Cuti</h5>
              <h5 onClick="timeoff()" class="text-content-3">0</h5>
            </div>
          </div>
          <div class="col-sm col-card-attendance">
            <div class="card card-content">
              <h5 class="text-content-1">Sakit</h5>
              <h5 onClick="dayoff()" class="text-content-3">0</h5>
            </div>
          </div>
          <div class="col-sm col-card-attendance">
            <div class="card card-content">
              <h5 class="text-content-1">Izin</h5>
              <h5 onClick="dayoff()" class="text-content-3">0</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="table-body">
      <div class="mb-1 tab">
        <div id="nav_atas" style="display: block;">
          <ul class="nav text-dark">
            <li class="nav-item">
              <a class="nav-link tablinks" onclick="tabGeneral(event, 'presensi');suborabsen();" id="defaultOpen">Presensi Sub</a>
            </li>
            <li class="nav-item">
              <a class="nav-link tablinks" onclick="tabGeneral(event, 'subordinate') ; subor();">Sub Ordinate</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="tabcontent" id="subordinate">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div id="change" class="mt-3"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="tabcontent" id="presensi">
        <div class="container">
          <div class="row">
            <div id="suborabsen" class="mt-3"></div>
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


<script>
$(document).ready(function(){
   suborabsen();
});

function subor(){
  readsubor();
}



function readsubor() {
    $.get("{{ url('/employ/subordinate/') }}",{},
  function(data,status){
    $("#change").html(data);
  });
}

</script>

<script>
  function Close() {
      $("#ModalSP").modal("hide");
  }


  function showsp(id) {
  $.get("{{ url('/employ/showsp/') }}/"+id,{}, 
  function(data,status){
      $("#ModalSPLabel").html('Pengajuan Teguran / Peringatan');
      $("#pagesp").html(data);
      $("#ModalSP").modal('show');
  });
  }

  function storesp(){
  event.preventDefault();
  var form = $('#myform')[0];
  var formData = new FormData(form);
  $('#cover-spin').show(0);
  console.log("ini datanya = ", formData)
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url:"{{ url('/employ/storesp') }}",
    data:formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      // $("#pagesp").html('');
      $("#ModalSP").modal("hide");
      $('#cover-spin').hide();
      $('#pagesp').load('#pagesp');
      Swal.fire({
        icon: 'success',
          title: data.message,
          showDenyButton: false,
          showCancelButton: false,
          confirmButtonText: 'Ok',
          timer: 1500 
      });
    },
      error:function(data){
        
    }
      });
    }

  function cekpasal() {
  var selectBox = document.getElementById('pasal');
  var id = selectBox.options[selectBox.selectedIndex].value;
  $.get("{{ url('/employ/cekpasal/') }}/"+id,{}, 
    function(data,status){
        $("#datapasal").html(data.data.isiayat);
  });
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
<script type="text/javascript">

$(document).ready(function(){
read();
requestshift();
suborabsen();
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
$.get("{{ url('/employ/subordinate/') }}",{}, 
    function(data,status){
$("#change").html(data);
    });
}
function suborabsen() {
$.get("{{ url('/employ/suborabsen') }}",{}, 
    function(data,status){
$("#suborabsen").html(data);
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
document.getElementById("subordinate").style.display="block"
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
