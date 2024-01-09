@extends('layouts.app-master')

@section('content-employ')
<div class="param-sp">
  <div class="head">
    <h5 class="title-applicant">param of the violation article</h5>
  </div>
  <div class="container">
	    <div class="table-body">
            <div id="read" class=""></div>
        </div>
  </div>
</div>
           

        
	
    
<!-- Modal edit -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="Modalpasal" tabindex="-1" role="dialog" aria-labelledby="ModalpasalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	      <h5 class="modal-title" id="ModalpasalLabel"></h5>
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
<script type="text/javascript">

    $(document).ready(function(){
      read();
    });

  function read() {
        $.get("{{ url('/pasal/readpasal') }}",{}, 
	    function(data,status){
        $("#read").html(data);
	    });
    }

      // Close Modal
    function Close() {
    $("#Modalpasal").modal("hide");
    }

   //Membuat Halaman Modal Dan Form Create
   function edit(id) {
    $.get("{{ url('/pasal/edit/') }}/"+id,{}, 	    
          function(data,status){
          $("#ModalpasalLabel").html('edit the violation article');
	        $("#page").html(data);
	        $("#Modalpasal").modal('show');    
        });
    }
    
   function create() {
     $.get("{{ url('/pasal/create') }}",{}, 
          function(data,status){
            $("#ModalpasalLabel").html('Add the violation article');
	        $("#page").html(data);
	        $("#Modalpasal").modal('show');    
        });
    }
    
    function showisi(id) {
      $.get("{{ url('/pasal/showisi/') }}/"+id,{}, 	    
        function(data,status){
            $("#ModalpasalLabel").html('contents of the violation article');
            $("#page").html(data);
            $("#Modalpasal").modal('show');    
        });
    }

    function storeedit(){
event.preventDefault();
  var form = $('#editForm')[0];
  var formData = new FormData(form);
  console.log("ini datanya = ", formData)
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('/pasal/storeedit') }}",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#page").html('');
      $("#Modalpasal").modal("hide");
      read();
      $("#page").html(data);
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

    function createpasal(){
      event.preventDefault();
      var form = $('#createForm')[0];
      var formData = new FormData(form);
      console.log("ini datanya = ", formData)
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        url:"{{ url('/pasal/store') }}",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data, textStatus, xhr) {
          $("#page").html('');
          $("#Modalpasal").modal("hide");
          read();
          $("#page").html(data);
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

    function hapus(id){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  $.ajax({
    url: "{{ url('/pasal/delete/') }}/" + id,
    type: 'DELETE',
    success: function(data, textStatus, xhr){
      $("#page").html('');
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


@endsection


