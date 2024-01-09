@extends('layouts.app-master')

@section('content-employ')

<div class="resign-employ">
  <div class="container">
    <div class="row">
      <div class="head-title col-md-6">
        <h5 class="title-employ">Resign External</h5>
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
                            <a class="nav-link tablinks active" href="#" data-tab="readallaju">                    
                                Request Resign
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tablinks" href="#" data-tab="nonactive">
                                Non Active
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tablinks" href="#" data-tab="readalmostexpired">
                                Almost Expired
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tablinks" href="#" data-tab="readexpired">
                                Expired At
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


<script>
$(document).ready(function () {
    // Load the content for the default tab (Request Resign)
    loadTabContent('readallaju', 1);
    
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
        url: '/resignterm/external/' + tab + '?page=' + page,
        type: 'GET',
        success: function (response) {
            $('#tab-content').html(response);
            setupPagination(tab); // Set up pagination for the loaded content
        }
    });
}

    // {UNTUK PAGINATION PADA SEMUA TAB NYA}
// function setupPagination(tab) {
//     $('.pagination a').on('click', function (e) {
//         e.preventDefault();
//         var page = $(this).attr('href').split('page=')[1];
//         loadTabContent(tab, page);
//     });
// }


</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

  $(document).ready(function(){
    read();
    readnonactive();
  });

  function read() {
      $.get("{{ url('/resignterm/readallaju') }}",{}, 
    function(data,status){
      $("#read").html(data);
    });
  }
  /// Nonactive
  function readnonactive() {
      $.get("{{ url('/resignterm/nonactive') }}",{}, 
    function(data,status){
      $("#readnonactive").html(data);
    });
  }
  // Close modal
  function Close() {
    $("#exampleModal").modal("hide");
  }     
  //Membuat Halaman Modal Dan Form Create
  function approve(id) {
      $.get("{{ url('/resignterm/approve') }}/"+id,{}, 
    function(data,status){
        $("#exampleModalLabel").html('Approval Request Resign');
        $("#page").html(data);
        $("#exampleModal").modal('show');    
      });
  }

  //Membuat Untuk Simpan Data Dari Modal Form Create
  function storeapprove(){
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
        url:"{{ url('resignterm/storeapprove') }}",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data, textStatus, xhr) {
          $("#page").html('');
          $("#exampleModal").modal("hide");
          read();
          Swal.fire({
            icon: 'success',
              title: data.message,
              showDenyButton: false,
              showCancelButton: false,
              confirmButtonText: 'Yes',
              timer: 1500 
          });
        },
        // success:function(data){
        //   
        //   alert(data.message);
        // },
          error:function(data){
            var err = JSON.parse(request.responseText);
            alert(err.message);
          }
        });
      }

  function showreject(id) {
    $.get("{{ url('/resignterm/reject') }}/"+id,{}, 
    function(data,status){
      $("#exampleModalLabel").html('Reject Request Resign');
      $("#page").html(data);
      $("#exampleModal").modal('show');    
    });
  }

  function storereject(){
    event.preventDefault();
    var form = $('#myformreject_resign')[0];
    var formData = new FormData(form);
    console.log("ini datanya = ", formData)
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      url:"{{ url('resignterm/rejectresign') }}",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data, textStatus, xhr) {
        $("#page").html('');
        $("#exampleModal").modal("hide");
        read();
        Swal.fire({
          icon: 'success',
            title: data.message,
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: 'Yes',
            timer: 1500 
        });
      },
        error:function(data){
          
      }
    });
  }
</script>

<script>
  // Tab
  document.getElementById("ajuan").style.display="block"
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
