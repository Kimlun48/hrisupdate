
<!--
//Di Blade Yang Akan Di pasangkan Row dan Pagination Masukan Koding ini di Bawah Table
    <table id="myTable">
        isikan data Yang Diinginkan
    </table>

      <select id="showEntries" class="show-entries mb-2 form-control form-control-sm col-sm-1" >
        <option value="5">Show 5</option>
        <option value="10">Show 10</option>
        <option value="25">Show 25</option>
        <option value="50">Show 50</option>
        <option value="100">Show 100</option>
      </select>
    </div>
    <div class="pagination" id="pagination">
        <a href="javascript:void(0)" id="prevPage">Previous</a>
        <a href="javascript:void(0)" id="nextPage">Next</a>
    </div>
    <br><br>
    <div id="dataCount"></div>

//setelah  di masukan di blade yang akan di pasang tinggal masukan

    @ include('folderapa.scriptpage_row') 

//di blade yang di pasangnya
-->

<!-- Show Berapa Banyak Data dan Pagination -->
<script>
    var currentPage = 1;
    var rowsPerPage = parseInt(document.getElementById('showEntries').value);
    var table = document.getElementById("myTable");
    var tbody = table.getElementsByTagName("tbody")[0];
    var rows = tbody.getElementsByTagName("tr");
    var totalPages = Math.ceil(rows.length / rowsPerPage);

    function showRows() {
        for (var i = 0; i < rows.length; i++) {
            rows[i].style.display = 'none';
        }

        var startIndex = (currentPage - 1) * rowsPerPage;
        var endIndex = startIndex + rowsPerPage;

        for (var j = startIndex; j < endIndex && j < rows.length; j++) {
            rows[j].style.display = 'table-row';
        }
    }

    function renderPagination() {
        var numRows = rows.length;
        var numPages = Math.ceil(numRows / rowsPerPage);

        var pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        if (currentPage > 1) {
            var firstPageLink = document.createElement('a');
            firstPageLink.href = 'javascript:void(0)';
            firstPageLink.textContent = '<<';
            firstPageLink.addEventListener('click', function () {
                currentPage = 1;
                showRows();
                renderPagination();
            });
            pagination.appendChild(firstPageLink);

            var prevPageLink = document.createElement('a');
            prevPageLink.href = 'javascript:void(0)';
            prevPageLink.textContent = 'Prev';
            prevPageLink.addEventListener('click', function () {
                currentPage--;
                showRows();
                renderPagination();
            });
            pagination.appendChild(prevPageLink);
        }

        // Menampilkan hanya 5 nomor halaman sekaligus
        var startPage = Math.max(1, currentPage - 2);
        var endPage = Math.min(numPages, currentPage + 2);

        for (var i = startPage; i <= endPage; i++) {
            var pageLink = document.createElement('a');
            pageLink.href = 'javascript:void(0)';
            pageLink.textContent = i;
            if (i === currentPage) {
                pageLink.classList.add('active');
            }
            pageLink.addEventListener('click', function (page) {
                return function () {
                    currentPage = page;
                    showRows();
                    renderPagination();
                };
            }(i));
            pagination.appendChild(pageLink);
        }

        if (currentPage < numPages) {
            var nextPageLink = document.createElement('a');
            nextPageLink.href = 'javascript:void(0)';
            nextPageLink.textContent = 'Next';
            nextPageLink.addEventListener('click', function () {
                currentPage++;
                showRows();
                renderPagination();
            });
            pagination.appendChild(nextPageLink);

            var endPageLink = document.createElement('a');
            endPageLink.href = 'javascript:void(0)';
            endPageLink.textContent = '>>';
            endPageLink.addEventListener('click', function () {
                currentPage = numPages;
                showRows();
                renderPagination();
            });
            pagination.appendChild(endPageLink);
        }

        var dataCount = document.getElementById('dataCount');
        dataCount.textContent = 'Page ' + currentPage + ' of ' + numPages;
    }

    function handleShowEntries() {
        rowsPerPage = parseInt(document.getElementById('showEntries').value, 10);
        currentPage = 1;
        showRows();
        renderPagination();
    }

    var showEntriesSelect = document.getElementById('showEntries');
    showEntriesSelect.addEventListener('change', handleShowEntries);

    showRows();
    renderPagination();
</script>

<style>
    .table-container {
        height: 200px;
        width: 1000px;
        overflow: auto;
    }

    .pagination {
        display: inline-block;
        margin-top: 10px;
    }

    .pagination a {
        color: #000; /* Mengubah warna teks menjadi hitam */
        background-color: #fff; /* Mengubah latar belakang menjadi putih */
        border: 1px solid #00BFFF;
        padding: 5px 8px;
        text-decoration: none;
        margin: 0 4px;
        border-radius: 4px;
    }

    .pagination a.active {
        background-color: #00BFFF;
        border-color: #00BFFF;
        color: #fff; /* Mengubah warna teks saat aktif menjadi putih */
    }

    .pagination a:hover:not(.active) {
        background-color: #00BFFF; /* Mengubah latar belakang menjadi biru saat dihover */
        color: #fff; /* Mengubah warna teks menjadi putih saat dihover */
    }

    .show-entries-container {
        margin-top: 10px;
    }

    .show-entries-label {
        font-weight: bold;
    }

    .show-entries-select {
        padding: 4px;
    }

    .show-entries-option {
        padding: 4px;
    }

    .ellipsis {
        display: inline-block;
        width: 20px;
        text-align: center;
    }
</style>
<!-- Akhir Show Berapa Banyak Data dan Pagination-->