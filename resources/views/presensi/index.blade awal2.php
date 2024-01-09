@extends('layouts.app-master')

@section('content-attend')
<div class="attendance">
  <div class="container">
    <div class="container headtext">
      <div class="row">
        <div class="col-md-6">
          <h5 class="title-vacancy">Attendance Internal</h5>
        </div>  
      </div>
    </div>

      <div class="row conten-head mt-3 md-3">
        <div class="filter-date col-md-2 form-group">
          <form action="/presensi" method="get">
              <input type="date" class="form-control cstom-input" name="tglpresen" id="tanggalInput" value="{{$skr}}">
              <!-- <button type="submit" class="btn btn-primary">Filter</button> -->
          </form>
      </div>



      <div class="col-md-5 dropdown" >
        <div class="dropdown">
            <button class="btn btn-secondary filter-head" onclick="showMainMenu()" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Filter <i class="fas fa-caret-down iconkananbawah"></i>
            </button>
            <div class="dropdown-menu dropcrl" id="mainMenu">
              <a class="dropdown-item" href="#" onclick="closeMainMenu()"><i class="fas fa-times"></i> Close</a> <!-- Tambahkan ini -->
              <a class="dropdown-item" href="#" onclick="showSubMenu('clockInSubMenu')">Clock In</a>
              <a class="dropdown-item" href="#" onclick="showSubMenu('clockOutSubMenu')">Clock Out</a>
              <a class="dropdown-item" href="#" onclick="showSubMenu('timeOffCodeSubMenu')">Time Off Code</a>
              <a class="dropdown-item" href="#" onclick="showSubMenu('overtimeSubMenu')">Overtime</a>
              <a class="dropdown-item" href="#" onclick="showSubMenu('branchSubMenu')">Branch</a>
              <a class="dropdown-item" href="#" onclick="showSubMenu('organizationSubMenu')">Organization</a>
              <a class="dropdown-item" href="#" onclick="showSubMenu('jobSubMenu')">Job Position</a>
              <a class="dropdown-item" href="#" onclick="showSubMenu('employmentstatusSubMenu')">Employment Status</a>
            </div>
            <div class="dropdown-menu dropcrl" id="clockInSubMenu">
              <a class="dropdown-item" href="#" onclick="goBackToMainMenu('clockInSubMenu')"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
              <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('clockInSubMenu', this)">
              <label class="dropdown-item" for="clockinCheckbox1">
                <input type="checkbox" id="clockinCheckbox1" value="Option 1">
                Early Clock In
              </label>
            
              <label class="dropdown-item" for="clockinCheckbox2">
                <input type="checkbox" id="clockinCheckbox2" value="Option 2">
                Late Clock Out
              </label>
            
              <label class="dropdown-item" for="clockinCheckbox3">
                <input type="checkbox" id="clockinCheckbox3" value="Option 3">
                No Clock In
              </label>
              
            </div>

            <div class="dropdown-menu dropcrl" id="clockOutSubMenu">
              <a class="dropdown-item" href="#" onclick="goBackToMainMenu('clockOutSubMenu')"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
              <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('clockOutSubMenu', this)">
              <label class="dropdown-item" for="clockoutCheckbox1">
                <input type="checkbox" id="clockoutCheckbox1" value="Option 1">
                Early Clock In
              </label>
            
              <label class="dropdown-item" for="clockoutCheckbox2">
                <input type="checkbox" id="clockoutCheckbox2" value="Option 2">
                Late Clock Out
              </label>
            
              <label class="dropdown-item" for="clockoutCheckbox3">
                <input type="checkbox" id="clockoutCheckbox3" value="Option 3">
                No Clock In
              </label>
            </div>

            <div class="dropdown-menu dropcrl" id="timeOffCodeSubMenu">
              <a class="dropdown-item" href="#" onclick="goBackToMainMenu('timeOffCodeSubMenu')"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
              <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('timeOffCodeSubMenu', this)">
              @foreach ($timeoff as $time)
                <label class="dropdown-item" for="{{ $time->id }}">
                  <input type="checkbox" id="{{ $time->id }}" value="{{ $time->nama }}">
                  {{ $time->nama }}
                </label>
              @endforeach
            </div>

            <div class="dropdown-menu dropcrl" id="overtimeSubMenu">
              <a class="dropdown-item" href="#" onclick="goBackToMainMenu('overtimeSubMenu')"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
              <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('overtimeSubMenu', this)">
              @foreach ($timeoff as $time)
                <label class="dropdown-item" for="{{ $time->id }}">
                  <input type="checkbox" id="{{ $time->id }}" value="{{ $time->nama }}">
                  {{ $time->nama }}
                </label>
              @endforeach
            </div>

            <div class="dropdown-menu dropcrl" id="branchSubMenu">
              <a class="dropdown-item" href="#" onclick="goBackToMainMenu('branchSubMenu')"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
              <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('branchSubMenu', this)">
              @foreach ($cabang as $cbg)
                <label class="dropdown-item" for="{{ $cbg->id }}">
                  <input class="cabangCheckbox" type="checkbox" id="{{ $cbg->id }}" value="{{ $cbg->nama }}">
                  {{ $cbg->nama }}
                </label>
              @endforeach
            </div>

            <div class="dropdown-menu dropcrl" id="organizationSubMenu">
              <a class="dropdown-item" href="#" onclick="goBackToMainMenu('organizationSubMenu')"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
              <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('organizationSubMenu', this)">
              @foreach ($bgn as $bgn)
                <label class="dropdown-item" for="{{ $bgn->id }}">
                  <input class="tableCheckbox" type="checkbox" id="{{ $bgn->id }}" value="{{ $bgn->nama }}">
                  {{ $bgn->nama }}
                </label>
              @endforeach
            </div>

            <div class="dropdown-menu dropcrl" id="jobSubMenu">
              <a class="dropdown-item" href="#" onclick="goBackToMainMenu('jobSubMenu')"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
              <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('jobSubMenu', this)">
              @foreach ($jabs as $jab)
                <label class="dropdown-item" for="{{ $jab->id }}">
                  <input class="jabatanCheckbox" type="checkbox" id="{{ $jab->id }}" value="{{ $jab->nama }}">
                  {{ $jab->nama }}
                </label>
              @endforeach
            </div>

            <div class="dropdown-menu dropcrl" id="employmentstatusSubMenu">
              <a class="dropdown-item" href="#" onclick="goBackToMainMenu('employmentstatusSubMenu')"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
              <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('employmentstatusSubMenu', this)">
              @foreach ($employes as $employes)
                <label class="dropdown-item" for="{{ $employes->id }}">
                  <input class="statusCheckbox" type="checkbox" id="{{ $employes->id }}" value="{{ $employes->status_karyawan }}">
                  {{ $employes->status_karyawan }}
                </label>
              @endforeach
            </div>

          </div>
        </div>

        <div class="dropdown col-md-2 custom-filter" >
          <a class="btn-custom mr-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
              <path d="M8.25 21.8424V2.55393M15.75 21.8424V2.55393M9 22.0897H15C20 22.0897 22 20.1114 22 15.1656V9.2307C22 4.28494 20 2.30664 15 2.30664H9C4 2.30664 2 4.28494 2 9.2307V15.1656C2 20.1114 4 22.0897 9 22.0897Z" stroke="#626B79" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </a>
          <div class="dropdown-menu check" onclick="event.stopPropagation();" aria-labelledby="dropdownMenuButton">
            <h6 class="dropdown-header">Column Displayed</h6>
            <!-- Tambahkan opsi checkbox lainnya sesuai kebutuhan -->
            <!-- <label class="dropdown-item">
              <input type="checkbox" name="check" id="colCheckbox" onchange="toggleColumn('col')" checked/>
              All
            </label> -->
            <label class="dropdown-item">
              <input type="checkbox" name="check" id="col3Checkbox" onchange="toggleColumn('col3')" />
              Branch
            </label>
            <label class="dropdown-item">
              <input type="checkbox" name="check" id="col4Checkbox" onchange="toggleColumn('col4')" />
              Organization
            </label>
            <label class="dropdown-item">
              <input type="checkbox" name="check" id="col5Checkbox" onchange="toggleColumn('col5')" />
              Job Position
            </label>
            <label class="dropdown-item">
              <input type="checkbox" name="check" id="col6Checkbox" onchange="toggleColumn('col6')" />
              Job Level
            </label>
            <label class="dropdown-item">
              <input type="checkbox" name="check" id="col7Checkbox" onchange="toggleColumn('col7')" />
              Employment Status
            </label>
            <label class="dropdown-item">
              <input type="checkbox" name="check" id="col15Checkbox" onchange="toggleColumn('col15')" checked/>
              Time Off Code 
            </label>
            <label class="dropdown-item">
              <input type="checkbox" name="check" id="col16Checkbox" onchange="toggleColumn('col16')" checked/>
              Overtime
            </label>
            <!-- Add other labels for each checkbox -->
          </div>
          
          <a class="export" onclick="exportdata()" style="cursor: pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
              <path d="M7.01134 9.97873C7.42551 9.97253 7.75618 9.63541 7.74991 9.22573C7.74365 8.81605 7.40282 8.48897 6.98866 8.49517L7.01134 9.97873ZM17.0113 8.49517C16.5972 8.48897 16.2564 8.81605 16.2501 9.22573C16.2438 9.63541 16.5745 9.97253 16.9887 9.97873L17.0113 8.49517ZM11.2499 17.1436C11.2499 17.5533 11.5857 17.8854 11.9999 17.8854C12.4141 17.8854 12.7499 17.5533 12.7499 17.1436H11.2499ZM11.9999 2.30631L12.5302 1.78174C12.2373 1.49202 11.7625 1.49202 11.4696 1.78174L11.9999 2.30631ZM8.11957 5.0954C7.82668 5.38511 7.82668 5.85484 8.11957 6.14455C8.41247 6.43426 8.88734 6.43426 9.18023 6.14455L8.11957 5.0954ZM14.8196 6.14455C15.1125 6.43426 15.5873 6.43426 15.8802 6.14455C16.1731 5.85484 16.1731 5.38511 15.8802 5.0954L14.8196 6.14455ZM15.5 21.3475H8.5V22.8312H15.5V21.3475ZM8.5 21.3475C7.31978 21.3475 6.4816 21.3469 5.82665 21.2918C5.18101 21.2375 4.78261 21.1342 4.46796 20.9679L3.76087 22.2764C4.32985 22.5773 4.95693 22.7076 5.69952 22.7702C6.43279 22.8318 7.34559 22.8312 8.5 22.8312V21.3475ZM1.25 15.6598C1.25 16.3158 1.24969 17.2084 1.31098 18.0494C1.34167 18.4707 1.38869 18.8929 1.46253 19.2759C1.53451 19.6493 1.64043 20.0322 1.81087 20.3476L3.13376 19.6482C3.06804 19.5265 2.99684 19.3137 2.93598 18.998C2.87698 18.692 2.83545 18.3318 2.8071 17.9428C2.75031 17.1635 2.75 16.3241 2.75 15.6598H1.25ZM4.46796 20.9679C3.90107 20.6682 3.43676 20.2088 3.13376 19.6482L1.81087 20.3476C2.25373 21.1671 2.93233 21.8384 3.76087 22.2764L4.46796 20.9679ZM21.25 15.6598C21.25 16.3241 21.2497 17.1635 21.1929 17.9428C21.1646 18.3318 21.123 18.692 21.064 18.998C21.0032 19.3137 20.932 19.5265 20.8662 19.6482L22.1891 20.3476C22.3596 20.0322 22.4655 19.6493 22.5375 19.2759C22.6113 18.8929 22.6583 18.4707 22.689 18.0494C22.7503 17.2084 22.75 16.3158 22.75 15.6598H21.25ZM15.5 22.8312C16.6544 22.8312 17.5672 22.8318 18.3005 22.7702C19.0431 22.7076 19.6701 22.5773 20.2391 22.2764L19.532 20.9679C19.2174 21.1342 18.819 21.2375 18.1734 21.2918C17.5184 21.3469 16.6802 21.3475 15.5 21.3475V22.8312ZM20.8662 19.6482C20.5632 20.2088 20.0989 20.6682 19.532 20.9679L20.2391 22.2764C21.0677 21.8384 21.7463 21.1671 22.1891 20.3476L20.8662 19.6482ZM22.75 15.6598C22.75 14.518 22.7506 13.6151 22.6883 12.8897C22.6251 12.1552 22.4933 11.535 22.1891 10.9721L20.8662 11.6716C21.0344 11.9828 21.1387 12.3768 21.1937 13.0155C21.2494 13.6633 21.25 14.4924 21.25 15.6598H22.75ZM19.532 10.3518C20.0989 10.6516 20.5632 11.1108 20.8662 11.6716L22.1891 10.9721C21.7463 10.1526 21.0677 9.48135 20.2391 9.04329L19.532 10.3518ZM2.75 15.6598C2.75 14.4924 2.75063 13.6633 2.80634 13.0155C2.86126 12.3768 2.96557 11.9828 3.13376 11.6716L1.81087 10.9721C1.50674 11.535 1.3749 12.1552 1.31174 12.8897C1.24937 13.6151 1.25 14.518 1.25 15.6598H2.75ZM3.76087 9.04329C2.93233 9.48135 2.25373 10.1526 1.81087 10.9721L3.13376 11.6716C3.43676 11.1108 3.90107 10.6516 4.46796 10.3518L3.76087 9.04329ZM6.98866 8.49517C5.6192 8.51566 4.61124 8.59368 3.76087 9.04329L4.46796 10.3518C4.95795 10.0927 5.61671 9.99959 7.01134 9.97873L6.98866 8.49517ZM16.9887 9.97873C18.3833 9.99959 19.042 10.0928 19.532 10.3518L20.2391 9.04329C19.3888 8.59368 18.3808 8.51566 17.0113 8.49517L16.9887 9.97873ZM12.7499 17.1436V2.30631H11.2499V17.1436H12.7499ZM9.18023 6.14455L12.5302 2.83089L11.4696 1.78174L8.11957 5.0954L9.18023 6.14455ZM11.4696 2.83089L14.8196 6.14455L15.8802 5.0954L12.5302 1.78174L11.4696 2.83089Z" fill="#626B79"/>
            </svg>
          </a>


        </div>
          

        <div class="col-md-2">
          <form class="search" id="searchForm" style="margin-right:-95px;">
            <div class="form-group has-search">
              <span class="fa fa-search form-control-feedback"></span>
              <input type="text" class="form-control" placeholder="Search" id="search" name="search">
            </div>
          </form>
        </div>
    </div>

  <div id="countindex"></div>
  
  <div class="content-attendance">
    <div class="table-body">
      <div id="readpresensi"></div>
    </div>
  </div>
</div>


<!-- modal edit presensi -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="modaleditlabel" aria-hidden="true">
  <div class="modal-dialog edit-modal modal-dialog-right" role="document">
    <div class="modal-content edit-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaleditlabel"></h5>
        <button type="button" class="close" data-dismiss="modal" onclick="Close()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="editor-body"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="Close()">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="saveedit()">Simpan Perubahan</button>
    </div>
    </div>
  </div>
</div>


<!--Modal-->
<div class="modal fade" id="todayPresensi" tabindex="-1" role="dialog" aria-labelledby="todayLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="todayLabel"></h4>
      </div>
        <div class="modal-body modal-daily" id="todaydata">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">Close</button>
      </div>
    </div>
  </div>     
</div>
</div>
</div>

<div class="modal fade" id="modalexport" tabindex="-1" role="dialog" aria-labelledby="exportlabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exportlabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="exportdata">
      </div>
    </div>
  </div>
</div>

	<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js" defer></script>
@include('presensi.partials.scripts')

<!-- select to choice multiple -->


	
<script>

  
    $(document).ready(function() {
        var uniqueValues = [];
        $('.statusCheckbox').each(function() {
            var checkboxValue = $(this).val().toLowerCase();
            if (uniqueValues.indexOf(checkboxValue) === -1) {
                uniqueValues.push(checkboxValue);
            } else {
                $(this).parent().remove(); // Hapus elemen parent (label dan input) yang sama
            }
        });
    });
</script>

<script>
  function exportdata() {
    $.get("{{ url('/presensi/exportmodal') }}",{}, 
    function(data,status){
      $("#exportlabel").html('Export Presensi Data');
      $("#exportdata").html(data);
      $("#modalexport").modal('show');    
      const select = new Choices('#mySelect', { removeItemButton: true });
   const select2 = new Choices('#mySelect2', { removeItemButton: true });
   const selectedValues = select.getValue();
   const selectedValues2 = select2.getValue();
    });
  }

</script>


<script>
  let activeSubmenu = null;

  function closeMainMenu() {
    // Sembunyikan menu utama
    const mainMenu = document.getElementById('mainMenu');
    mainMenu.style.display = 'none';

    // Tampilkan kembali menu utama saat tombol "Close" diklik
    // Kita menghapus baris ini:
    // mainMenu.style.display = 'block';
  }

  function showMainMenu() {
    // Tampilkan kembali menu utama
    const mainMenu = document.getElementById('mainMenu');
    mainMenu.style.display = 'block';
  }

  function showSubMenu(submenuId) {
      // Sembunyikan menu utama
      const mainMenu = document.getElementById('mainMenu');
      mainMenu.style.display = 'none';

      // Sembunyikan submenu yang saat ini aktif
      if (activeSubmenu) {
          activeSubmenu.style.display = 'none';
      }

      // Tampilkan submenu yang dipilih
      const selectedSubmenu = document.getElementById(submenuId);
      if (selectedSubmenu) {
          selectedSubmenu.style.display = 'block';
          activeSubmenu = selectedSubmenu;
      } else {
          console.error("Error: Submenu dengan ID '" + submenuId + "' tidak ditemukan.");
      }
  }


  function goBackToMainMenu(submenuId) {
      // Sembunyikan submenu yang saat ini aktif
      if (activeSubmenu) {
          activeSubmenu.style.display = 'none';
          activeSubmenu = null;
      } else {
          console.error("Error: Tidak ada submenu yang aktif.");
      }

      // Tampilkan menu dropdown utama
      document.getElementById('mainMenu').style.display = 'block';

      // Reset input pencarian
      const searchInput = document.querySelector(`#${submenuId} input[type="text"]`);
      if (searchInput) {
          searchInput.value = '';
          searchSubMenu(submenuId, searchInput);
      }
  }

  function searchSubMenu(submenuId, input) {
      const submenu = document.getElementById(submenuId);
      if (submenu) {
          const labels = submenu.querySelectorAll('label.dropdown-item');
          const searchTerm = input.value.toLowerCase();
          
          labels.forEach(label => {
              const text = label.textContent.toLowerCase();
              if (text.includes(searchTerm)) {
                  label.style.display = 'block';
              } else {
                  label.style.display = 'none';
              }
          });
      }
  }
</script>


<style>
  .dropcrl{
    overflow-y: auto;
    max-height: 300px;
  }

  .edit-modal {
    position: fixed;
    margin: auto;
    width: 100%;
    height: 100%;
    right: 0px;
  }
  .edit-content {
      height: 100%;
      margin-left: -100px;
      width: 120%;
      overflow: auto; /* Tambahkan ini agar konten modal bisa di-scroll */

  }
</style>

  

	<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js" defer></script>
@endsection



