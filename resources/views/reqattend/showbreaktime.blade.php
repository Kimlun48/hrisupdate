@extends('layouts.app-master')

@section('content')
<div class="employ">
  <div class="container">
    <h5 class="title-employ">Request Break Time</h5>
      <hr class="border"/>
        <div class="table-body">
          <h5 class="list-employ">History Break Time</h5>
          <button type="button" class="btn btn-primary btn-sm d-flex ms-auto" onClick="create()"><i class="fas fa-plus" style="color:#fff;"></i>Break Time</button>
          <div id="read" class="mt-3"></div>
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
<script type="text/javascript">

    $(document).ready(function(){
      read();
    });
    //Membuat Halaman Modal Dan Form Create
    function create() {
        $.get("{{ url('/reqattend/addbreaktime') }}",{}, 
	    function(data,status){
          $("#exampleModalLabel").html('Request Break Time');
	        $("#page").html(data);
	        $("#exampleModal").modal('show');    
        });
    } 
    //Membuat Halaman Read Data
    function read() {
        $.get("{{ url('/reqattend/readbreaktime') }}",{}, 
	    function(data,status){
        $("#read").html(data);
	    });
    }
    // Close odal
    function Close() {
      $("#exampleModal").modal("hide");
    } 
    //Membuat Untuk Simpan Data Dari Modal Form Create
    function breaktimee(){
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
          url:"{{ url('reqattend/savebreak') }}",
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          type: 'POST',
          success:function(data){
            //$("#close-button").click();
            $("#page").html('');
            $("#exampleModal").modal("hide");
            Swal.fire({
              icon: 'success',
              title: data.message,
              showDenyButton: false,
              showCancelButton: false,
              confirmButtonText: 'Ok',
              //timer: 1500
            });
            read();
          },
            error:function(data){
             var err = JSON.parse(request.responseText);
             alert(err.message);
          }
            });
          }
  

</script>
@endsection


