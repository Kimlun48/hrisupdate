@extends('layouts.app-master')

@section('content-employ')
<div class="aproval">
  <div class="head">
    <h5 class="title-employ">Approval Admin</h5>
  </div>
  <div class="container">
    <div class="table-body">
      <div class="tab ">
        <ul class="nav head-tab text-dark text-uppercase">
          <li class="nav-item active">
            <a class="nav-link tablinks active" for="main-tab-1" href="#" data-tab="readdata">
              Attendance
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link tablinks" href="#" data-tab="readall">
              Time Off
            </a>

          </li>
          <li class="nav-item">
            <a class="nav-link tablinks" href="#" data-tab="approvalreqshift">
              Change Shift
            </a>

          </li>
          <li class="nav-item">
            <a class="nav-link tablinks" href="#" data-tab="leadindexovertime">
              Overtime
            </a>

          </li>
          <!-- Add other tab links here -->
        </ul>
      </div>
      <div class="border mt-3">
        {{-- sub menu Attandace --}}

            <div class="sub-menu " id="sub-menu-readdata">
              <a class="btn sub-menu-item" data-tab="readdata">Request</a>
              <a class="btn sub-menu-item" data-tab="attend_approve">Approve</a>
              <a class="btn sub-menu-item" data-tab="attend_reject">Reject</a>
            </div>
        {{-- sub menu time off --}}
        <div class="sub-menu" id="sub-menu-readall">
          <a class="btn sub-menu-item" data-tab="readall">Request</a>
          <a class="btn sub-menu-item" data-tab="timeoff_approve">Approve</a>
          <a class="btn sub-menu-item" data-tab="timeoff_reject">Reject</a>
        </div>

        {{-- sub menu Change Shift --}}
        <div class="sub-menu" id="sub-menu-approvalreqshift">
          <a class="btn sub-menu-item" data-tab="approvalreqshift">Request</a>
          <a class="btn sub-menu-item" data-tab="changeshift_approve">Approve</a>
          <a class="btn sub-menu-item" data-tab="changeshift_reject">Reject</a>
        </div>

        {{-- sub menu overtime --}}
        <div class="sub-menu" id="sub-menu-leadindexovertime">
          <a class="btn sub-menu-item" data-tab="leadindexovertime">Request</a>
          <a class="btn sub-menu-item" data-tab="overtime_approve">Approve</a>
          <a class="btn sub-menu-item " data-tab="overtime_reject">Reject</a>
        </div>

        <div id="tab-content"></div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	      <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="page" class="p-2"></div>
      </div>
    </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk menampilkan submenu sesuai dengan tab yang aktif
    function showSubMenu(tabId) {
      // Sembunyikan semua submenu terlebih dahulu
      document.querySelectorAll('.sub-menu').forEach(function(subMenu) {
        subMenu.style.display = 'none';
      });

      // Tampilkan submenu yang sesuai dengan tab yang aktif
      var subMenuId = 'sub-menu-' + tabId;
      var activeSubMenu = document.getElementById(subMenuId);
      if (activeSubMenu) {
        activeSubMenu.style.display = 'block';
      }
    }

    

    // Tambahkan event listener untuk setiap tab
    document.querySelectorAll('.tablinks').forEach(function(tab) {
      tab.addEventListener('click', function(event) {
        var tabId = event.target.getAttribute('data-tab');
        showSubMenu(tabId);
      });
    });

    // Tampilkan submenu untuk tab pertama saat halaman dimuat
    var initialTabId = 'readdata';
    showSubMenu(initialTabId);
  });
</script>


<script>
  $(document).ready(function () {
    // Define a map of tabs to their corresponding routes
    var tabToRoute = {
      'readdata': '/reqattend/readdata_admin',
      'readall': '/timeoff/readall',
      'approvalreqshift': '/shift/approvalreqshift_admin',
      'leadindexovertime': '/ovtime/leadindexovertime_admin',
      'attend_approve': '/reqattend/log_attendance_approve',
      'attend_reject': '/reqattend/log_attendance_reject',
      'timeoff_approve': '/reqattend/log_timeoff_approve',
      'timeoff_reject': '/reqattend/log_timeoff_reject',
      'changeshift_approve': '/reqattend/log_changeshift_approve',
      'changeshift_reject': '/reqattend/log_changeshift_reject',
      'overtime_approve': '/reqattend/log_overtime_approve',
      'overtime_reject': '/reqattend/log_overtime_reject',
      // Add other tabs and routes here
    };

    // Load the content for the default tab (Attendance)
    loadTabContent('readdata', 1);

    // Tangani klik tab
    $('.nav a, .sub-menu-item').click(function (e) {
      e.preventDefault();
      var tab = $(this).data('tab');
      $('.nav a, .sub-menu-item').removeClass('active');
      $(this).addClass('active');
      loadTabContent(tab, 1);

      // Sembunyikan semua sub-menu dan tampilkan sub-menu untuk tab yang aktif
      // $('.sub-menu').hide();
      // $('#' + 'sub-menu-' + tab).show();
    });

    function loadTabContent(tab, page) {
      var route = tabToRoute[tab]; // Dapatkan rute yang sesuai untuk tab
      if (route) {
        $.ajax({
          url: route + '?page=' + page,
          type: 'GET',
          success: function (response) {
            $('#tab-content').html(response);
            // setupPagination(tab); // Set up pagination untuk konten yang dimuat
          },
          error: function (error) {
            console.error(error);
          },
        });
      }
    }



  });
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
<script type="text/javascript">



// Close odal
function Close() {
  $("#exampleModal").modal("hide");
} 

// approval attendance
/////APPROVE///////
function showattend(id) {
  $.get("{{ url('/reqattend/showupdate') }}/"+id,{}, 
  function(data,status){
    $("#exampleModalLabel").html('Approve Req Attend');
    $("#page").html(data);
    $("#exampleModal").modal('show');    
  });
}

//Membuat Untuk Simpan Data Dari Modal Form Update(approve)
function approve(id){
event.preventDefault();
  var form = $('#approveform')[0];
  var formData = new FormData(form);
  // console.log("ini datanya = ", formData)
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('reqattend/approve') }}/"+id,
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success:function(data){
      $("#page").html('');
      $("#exampleModal").modal("hide");
      reqattend();
      // console.log("ini data 2",data);
    },
      error:function(data){
        // console.log('ini error ==',data);
    }
  });
}

/////REJECTTT///////
function showrejectattend(id) {
  $.get("{{ url('/reqattend/showreject') }}/"+id,{}, 
  function(data,status){
    $("#exampleModalLabel").html('Reject Request Attendance');
    $("#page").html(data);
    $("#exampleModal").modal('show');    
  });
} 
//Membuat Untuk Simpan Data Dari Modal Form Update(approve)
function rejectattend(id){
event.preventDefault();
  var form = $('#rejectform')[0];
  var formData = new FormData(form);
  console.log("ini datanya = ", formData)
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('reqattend/reject') }}/"+id,
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success:function(data){
      $("#page").html('');
      $("#exampleModal").modal("hide");
      reqattend();
      console.log("ini data 2",data);
    },
      error:function(data){
        console.log('ini error ==',data);
    }
  });
}

// approval timeoff
/////APPROVE///////
function show(id) {
$.get("{{ url('/timeoff/showupdate') }}/"+id,{}, 
function(data,status){
$("#exampleModalLabel").html('Approve Times Off');
$("#page").html(data);
$("#exampleModal").modal('show');    
});
} 

//Membuat Untuk Simpan Data Dari Modal Form Update(approve)
function approvetimeoff(id){
event.preventDefault();
var form = $('#approveform')[0];
var formData = new FormData(form);
console.log("ini datanya = ", formData)
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
  url:"{{ url('timeoff/approve') }}/"+id,
  data: formData,
  cache: false,
  processData: false,
  contentType: false,
  type: 'POST',
  success:function(data){
    $("#page").html('');
    $("#exampleModal").modal("hide");
    readall();
    tabToRoute('readall');
    // console.log("ini data 2",data);
    // console.log('ini iddd==',data['note'])
  },
    error:function(data){
      // console.log('ini iddd==',note)
      // console.log('ini error ==',data);
  }
    });
  }

/////REJECTTT///////
function showreject(id) {
$.get("{{ url('/timeoff/showreject') }}/"+id,{}, 
      function(data,status){
  $("#exampleModalLabel").html('Reject Times Off');
        $("#page").html(data);
        $("#exampleModal").modal('show');    
});
} 
//Membuat Untuk Simpan Data Dari Modal Form Update(approve)
function reject(id){
event.preventDefault();
  var form = $('#rejectform')[0];
  var formData = new FormData(form);
  console.log("ini datanya = ", formData)
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('timeoff/reject') }}/"+id,
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success:function(data){
      $("#page").html('');
      $("#exampleModal").modal("hide");
      reqtimeoff();
      // console.log("ini data 2",data);
      // console.log('ini iddd==',data['note'])
    },
      error:function(data){
        // console.log('ini iddd==',note)
        // console.log('ini error ==',data);
    }
  });
}

// approval changeshift
/////APPROVE///////
function showapproveshift(id) {
$.get("{{ url('/shift/showupdate') }}/"+id,{}, 
function(data,status){
$("#exampleModalLabel").html('Approve Change shift');
$("#page").html(data);
$("#exampleModal").modal('show');    
});
} 

//Membuat Untuk Simpan Data Dari Modal Form Update(approve)
function approvechangeshift(id){
event.preventDefault();
var form = $('#approvechangeshift')[0];
var formData = new FormData(form);
console.log("ini datanya = ", formData)
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
  url:"{{ url('shift/approve') }}/"+id,
  data: formData,
  cache: false,
  processData: false,
  contentType: false,
  type: 'POST',
  success:function(data){
    $("#page").html('');
    $("#exampleModal").modal("hide");
    reqchangeshift();

  },
    error:function(data){

  }
    });
  }

/////REJECTTT///////
function showrejectshift(id) {
$.get("{{ url('/shift/showreject') }}/"+id,{}, 
function(data,status){ 
  $("#exampleModalLabel").html('Reject Change Shift');
  $("#page").html(data);
  $("#exampleModal").modal('show');    
});
} 

//Membuat Untuk Simpan Data Dari Modal Form Update(approve)
function rejectchangeshift(id){
event.preventDefault();
  var form = $('#rejectchangeshift')[0];
  var formData = new FormData(form);
  console.log("ini datanya = ", formData)
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('shift/reject') }}/"+id,
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success:function(data){
      $("#page").html('');
      $("#exampleModal").modal("hide");
      reqchangeshift();

    },
      error:function(data){
 
    }
  });
}


// Untuk Overtime


// approval Overtime
/////APPROVE///////
function approveovertime(id) {
  $.get("{{ url('/ovtime/showupdate') }}/"+id,{}, 
  function(data,status){
    $("#exampleModalLabel").html('Approve OverTime');
    $("#page").html(data);
    $("#exampleModal").modal('show');    
  });
}

//Membuat Untuk Simpan Data Dari Modal Form Update(approve)
function approveovtime(id){
event.preventDefault();
  var form = $('#approveform')[0];
  var formData = new FormData(form);
  console.log("ini datanya = ", formData)
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('ovtime/overtimeapproval') }}/"+id,
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success:function(data){
      $("#page").html('');
      $("#exampleModal").modal("hide");
      reqover();
      console.log("ini data 2",data);
    },
      error:function(data){
        console.log('ini error ==',data);
    }
  });
}

/////REJECTTT///////
function rejectovertime(id) {
  $.get("{{ url('/ovtime/showreject') }}/"+id,{}, 
  function(data,status){
    $("#exampleModalLabel").html('Reject Request OverTime');
    $("#page").html(data);
    $("#exampleModal").modal('show');    
  });
} 
//Membuat Untuk Simpan Data Dari Modal Form Update(approve)
function rejectattend(id){
event.preventDefault();
  var form = $('#rejectform')[0];
  var formData = new FormData(form);
  console.log("ini datanya = ", formData)
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('ovtime/reject') }}/"+id,
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success:function(data){
      $("#page").html('');
      $("#exampleModal").modal("hide");
      reqover();
      console.log("ini data 2",data);
    },
      error:function(data){
        console.log('ini error ==',data);
    }
  });
}


/////Detaik///////
function detailovertime(id) {
  $.get("{{ url('/ovtime/detail') }}/"+id,{}, 
  function(data,status){
    $("#exampleModalLabel").html('Detail Request OverTime');
    $("#page").html(data);
    $("#exampleModal").modal('show');    
  });
} 
</script>

@endsection

