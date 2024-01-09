@extends('layouts.app-master')

@section('content-employ')
<div class="aproval">
  <div class="head">
    <h5 class="title-employ">Approval</h5>
  </div>
  <div class="container">
    <div class="table-body">

      <div class="tab">
        <ul class="nav head-tab text-dark text-uppercase">
          <li class="nav-item">
            <a class="nav-link tablinks active" href="#" data-tab="readdata">
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
          <li class="nav-item">
            <a class="nav-link tablinks" href="#" data-tab="loghistory">
              Log History
            </a>
          </li>
          <!-- Add other tab links here -->
        </ul>
      </div>

      <!-- Sub-menu for Log History -->
      <div id="loghistory-submenu" style="display: none;">
        <ul class="nav subtab text-dark text-uppercase">
          <li class="nav-item">
            <a class="nav-link subtablinks active" href="#" data-subtab="subtab1">
              Attendance
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link subtablinks" href="#" data-subtab="subtab2">
              Time Off
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link subtablinks" href="#" data-subtab="subtab3">
              Change Shift
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link subtablinks" href="#" data-subtab="subtab4">
              OverTime
            </a>
          </li>
          <!-- Add other sub-tab links here -->
        </ul>
      </div>

      <div id="subtab-content"></div>
      <div id="tab-content"></div>

    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    // Define a map of tabs to their corresponding routes
    var tabToRoute = {
      'readdata': '/reqattend/readdata',
      'readall': '/timeoff/readall',
      'approvalreqshift': '/shift/approvalreqshift',
      'leadindexovertime': '/ovtime/leadindexovertime',
      'loghry': '/loghistory', // Add route for Log History
      // Add other tabs and routes here
    };

    // Define a map of sub-tabs to their corresponding routes
    var subtabToRoute = {
      'subtab1': '/reqattend/log_attendance',
      'subtab2': '/reqattend/log_timeoff',
      'subtab3': '/reqattend/log_changeshift',
      'subtab4': '/reqattend/log_overtime',
      // Add other sub-tabs and routes here
    };

    // Load the content for the default tab (Attendance)
    loadTabContent('readdata', 1);

    // Handle tab clicks
    $('.nav a').click(function (e) {
      e.preventDefault();
      var tab = $(this).data('tab');
      $('.nav a').removeClass('active'); // Remove active class from all tabs
      $(this).addClass('active'); // Add active class to the clicked tab

      // Hide sub-menu for Log History for other tabs
      if (tab !== 'loghistory') {
        $('#loghistory-submenu').hide();
        loadTabContent(tab, 1); // Load content for the clicked tab
      } else {
        $('#loghistory-submenu').show(); // Show sub-menu for Log History
        loadSubTabContent('subtab1'); // Load content for the default sub-tab (attendance)
      }
    });

    // Handle sub-tab clicks
    $('.subtab a').click(function (e) {
      e.preventDefault();
      var subtab = $(this).data('subtab');
      $('.subtab a').removeClass('active'); // Remove active class from all sub-tabs
      $(this).addClass('active'); // Add active class to the clicked sub-tab
      loadSubTabContent(subtab); // Load content for the clicked sub-tab
    });

    function loadTabContent(tab, page) {
      var route = tabToRoute[tab]; // Get the corresponding route for the tab
      if (route) {
        $.ajax({
          url: route + '?page=' + page,
          type: 'GET',
          success: function (response) {
            $('#subtab-content').html(''); // Clear sub-tab content when switching tabs
            $('#subtab-content').hide(); // Hide sub-tab content when switching tabs
            $('#subtab-content').show(); // Show sub-tab content when switching tabs
            $('#tab-content').html(response);
            setupPagination(tab); // Set up pagination for the loaded content
          },
          error: function (error) {
            console.error(error);
          },
        });
      }
    }

    function loadSubTabContent(subtab) {
      var route = subtabToRoute[subtab]; // Get the corresponding route for the sub-tab
      if (route) {
        $.ajax({
          url: route,
          type: 'GET', // Use POST method for logging attendance, timeoff, changeshift, overtime
          success: function (response) {
            $('#subtab-content').html(response);
          },
          error: function (error) {
            console.error(error);
          },
        });
      }
    }
  });
</script>




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
  $(document).ready(function () {
    // Define a map of tabs to their corresponding routes
    var tabToRoute = {
      'readdata': '/reqattend/readdata',
      'readall': '/timeoff/readall',
      'approvalreqshift': '/shift/approvalreqshift',
      'leadindexovertime': '/ovtime/leadindexovertime',
      // Add other tabs and routes here
    };

    // Load the content for the default tab (Attendance)
    loadTabContent('readdata', 1);

    // Handle tab clicks
    $('.nav a').click(function (e) {
      e.preventDefault();
      var tab = $(this).data('tab');
      $('.nav a').removeClass('active'); // Remove active class from all tabs
      $(this).addClass('active'); // Add active class to the clicked tab
      loadTabContent(tab, 1); // Load content for the clicked tab
    });

    function loadTabContent(tab, page) {
      var route = tabToRoute[tab]; // Get the corresponding route for the tab
      if (route) {
        $.ajax({
          url: route + '?page=' + page,
          type: 'GET',
          success: function (response) {
            $('#tab-content').html(response);
            // setupPagination(tab); // Set up pagination for the loaded content
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
  console.log("ini datanya = ", formData)
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
      console.log("ini data 2",data);
    },
      error:function(data){
        console.log('ini error ==',data);
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
    console.log("ini data 2",data);
    console.log('ini iddd==',data['note'])
  },
    error:function(data){
      console.log('ini iddd==',note)
      console.log('ini error ==',data);
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
      console.log("ini data 2",data);
      console.log('ini iddd==',data['note'])
    },
      error:function(data){
        console.log('ini iddd==',note)
        console.log('ini error ==',data);
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

