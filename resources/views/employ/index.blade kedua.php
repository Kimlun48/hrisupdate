@extends('layouts.app-master')

@section('content-employ')
<div class="employ">
  <div class="container">
    <div class="row align-items-center">
      <div class="container headtext">
        <div class="row">
          <div class="col-md-6">
            <h5 class="title-employ">Employees Internal</h5>
          </div>
          <div class="col-md-6">
            <a class="btn btn-primary mr-3 custombtn-2" href="{{route('employ.create')}}" style="text-decoration: none; color:white;">Add Employees Internal</a>
            <a class="btn btn-light mr-3 custombtn " href="/trans" style="text-decoration: none;">Employee Transfer</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row conten-head mt-3 md-3">
      <!-- COBABUTUTON -->
      
      <!-- aKHIr buttin -->
      <div class="col-md-8 dropdown" style="margin-left: -12px;">
        <button class="btn btn-secondary filter-head" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Filter <i class="fas fa-caret-down iconkananbawah"></i>
        </button>
        <div class="dropdown-menu dropcrl dropright" aria-labelledby="filterDropdown" onclick="event.stopPropagation();">
          <a class="dropdown-item" href="#" onclick="toggleMenu('statusMenu')">Status <i class="fas fa-caret-down iconkananbawah"></i></a>
          <div id="statusMenu" style="display: none;">
            <div class="dropdown-menu-checkbox">
              <div class="dropdown-checkbox">
              <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('statusMenu', this)">
              <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="employmentCheckbox1" value="Option 1" checked >
                    <label class="form-check-label cstmz-txt" for="employmentCheckbox1">
                      Aktif
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="employmentCheckbox2" value="Option 2" >
                    <label class="form-check-label cstmz-txt" for="employmentCheckbox2">
                      Resign
                    </label>
                  </div>
                <!-- Tambahkan opsi checkbox lainnya sesuai kebutuhan -->
              </div>
            </div>
          </div>
          <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="toggleMenu('employmentMenu')">Employment Status <i class="fas fa-caret-down iconkananbawah"></i></a>
            <div id="employmentMenu" style="display: none;">
              <div class="dropdown-menu-checkbox">
                <div class="dropdown-checkbox">
                <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('employmentMenu', this)">
                @foreach ($employes as $status)
                  <div class="form-check">
                      <input class="form-check-input statusCheckbox" type="checkbox" id="{{ $status->id }}" value="{{ $status->status_karyawan }}">
                      <label class="form-check-label cstmz-txt" for="{{ $status->id }}">
                          {{ $status->status_karyawan }}
                      </label>
                  </div>
                @endforeach
                  <!-- Tambahkan opsi checkbox lainnya sesuai kebutuhan -->
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="toggleMenu('branchMenu')">Branch<i class="fas fa-caret-down iconkananbawah"></i></a>
            <div id="branchMenu" style="display: none;">
              <div class="dropdown-menu-checkbox">
                <div class="dropdown-checkbox">
                <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('branchMenu', this)">
                  <!-- Isi dengan opsi checkbox untuk Branch -->
                  @foreach ($cabs as $cab)
                  <div class="form-check">
                    <input class="form-check-input cabangCheckbox" type="checkbox" id="{{ $cab->id }}" value="{{ $cab->nama }}">
                    <label class="form-check-label cstmz-txt" for="{{ $cab->id }}">
                      {{ $cab->nama }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="toggleMenu('organizationMenu')">Organization<i class="fas fa-caret-down iconkananbawah"></i></a>
            <div id="organizationMenu" style="display: none;">
              <div class="dropdown-menu-checkbox">
                <div class="dropdown-checkbox">
                  <!-- Isi dengan opsi checkbox untuk Organization -->
                  <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('organizationMenu', this)">
                  @foreach ($bgn as $table)
                  <div class="form-check">
                    <input class="form-check-input tableCheckbox" type="checkbox" id="{{ $table->id }}" value="{{ $table->nama }}">
                    <label class="form-check-label cstmz-txt" for="{{ $table->id }}">
                      {{ $table->nama }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="toggleMenu('jobPositionMenu')">Job Position<i class="fas fa-caret-down iconkananbawah"></i></a>
            <div id="jobPositionMenu" style="display: none;">
              <div class="dropdown-menu-checkbox">
                <div class="dropdown-checkbox">
                <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('jobPositionMenu', this)">
                  @foreach ($jabs as $jab)
                  <div class="form-check">
                    <input class="form-check-input jabatanCheckbox" type="checkbox" id="{{ $jab->id }}" value="{{ $jab->nama }}">
                    <label class="form-check-label cstmz-txt" for="{{ $jab->id }}">
                      {{ $jab->nama }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="toggleMenu('jobLevelMenu')">Job Level<i class="fas fa-caret-down iconkananbawah"></i></a>
            <div id="jobLevelMenu" style="display: none;">
              <div class="dropdown-menu-checkbox">
                <div class="dropdown-checkbox">
                  <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('jobLevelMenu', this)">
                  @foreach($lvl as $lvl)
                  <div class="form-check">
                    <input class="form-check-input levelCheckbox" type="checkbox" id="{{$lvl->id}}" value="{{$lvl->nama}}">
                    <label class="form-check-label cstmz-txt" for="{{$lvl->id}}">
                      {{$lvl->nama}}
                    </label>
                  </div>
                  @endforeach
                  <!-- Tambahkan opsi checkbox lainnya sesuai kebutuhan -->
                </div>
              </div>
            </div>
          <div class="dropdown-divider"></div>
          <!-- Tambahkan menu dan opsi checkbox lainnya di sini -->
          <div class="dropdown-footer">
            <!-- <button class="dropdown-item btnczmy" type="button" onclick="closeAllMenus()">Close</button> -->
            <!-- <button class="dropdown-item btn-pry" type="button" onclick="filterTable()">Apply</button> -->
          </div>
        </div>
      </div>

      <div class="dropdown col-md-2 custom-filter" >
      <a class="btn-custom mr-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <svg width="24" height="23" viewBox="0 0 24 23" fill="none">
            <!-- SVG content -->
            <path d="M7.3724 18.1253V1.87533M13.6224 18.1253V1.87533M7.9974 18.3337H12.9974C17.1641 18.3337 18.8307 16.667 18.8307 12.5003V7.50033C18.8307 3.33366 17.1641 1.66699 12.9974 1.66699H7.9974C3.83073 1.66699 2.16406 3.33366 2.16406 7.50033V12.5003C2.16406 16.667 3.83073 18.3337 7.9974 18.3337Z" stroke="#626B79" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
        <div class="dropdown-menu check" onclick="event.stopPropagation();" aria-labelledby="dropdownMenuButton">
          <h6 class="dropdown-header">Column Displayed</h6>
          <!-- Tambahkan opsi checkbox lainnya sesuai kebutuhan -->
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col3Checkbox" onchange="toggleColumn('col3')" checked/>
            Branch
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col4Checkbox" onchange="toggleColumn('col4')" checked/>
            Organization
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col5Checkbox" onchange="toggleColumn('col5')" checked/>
            Job Position
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col6Checkbox" onchange="toggleColumn('col6')" checked/>
            Job Level
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col7Checkbox" onchange="toggleColumn('col7')" checked/>
            Employment Status
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col8Checkbox" onchange="toggleColumn('col8')" checked/>
            Join Date
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col9Checkbox" onchange="toggleColumn('col9')" checked/>
            End Date
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col10Checkbox" onchange="toggleColumn('col10')" checked/>
            Sign Date
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col11Checkbox" onchange="toggleColumn('col11')" checked/>
            Resign Date
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col12Checkbox" onchange="toggleColumn('col12')" checked/>
            Barcode
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col13Checkbox" onchange="toggleColumn('col13')" checked/>
            Email
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col14Checkbox" onchange="toggleColumn('col14')" checked/>
            Birth date
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col15Checkbox" onchange="toggleColumn('col15')" checked/>
            Birth Place
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col16Checkbox" onchange="toggleColumn('col16')" checked/>
            Address
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col17Checkbox" onchange="toggleColumn('col17')" checked/>
            Mobile Phone
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col18Checkbox" onchange="toggleColumn('col18')" checked/>
            Relegion
          </label>
          <label class="dropdown-item">
            <input type="checkbox" name="check" id="col19Checkbox" onchange="toggleColumn('col19')" checked/>
            Martial Status
          </label>
          <!-- Add other labels for each checkbox -->
        </div>
        <!-- Tambahkan button lainnya di sini -->
        <a class="export mr-3" data-toggle="modal" data-target="#modaleditinternal" style="cursor: pointer;">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
            <path d="M6.34018 8.13079C6.68532 8.12557 6.96088 7.84155 6.95565 7.49641C6.95044 7.15126 6.66641 6.87571 6.32128 6.88093L6.34018 8.13079ZM14.6735 6.88093C14.3284 6.87571 14.0444 7.15126 14.0391 7.49641C14.0339 7.84155 14.3095 8.12557 14.6546 8.13079L14.6735 6.88093ZM9.87231 14.167C9.87231 14.5121 10.1521 14.792 10.4973 14.792C10.8425 14.792 11.1223 14.5121 11.1223 14.167H9.87231ZM10.4973 1.66699L10.9392 1.22505C10.6951 0.980973 10.2995 0.980973 10.0554 1.22505L10.4973 1.66699ZM7.2637 4.01671C7.01963 4.26079 7.01963 4.65652 7.2637 4.9006C7.50779 5.14467 7.90351 5.14467 8.14759 4.9006L7.2637 4.01671ZM12.8471 4.9006C13.0911 5.14467 13.4868 5.14467 13.7309 4.9006C13.975 4.65652 13.975 4.26079 13.7309 4.01671L12.8471 4.9006ZM13.4141 17.7086H7.58073V18.9586H13.4141V17.7086ZM7.58073 17.7086C6.59721 17.7086 5.89873 17.7081 5.35294 17.6617C4.8149 17.616 4.4829 17.529 4.2207 17.3889L3.63145 18.4912C4.1056 18.7447 4.62817 18.8545 5.247 18.9072C5.85805 18.9591 6.61872 18.9586 7.58073 18.9586V17.7086ZM1.53906 12.917C1.53906 13.4696 1.5388 14.2215 1.58988 14.9301C1.61545 15.285 1.65464 15.6407 1.71617 15.9634C1.77615 16.278 1.86442 16.6005 2.00645 16.8663L3.10886 16.277C3.0541 16.1745 2.99476 15.9952 2.94405 15.7293C2.89488 15.4715 2.86027 15.168 2.83665 14.8403C2.78932 14.1838 2.78906 13.4765 2.78906 12.917H1.53906ZM4.2207 17.3889C3.74829 17.1364 3.36136 16.7494 3.10886 16.277L2.00645 16.8663C2.3755 17.5567 2.941 18.1222 3.63145 18.4912L4.2207 17.3889ZM18.2057 12.917C18.2057 13.4765 18.2055 14.1838 18.1581 14.8403C18.1346 15.168 18.0999 15.4715 18.0507 15.7293C18.0001 15.9952 17.9407 16.1745 17.8859 16.277L18.9883 16.8663C19.1304 16.6005 19.2186 16.278 19.2786 15.9634C19.3401 15.6407 19.3793 15.285 19.4049 14.9301C19.456 14.2215 19.4557 13.4696 19.4557 12.917H18.2057ZM13.4141 18.9586C14.3761 18.9586 15.1367 18.9591 15.7478 18.9072C16.3666 18.8545 16.8891 18.7447 17.3633 18.4912L16.7741 17.3889C16.5119 17.529 16.1799 17.616 15.6419 17.6617C15.0961 17.7081 14.3976 17.7086 13.4141 17.7086V18.9586ZM17.8859 16.277C17.6334 16.7494 17.2465 17.1364 16.7741 17.3889L17.3633 18.4912C18.0538 18.1222 18.6193 17.5567 18.9883 16.8663L17.8859 16.277ZM19.4557 12.917C19.4557 11.955 19.4562 11.1943 19.4043 10.5832C19.3516 9.96438 19.2418 9.44188 18.9883 8.96771L17.8859 9.55696C18.0261 9.81913 18.113 10.1511 18.1588 10.6892C18.2052 11.235 18.2057 11.9335 18.2057 12.917H19.4557ZM16.7741 8.44513C17.2465 8.69763 17.6334 9.08455 17.8859 9.55696L18.9883 8.96771C18.6193 8.27726 18.0538 7.71176 17.3633 7.34271L16.7741 8.44513ZM2.78906 12.917C2.78906 11.9335 2.78959 11.235 2.83601 10.6892C2.88178 10.1511 2.9687 9.81913 3.10886 9.55696L2.00645 8.96771C1.75301 9.44188 1.64315 9.96438 1.59051 10.5832C1.53854 11.1943 1.53906 11.955 1.53906 12.917H2.78906ZM3.63145 7.34271C2.941 7.71176 2.3755 8.27726 2.00645 8.96771L3.10886 9.55696C3.36136 9.08455 3.74829 8.69763 4.2207 8.44513L3.63145 7.34271ZM6.32128 6.88093C5.18006 6.89819 4.3401 6.96392 3.63145 7.34271L4.2207 8.44513C4.62902 8.22685 5.17799 8.14837 6.34018 8.13079L6.32128 6.88093ZM14.6546 8.13079C15.8168 8.14837 16.3657 8.22686 16.7741 8.44513L17.3633 7.34271C16.6547 6.96392 15.8147 6.89819 14.6735 6.88093L14.6546 8.13079ZM11.1223 14.167V1.66699H9.87231V14.167H11.1223ZM8.14759 4.9006L10.9392 2.10893L10.0554 1.22505L7.2637 4.01671L8.14759 4.9006ZM10.0554 2.10893L12.8471 4.9006L13.7309 4.01671L10.9392 1.22505L10.0554 2.10893Z" fill="#626B79"/>
          </svg>
        </a>
        
        <a href="/employ/bulkupdateinternal" class="Bulk">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
            <path d="M3 17.7085C2.65483 17.7085 2.375 17.9884 2.375 18.3335C2.375 18.6787 2.65483 18.9585 3 18.9585V17.7085ZM18 18.9585C18.3452 18.9585 18.625 18.6787 18.625 18.3335C18.625 17.9884 18.3452 17.7085 18 17.7085V18.9585ZM4.70833 10.2419L4.25402 9.81262L4.2528 9.81395L4.70833 10.2419ZM4.15 11.4335L3.53038 11.351L3.52903 11.3626L4.15 11.4335ZM3.84167 14.1335L3.2207 14.0626L3.22049 14.0645L3.84167 14.1335ZM5.4 15.6085L5.29477 14.9925L5.29381 14.9926L5.4 15.6085ZM8.08333 15.1502L8.18857 15.7663L8.19273 15.7655L8.08333 15.1502ZM9.24167 14.5252L8.78728 14.096L8.77982 14.1041L9.24167 14.5252ZM15.9583 2.86687L16.3877 2.41277L16.3866 2.41168L15.9583 2.86687ZM3 18.9585H18V17.7085H3V18.9585ZM4.2528 9.81395C4.06282 10.0162 3.90227 10.2837 3.78461 10.536C3.66652 10.7893 3.56634 11.0812 3.53038 11.351L4.76952 11.5161C4.78355 11.4109 4.83348 11.2445 4.91748 11.0644C5.00189 10.8834 5.09552 10.7425 5.16387 10.6698L4.2528 9.81395ZM3.52903 11.3626L3.2207 14.0626L4.46263 14.2045L4.77097 11.5045L3.52903 11.3626ZM3.22049 14.0645C3.14785 14.7183 3.34392 15.3319 3.78763 15.7527C4.23197 16.174 4.85572 16.3366 5.50619 16.2245L5.29381 14.9926C4.97761 15.0471 4.76803 14.9597 4.64778 14.8457C4.52691 14.731 4.42715 14.5238 4.46284 14.2025L3.22049 14.0645ZM5.50523 16.2246L8.18857 15.7663L7.9781 14.5341L5.29477 14.9925L5.50523 16.2246ZM8.19273 15.7655C8.46339 15.7175 8.75169 15.6034 9.00092 15.4701C9.24875 15.3376 9.51033 15.1582 9.7035 14.9463L8.77982 14.1041C8.71468 14.1755 8.58455 14.2753 8.41157 14.3678C8.23998 14.4595 8.07828 14.5163 7.97394 14.5349L8.19273 15.7655ZM16.5372 7.71321C17.1633 7.05183 17.7125 6.25025 17.7787 5.30316C17.8472 4.32326 17.3907 3.36117 16.3877 2.41277L15.5289 3.32097C16.3677 4.11423 16.5653 4.73548 16.5317 5.216C16.4958 5.72932 16.1867 6.26524 15.6294 6.85387L16.5372 7.71321ZM16.3866 2.41168C15.3871 1.47123 14.4034 1.07363 13.4312 1.19796C12.4916 1.3181 11.7224 1.90897 11.0961 2.57053L12.0039 3.42988C12.5609 2.84143 13.0792 2.50313 13.5897 2.43787C14.0674 2.37678 14.6963 2.53752 15.5301 3.32206L16.3866 2.41168ZM14.7532 8.13064C13.8318 8.0447 12.8466 7.59949 12.0403 6.79324L11.1564 7.67713C12.156 8.6767 13.4082 9.26062 14.637 9.3752L14.7532 8.13064ZM9.696 14.9545L15.1494 9.18212L14.2407 8.32373L8.78728 14.096L9.696 14.9545ZM15.1494 9.18212L16.5372 7.71321L15.6294 6.85387L14.2407 8.32373L15.1494 9.18212ZM12.0403 6.79324C11.3254 6.07838 10.8935 5.22161 10.7455 4.39305L9.515 4.61294C9.70992 5.70398 10.2688 6.78957 11.1564 7.67713L12.0403 6.79324ZM11.0961 2.57053L9.67592 4.07378L10.5845 4.93222L12.0039 3.42988L11.0961 2.57053ZM9.67592 4.07378L4.25402 9.81262L5.16264 10.6711L10.5845 4.93222L9.67592 4.07378Z" fill="#626B79"/>
          </svg>
        </a>

      </div>
        

      <div class="col-md-2">
        <form class="search" id="searchForm" style="margin-right:-20px;">
          <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control" placeholder="Search" id="search" name="search">
          </div>
        </form>
      </div>
    </div>

    <div class="form-trans mb-2" id="formContainer" style="display: none;">
  <button class="btn btn-sm btn-primary" id='transfer' type="button" onclick="showtransferbarubulk()">Transfer Karyawan</button>
  <button class="btn btn-sm btn-danger" type="button">Cancel</button>
</div>
    <div class="table-body">
      <div class="tabcontent" id="employee">
        <div id="read">
          @include('employ.reademploy')
        </div>
      </div>
    </div>
  </div>
  <!-- <select id="showEntries" onchange="cekdatashow()">
  <option value="25">25</option>
  <option value="50">50</option>
  <option value="100">100</option>
  </select>

  <div class="pagination" id="pagination">
    <a href="#" id="prevPage">Previous</a>
    <a href="#" id="nextPage">Next</a>
  </div>

  <div id="dataCount"></div>
    
  <br><br>
  <div id="table-data"></div>  -->

</div>

@include('loadjs.ical_table')




<!-- Modal phk internal -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="ModalResign" tabindex="-1" role="dialog" aria-labelledby="ModalResignLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalResignLabel"></h5>
        <button type="button" class="close" onClick="Close()" id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="page" class="p-2"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal phk external -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="ModalResignExternal" tabindex="-1" role="dialog" aria-labelledby="ModalResignExternalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalResignExternalLabel"></h5>
        <button type="button" class="close" onClick="Close()" id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="page" class="p-2"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Transfer -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="ModalTransfer" tabindex="-1" role="dialog" aria-labelledby="ModalTransferLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTransferLabel"></h5>
        <button type="button" class="close" onClick="Close()" id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="pagetransfer" class="p-2"></div>
      </div>
    </div>
  </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade detail-pelamar" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="ModalTransferLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-pelamar" role="document">
    <div class="modal-content modal-content-pelamar">
      <div class="modal-header">
        <h5 class="modal-title" id="labeldetail"></h5>
        <button type="button" class="close" onClick="Close()" id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-body-pelamar">
        <div id="detail" class="p-2"></div>
      </div>
    </div>
  </div>
</div>

<!-- External -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade detail-pelamar" id="modalDetailExternal" tabindex="-1" role="dialog" aria-labelledby="ModalTransferLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-pelamar" role="document">
    <div class="modal-content modal-content-pelamar">
      <div class="modal-header">
        <h5 class="modal-title" id="labeldetailexternal"></h5>
        <button type="button" class="close" onClick="CloseExternal()" id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-body-pelamar">
        <div id="detailexternal" class="p-2"></div>
      </div>
    </div>
  </div>
</div>



@include('employ.partials.script')

<div id="cover-spin"></div>

<script>
function searchSubMenu(menuId, input) {
  var menu = document.getElementById(menuId);
  if (menu) {
    const checkboxes = menu.querySelectorAll('.form-check');
    const searchTerm = input.value.toLowerCase();

    checkboxes.forEach(formCheck => {
      const label = formCheck.querySelector('label.form-check-label');
      const text = label.textContent.toLowerCase();
      if (text.includes(searchTerm)) {
        formCheck.style.display = 'block';
      } else {
        formCheck.style.display = 'none';
      }
    });
  }
}


</script>

<style>
  #cover-spin {
    position: fixed;
    width: 100%;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.7);
    z-index: 9999;
    display: none;
  }

  @-webkit-keyframes spin {
    from {
      -webkit-transform: rotate(0deg);
    }

    to {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  #cover-spin::after {
    content: '';
    display: block;
    position: absolute;
    left: 48%;
    top: 40%;
    width: 40px;
    height: 40px;
    border-style: solid;
    border-color: black;
    border-top-color: transparent;
    border-width: 4px;
    border-radius: 50%;
    -webkit-animation: spin 0.8s linear infinite;
    animation: spin 0.8s linear infinite;
  }

  /* .container {
      max-width: 1300px !important;
  } */


    /* Gaya kustom untuk menu dropdown */
    .dropdown-menu-checkbox {
      background-color: #f8f9fa; /* Warna latar belakang menu */
      padding: 10px; /* Ruang di sekitar kotak menu */
      border-radius: 5px; /* Tampilan sudut tombol */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Efek bayangan menu */
    }

    .dropdown-checkbox {
      /* Tampilan kotak opsi checkbox */
      display: flex;
      flex-direction: column;
    }

    .dropdown-checkbox .form-check {
      /* Jarak antara opsi checkbox */
      margin-bottom: 5px;
    }





</style>

@endsection
