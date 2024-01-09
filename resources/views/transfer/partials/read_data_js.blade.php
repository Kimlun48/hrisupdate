<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" defer/>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js" defer></script>
<!-- selectize -->
<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">  
$(document).ready(function(){
  read();
  readex();
});

function read() {
    $.get("{{ url('/trans/read') }}",{},
  function(data,status){
    console.log('ini dataaaaaaaaaaaaaa');  
    $("#read").html(data);
  });
}
function readex() {
    $.get("{{ url('/transext/readext') }}", {}, function(data, status) {
        if (status === 'success') {
            $("#readex").html(data);
        } else {
            console.error("Terjadi kesalahan saat melakukan permintaan AJAX. Status: " + status);
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Gagal melakukan permintaan AJAX. Kesalahan: " + errorThrown);
        console.error("Gagal melakukan permintaan AJAX. Kesalahan: " + JSON.stringify(errorThrown));
        console.error("Gagal melakukan permintaan AJAX. Status HTTP: " + jqXHR.status);


    });
}


function showmodaldetail(id) {
    $.get("{{ url('/trans/detail') }}/"+id,{}, 
    function(data,status){
        $("#ModalTransLabel").html('Transfer Detail');
        $("#page").html(data);
        $("#ModalTrans").modal('show');  
    });
}

function Close() {
    $("#ModalTransLabel").modal("hide");
    $("#page").modal("hide");
    $("#ModalTrans").modal("hide");
}



// function showmodalcreate(id) {
//     $.get("{{ url('/trans/detail') }}/"+id,{}, 
//     function(data,status){
//         $("#ModalCreateLabel").html('Create Transfer');
//         $("#page").html(data);
//         $("#ModalCreate").modal('show');  
//     });
// }


function showtransfer() {
    $.get("{{ url('/trans/transfer/') }}",{}, 
    function(data,status){
        $("#ModalTransLabel").html('Employee Transfer Internal');
        $("#page").html(data);
        $("#ModalTrans").modal('show');
        const select = new Choices('#mySelect', { removeItemButton: true });
        const selectedValues = select.getValue();
    });
}


function showtransferexternal() {
    $.get("{{ url('/trans/transferexternal/') }}",{}, 
    function(data,status){
        $("#ModalTransLabel").html('Employee Transfer External');
        $("#page").html(data);
        $("#ModalTrans").modal('show');
        const select = new Choices('#mySelect', { removeItemButton: true });
        const selectedValues = select.getValue();
    });
}


function storetransfer(){
  event.preventDefault();
  var form = $('#myform')[0];
  var formData = new FormData(form);
  document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create( document.querySelector( '#keterangan' ) )
            .catch( error => {
                console.log( error );
            } );
    });
  console.log("ini datanya sepurrrrrr= ", formData)
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url:"trans/storetransfer",
    data:formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#page").html('');
      $("#ModalTrans").modal("hide");
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
    

// function canceltransfer(id){
//   $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//   });
//     $.post("/trans/cancel/"+id,{}, 
//     );
// }


function canceltransfer(id) {
  let text = "Apakah Anda Yakin Akan Membatalkan Transfer Karyawan ini";
  if (confirm(text) == true) {
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
      $.post("/trans/cancel/"+id,{}, 
      );
    }
    read();
    
}

// function showtransfer() {
//   $.get("{{ url('/employ/transferbulk') }}", {}, function(data, status) {
//     $("#ModalTransferLabel").html('Transfer status karyawan');
//     $("#pagetransfer").html(data);
//     $("#ModalTransfer").modal('show');
//   });
// }

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
