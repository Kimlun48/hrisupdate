<!-- <div class="col-md-12 d-flex justify-content-end align-items-center">
      <form class="search" id="searchForm" style="margin-top: -35px;">
        <div class="form-group has-search">
          <span class="fa fa-search form-control-feedback"></span>
          <input type="text" class="form-control" placeholder="Search" id="search" name="search">
        </div>
      </form>
    </div>  -->


<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
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
            $("#myTable tbody").append('<tr id="no-data-row"><td colspan="9"><div class="alert alert-danger text-center">Data yang ada cari tidak tersedia.</div></td></tr>');
            } else {
            // Jika ada baris yang cocok, hapus pesan jika ada
            $("#no-data-row").remove();
            }
        });
    });
</script>

<style>
  .has-search .form-control {
    padding-left: 2.375rem;
    border-radius: 10px;

  }

  .has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
  }
</style>