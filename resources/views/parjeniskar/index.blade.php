@extends('layouts.app-master')

@section('content-employ')
<div class="param-jeniskar">
  <div class="head">
    <h5 class="title-applicant">Param Type Of Employee</h5>
  </div>
  <div class="container">
	    <div class="table-body">
            <div id="read" class=""></div>
        </div>
  </div>
</div>

        
	
    
           <!-- Modal edit -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="Modalparam" tabindex="-1" role="dialog" aria-labelledby="ModalparamLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	      <h5 class="modal-title" id="ModalparamLabel"></h5>
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
            

@include('loadjs.script_search_table') 

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
<script type="text/javascript">
    $(document).ready(function() {
        read();
    });

    function read() {
        $.get("{{ url('/parjeniskar/readparam') }}", {}, function(data, status) {
            $("#read").html(data);
        });
    }

    // Close Modal
    function Close() {
        $("#Modalparam").modal("hide");
    }

    // Membuat Halaman Modal Dan Form Create
    function edit(id) {
        $.get("{{ url('/parjeniskar/edit/') }}/"+id, {}, function(data, status) {
            $("#ModalparamLabel").html('Edit Param Jenis Karyawan');
            $("#page").html(data);
            $("#Modalparam").modal('show');
        });
    }

    function create() {
        $.get("{{ url('/parjeniskar/create') }}", {}, function(data, status) {
            $("#ModalparamLabel").html('Add Param Jenis Karyawan');
            $("#page").html(data);
            $("#Modalparam").modal('show');
        });
    }

    function storeedit() {
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
            url: "{{ url('/parjeniskar/storeedit') }}",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
                $("#Modalparam").modal("hide");
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
            error: function(data) {

            }
        });
    }

    function createparam() {
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
            url: "{{ url('/parjeniskar/store') }}",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
                read();
                $("#page").html(data);
                $("#Modalparam").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Yes',
                    timer: 1500
                });
            },
            error: function(data) {

            }
        });
    }
</script>
@endsection


