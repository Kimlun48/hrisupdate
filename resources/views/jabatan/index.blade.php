@extends('layouts.app-master')

@section('content-employ')
<div class="param-position">
  <div class="head">
    <h5 class="title-applicant">List Position Parent</h5>
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
    //   document.querySelector('#answerInput').addEventListener('input', function(e) {
    //     var input = e.target,	
    //         list = input.getAttribute('list'),
    //         options = document.querySelectorAll('#' + list + ' option[value="'+input.value+'"]'),
    //         hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden');

    //     if (options.length > 0) {
    //       hiddenInput.value = input.value;
    //       input.value = options[0].innerText;
    //       }
      
    // });

    });

    

  function read() {
        $.get("{{ url('/jabatan/readjabatan') }}",{}, 
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
    $.get("{{ url('/jabatan/edit/') }}/"+id,{}, 	    
          function(data,status){
          $("#ModalpasalLabel").html('Edit jabatan parent');
	        $("#page").html(data);
	        $("#Modalpasal").modal('show');    
        });
    }
    
   function create() {
     $.get("{{ url('/jabatan/create') }}",{}, 
          function(data,status){
            $("#ModalpasalLabel").html('Add jabatan parent');
	        $("#page").html(data);
	        $("#Modalpasal").modal('show');    
        });
    }
    
    function showisi(id) {
      $.get("{{ url('/jabatan/showisi/') }}/"+id,{}, 	    
        function(data,status){
            $("#ModalpasalLabel").html('Isi jabatan parent');
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
    url:"{{ url('/jabatan/storeedit') }}",
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
        url:"{{ url('/jabatan/store') }}",
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
    url: "{{ url('/jabatan/delete/') }}/" + id,
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


$(document).ready(function() {
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    
    // Menemukan semua baris dalam tabel
    var rows = $('#myTable tbody tr');
    
    var anyRowMatches = false; // Apakah ada baris yang cocok
    
    rows.each(function() {
      // Mengambil semua teks dalam baris
      var rowText = $(this).text().toLowerCase();
      
      // Memeriksa apakah teks dalam baris cocok dengan nilai pencarian
      if (rowText.includes(value)) {
        $(this).show(); // Menampilkan baris jika cocok
        anyRowMatches = true; // Setel flag menjadi true
      } else {
        $(this).hide(); // Menyembunyikan baris jika tidak cocok
      }
    });
    
    // Memeriksa apakah ada baris yang cocok
    if (!anyRowMatches) {
      // Jika tidak ada baris yang cocok, tampilkan pesan
      $("#myTable tbody").append('<tr id="no-data-row"><td colspan="7"><div class="alert alert-danger text-center">Data yang ada cari tidak tersedia.</div></td></tr>');
    } else {
      // Jika ada baris yang cocok, hapus pesan jika ada
      $("#no-data-row").remove();
    }
  });
});
</script>

<style>
    .has-search .form-control {
    padding-left: 2.375rem;
    border-radius: 10px;

  }

  .has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
  }
</style>


@endsection


