<script>
    var isLoaded = true;

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        if (!isLoaded) return; // prevent multiple clicks while the data is still loading
        isLoaded = false;
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'get',
            success: function (data) {
                $('#paginate-content').html(data);
                isLoaded = true;
            },
            error: function () {
                isLoaded = true;
            }
        });
    });
</script>