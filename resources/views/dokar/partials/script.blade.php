    <!-- selectize -->
    <link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $(document).ready(function() {
        read();
    });

    function read() {
        $.get("{{ url('/dokar/read') }}", {}, function(data, status) {
            $("#read").html(data);
        });
    }

    // Close Modal
    function Close() {
        $('#ModalDokar').modal('hide');
    }
    // Membuat Halaman Modal Dan Form Create
    function edit(id) {
        $.get("{{ url('/dokar/edit/') }}/"+id, {}, function(data, status) {
            $("#ModalDokarLabel").html('Edit Document Employee');
            $("#page").html(data);
            $("#ModalDokar").modal('show');
        });
    }

    function create() {
        $.get("{{ url('/dokar/create') }}", {}, function(data, status) {
            $("#ModalDokarLabel").html('Add Document Employee');
            $("#page").html(data);
            $("#ModalDokar").modal('show');
        });
    }

    function showisi(id) {
        $.get("{{ url('/pasal/showisi/') }}/"+id, {}, function(data, status) {
            $("#ModalDokarLabel").html('Isi Ayat Pasal');
            $("#page").html(data);
            $("#ModalDokar").modal('show');
        });
    }

    function storeedit() {
        event.preventDefault();
        var form = $('#editForm')[0];
        var formData = new FormData(form);
        console.log("ini datanya = ", formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/dokar/storeedit') }}",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
                $("#ModalDokar").modal("hide");
                read();
                $("#page").html(data);
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
                // Penanganan kesalahan di sini
                console.error("AJAX Error:", textStatus, errorThrown);
                // Tampilkan pesan kesalahan kepada pengguna
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: 'Gagal mengirim data ke server. Silakan coba lagi nanti.',
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                });
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
            url: "{{ url('/dokar/store') }}",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
                read();
                $("#page").html(data);
                $("#ModalDokar").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Yes',
                    timer: 1500
                });
            },
            error: function(data) {

            }
        });
    }
</script>