<!-- selectize -->
<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
// Close Modalaaaaaa
function Close() {
    $("#ModalEdit").modal("hide");
}
//Membuat Halaman Modal Dan Form Create
// Modal Personal data 
function showedit_personaldata(id) {
    $.get("{{ url('/employ/showeditpersonaldata') }}/"+id,{}, 
    function(data,status){
        $("#ModalEditLabel").html('Edit Data Personal');
        $("#page").html(data);
        $("#ModalEdit").modal('show');    
    });
}
// Sace Personal Data
function storepersonalprofil(){
  event.preventDefault();
  var form = $('#myform')[0];
  var formData = new FormData(form);
  var currentURL = window.location.href;
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('/employ/storepersonalprofil') }}",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#page").html('');
      $("#ModalEdit").modal("hide");
      location.reload();
      Swal.fire({
        icon: 'success',
          title: data.message,
          showDenyButton: false,
          showCancelButton: false,
          confirmButtonText: 'Yes',
          timer: 1500 
      });
    },
    error: function (xhr, textStatus, errorThrown) {
      // Tangkap pesan kesalahan dari respons
      var errorMessage = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Oops! Something went wrong.';

      // Tampilkan pesan kesalahan menggunakan Swal
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: errorMessage,
        confirmButtonText: 'OK'
      });
    }
  });
}


// Modal Identity & Address
function showedit_identity_and_address(id) {
    $.get("{{ url('/employ/showidentityaddressprofile') }}/"+id,{}, 
    function(data,status){
        $("#ModalEditLabel").html('Edit Identity & Address');
        $("#page").html(data);
        $("#ModalEdit").modal('show');    
    });
}


// Sace Personal Data
function save_identity_and_address(){
  event.preventDefault();
  var form = $('#myform')[0];
  var formData = new FormData(form);
  var currentURL = window.location.href;
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('/employ/saveidentityaddressprofile') }}",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#page").html('');
      $("#ModalEdit").modal("hide");
      location.reload();
      Swal.fire({
        icon: 'success',
          title: data.message,
          showDenyButton: false,
          showCancelButton: false,
          confirmButtonText: 'Yes',
          timer: 1500 
      });
    },
    error: function (xhr, textStatus, errorThrown) {
      // Tangkap pesan kesalahan dari respons
      var errorMessage = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Oops! Something went wrong.';

      // Tampilkan pesan kesalahan menggunakan Swal
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: errorMessage,
        confirmButtonText: 'OK'
      });
    }
  });
}


// Modal Employees Data
function showedit_employ_data(id) {
    $.get("{{ url('/employ/showemploydata') }}/"+id,{}, 
    function(data,status){
        $("#ModalEditLabel").html('Edit Employment Data');
        $("#page").html(data);
        $("#ModalEdit").modal('show');    
    });
}


// Sace Employees Data
function saveedit_employ_data(){
  event.preventDefault();
  var form = $('#myform')[0];
  var formData = new FormData(form);
  var currentURL = window.location.href;
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('/employ/saveemploydata') }}",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#page").html('');
      $("#ModalEdit").modal("hide");
      location.reload();
      Swal.fire({
        icon: 'success',
          title: data.message,
          showDenyButton: false,
          showCancelButton: false,
          confirmButtonText: 'Yes',
          timer: 1500 
      });
    },
    error: function (xhr, textStatus, errorThrown) {
      // Tangkap pesan kesalahan dari respons
      var errorMessage = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Oops! Something went wrong.';

      // Tampilkan pesan kesalahan menggunakan Swal
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: errorMessage,
        confirmButtonText: 'OK'
      });
    }
  });
}

</script>
