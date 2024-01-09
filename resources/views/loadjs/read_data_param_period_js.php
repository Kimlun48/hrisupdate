
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" defer/>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js" defer></script>
<script type="text/javascript">  
$(document).ready(function(){
    read()
  // readexpired();
});


function read() {
    $.get("/parcab/readdata",{},
  function(data,status){
    $("#readparcab").html(data);
  });
}

function createparcab() {
    $.get("/parcab/showparam/",{}, 
    function(data,status){
        $("#ModalCreateLabel").html('Employee Transfer');
        $("#page").html(data);
        $("#ModalCreate").modal('show');
    });
}


function Close() {
    $("#ModalCreateLabel").modal("hide");
    $("#page").modal("hide");
    $("#ModalCreate").modal("hide");
}

function saveparam(){
  event.preventDefault();
  var form = $('#myform')[0];
  var formData = new FormData(form);
 
  console.log("ini datanya sepurrrrrr= ", formData)
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url:"/parcab/saveparam/",
    data:formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#page").html('');
      $("#ModalCreate").modal("hide");
      read();
      // reademploy();
      Swal.fire({
        icon: 'success',
          title: data.message,
          showDenyButton: false,
          showCancelButton: false,
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
