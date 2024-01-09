<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">  
$(document).ready(function(){
  readalmostexpired();
  readexpired();
});

function reademploy() {
    $.get("{{ url('/employ/showemploy') }}",{},
  function(data,status){
    $("#read").html(data.data_employ);
  });
}

// Close Modalaaaaaa
function Close() {
    $("#ModalResign").modal("hide");
    $("#ModalTransfer").modal("hide");
    $("#exampleModalCenter2").modal("hide");
}
/// Almost Expired
function readalmostexpired() {
    $.get("{{ url('/employ/suborabsen') }}",{}, 
  function(data,status){
    $("#readalmostexpired").html(data);
  });
}




  
</script>

<script>
  function Close() {
      $("#ModalSP").modal("hide");
  }

  $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        getSub(url);
        window.history.pushState("", "", url);

        function getSub(url) {
          $.ajax({
              url : url
          }).done(function (data) {
              $('#sub').html(data);  
          });
        };

    });

  function showsp(id) {
  $.get("{{ url('/employ/showsp/') }}/"+id,{}, 
  function(data,status){
      $("#ModalSPLabel").html('Pengajuan Teguran / Peringatan');
      $("#pagesp").html(data);
      $("#ModalSP").modal('show');
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
      // $("#pagesp").html('');
      $("#ModalSP").modal("hide");
      $('#cover-spin').hide();
      $('#pagesp').load('#pagesp');
      Swal.fire({
        icon: 'success',
          title: data.message,
          showDenyButton: false,
          showCancelButton: false,
          confirmButtonText: 'Ok',
          timer: 1500 
      });
    },
      error:function(data){
        
    }
      });
    }

  function cekpasal() {
  var selectBox = document.getElementById('pasal');
  var id = selectBox.options[selectBox.selectedIndex].value;
  $.get("{{ url('/employ/cekpasal/') }}/"+id,{}, 
    function(data,status){
        $("#datapasal").html(data.data.isiayat);
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
document.getElementById("employee").style.display="block"
document.getElementById("defaultOpen").click();

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
