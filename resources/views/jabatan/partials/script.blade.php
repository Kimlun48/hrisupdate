


<script type="text/javascript">

// $(document).ready(function(){
//     read();
//   //   document.querySelector('#answerInput').addEventListener('input', function(e) {
//   //     var input = e.target,	
//   //         list = input.getAttribute('list'),
//   //         options = document.querySelectorAll('#' + list + ' option[value="'+input.value+'"]'),
//   //         hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden');

//   //     if (options.length > 0) {
//   //       hiddenInput.value = input.value;
//   //       input.value = options[0].innerText;
//   //       }
    
//   // });

//   });

  

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
    }).then(function () {
            loadTabContent('posisi', 1); // Panggil fungsi untuk menampilkan tab branch setelah AJAX berhasil
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
        }).then(function () {
            loadTabContent('posisi', 1); // Panggil fungsi untuk menampilkan tab branch setelah AJAX berhasil
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