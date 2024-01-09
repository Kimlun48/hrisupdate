<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.all.min.js" integrity="sha512-LXVbtSLdKM9Rpog8WtfAbD3Wks1NSDE7tMwOW3XbQTPQnaTrpIot0rzzekOslA1DVbXSVzS7c/lWZHRGkn3Xpg==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        read();
    });

    function read() {
        $.get("{{ url('/parcom/readparam') }}", {}, function(data, status) {
            $("#read").html(data);
        });
    }


// Close Modal
    function Close() {
        $("#Modalparam").modal("hide");
    }

    // Membuat Halaman Modal Dan Form Create
    function edit(id) {
        $.get("{{ url('/parcom/edit/') }}/"+id, {}, function(data, status) {
            $("#ModalparamLabel").html('Edit Param Presensi');
            $("#page").html(data);
            $("#Modalparam").modal('show');
        });
    }

    function create() {
        $.get("{{ url('/parcom/create') }}", {}, function(data, status) {
            $("#ModalparamLabel").html('Add Param Presensi');
            $("#page").html(data);
            $("#Modalparam").modal('show');
        });
    }

    function showisi(id) {
        $.get("{{ url('/parcom/showisi/') }}/"+id, {}, function(data, status) {
            $("#ModalparamLabel").html('Isi Ayat Pasal');
            $("#page").html(data);
            $("#Modalparam").modal('show');
        });
    }

    function storeedit() {
        event.preventDefault();
        var form = $('#editForm')[0];
        var formData = new FormData(form);
        formData.set('nama', formData.get('nama').toUpperCase());
        console.log("ini datanya = ", formData.set('nama', formData.get('nama').toUpperCase()))
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/parcom/storeedit') }}",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
                $("#Modalparam").modal("hide");
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
            url: "{{ url('/parcom/store') }}",
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
                    // timer: 1500
                });
            },
            error: function(data) {

            }
        });
    }


    function createdeductions() {
        event.preventDefault();
        var form = $('#createFormDeductions')[0];
        var formData = new FormData(form);
        console.log("ini datanya = ", formData)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/parcom/store') }}",
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
                    // timer: 1500
                });
            },
            error: function(data) {

            }
        });
    }

    function createbenefit() {
        event.preventDefault();
        var form = $('#createFormBenefit')[0];
        var formData = new FormData(form);
        console.log("ini datanya = ", formData)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/parcom/store') }}",
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
                    // timer: 1500
                });
            },
            error: function(data) {

            }
        });
    }

    function confirmEditAllowance(id) {
        event.preventDefault();
        var form = $('#editallowance_'+id)[0];
        var formData = new FormData(form);
        console.log("ini datanya = ", formData)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
	});
	Swal.fire({
        icon: 'warning',
        title: 'Confirmation',
        text: 'Apakah Anda Yakin Akan Menonaktifkan Param Ini?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
	}).then(function(result) {
        if (result.isConfirmed) {
        $.ajax({
            url: "{{ url('/parcom/storeedit') }}/"+id,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
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
  });
}
function confirmEditDeductive(id) {
        event.preventDefault();
        var form = $('#editdeductive_'+id)[0];
        var formData = new FormData(form);
        console.log("ini datanya = ", formData)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
	});
	Swal.fire({
        icon: 'warning',
        title: 'Confirmation',
        text: 'Apakah Anda Yakin Akan Menonaktifkan Param Ini?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
	}).then(function(result) {
        if (result.isConfirmed) {
        $.ajax({
            url: "{{ url('/parcom/storeedit') }}/"+id,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
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
  });
}
function confirmEditBenefit(id) {
        event.preventDefault();
        var form = $('#editbenefit_'+id)[0];
        var formData = new FormData(form);
        console.log("ini datanya = ", formData)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
	});
	Swal.fire({
        icon: 'warning',
        title: 'Confirmation',
        text: 'Apakah Anda Yakin Akan Menonaktifkan Param Ini?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
	}).then(function(result) {
        if (result.isConfirmed) {
        $.ajax({
            url: "{{ url('/parcom/storeedit') }}/"+id,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, textStatus, xhr) {
                $("#page").html('');
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
  });
}

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.all.min.js" integrity="sha512-LXVbtSLdKM9Rpog8WtfAbD3Wks1NSDE7tMwOW3XbQTPQnaTrpIot0rzzekOslA1DVbXSVzS7c/lWZHRGkn3Xpg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function()
{
    $('#nama').keyup(function()
    {
        $(this).val($(this).val().toUpperCase());
    });
});


    //Cek Data Jika Ada
    $('#nama').on('change', function() {
    var nama = $(this).val();
    console.log('ini name===',nama);
    $.ajax({
        url: '/parcom/cekinputpartun',
        method: 'get',
        data: {nama: nama},
        success: function(data) {
            console.log('ini console22===',data);
            
            if(data.message){
            Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Yes',
                    // timer: 1500
                });
            $('input[type="text"],textarea').val('');
        }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});


$(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var x = location.origin;
        $.ajax({
            url: url,
            type: 'get',
            success: function (data) {
                $('table').html($(data).find('table').html());
                $('.pagination-links').html($(data).find('.pagination-links').html());
                $('.pagination li.page-item').removeClass('active');
                 $('.pagination li span').each(function() {
                  //$(this).replaceWith('<a href="http://127.0.0.1:8000/employ/readexternal?page=1">' + $(this).html() + '</a>');
                  $(this).replaceWith('<a href='+x+'/parcom/readparam?page=1>' + $(this).html() + '</a>');
                 });

            // add the active class to the link page that corresponds to the current page
            $('.pagination li').find('a[href="' + url + '"]').parent().addClass('active');
            }
        });
    });
</script>

