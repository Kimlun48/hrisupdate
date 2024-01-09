@extends('layouts.app-master')

@section('content')
<div class="employ">
    <div class="container">
        <h5 class="title-employ">RESIGN REQUEST EXTERNAL</h5>
        <hr class="border"/>
        <div class="table-body">
            <div class="tab">
                <ul class="nav text-dark text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link tablinks active" href="#" data-tab="readallaju">                    
                            <span class="fa-stack fa-1x me-2">
                                <i class="fas fa-solid fa-circle fa-stack-2x" style="color: grey"></i>
                            </span>
                            Request Resign
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tablinks" href="#" data-tab="nonactive">
                            <span class="fa-stack fa-1x me-2">
                                <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #003153"></i>
                            </span>
                            Non Active
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tablinks" href="#" data-tab="readalmostexpired">
                            <span class="fa-stack fa-1x me-2" >
                                <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #F46060"></i>
                            </span>
                            Almost Expired
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tablinks" href="#" data-tab="readexpired">
                            <span class="fa-stack fa-1x me-2" >
                                <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #630606"></i>
                            </span>
                            Expired At
                        </a>
                    </li>
                    <!-- Add other tab links here -->
                </ul>
            </div>
            <div id="tab-content">
                <!-- Default content for the active tab (Request Resign) -->
                <!-- Load content using AJAX as needed -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
<script>
$(document).ready(function () {
    // Load the content for the default tab (Request Resign)
    loadTabContent('readallaju', 1);
    
    // Handle tab clicks
    $('.nav a').click(function (e) {
        e.preventDefault();
        var tab = $(this).data('tab');
        $('.nav a').removeClass('active'); // Remove active class from all tabs
        $(this).addClass('active'); // Add active class to the clicked tab
        loadTabContent(tab, 1); // Load content for the clicked tab
    });
});

function loadTabContent(tab, page) {
    $.ajax({
        url: '/resignterm/external/' + tab + '?page=' + page,
        type: 'GET',
        success: function (response) {
            $('#tab-content').html(response);
            setupPagination(tab); // Set up pagination for the loaded content
        }
    });
}

    // {UNTUK PAGINATION PADA SEMUA TAB NYA}
// function setupPagination(tab) {
//     $('.pagination a').on('click', function (e) {
//         e.preventDefault();
//         var page = $(this).attr('href').split('page=')[1];
//         loadTabContent(tab, page);
//     });
// }
</script>

@endsection
