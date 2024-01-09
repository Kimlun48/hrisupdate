@extends('layouts.app-master')

@section('content')
<div class="employ">
    <div class="container">
        <h5 class="title-employ">RESIGN REQUEST INTERNAL</h5>
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
            <div id="loader-overlay" class="loader-overlay">
                <!-- Add your loading spinner or text here -->
                <div class="spinnerContainer">
                    <div class="spinner"></div>
                    <div class="loader">
                        <p>loading</p>
                        <div class="words">
                            <span class="word">Data</span>
                            <span class="word">Data</span>
                            <span class="word">Data</span>
                            <span class="word">Data</span>
                            <span class="word">Data</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
<script>
// $(document).ready(function () {
//     // Load the content for the default tab (Request Resign)
//     loadTabContent('readallaju', 1);
    
//     // Handle tab clicks
//     $('.nav a').click(function (e) {
//         e.preventDefault();
//         var tab = $(this).data('tab');
//         $('.nav a').removeClass('active'); // Remove active class from all tabs
//         $(this).addClass('active'); // Add active class to the clicked tab
//         loadTabContent(tab, 1); // Load content for the clicked tab
//     });
// });

// function loadTabContent(tab, page) {
//     $.ajax({
//         url: '/resignterm/' + tab + '?page=' + page,
//         type: 'GET',
//         success: function (response) {
//             $('#tab-content').html(response);
//             setupPagination(tab); // Set up pagination for the loaded content
//         }
//     });
// }

    // {UNTUK PAGINATION PADA SEMUA TAB NYA}
// function setupPagination(tab) {
//     $('.pagination a').on('click', function (e) {
//         e.preventDefault();
//         var page = $(this).attr('href').split('page=')[1];
//         loadTabContent(tab, page);
//     });
// }
</script>

<script>
$(document).ready(function () {

    // Load the content for the default tab (Request Resign)
    showLoader();
    loadTabContent('readallaju', 1);
    
    // Handle tab clicks
    $('.nav a').click(function (e) {
        e.preventDefault();
        var tab = $(this).data('tab');
        $('.nav a').removeClass('active'); // Remove active class from all tabs
        $(this).addClass('active'); // Add active class to the clicked tab
        showLoader(); // Show the loader overlay
        loadTabContent(tab, 1); // Load content for the clicked tab
    });
});
var loaderStartTime;

function showLoader() {
    loaderStartTime = Date.now();
    $('#loader-overlay').show();
    setTimeout(function () {
        hideLoader();
    }, 2000); 
}


function hideLoader() {
    var currentTime = Date.now();
    var elapsedTime = currentTime - loaderStartTime;

    if (elapsedTime >= 2000) {
        $('#loader-overlay').hide();
    } else {
        // Jika belum 10 detik, tunggu sisa waktu yang diperlukan sebelum menyembunyikan loader
        setTimeout(function () {
            $('#loader-overlay').hide();
        }, 2000 - elapsedTime);
    }
}


function loadTabContent(tab, page) {
    $.ajax({
        url: '/resignterm/' + tab + '?page=' + page,
        type: 'GET',
        success: function (response) {
            hideLoader(); // Hide the loader overlay when content is loaded
            $('#tab-content').html(response);
            setupPagination(tab); // Set up pagination for the loaded content
        }
    });
}

function setupPagination(tab) {
    $('.pagination a').on('click', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        loadTabContent(tab, page);
    });
}
</script>

<style>
.loader-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
    z-index: 9999;
    text-align: center;
    padding-top: 20%;
}

.spinnerContainer {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.spinner {
  width: 56px;
  height: 56px;
  display: grid;
  border: 4px solid #0000;
  border-radius: 50%;
  border-right-color: #299fff;
  animation: tri-spinner 1s infinite linear;
}

.spinner::before,
.spinner::after {
  content: "";
  grid-area: 1/1;
  margin: 2px;
  border: inherit;
  border-radius: 50%;
  animation: tri-spinner 2s infinite;
}

.spinner::after {
  margin: 8px;
  animation-duration: 3s;
}

@keyframes tri-spinner {
  100% {
    transform: rotate(1turn);
  }
}

.loader {
  color: #4a4a4a;
  font-family: "Poppins",sans-serif;
  font-weight: 500;
  font-size: 25px;
  -webkit-box-sizing: content-box;
  box-sizing: content-box;
  height: 40px;
  padding: 10px 10px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  border-radius: 8px;
}

.words {
  overflow: hidden;
}

.word {
  display: block;
  height: 100%;
  padding-left: 6px;
  color: #299fff;
  animation: cycle-words 5s infinite;
}

@keyframes cycle-words {
  10% {
    -webkit-transform: translateY(-105%);
    transform: translateY(-105%);
  }

  25% {
    -webkit-transform: translateY(-100%);
    transform: translateY(-100%);
  }

  35% {
    -webkit-transform: translateY(-205%);
    transform: translateY(-205%);
  }

  50% {
    -webkit-transform: translateY(-200%);
    transform: translateY(-200%);
  }

  60% {
    -webkit-transform: translateY(-305%);
    transform: translateY(-305%);
  }

  75% {
    -webkit-transform: translateY(-300%);
    transform: translateY(-300%);
  }

  85% {
    -webkit-transform: translateY(-405%);
    transform: translateY(-405%);
  }

  100% {
    -webkit-transform: translateY(-400%);
    transform: translateY(-400%);
  }
}

</style>

@endsection
