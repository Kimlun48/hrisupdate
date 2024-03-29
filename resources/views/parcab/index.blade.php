@extends('layouts.app-master')

@section('content-employ')
<div class="param-approve">
  <div class="head">
    <h5 class="title-applicant">Param Approve</h5>
  </div>
  <div class="container">
    <div class="table-body mb-3">
      <div class="tab mt-3">
        <ul class="nav head-tab text-dark text-uppercase">
          <li class="nav-item">
            <a class="nav-link tablinks active" href="#" data-tab="branch">                    
              Parent Job
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link tablinks" href="#" data-tab="pic">
                PIC
              </a>
          </li>
          <!-- Add other tab links here -->
        </ul>
      </div>
      <!-- <button type="button" class="btn btn-primary btn-sm d-flex ms-auto" onClick="create()"><i class="fas fa-plus" style="color:#fff;"></i> Tambah </button> -->
      <div id="read" class="mt-3"></div>
    </div>
  </div>
</div>


@include('parcab.partials.script')



<script>
  $(document).ready(function () {
    // Define a map of tabs to their corresponding routes
    window.tabToRoute = {
      'branch': '/parcab/readdata',
      'pic': '/picapprove/readpic',
      // Add other tabs and routes here
    };

    // Load the content for the default tab (Attendance)
    window.loadTabContent('branch', 1);

    // Handle tab clicks
    $('.nav a').click(function (e) {
      e.preventDefault();
      var tab = $(this).data('tab');
      $('.nav a').removeClass('active'); // Remove active class from all tabs
      $(this).addClass('active'); // Add active class to the clicked tab
      window.loadTabContent(tab, 1); // Load content for the clicked tab
    });
  });

  // Assign loadTabContent as a global function
  window.loadTabContent = function (tab, page) {
    var route = window.tabToRoute[tab]; // Get the corresponding route for the tab
    if (route) {
      $.ajax({
        url: route + '?page=' + page,
        type: 'GET',
        success: function (response) {
          $('#read').html(response);
          // setupPagination(tab); // Set up pagination for the loaded content
        },
        error: function (error) {
          console.error(error);
        },
      });
    }
  };

</script>


@endsection
