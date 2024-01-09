<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.all.min.js" integrity="sha512-LXVbtSLdKM9Rpog8WtfAbD3Wks1NSDE7tMwOW3XbQTPQnaTrpIot0rzzekOslA1DVbXSVzS7c/lWZHRGkn3Xpg==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        read();
    });

    function read() {
        $.get("{{ url('/paroff/readparam') }}", {}, function(data, status) {
            $("#readtimeoff").html(data);
        });
    }


// Close Modal
    function Close() {
        $("#ModalCreate").modal("hide");
    }

    // Membuat Halaman Modal Dan Form Create
    function edit(id) {
        $.get("{{ url('/paroff/edit/') }}/"+id, {}, function(data, status) {
            $("#ModalCreateLabel").html('Edit Param Off');
            $("#page").html(data);
            $("#ModalCreate").modal('show');
        });
    }

    function createpartimeoff() {
        $.get("{{ url('/paroff/create') }}", {}, function(data, status) {
            $("#ModalCreateLabel").html('Add Param Periode');
            $("#page").html(data);
            $("#ModalCreate").modal('show');
        });
    }

    function storeedit(id) {
        event.preventDefault();
        var form = $('#editForm')[0];
        var formData = new FormData(form);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/paroff/storeedit') }}/"+id,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
                $("#ModalCreate").modal("hide");
                read();
                $("#page").html(data);
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Yes',
                    // timer: 1500
                });
              
            },
            error: function(data) {

            }
        });
    }

    
    function createparam() {
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
            url: "{{ url('/paroff/store') }}",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
                read();
                $("#page").html(data);
                $("#ModalCreate").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Yes',
                    // timer: 1500
                });
            },
            error: function(data) {

            }
        });
    }


</script>

