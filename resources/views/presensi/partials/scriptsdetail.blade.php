<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

<!-- AWAL UNTUK COUNTDETAIL INTERNAL -->
<script>

  function ontime_detail_internal() {
    $.get("{{ url('/presensi/detail/internal/ontime') }}", {}, 
        function(data, status) {
            $("#todayLabel").html('Ontime Internal Detail');
            $("#todaydata").html(data);
            $("#todayPresensi").modal('show');    
        }
    );
  }

  //Late today
  function late_detail_internal() {
    $.get("{{ url('/presensi/detail/internal/latein') }}",{}, 
    function(data,status){
        $("#todayLabel").html('LateIn Internal Detail');
        $("#todaydata").html(data);
        $("#todayPresensi").modal('show');    
      });
  }
  //Attend today
  function attend_detail_internal() {
    $.get("{{ url('/presensi/detail/internal/attend') }}",{}, 
    function(data,status){
        $("#todayLabel").html('Attend Internal Detail');
        $("#todaydata").html(data);
        $("#todayPresensi").modal('show');    
      });
  }
  //Attend Time Off
  function timeoff_detail_internal() {
    $.get("{{ url('/presensi/detail/internal/timeoff') }}",{}, 
    function(data,status){
        $("#todayLabel").html('TimeOff Internal Detail');
        $("#todaydata").html(data);
        $("#todayPresensi").modal('show');    
      });
  }
  //Attend Day Off
  function dayoff_detail_internal() {
    $.get("{{ url('/presensi/detail/internal/dayoff') }}",{}, 
    function(data,status){
        $("#todayLabel").html('DayOff Internal Detail');
        $("#todaydata").html(data);
        $("#todayPresensi").modal('show');    
      });
  }

  function absen_detail_internal() {
    $.get("{{ url('/presensi/detail/internal/absen') }}",{}, 
    function(data,status){
        $("#todayLabel").html('Absen Internal Detail');
        $("#todaydata").html(data);
        $("#todayPresensi").modal('show');    
      });
  }

  //Early today
  function earlyin_detail_internal() {
    $.get("{{ url('/presensi/detail/internal/earlyin') }}",{}, 
    function(data,status){
      $("#todayLabel").html('EarlyIn Internal Detail');
      $("#todaydata").html(data);
      $("#todayPresensi").modal('show');    
    });
  }

  //Noclockin today
  function noclockin_detail_internal() {
    $.get("{{ url('/presensi/detail/internal/noclockin') }}",{}, 
    function(data,status){
      $("#todayLabel").html('No Clock In Internal Detail');
      $("#todaydata").html(data);
      $("#todayPresensi").modal('show');    
    });
  }

  //Noclockout today
  function noclockout_detail_internal() {
    $.get("{{ url('/presensi/detail/internal/noclockout') }}",{}, 
    function(data,status){
      $("#todayLabel").html('No Clock Out Internal Detail');
      $("#todaydata").html(data);
      $("#todayPresensi").modal('show');    
    });
  }
  
  function Close() {
    $("#todayPresensi").modal("hide");
  }
</script>
<!-- AKHIR UNTUK COUNTDETAIL INTERNAL -->





<script>


var url = window.location.href;
  // console.log('nih url nya', url)
  let hasil = url.split('/')
  // console.log('nih url nya', hasil)
  var currentEmployeeId = hasil[5]; // Ganti angka ini dengan ID karyawan yang sedang Anda lihat
  document.getElementById("select-state").value = currentEmployeeId;

  $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>

<script>  


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

  $("#detailbln").on("change", function() {
    const tanggal = $(this).val();
      $.ajax({
        url: "{{ url('/presensi/readdetail') }}/"+idtes, 
        type: "GET",
        data: { tanggal: tanggal },
        success: function(response) {
          $("#readdetail").html(response);
        },
        error: function(xhr, status, error) {
          console.log("Error:", status, error);
        }
    });
  });
</script>
<script>
    function toprofile(id) {
    window.location.href = "/presensi/detail/" + id;
  }

  function changeProfile(id) {
    var selectedId = id.value;
    if (selectedId !== '') {
        toprofile(selectedId);
    }
  }

  function toggleMenu(menuId) {
    var menu = document.getElementById(menuId);
    if (menu.style.display === "none") {
      menu.style.display = "block";
    } else {
      menu.style.display = "none";
    }
  }


    function toggleColumn(column) {
    var checkbox = document.getElementById(column + "Checkbox");
    var table = document.getElementById("myTable");
    var thElements = table.getElementsByClassName(column);
    var tdElements = table.getElementsByClassName(column);

    for (var i = 0; i < thElements.length; i++) {
      thElements[i].style.display = checkbox.checked ? "" : "none";
    }

    for (var i = 0; i < tdElements.length; i++) {
      tdElements[i].style.display = checkbox.checked ? "" : "none";
    }
  }


    // Untuk Sort Table dari a ke z dan dari z ke a
    var currentPage = 1;
    var table = document.getElementById("myTable");
    var tbody = table.getElementsByTagName("tbody")[0];
    var rows = tbody.getElementsByTagName("tr");
    var totalPages = Math.ceil(rows.length / rowsPerPage);

    function showRows() {
      var startIndex = (currentPage - 1) * rowsPerPage;
      var endIndex = startIndex + rowsPerPage;

      for (var i = 0; i < rows.length; i++) {
        if (i >= startIndex && i < endIndex) {
          rows[i].style.display = "table-row";
        } else {
          rows[i].style.display = "none";
        }
      }
    }

    function sortTable(columnIndex) {
      var sortOrder = 1;
      

      if (table.rows[0].cells[columnIndex].classList.contains("asc")) {
        table.rows[0].cells[columnIndex].classList.remove("asc");
        table.rows[0].cells[columnIndex].classList.add("desc");
        sortOrder = -1;
      } else {
        table.rows[0].cells[columnIndex].classList.remove("desc");
        table.rows[0].cells[columnIndex].classList.add("asc");
      }

      var rowsArray = Array.prototype.slice.call(rows);
      rowsArray.sort(function(a, b) {
        var aValue = a.cells[columnIndex].textContent.trim();
        var bValue = b.cells[columnIndex].textContent.trim();

        if (aValue < bValue) {
          return -1 * sortOrder;
        } else if (aValue > bValue) {
          return 1 * sortOrder;
        } else {
          return 0;
        }
      });

      for (var i = 0; i < rowsArray.length; i++) {
        tbody.appendChild(rowsArray[i]);
      }

      showRows();
    }
  // Akhir Untuk Sort Tbale dari a ke z dan dari z ke a
  // Untuk mempeprtahankan page tetep bisa di clik setelah sort table




</script>

<!-- onclik detail -->
<script>

// $(document).ready(function(){
//       readdetail()
//     });
    
//     function readdetail() {
//         $.get("{{ url('/presensi/readdetail') }}/"+id,{},
//       function(data,status){
//         $("#readdetail").html(data);
//       });
//     }





    function Close() {
    $("#editmodal").modal("hide");
    }


function saveedit() {
  event.preventDefault();
  var form = $('#editForm')[0];
  var formData = new FormData(form);
  var presensiId = $('#id').val(); // Get the ID from the 'id' input field

  console.log("ini datanya = ", formData)
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
      readdetail();
      readcounter();
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
</script>











