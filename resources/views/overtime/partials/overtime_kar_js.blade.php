<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" defer/>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js" defer></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" defer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js" defer></script>

<script type="text/javascript">
    $(document).ready(function() {
        read();
    });



    function read() {
        $.get("{{ url('/ovtime/bacadatakar') }}", {}, function(data, status) {
            $("#read").html(data);
        });
    }


  function detail(id) {
        $.get("{{ url('/ovtime/detail/') }}/"+id, {}, function(data, status) {
            $("#ModalparamLabel").html('Request Over Time Detail');
            $("#page").html(data);
            $("#Modalparam").modal('show');
        });
    }


    function create() {
        $.get("{{ url('/ovtime/createovertimekar') }}", {}, function(data, status) {
            $("#ModalparamLabel").html('Add Over Time');
            $("#page").html(data);
            $("#Modalparam").modal('show');
            $('.timepicker').timepicker({ zindex: 9999999,timeFormat: 'HH:mm'});

        });
    }

        // // // Close Modal
    function CloseModal() {
        $("#Modalparam").modal("hide");
    }


 function timepickersepur() {
    (function($) {
    $(function() {
      $('input.timepicker').timepicker({ 
        // 'timeFormat': 'h:mm:i'
      });
    });
  })(jQuery);
    }




function storeovertimekar() {
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
        url: "{{ url('/ovtime/storeovertimekar') }}",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data, textStatus, xhr) {
            $("#page").html('');
            read();
            $("#page").html(data);
            $("#Modalparam").modal("hide");
            Swal.fire({
                icon: 'success',
                title: data.message,
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: 'Yes',
                timer: 1500
            });
        },
        error: function(xhr, status, error) {
        var errorResponse = xhr.responseJSON;
        var errorMessage = errorResponse.message;

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: errorMessage,
        });
        // error: function(data) {
        }
        // }
    });
}
</script>
