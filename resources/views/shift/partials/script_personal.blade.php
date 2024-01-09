<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
<script type="text/javascript">

$(document).ready(function(){
// read();
// requestshift();
});

//Membuat Halaman Modal Dan Form Create
function create() {
  $.get("{{ url('/shift/karcreate') }}",{}, 
  function(data,status){
    $("#exampleModalLabel").html('Change Shift');
    $("#pagechange").html(data);
    $("#changeshift").modal('show');    
  });
} 
//Membuat Halaman Read Data
function read() {
    $.get("{{ url('/shift/shiftkar') }}",{},
  function(data,status){
    $("#pagechange").html(data);
  });
}

function requestshift() {
$.get("{{ url('/shift/requestshift') }}",{}, 
    function(data,status){
$("#change").html(data);
    });
}

// Close odal
function Close() {
  $("#changeshift").modal("hide");
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
      url:"{{ url('shift/storechangeshift') }}",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      type: 'POST',
      success:function(data){
        //$("#close-button").click();
        $("#pagechange").html('');
        $("#changeshift").modal("hide");
        requestshift();
        alert(data.message);
      },
        error:function(request, error){
         var err = JSON.parse(request.responseText);
         alert(err.message);
      }
    });
}
</script>