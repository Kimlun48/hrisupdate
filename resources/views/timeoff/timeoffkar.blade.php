@extends('layouts.app-master')

@section('content-employ')

  <div class="timeoffkar">
    <div class="head">
      <h5 class="title-applicant">Your time off information</h5>
    </div>
    <div class="container">
      <div class="table-body">
        <div id="read{{ auth()->user()->getkaryawan->id }}" class=""></div>
      </div>
    </div>
  </div>

    

   
  <!-- Modal -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" onClick="Close()" class="close" data-dismiss="modal" aria-label="Close">
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
    read('{{ auth()->user()->getkaryawan->id }}');
  });

  function create() {
    $.get("{{ url('/timeoff/create') }}",{}, 
  function(data,status){
      $("#exampleModalLabel").html('Request Time Off');
      $("#page").html(data);
      $("#exampleModal").modal('show');
    });
  }

  function read(id) {
        $.get("{{ url('/timeoff/read') }}/" + id,{}, 
	    function(data,status){
        $("#read{{ auth()->user()->getkaryawan->id }}").html(data);
	    });
    } 
    // Close odal
    function Close() {
      $("#exampleModal").modal("hide");
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
          url:"{{ url('timeoff/store') }}",
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          type: 'POST',
          success:function(data){
            //$("#close-button").click();
            $("#page").html('');
            $("#exampleModal").modal("hide");
            read('{{ auth()->user()->getkaryawan->id }}');
            alert(data.message)
          },
            error:function(data){
              var err = JSON.parse(request.responseText);
              alert(err.message);
          }
            });
          }
          
        //Membuat Halaman Modal Dan Form Show Update
        function show(id) {
            $.get("{{ url('/timeoff/showupdate') }}/" + id,{}, 
          function(data,status){
              $("#exampleModalLabel").html('INI CONTOH JUDUL');
              $("#page").html(data);
              $("#exampleModal").modal('show');    
            });
        } 

        
  </script>






@endsection

