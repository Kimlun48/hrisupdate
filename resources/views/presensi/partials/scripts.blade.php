<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- <script src='https://code.jquery.com/jquery-1.11.1.min.js' defer></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js" defer></script>



<!-- Untuk Date Picker -->
<!-- Memuat library jQuery -->
<!-- Memuat library jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" defer>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
<!-- Akhir Untuk Date Picker -->


<script type='text/javascript'>

var months = ['January', 'February', 'March', 'April', 'Mey', 'June', 'July', 'August', 'September', 'October', 'November', 'Desember'];

var myDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

var date = new Date();

var day = date.getDate();

var month = date.getMonth();

var thisDay = date.getDay(),

    thisDay = myDays[thisDay];

var yy = date.getYear();

var year = (yy < 1000) ? yy + 1900 : yy;

// tanggallengkap = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;  
// document.getElementById("time").innerHTML = tanggallengkap;

const time = new Date().getHours();
let greeting;

if (time < 10) {
greeting = "Good Morning";
} else if (time < 15) {
greeting = "Good Afternoon";
} else if (time < 19) {
greeting = "Good Afternoon";
} else {
greeting = "Good Evening";
}

  
// document.getElementById('greetings').innerHTML = greeting ;
    $(document).ready(function(){
      readpresensi();
      counterindex();
    });
    
    function readpresensi() {
        $.get("{{ url('/presensi/read') }}",{},
      function(data,status){
        $("#readpresensi").html(data);
      });
    };
    
    function counterindex() {
        $.get("{{ url('/presensi/countindex') }}",{},
      function(data,status){
        $("#countindex").html(data);
      });
    };




// function exportdata() {
//     $.get("{{ url('/presensi/exportmodal') }}",{}, 
//     function(data,status){
//       $("#exportlabel").html('Export Presensi Data');
//       $("#exportdata").html(data);
//       $("#modalexport").modal('show');    
//     });
//   }

  // function exportdata() {
  //   	$.get("{{ url('/presensi/exportmodal') }}",{}, 
	//     function(data,status){
  //         $("#todayLabel").html('Export Presensi Data');
	//         $("#todaydata").html(data);
	//         $("#todayPresensi").modal('show');    
  //       });
  //   }

    // function edit(id,nama_lengkap) {
    // $.get("{{ url('/presensi/showedit/') }}/"+id,{}, 	    
    //       function(data,status){
    //       $("#modaleditlabel").html('Edit Attendance  - ' + nama_lengkap);
	  //       $("#editor-body").html(data);
	  //       $("#editmodal").modal('show');    
    //       $("#id").val(id);
    //       // console.log("Nama: ", nama_lengkap);

    //     });
    // }

  //List Presensi Today EarlyIn, OnTime, LateIn, DayOff, TimeOff 
	//Close Modal
    function Close() {
      $("#todayPresensi").modal("hide");
    }
    //Early Clock In today
    function early() {
    	$.get("{{ url('/presensi/earlyin') }}",{}, 
	    function(data,status){
          $("#todayLabel").html('Early In');
	        $("#todaydata").html(data);
	        $("#todayPresensi").modal('show');    
        });
    }
    //Ontime today
    // function ontime() {
    // 	$.get("{{ url('/presensi/ontime') }}",{}, 
	  //   function(data,status){
    //       $("#todayLabel").html('Ontime');
	  //       $("#todaydata").html(data);
	  //       $("#todayPresensi").modal('show');    
    //     });
    // }
  function ontime() {
      // Ambil nilai dari input tanggal
      var tanggalInput = document.getElementById('tanggalInput');
      var tanggalValue = tanggalInput.value;
      
      // Kirim nilai tanggal ke fungsi server
      $.get("{{ url('/presensi/ontime') }}", { tanggal: tanggalValue }, 
          function(data, status) {
              $("#todayLabel").html('On time');
              $("#todaydata").html(data);
              $("#todayPresensi").modal('show');    
          }
      );
    }
    //Late Clock In today
    function late() {
    	$.get("{{ url('/presensi/latein') }}",{}, 
	    function(data,status){
          $("#todayLabel").html('Late In');
	        $("#todaydata").html(data);
	        $("#todayPresensi").modal('show');    
        });
    }
    //Attend today
    function attend() {
    	$.get("{{ url('/presensi/attendin') }}",{}, 
	    function(data,status){
          $("#todayLabel").html('Attend');
	        $("#todaydata").html(data);
	        $("#todayPresensi").modal('show');    
        });
    }
    //Attend Time Off
    function timeoff() {
    	$.get("{{ url('/presensi/timeoff') }}",{}, 
	    function(data,status){
          $("#todayLabel").html('Time Off');
	        $("#todayPresensi").modal('show');    
	        $("#todaydata").html(data);
        });
    }
    //Attend Day Off
    function dayoff() {
    	$.get("{{ url('/presensi/dayoff') }}",{}, 
	    function(data,status){
          $("#todayLabel").html('Day Off');
	        $("#todaydata").html(data);
	        $("#todayPresensi").modal('show');    
        });
    }

    function absen() {
    	$.get("{{ url('/presensi/absen') }}",{}, 
	    function(data,status){
          $("#todayLabel").html('Absen');
	        $("#todaydata").html(data);
	        $("#todayPresensi").modal('show');    
        });
    }

    function noclockin() {
    	$.get("{{ url('/presensi/noclockin') }}",{}, 
	    function(data,status){
          $("#todayLabel").html('No Clock In');
	        $("#todaydata").html(data);
	        $("#todayPresensi").modal('show');    
        });
    }

    function noclockout() {
    	$.get("{{ url('/presensi/noclockout') }}",{}, 
	    function(data,status){
          $("#todayLabel").html('No Clock Out');
	        $("#todaydata").html(data);
	        $("#todayPresensi").modal('show');    
        });
    }

    function edit(id,nama_lengkap) {
    $.get("{{ url('/presensi/showedit/') }}/"+id,{}, 	    
          function(data,status){
          $("#modaleditlabel").html('Edit Attendance  - ' + nama_lengkap);
	        $("#editor-body").html(data);
	        $("#editmodal").modal('show');    
          $("#id").val(id);
          // console.log("Nama: ", nama_lengkap);

        });
    }

    function Close() {
    $("#editmodal").modal("hide");
    }


function saveedit() {
  event.preventDefault();
  var form = $('#editForm')[0];
  var formData = new FormData(form);
  var presensiId = $('#id').val(); // Get the ID from the 'id' input field

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "{{ url('/presensi/edit') }}" + "/" + presensiId,
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function(response, textStatus, xhr) {
      $("#editor-body").html('');
      $("#editmodal").modal("hide");
      updateTanggalInput();
      counterindex();
      $("#editor-body").html(response.presensi);
      handleSuccess(response.message); // Show Swal alert for success
    },
    error: function(xhr, textStatus, errorThrown) {
      var errorMessage = 'An error occurred while processing your request.';
      if (xhr.responseJSON && xhr.responseJSON.errors) {
        var errors = xhr.responseJSON.errors;
        errorMessage = getErrorMessageFromErrors(errors);
      } else if (xhr.responseJSON && xhr.responseJSON.error) {
        errorMessage = xhr.responseJSON.error;
      }
      handleError(errorMessage); // Show Swal alert for error
    }
  });
}

function getErrorMessageFromErrors(errors) {
  var errorMessage = '';
  for (var key in errors) {
    if (errors.hasOwnProperty(key)) {
      errorMessage += errors[key][0] + '<br>';
    }
  }
  return errorMessage;
}

function handleSuccess(message) {
  Swal.fire({
    icon: 'success',
    title: 'Success',
    text: message,
    confirmButtonText: 'Ok'
  });
}

function handleError(errorMessage) {
  Swal.fire({
    icon: 'error',
    title: 'Error',
    html: errorMessage,
    confirmButtonText: 'Ok'
  });
}


$("#tanggalInput").on("change", function() {
    const tanggal = $(this).val();
    $.ajax({
        url: "{{ url('/presensi/read') }}", 
        type: "GET",
        data: { tanggal: tanggal },
        success: function(response) {
            // Make sure you have an element with ID 'readpresensi' in your HTML
            $("#readpresensi").html(response); // Update the content
        },
        error: function(xhr, status, error) {
            console.log("Error:", status, error);
        }
    });
});

function updateTanggalInput() {
  const tanggal = $("#tanggalInput").val();
  $.ajax({
    url: "{{ url('/presensi/read') }}",
    type: "GET",
    data: { tanggal: tanggal },
    success: function(response) {
      // Pastikan Anda memiliki elemen dengan ID 'readpresensi' di HTML Anda
      $("#readpresensi").html(response); // Perbarui konten
    },
    error: function(xhr, status, error) {
      console.log("Error:", status, error);
    }
  });
}



function toggleMenu(menuId) {
  var menu = document.getElementById(menuId);
  if (menu.style.display === "none") {
    menu.style.display = "block";
  } else {
    menu.style.display = "none";
  }
}


</script>

<!-- Show Data Count  -->

<script>
  function toprofilepresensi(id) {
    window.location.href = "/presensi/detail/" + id;
  }

  
  function changeProfile(id) {
        var selectedId = id.value;
        if (selectedId !== '') {
            toprofile(selectedId);
        }
    }



    $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>



<style>

  .sticky-col-name,
  .sticky-col-id{
    position: sticky;
    background-color: #E2E7FB !important; /* Warna kuning mencolok dengan !important */
    z-index: 2;
  }

  .sticky-col-name {
    left: 0px ;
    padding-left: 0px; /* Beri jarak padding agar isi tetap terlihat */
  }


  .sticky-col-id {
    left: 154px; /* Sesuaikan jarak untuk membuat tampilan lebih baik */
  }

  .zui-sticky-col{
    right: 0px;
  }

  .zui-sticky-col {
    position: sticky;
    z-index: 2;
    border-left: 1px solid #A7A7A7;
    background-color: #E2E7FB !important; /* Warna kuning mencolok dengan !important */
  }

</style>