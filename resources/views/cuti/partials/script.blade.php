
<script type="text/javascript">
    $(document).ready(function() {
        read();
    });

    function read() {
        $.get("{{ url('/cuti/readcuti') }}", {}, function(data, status) {
            $("#read").html(data);
        });
    }

    function create() {
        $.get("{{ url('/cuti/create') }}", {}, function(data, status) {
            $("#ModalparamLabel").html('Bulk Cuti');
            $("#page").html(data);
            $("#Modalparam").modal('show');
        });
    }

    function edit(id) {
        $.get("{{ url('/cuti/edit/') }}/"+id,{}, 	    
            function(data,status){
            $("#ModalparamLabel").html('Edit Param Cuti Karyawan');
            $("#page").html(data);
            $("#Modalparam").modal('show');    
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
            url: "{{ url('/cuti/eksebulkcutikar') }}",
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
            error: function (xhr, textStatus, errorThrown) {
            $('input[name="fileimportinter"]').val('');
            var errorMessage = "Terjadi kesalahan saat memproses permintaan Anda.";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            Swal.fire({
                title: "Error!",
                text: errorMessage,
                icon: "error",
                footer: `<button id="customButton" class="btn btn-primary btn-block mt-4" onclick="exportTableToCSV('members.csv')">Ekspor Kesalahan</button>`
            });
        }
    });
}



function storeedit() {
        event.preventDefault();
        var form = $('#editForm')[0];
        var formData = new FormData(form);
        console.log("ini datanya = ", formData)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/cuti/storeedit') }}",
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
                    timer: 1500
                });
            },
            error: function(data) {

            }
        });
    }
function exportTableToCSV(filename) {
    var csv = [];
	var rows =  document.getElementById("swal2-html-container"); 
    console.log(rows.firstChild.textContent);
    csv.push(rows.firstChild.textContent);		
    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}

function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;
    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});
    // Download link
    downloadLink = document.createElement("a");
    // File name
    downloadLink.download = filename;
    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);
    // Hide download link
    downloadLink.style.display = "none";
    // Add the link to DOM
    document.body.appendChild(downloadLink);
    // Click download link
    downloadLink.click();
}


    </script>