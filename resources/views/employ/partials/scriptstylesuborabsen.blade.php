<style>
    .export-attendance {
  margin-bottom: 10px;
  margin-top: 5px;
  background: #D2CFCF;
  float: left;
  width: 65%;
  padding: 10px;
  border-radius: 10px;
}

.export-attendance .report .group-export .col-form-input-1 {
  border: 2px solid #999999;
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
  margin-right: 5px;
}

.export-attendance .report .group-export .col-form-input-2 {
  border: 2px solid #999999;
  border-radius: 0px;
  margin-right: 5px;
}

.export-attendance .report .group-export .col-form-input-3 {
  border: 2px solid #999999;
  border-radius: 0px;
  margin-right: 5px;
}

.export-attendance .report .group-export .col-form-input-4 {
  border: 2px solid #999999;
  border-radius: 0px;
  margin-right: 5px;
}

.export-attendance .report .group-export .col-form-input-5 {
  border: 2px solid #999999;
  border-radius: 0px;
  margin-right: 5px;
}

.export-attendance .report .group-export .btn-process {
  background-color: #0B3AB1;
  color: #fff;
  border-radius: 10px;
  border: none;
  border-top-left-radius: 0px;
  border-bottom-left-radius: 0px;
  margin-left: -5px;
}

.isi {
  font-family: 'Nunito Sans';
  font-style: normal;
  font-weight: 400;
  font-size: 13px;
  line-height: 19px;
  color: #000000;
}

.isi .nomor {
  padding-top: 20px;
}

.isi .name {
  padding-top: 20px;
}

.isi .nik {
  padding-top: 20px;
}

.isi .id {
  padding-top: 20px;
}

.isi .branch {
  padding-top: 20px;
}

.isi .date {
  padding-top: 20px;
}

.isi .position {
  padding-top: 20px;
}

.isi .clock-in .row-clock-in .col-img-attendance .img-attendance {
  height: 40px;
  width: 40px;
  border: 1px solid #999999;
  border-radius: 50%;
}

.isi .clock-in .row-clock-in .col-text {
  padding-top: 10px;
}

.isi .clock-out .row-clock-out .col-img-attendance .img-attendance {
  height: 40px;
  width: 40px;
  border: 1px solid #999999;
  border-radius: 50%;
}

.isi .clock-out .row-clock-out .col-text {
  padding-top: 10px;
}

.isi .desk {
  padding-top: 20px;
}


</style>

<!-- <script>
var isLoaded = true;

$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    if (!isLoaded) return; // prevent multiple clicks while the data is still loading
    
    var clickedLink = $(this);
    if (clickedLink.hasClass('active')) return; // prevent clicking on active link
    
    isLoaded = false;
    var url = clickedLink.attr('href');
    $.ajax({
        url: url,
        type: 'get',
        success: function (data) {
            var newContent = $(data).find('.table.data-table tbody').html();
            $('.table.data-table tbody').empty().html(newContent);
            
            $('.pagination-links .page-item').removeClass('active');
            clickedLink.parent().addClass('active');
            
            isLoaded = true;
        },
        error: function () {
            isLoaded = true;
        }
    });
});


</script> -->

<script>
    $(document).ready(function() {
        // Fungsi untuk menangani klik pada tautan paginasi
        $(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    $('table').html($(data).find('table').html());
                    $('.pagination-links').html($(data).find('.pagination-links').html());

                    // Hapus kelas 'active' dari semua item halaman
                    $('.pagination li.page-item').removeClass('active');

                    // Ganti <span> dengan <a> untuk semua item halaman
                    $('.pagination li span').each(function() {
                        $(this).replaceWith('<a href="' + url + '">' + $(this).html() + '</a>');
                    });

                    // Tambahkan kelas 'active' ke tautan halaman yang sesuai dengan halaman saat ini
                    $('.pagination li').find('a[href="' + url + '"]').parent().addClass('active');
                }
            });
        });
    });
</script>


