@extends('layouts.app-master')

@section('content-employ')
<div class="resign-employ">
  <div class="container">
    <div class="row">
      <div class="head-title col-md-6">
        <h5 class="title-employ">List Time Off</h5>
      </div>
    </div>
  </div>
</div>

<div class="body-resign mt-3">
  <div class="container">
    <div class="row">
      <div class="table-body mb-3">
        <div class="tab mt-3">
          <ul class="nav head-tab text-dark text-uppercase">
            <li class="nav-item">
              <a class="nav-link tablinks active" href="#" data-tab="readall">                    
                All Request 
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link tablinks" href="#" data-tab="readallapprove">
                  History Request Approve
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link tablinks" href="#" data-tab="readallreject">
                  History Request Reject
                </a>
            </li>
            <!-- Add other tab links here -->
          </ul>
        </div>
        <div id="tab-content" ></div>
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



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
<script>
  $(document).ready(function () {
    // Load the content for the default tab (Request Resign)
    loadTabContent('readall', 1);
    
    // Handle tab clicks
    $('.nav a').click(function (e) {
      e.preventDefault();
      var tab = $(this).data('tab');
      $('.nav a').removeClass('active'); // Remove active class from all tabs
      $(this).addClass('active'); // Add active class to the clicked tab
      loadTabContent(tab, 1); // Load content for the clicked tab
    });
  });

  function loadTabContent(tab, page) {
    $.ajax({
      url: '/timeoff/' + tab + '?page=' + page,
      type: 'GET',
      success: function (response) {
        $('#tab-content').html(response);
        setupPagination(tab); // Set up pagination for the loaded content
      }
    });
  }
</script>
<script type="text/javascript">

// Close Modal
function Close() {
$("#exampleModal").modal("hide");
} 

/////APPROVE///////
//Membuat Halaman Modal Dan Form Show Update
function show(id) {
$.get("{{ url('/timeoff/showupdate') }}/"+id,{}, 
function(data,status){
$("#exampleModalLabel").html('Approve Times Off');
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
  url:"{{ url('timeoff/approve') }}/"+id,
  data: formData,
  cache: false,
  processData: false,
  contentType: false,
  type: 'POST',
  success:function(data){
    $("#page").html('');
    $("#exampleModal").modal("hide");
    read();
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
//Membuat Halaman Modal Dan Form Show reject
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
      read();
      console.log("ini data 2",data);
      console.log('ini iddd==',data['note'])
    },
      error:function(data){
        console.log('ini iddd==',note)
        console.log('ini error ==',data);
    }
      });
    }

</script>


@endsection

