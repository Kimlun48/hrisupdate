<!-- selectize -->
<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">  
$(document).ready(function(){
  // readalmostexpired();
  // readexpired();
});

// Baca Data Ketika Even Click almost
 function cekdataemploy(){
   reademploy();
 }




// Baca Data Ketika Even Click almost
function cekdataalmostexpired(){
  readalmostexpired();
}
// Baca Data Ketika Even Click Yang Telah Expired
function cekdataexpired(){
  readexpired();
}

// Baca Data Ketika Even Click Yang Telah Expired
function cekdataexternal(){
  readexternal();
}

function  reademploy() {
    $.get("{{ url('/employ/showemploy') }}",{},
  function(data,status){
    $("#read").html(data.data_employ);
  });
}

/// Almost Expired
function readalmostexpired() {
    $.get("{{ url('/resignterm/readalmostexpired') }}",{}, 
  function(data,status){
    $("#readalmostexpired").html(data);
  });
}

/// Expired
function readexpired() {
    $.get("{{ url('/resignterm/readexpired') }}",{}, 
  function(data,status){
    $("#readexpired").html(data);
  });
}


/// External
//External Baru
function readexternal() {
    $.get("{{ url('/employ/readexternal') }}",{}, 
  function(data,status){
    $("#readexternal").html(data);
  });
}
//function readexternal() {
//    $.get("{{ url('/employ/external') }}",{}, 
//  function(data,status){
//    $("#readexternal").html(data.data_employ_ex);
//  });
//}

// Close Modalaaaaaa
function Close() {
    $("#ModalResign").modal("hide");
    $("#ModalTransfer").modal("hide");
    $("#modalDetail").modal("hide");
}
//Membuat Halaman Modal Dan Form Create
// internal phk
function show(id) {
    $.get("{{ url('/resignterm/showphk') }}/"+id,{}, 
    function(data,status){
        $("#ModalResignLabel").html('PHK/Habis Kontrak');
        $("#page").html(data);
        $("#ModalResign").modal('show');    
    });
}

// external show phk
function externalshow(id) {
    $.get("{{ url('/resignterm/showphk') }}/"+id,{}, 
    function(data,status){
        $("#ModalResignLabel").html('PHK/Habis Kontrak');
        $("#page").html(data);
        $("#ModalResign").modal('show');    
    });
}

function showedit(id) {
    $.get("{{ url('/employ/showedit/') }}/"+id,{}, 
    function(data,status){
        $("#ModalTransLabel").html('Edit Data Pegawai');
        $("#pagetransferbulk").html(data);
        $("#ModalTrans").modal('show');    
    });
}

function showtransfer(id) {
    $.get("{{ url('/employ/transfer/') }}/"+id,{}, 
    function(data,status){
        $("#ModalTransferLabel").html('Transfer status karyawan');
        $("#pagetransfer").html(data);
        $("#ModalTransfer").modal('show');
    });
}

function showtransferbulk() {
  $.get("{{ url('/employ/transferbulk') }}", {}, function(data, status) {
    $("#ModalTransferLabelbulk").html('Transfer status karyawan');
    $("#pagetransferbulk").html(data);
    $("#ModalTransferBulk").modal('show');
  });
}

function Close() {
  $("#ModalTransferBulk").modal('hide');
}

function loadModalinternal() {
    $.ajax({
        url: "contoh_modal.html",
        success: function(response) {
            $('#myModal .modal-body').html(response);
            $('#myModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}


function showdetail(id) {
    $.get("{{ url('/employ/detail/') }}/"+id,{}, 
    function(data,status){
        $("#labeldetail").html('Detail karyawan');
        $("#detail").html(data);
        $("#modalDetail").modal('show');
    });
}


function CloseExternal() {
    $("#labeldetailexternal").modal("hide");
    $("#detailexternal").modal("hide");
    $("#modalDetailExternal").modal("hide");
}

// modal external show
function showexternal(id) {
  console.log('ini show akuu');
    $.get("{{ url('/employ/detail/') }}/"+id,{}, 
    function(data,status){
        $("#labeldetailexternal").html('Detail karyawan');
        $("#detailexternal").html(data);
        $("#modalDetailExternal").modal('show');
    });
}
//untuk modal yang di dashboard
//function showdetaildash(id) {
//    $.get("{{ url('/employ/detail/') }}/"+id,{}, 
//    function(data,status){
//        $("#labeldetail").html('Detail karyawan');
//        $("#detail").html(data);
//        $("#modalDetail").modal('show');
//    });
//}

function cekpasal() {
  var selectBox = document.getElementById('pasal');
  var id = selectBox.options[selectBox.selectedIndex].value;
  $.get("{{ url('/employ/cekpasal/') }}/"+id,{}, 
    function(data,status){
        $("#datapasal").html(data.data.isiayat);
  });
}

function showsp(id) {
  $.get("{{ url('/employ/showsp/') }}/"+id,{}, 
  function(data,status){
      $("#ModalTransferLabel").html('Pengajuan Teguran / Peringatan');
      $("#pagetransfer").html(data);
      $("#ModalTransfer").modal('show');
  });
}
// Rehire
function showtrehire(id) {
  console.log('asdasdasd',id);
  $.get("{{ url('/rehire/create/') }}/"+id,{}, 
  function(data,status){
      $("#ModalTransferLabel").html('Rehiring Employees');
      $("#pagetransfer").html(data);
      $("#ModalTransfer").modal('show');
  });
}


// Save Rehire
function storerehire() {

  Swal.fire({
      title: 'Loading...',
      html: '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%; background-color: red;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>',
      allowOutsideClick: false,
      didOpen: () => {
        // Mencegah penutupan modal selama request berlangsung
        Swal.showLoading();
      },
    });

    function updateProgress() {
        if (currentCount <= totalCount) {
            var percentage = Math.round((currentCount / totalCount) * 100);
            progressBar.css('width', percentage + '%');
            percentageText.text(percentage + '%');
            currentCount++;
            setTimeout(updateProgress, intervalTime);
        } else {
            Swal.close();
            Swal.fire({
                icon: 'success',
                title: 'Proses selesai!',
                showConfirmButton: false,
                // timer: 1500
            });
        }
    }
}
// function storerehire(){
// event.preventDefault();

//   var form = $('#myform')[0];
//   var formData = new FormData(form);
//   console.log("ini datanya = ", formData)
//   $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//   });
//   $.ajax({
//     url:"{{ url('rehire/store') }}/",
//     data: formData,
//     cache: false,
//     processData: false,
//     contentType: false,
//     type: 'POST',
//     success: function (data, textStatus, xhr) {
//       $("#pagetransfer").html('');
//       $("#ModalTransfer").modal("hide");
//       reademploy();    
//       Swal.fire({
//         icon: 'success',
//           title: data.message,
//           showDenyButton: false,
//           showCancelButton: false,
//           confirmButtonText: 'Yes',
//           timer: 1500 
//       });
//     },
//       error:function(data){
        
//     }
//       });
//     }

// Akhir Re Hire

// internal phk
function storephk(){
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
    url:"{{ url('resignterm/storephk') }}",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#page").html('');
      $("#ModalResign").modal("hide");
      
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

    // external phk

    
function storeedit(){
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
    url:"{{ url('/employ/storeedit') }}",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#pagetransferbulk").html('');
      $("#ModalTrans").modal("hide");
      reademploy();
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

function storetransfer(){
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
    url:"{{ url('/employ/storetransfer') }}",
    data:formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#pagetransfer").html('');
      $("#ModalTransfer").modal("hide");
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
// untuk Transfer yang Di Klik Di page Readdata External

function storetransferonclick(){
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
    url:"{{ url('/trans/storetransferonclick') }}",
    data:formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#pagetransfer").html('');
      $("#ModalTransfer").modal("hide");
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


// Untuk Tranfer yang Di Bulk D Page Transer
function storetransferbulk(){
  event.preventDefault();
  var form = $('#myform')[0];
  var formData = new FormData(form);
  console.log("ini datanyabulk = ", formData)
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url:"{{ url('/employ/storetransferbulk') }}",
    data:formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#pagetransferbulk").html('');
      $("#ModalTransferBulk").modal("hide");
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

function storesp(){
  event.preventDefault();
  var form = $('#myform')[0];
  var formData = new FormData(form);
  $('#cover-spin').show(0);
  console.log("ini datanya = ", formData)
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url:"{{ url('/employ/storesp') }}",
    data:formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#pagetransfer").html('');
      $("#ModalTransfer").modal("hide");
      $('#cover-spin').hide();
      reademploy();
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

</script>


<script>
$('#employ-list').on('click', '.pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    getPelamar(url);
    window.history.pushState("", "", url);

    function getPelamar(url) {
      $.ajax({
          url : url
      }).done(function (data) {
          $('#read').html(data);  
      });
    };

});

</script>

<script>
// Tab
document.getElementById("employee").style.display="block";
// document.getElementById("defaultOpen").click();

function tabGeneral(evt, tab) {
  var i, tabcontent, tablinks, hide_nav, nav_atas;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tab).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>


<style>
  .sticky-col-name,
.sticky-col-id,
.sticky-col-ckbx {
  position: sticky;
  background-color: #E2E7FB !important; /* Warna kuning mencolok dengan !important */
  z-index: 2;
}

.sticky-col-name {
  left: 43px ;
  padding-left: 0px; /* Beri jarak padding agar isi tetap terlihat */
}
.sticky-col-ckbx {
  left: 0 ;
  padding-left: 0px; /* Beri jarak padding agar isi tetap terlihat */
}

.sticky-col-id {
  left: 197px; /* Sesuaikan jarak untuk membuat tampilan lebih baik */
}

.zui-sticky-col{
  right: 0;
  border-left: 1px solid #A7A7A7;

}


.zui-sticky-col {
position: sticky;
z-index: 2;
border-left: 1px solid #A7A7A7;
background-color: #E2E7FB !important; /* Warna kuning mencolok dengan !important */
}


</style>