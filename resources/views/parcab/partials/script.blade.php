<!-- selectize -->
<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
  $(document).ready(function () {
    read();

    $("#search").on("keyup", function () {
      var value = $(this).val().toLowerCase();
      // Menemukan semua baris dalam tabel
      var rows = $('#myTable tbody tr');
      var anyRowMatches = false; // Apakah ada baris yang cocok
      rows.each(function() {
        // Mengambil semua teks dalam baris
        var rowText = $(this).text().toLowerCase();
        // Memeriksa apakah teks dalam baris cocok dengan nilai pencarian
        if (rowText.includes(value)) {
          $(this).show(); // Menampilkan baris jika cocok
          anyRowMatches = true; // Setel flag menjadi true
        } else {
          $(this).hide(); // Menyembunyikan baris jika tidak cocok
        }
      });
      // Memeriksa apakah ada baris yang cocok
      if (!anyRowMatches) {
        // Jika tidak ada baris yang cocok, tampilkan pesan
        $("#myTable tbody").append('<tr id="no-data-row"><td colspan="7"><div class="alert alert-danger text-center">Data yang ada cari tidak tersedia.</div></td></tr>');
      } else {
        // Jika ada baris yang cocok, hapus pesan jika ada
        $("#no-data-row").remove();
      }
    });
  });

  function read() {
    $.get("/parcab/readdata", {}, function (data, status) {
      $("#readparcab").html(data);
    });
  }

  function edit(id) {
    $.get("{{ url('/parcab/showedit/') }}/" + id, {}, function (data, status) {
      $("#ModalCreateLabel").html('Edit Param Approve cabang');
      $("#page").html(data);
      $("#ModalCreate").modal('show');
    });
  }

  function createparcab() {
    $.get("/parcab/showcreate/", {}, function (data, status) {
      $("#ModalCreateLabel").html('Create Param Approve cabang');
      $("#page").html(data);
      $("#ModalCreate").modal('show');
    });
  }

  function Close() {
    $("#ModalCreateLabel").modal("hide");
    $("#page").modal("hide");
    $("#ModalCreate").modal("hide");
  }

  function saveparam(event) {
    if (event) {
        event.preventDefault();
    }

    var form = $('#createForm')[0];
    var formData = new FormData(form);

    commonAjaxSetup(formData, "/parcab/saveparam/", function (data, textStatus, xhr) {
        $("#page").html('');
        $("#ModalCreate").modal("hide");
        read();

        Swal.fire({
            icon: 'success',
            title: data.message,
            showDenyButton: false,
            showCancelButton: false,
            timer: 1500
        }).then(function () {
            loadTabContent('branch', 1); // Panggil fungsi untuk menampilkan tab branch setelah AJAX berhasil
        });
    }, function (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred while processing your request.',
            showDenyButton: false,
            showCancelButton: false,
            timer: 1500
        });
    });
}

function storeedit(event) {
    if (event) {
        event.preventDefault();
    }

    var form = $('#createForm')[0];
    var formData = new FormData(form);

    commonAjaxSetup(formData, "{{ url('/parcab/createallkarparam') }}", function (data, textStatus, xhr) {
        $("#page").html('');
        $("#ModalCreate").modal("hide");
        read();

        Swal.fire({
            icon: 'success',
            title: data.message,
            text: 'Edit Param Aprrove Success.',
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: 'Yes',
            timer: 1500
        }).then(function () {
            loadTabContent('branch', 1); // Panggil fungsi untuk menampilkan tab branch setelah AJAX berhasil
        });
    }, function (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred while processing your request.',
            showDenyButton: false,
            showCancelButton: false,
            timer: 1500
        });
    });
}

function commonAjaxSetup(formData, url, successCallback, errorCallback) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: successCallback,
        error: errorCallback
    });
}

</script>
