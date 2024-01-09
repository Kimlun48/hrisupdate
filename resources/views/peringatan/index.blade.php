@extends('layouts.app-master')

@section('content-employ')
<div class="peringatan">
  <div class="head">
    <h5 class="title-applicant">Employee Warning Notice List</h5>
  </div>
  <div class="container">
    <div class="table-body mb-3">
      <div class="tab mt-3">
        <ul class="nav head-tab text-dark text-uppercase">
          <li class="nav-item">
            <a class="nav-link tablinks active" href="#" data-tab="readsp">                    
              All Request 
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link tablinks" href="#" data-tab="approve">
                History Request Approve
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link tablinks" href="#" data-tab="reject">
                History Request Reject
              </a>
          </li>
          <!-- Add other tab links here -->
        </ul>
      </div>
      <!-- <button type="button" class="btn btn-primary btn-sm d-flex ms-auto" onClick="create()"><i class="fas fa-plus" style="color:#fff;"></i> Tambah </button> -->
      <div id="read" class="mt-3"></div>
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

<div id="cover-spin"></div>
<style>
    #cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
    display:none;
}

@-webkit-keyframes spin {
	from {-webkit-transform:rotate(0deg);}
	to {-webkit-transform:rotate(360deg);}
}

@keyframes spin {
	from {transform:rotate(0deg);}
	to {transform:rotate(360deg);}
}

#cover-spin::after {
    content:'';
    display:block;
    position:absolute;
    left:48%;top:40%;
    width:40px;height:40px;
    border-style:solid;
    border-color:black;
    border-top-color:transparent;
    border-width: 4px;
    border-radius:50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}
</style>

<script>
  $(document).ready(function () {
    // Load the content for the default tab (Request Resign)
    loadTabContent('readsp', 1);
    
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
      url: '/sp/' + tab + '?page=' + page,
      type: 'GET',
      success: function (response) {
        $('#read').html(response);
        setupPagination(tab); // Set up pagination for the loaded content
      }
    });
  }
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script type="text/javascript">

    $(document).ready(function(){
      read();
    });

  function read() {
        $.get("{{ url('/sp/readsp') }}",{}, 
	    function(data,status){
        $("#read").html(data);
	    });
    }
    // Close Modal
    function Close() {
      $("#exampleModal").modal("hide");
    }     
    //Membuat Halaman Modal Dan Form Create
    function showapp(id) {
        $.get("{{ url('/sp/showapprove') }}/"+id,{}, function(data,status){
            $("#exampleModalLabel").html('Approval SP');
            $("#page").html(data);
            $("#exampleModal").modal('show');    
            // Hide the "reject" button with fade-out animation
            $(".rjct").fadeOut();
        });
    }

    //Membuat Halaman Modal Dan Form Reject
    function showreject(id) {
        $.get("{{ url('/sp/showreject') }}/"+id,{}, function(data,status){
            $("#exampleModalLabel").html('Approval SP');
            $("#page").html(data);
            $("#exampleModal").modal('show');    
            // Hide the "approve" button with fade-out animation
            $(".aprv").fadeOut();
        });
    }


    
    //Membuat Untuk Simpan Data Dari Modal Form Create
    function storeapprovesp(){
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
          url:"{{ url('sp/storeapprovesp') }}",
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          type: 'POST',
          success:function(data){
            //$("#close-button").click();
            $("#page").html('');
            $("#exampleModal").modal("hide");
            $('#cover-spin').hide();
            read();
            //alert(data.message);
            Swal.fire({
            icon: 'success',
            title: data.message,
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: 'Ok',
            timer: 1500
      });
          },
            error:function(request){
             var err = JSON.parse(request.responseText);
             alert(err.message);
          }
            });
          }

    //Membuat Untuk Simpan Data Dari Modal Form Reject
    function storerejectsp(){
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
          url:"{{ url('sp/storerejectsp') }}",
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          type: 'POST',
          success:function(data){
            //$("#close-button").click();
            $("#page").html('');
            $("#exampleModal").modal("hide");
            $('#cover-spin').hide();
            read();
            //alert(data.message);
            Swal.fire({
            icon: 'success',
            title: data.message,
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: 'Ok',
            timer: 1500
            });
          },
            error:function(request){
             var err = JSON.parse(request.responseText);
             alert(err.message);
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



@endsection


