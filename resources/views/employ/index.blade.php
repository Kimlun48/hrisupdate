@extends('layouts.app-master')

@section('content-employ')

<div class="employing">
  <div class="container">
    <div class="row">
      <div class="head-title col-md-6">
        <h5 class="title-employ">Employees Internal</h5>
      </div>
      <div class="lay-button col-md-6 d-flex justify-content-end align-items-center">
        <a class="btn mr-3 custombtn" href="/trans">Employee Transfer</a>
        <a class="btn btn-primary custombtn-2" href="{{route('employ.create')}}">Add Employees Internal</a>
      </div>
    </div>
  </div>
</div>




<div class="head-employ container">
  <div class="row content-head mt-3 md-3">
    <div class="col-md-6 dropdown drop-cztmng" style="">
      <button class="btn filter-head" onclick="showMainMenu()" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Filter 
        <i class="iconkananbawah">
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M7.68489 9.27827L11.2368 12.8302L14.7888 9.27827C15.1458 8.92124 15.7225 8.92124 16.0796 9.27827C16.4366 9.63529 16.4366 10.212 16.0796 10.569L11.8776 14.771C11.5206 15.128 10.9439 15.128 10.5869 14.771L6.38496 10.569C6.02793 10.212 6.02793 9.63529 6.38496 9.27827C6.74198 8.9304 7.32787 8.92124 7.68489 9.27827Z" fill="#323232"/>
          </svg>
        </i>
      </button>
      <div class="dropdown-menu dropcrl" id="mainMenu">
        <a class="dropdown-item" href="#" onclick="closeMainMenu()"><i class="fas fa-times"></i> Close</a> <!-- Tambahkan ini -->
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" onclick="showSubMenu('statusSubMenu')">Status 
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
        <a class="dropdown-item" href="#" onclick="showSubMenu('employmentstatusSubMenu')">Employment Status
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
        <a class="dropdown-item" href="#" onclick="showSubMenu('branchSubMenu')">Branch
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
        <a class="dropdown-item" href="#" onclick="showSubMenu('organizationSubMenu')">Organization
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
        <a class="dropdown-item" href="#" onclick="showSubMenu('jobpositionSubMenu')">Job Position
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
        <a class="dropdown-item" href="#" onclick="showSubMenu('joblevelSubMenu')">Job Level
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
      </div>

      <div class="dropdown-menu dropcrl" id="statusSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('statusSubMenu')"><i class="fas fa-arrow-left"></i> Status</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('statusSubMenu', this)">
        <label class="dropdown-item" for="employmentCheckbox1">
          <input class="" type="checkbox" id="employmentCheckbox1" value="Option 1" checked >
          Aktif
        </label>
      
        <label class="dropdown-item" for="employmentCheckbox2">
        <input class="" type="checkbox" id="employmentCheckbox2" value="Option 2" >
          Resign
        </label>
      </div>

      <div class="dropdown-menu dropcrl" id="employmentstatusSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('employmentstatusSubMenu')"><i class="fas fa-arrow-left"></i> Employment Status</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('employmentstatusSubMenu', this)">
        @foreach ($dakar as $item)
          <label class="dropdown-item" for="{{ $item->id }}">
          <input class="statusCheckbox" type="checkbox" id="{{ $item->id }}" value="{{ $item->status_karyawan }}">
          {{ $item->status_karyawan }}
          </label>
        @endforeach
      </div>

      <div class="dropdown-menu dropcrl" id="branchSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('branchSubMenu')"><i class="fas fa-arrow-left"></i> Branch</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('branchSubMenu', this)">
        @foreach ($cabs as $cbg)
          <label class="dropdown-item" for="{{ $cbg->id }}">
            <input class="cabangCheckbox" type="checkbox" id="{{ $cbg->id }}" value="{{ $cbg->id }}">
            {{ $cbg->nama }}
          </label>
        @endforeach
      </div>

      <div class="dropdown-menu dropcrl" id="organizationSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('organizationSubMenu')"><i class="fas fa-arrow-left"></i> Organization</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('organizationSubMenu', this)">
        @foreach ($bgn as $table)
        <label class="dropdown-item" for="{{ $table->id }}">
          <input class="tableCheckbox" type="checkbox" id="{{ $table->id }}" value="{{ $table->id }}">
          {{ $table->nama }}
        </label>
        @endforeach
      </div>

      <div class="dropdown-menu dropcrl" id="jobpositionSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('jobpositionSubMenu')"><i class="fas fa-arrow-left"></i> Job Position</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('jobpositionSubMenu', this)">
        @foreach ($jabs as $jab)
          <label class="dropdown-item" for="{{ $jab->id }}">
            <input class="jabatanCheckbox" type="checkbox" id="{{ $jab->id }}" value="{{ $jab->id }}">
            {{ $jab->nama }}
          </label>
        @endforeach
      </div>

      <div class="dropdown-menu dropcrl" id="joblevelSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('joblevelSubMenu')"><i class="fas fa-arrow-left"></i> Job Level</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('joblevelSubMenu', this)">
        @foreach($lvl as $lvl)
          <label class="dropdown-item" for="{{ $lvl->nama }}">
            <input class="levelCheckbox" type="checkbox" id="{{ $lvl->nama }}" value="{{ $lvl->id }}">
            {{ $lvl->nama }}
          </label>
        @endforeach
      </div>
    </div>


    <div class="dropdown col-md-4 d-flex justify-content-end align-items-center custom-filter" >
      <a class="btn-custom mr-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <svg width="28" height="28" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.9375 33.5469C5.11768 33.5469 4.45312 32.8819 4.45312 32.0625V27.0156H10.9844V33.5469H5.9375Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M10.9844 19.8906V26.4219H4.45312V19.8906H10.9844Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M18.1094 27.0156V33.5469H11.5781V27.0156H18.1094Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M25.2344 27.0156V33.5469H18.7031V27.0156H25.2344Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M18.1094 19.8906V26.4219H11.5781V19.8906H18.1094Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M25.2344 19.8906V26.4219H18.7031V19.8906H25.2344Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M32.3594 19.8906V26.4219H25.8281V19.8906H32.3594Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M10.9844 12.7656V19.2969H4.45312V12.7656H10.9844Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M18.1094 12.7656V19.2969H11.5781V12.7656H18.1094Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M25.2344 12.7656V19.2969H18.7031V12.7656H25.2344Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M32.3594 12.7656V19.2969H25.8281V12.7656H32.3594Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M5.9375 5.64062H30.875C31.6948 5.64062 32.3594 6.30565 32.3594 7.125V12.1719H4.45312V7.125C4.45312 6.30565 5.11768 5.64062 5.9375 5.64062Z" fill="#4A62B4" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path d="M30.875 33.5469H25.8281V27.0156H32.3594V32.0625C32.3594 32.8819 31.6948 33.5469 30.875 33.5469Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.59375"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M30.875 5.34375H5.9375C4.95366 5.34375 4.15625 6.14116 4.15625 7.125V32.0625C4.15625 33.0463 4.95366 33.8438 5.9375 33.8438H30.875C31.8588 33.8438 32.6562 33.0463 32.6562 32.0625V7.125C32.6562 6.14116 31.8588 5.34375 30.875 5.34375Z" stroke="#DEDEDE" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M4.15625 12.4688H32.6562" stroke="#DEDEDE" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M4.15625 19.5938H32.6562" stroke="#DEDEDE" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M4.15625 26.7188H32.6562" stroke="#DEDEDE" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M18.4062 12.4688V33.8438" stroke="#DEDEDE" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M25.5312 12.4688V33.8438" stroke="#DEDEDE" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M11.2812 12.4688V33.8438" stroke="#DEDEDE" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
          <rect x="21" y="19" width="16" height="17" rx="4" fill="white"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M24.75 23H32.9167L26.9758 29.3653C26.8826 29.1056 26.7333 28.8826 26.5219 28.686C26.389 28.5624 26.2034 28.4504 25.8321 28.2265L24.1328 27.2016C23.5795 26.8679 23.3029 26.701 23.1514 26.4321C23 26.1633 23 25.839 23 25.1903V24.7592C23 23.9299 23 23.5153 23.2563 23.2576C23.5126 23 23.925 23 24.75 23Z" fill="#4A62B4"/>
          <path opacity="0.5" d="M34.6909 25.1903V24.7592C34.6909 23.9299 34.6909 23.5152 34.4346 23.2576C34.1783 23 33.7658 23 32.9409 23L27 29.3652C27.0288 29.4456 27.0522 29.5294 27.0705 29.617C27.1076 29.7951 27.1076 30.0036 27.1076 30.4206V32.089C27.1076 32.6575 27.1076 32.9417 27.2545 33.1633C27.4015 33.3849 27.6625 33.4942 28.1845 33.7129C29.2803 34.1719 29.8283 34.4014 30.2179 34.1402C30.6075 33.8791 30.6075 33.2824 30.6075 32.089V30.4206C30.6075 30.0036 30.6075 29.7951 30.6446 29.617C30.7218 29.2459 30.8922 28.9434 31.169 28.686C31.3019 28.5624 31.4875 28.4504 31.8588 28.2265L33.558 27.2016C34.1113 26.8679 34.388 26.701 34.5394 26.4321C34.6909 26.1633 34.6909 25.8389 34.6909 25.1903Z" fill="#E2E7FB"/>
          <rect x="21" y="19" width="16" height="17" rx="4" stroke="white" stroke-width="2"/>
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
          type
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col5Checkbox" onchange="toggleColumn('col5')" checked/>
          Organization
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col6Checkbox" onchange="toggleColumn('col6')" checked/>
          Job Position
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col7Checkbox" onchange="toggleColumn('col7')" checked/>
          Job Level
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col8Checkbox" onchange="toggleColumn('col8')" checked/>
          Employment Status
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col9Checkbox" onchange="toggleColumn('col9')" checked/>
          Join Date
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col10Checkbox" onchange="toggleColumn('col10')" checked/>
          End Date
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col11Checkbox" onchange="toggleColumn('col11')" checked/>
          Sign Date
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col12Checkbox" onchange="toggleColumn('col12')" checked/>
          Resign Date
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col13Checkbox" onchange="toggleColumn('col13')" checked/>
          Barcode
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col14Checkbox" onchange="toggleColumn('col14')" checked/>
          Email
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col15Checkbox" onchange="toggleColumn('col15')" checked/>
          Birth date
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col16Checkbox" onchange="toggleColumn('col16')" checked/>
          Birth Place
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col17Checkbox" onchange="toggleColumn('col17')" checked/>
          Address
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col18Checkbox" onchange="toggleColumn('col18')" checked/>
          Mobile Phone
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col19Checkbox" onchange="toggleColumn('col19')" checked/>
          Relegion
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col20Checkbox" onchange="toggleColumn('col20')" checked/>
          gender
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col21Checkbox" onchange="toggleColumn('col21')" checked/>
          Martial Status
        </label>
        <!-- Add other labels for each checkbox -->
      </div>
      <!-- Tambahkan button lainnya di sini -->
      <a class="export mr-3" data-toggle="modal" data-target="#modaleditinternal" style="cursor: pointer;">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 38 38" fill="none">
          <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M4.75 22.5625C5.40583 22.5625 5.9375 23.0942 5.9375 23.75C5.9375 26.0227 5.94002 27.6078 6.10082 28.8038C6.25702 29.9657 6.54273 30.5808 6.98093 31.0191C7.41914 31.4573 8.03439 31.743 9.19619 31.8993C10.3922 32.06 11.9773 32.0625 14.25 32.0625H23.75C26.0227 32.0625 27.6078 32.06 28.8038 31.8993C29.9657 31.743 30.5808 31.4573 31.0191 31.0191C31.4573 30.5808 31.743 29.9657 31.8993 28.8038C32.06 27.6078 32.0625 26.0227 32.0625 23.75C32.0625 23.0942 32.5942 22.5625 33.25 22.5625C33.9058 22.5625 34.4375 23.0942 34.4375 23.75V23.8369C34.4375 26.0023 34.4375 27.7476 34.253 29.1203C34.0615 30.5455 33.6515 31.7454 32.6985 32.6984C31.7454 33.6515 30.5455 34.0615 29.1203 34.253C27.7476 34.4375 26.0023 34.4375 23.8369 34.4375H14.1631C11.9978 34.4375 10.2524 34.4375 8.87973 34.253C7.45456 34.0615 6.2546 33.6515 5.30156 32.6985C4.34851 31.7454 3.93861 30.5455 3.74699 29.1203C3.56244 27.7476 3.56247 26.0023 3.5625 23.8369C3.5625 23.808 3.5625 23.779 3.5625 23.75C3.5625 23.0942 4.09417 22.5625 4.75 22.5625Z" fill="#E2E7FB"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M18.9998 3.5625C19.3333 3.5625 19.6512 3.70266 19.8762 3.94871L26.2095 10.8758C26.6521 11.3598 26.6185 12.1109 26.1345 12.5535C25.6505 12.996 24.8993 12.9624 24.4568 12.4784L20.1873 7.80868V25.3333C20.1873 25.9891 19.6557 26.5208 18.9998 26.5208C18.344 26.5208 17.8123 25.9891 17.8123 25.3333V7.80868L13.5429 12.4784C13.1004 12.9624 12.3493 12.996 11.8652 12.5535C11.3812 12.1109 11.3476 11.3598 11.7901 10.8758L18.1235 3.94871C18.3485 3.70266 18.6664 3.5625 18.9998 3.5625Z" fill="#4A62B4"/>
        </svg>
      </a>
      
      {{-- <a href="/employ/bulkupdateinternal" class="Bulk">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 38 38" fill="none">
          <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M5.146 34.8335C5.146 34.1777 5.67766 33.646 6.3335 33.646H31.6668C32.3226 33.646 32.8543 34.1777 32.8543 34.8335C32.8543 35.4893 32.3226 36.021 31.6668 36.021H6.3335C5.67766 36.021 5.146 35.4893 5.146 34.8335Z" fill="#E2E7FB"/>
          <path opacity="0.5" d="M30.2112 11.6716C32.1568 9.72592 32.1568 6.5714 30.2112 4.62574C28.2656 2.68009 25.111 2.68009 23.1654 4.62574L22.0415 5.74957C22.0569 5.79604 22.0729 5.84316 22.0895 5.89089C22.5013 7.0782 23.2786 8.63464 24.7406 10.0967C26.2027 11.5588 27.7591 12.336 28.9464 12.7479C28.9939 12.7644 29.0408 12.7803 29.0872 12.7956L30.2112 11.6716Z" fill="#E2E7FB"/>
          <path d="M22.0891 5.69922L22.0406 5.74761C22.0561 5.79408 22.072 5.8412 22.0886 5.88892C22.5006 7.07623 23.2777 8.63268 24.7397 10.0948C26.2019 11.5568 27.7584 12.334 28.9457 12.746C28.9927 12.7623 29.0393 12.7781 29.085 12.7932L18.2395 23.6388C17.5083 24.37 17.1426 24.7358 16.7395 25.0502C16.264 25.421 15.7494 25.7391 15.205 25.9985C14.7435 26.2184 14.2529 26.382 13.2719 26.7091L8.09853 28.4335C7.61574 28.5944 7.08347 28.4688 6.72363 28.1089C6.36379 27.749 6.23813 27.2169 6.39906 26.7339L8.1235 21.5606C8.45052 20.5795 8.61404 20.089 8.83399 19.6275C9.09345 19.0831 9.41145 18.5685 9.78236 18.0931C10.0968 17.6899 10.4624 17.3244 11.1935 16.5932L22.0891 5.69922Z" fill="#4A62B4"/>
        </svg>
      </a> --}}
    </div>

    <div class="col-md-2 d-flex justify-content-end align-items-center">
      <form class="search" id="searchForm" style="">
        <div class="form-group has-search">
          <span class="fa fa-search form-control-feedback"></span>
          <input type="text" class="form-control" placeholder="Search" id="search" name="search">
        </div>
      </form>
    </div>

    <div class="form-trans mb-2" id="formContainer" style="display: none;">
      <button class="btn btn-sm btn-primary" id='transfer' type="button" onclick="showtransferbarubulk()">Transfer Karyawan</button>
      <button class="btn btn-sm btn-danger" type="button">Cancel</button>
    </div>
  </div>
      
  <div class="table-body">
    <div class="tabcontent" id="employee">
      <div id="read">
      </div>
    </div>
  </div>


</div>

@include('employ.partials.script_read')
@include('employ.partials.script')



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


<!-- Modal edit internal -->
<div class="modal fade" id="modaleditinternal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Employee Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form untuk filter pencarian -->
        <form class="col" action="{{ route('employ.exportemployeinternal') }}" method="POST" enctype="multipart/form-data" id="exportForm">
            @csrf
            <div class="form-group">
                <label for="cabang">Employment status</label>
                <div class="dropdown custom-dropdown">
                  <button class="form-control dropdown-toggle" style="text-align: left;" type="button" id="employStatusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="employStatusSelectedText">Select Employment status</span>
                  </button>
                  <div class="dropdown-menu custom-dropdown-menu" onclick="event.stopPropagation();" aria-labelledby="employStatusDropdown" style="overflow-y: auto;width: 100%;padding: 10px;font-size: 14px;">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="All" name="employ_status[]" id="employStatusCheckboxAll">
                      <label class="form-check-label" for="employStatusCheckboxAll" onclick="event.stopPropagation();">
                        All
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="active" name="employ_status[]" id="employStatusCheckboxActive">
                      <label class="form-check-label" for="employStatusCheckboxActive" onclick="event.stopPropagation();">
                        Active
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="resign" name="employ_status[]" id="employStatusCheckboxResign">
                      <label class="form-check-label" for="employStatusCheckboxResign" onclick="event.stopPropagation();">
                        Resign
                      </label>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label for="cabang">Branch</label>
              <div class="dropup custom-dropdown" >
                <button class="form-control dropdown-toggle" style="text-align: left;" type="button" id="branchDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span id="branchSelectedText">Select Branch</span>
                </button>
                <div class="dropdown-menu custom-dropdown-menu" onclick="event.stopPropagation();" aria-labelledby="branchDropdown" style="overflow-y: auto;height: 190px;width: 100%;padding: 10px;font-size: 14px;">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="All" name="branch[]" id="branchCheckboxAll">
                    <label class="form-check-label" for="branchCheckboxAll" onclick="event.stopPropagation();">
                      All
                    </label>
                  </div>
                  @foreach($cabs as $cbg)
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="{{ $cbg->id }}" name="branch[]" id="branchCheckbox{{ $cbg->id }}">
                      <label class="form-check-label" for="branchCheckbox{{ $cbg->id }}" onclick="event.stopPropagation();">
                        {{ $cbg->nama }}
                      </label>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="form-group">
                <label for="jabatan">Organization</label>
                <div class="dropup custom-dropdown">
                  <button class="form-control dropdown-toggle" style="text-align: left;" type="button" id="organizationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="organizationSelectedText">Select Organization</span>
                  </button>
                  <div class="dropdown-menu custom-dropdown-menu" onclick="event.stopPropagation();" aria-labelledby="organizationDropdown" style="overflow-y: auto;width: 100%;padding: 10px;font-size: 14px;">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="All" name="organization[]" id="organizationCheckboxAll">
                      <label class="form-check-label" for="organizationCheckboxAll" onclick="event.stopPropagation();">
                        All
                      </label>
                    </div>
                    @foreach($bgn as $bgn)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $bgn->id }}" name="organization[]" id="organizationCheckbox{{ $bgn->id }}">
                        <label class="form-check-label" for="organizationCheckbox{{ $bgn->id }}" onclick="event.stopPropagation();">
                           {{ $bgn->nama }}
                        </label>                        
                      </div>
                    @endforeach
                  </div>
                </div>
            </div>
            <button type="submit" style="float: right;" class="btn btn-primary">Export</button>
            <button data-dismiss="modal" style="float: right;" class="btn btn-danger mr-1">Cancel</button>
        </form>
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


<!-- Modal Untuk (Detail Transfer, Create Transfer)-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="ModalTrans" tabindex="-1" role="dialog" aria-labelledby="ModalTransLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTransLabel"></h5>
        <button type="button" class="close" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="pagetransferbulk" class="p-2"></div>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal Untuk (Detail Transfer, Create Transfer)-->


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

{{-- <div class="pagination-length">
  <label for="length">Row Per Page:</label>
  <select name="length" id="length">
      <option value="10">10</option>
      <option value="20">20</option>
      <!-- Tambahkan pilihan lain sesuai kebutuhan -->
    </select>
</div> --}}


<script type="text/javascript">
   $(document).ready(function() {
    handleStatusChange();
    });
    
    // Mengirim permintaan AJAX saat perubahan pagination
    $('.pagination a').on('click', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page, $('#length').val());
    });

    // $(document).on('change', '#length', function () {
    //     var rowsPerPage = parseInt($('#showEntries').val());
    //     var coba = $("#length").val();
    //     fetch_data(1, coba);
    // })

    // Fungsi untuk menangani perubahan dropdown "Status"
  function handleStatusChange() {
    var coba = $("#length").val();
    var search = $('#search').val();

    // Ambil nilai terpilih dari dropdown
    var statusAktif = $('#employmentCheckbox1').is(':checked') ? 'aktif' : '';
    var statusNonAktif = $('#employmentCheckbox2').is(':checked') ? 'Non Aktif' : '';

    var selectedStatus = [];
    $('.statusCheckbox:checked').each(function() {
      selectedStatus.push($(this).val());
    });

    var selectedCabangs = [];
    $('.cabangCheckbox:checked').each(function() {
      selectedCabangs.push($(this).val());
    });

    var selectedbrand = [];
    $('.brandCheckbox:checked').each(function() {
      selectedbrand.push($(this).val());
    });

    var selectedvendor = [];
    $('.vendorCheckbox:checked').each(function() {
      selectedvendor.push($(this).val());
    });

    var selectedBagians = [];
    $('.tableCheckbox:checked').each(function() {
      selectedBagians.push($(this).val());
    });

    var selectedJabatan = [];
    $('.jabatanCheckbox:checked').each(function() {
      selectedJabatan.push($(this).val());
    });

    var selectedLevel = [];
    $('.levelCheckbox:checked').each(function() {
      selectedLevel.push($(this).val());
    });

    
    // Kirim permintaan AJAX ke server dengan nilai dropdown
    $.ajax({
      type: 'GET',  // Ganti sesuai dengan metode yang sesuai
      url: '{{ url("employ/index_read") }}',
      data: {
        status: statusAktif,
        statusNonAktif:statusNonAktif,
        employmentStatus: selectedStatus.join(','),
        employmentcabang: selectedCabangs.join(','),
        employmentbrand: selectedbrand.join(','),
        employmentvendor: selectedvendor.join(','),
        employmentbagian: selectedBagians.join(','),
        employmentjabatan: selectedJabatan.join(','),
        employmentlevel: selectedLevel.join(','),
        choiceValue:coba,
        search:search,
        // Tambahkan parameter lain jika diperlukan
      },
      success: function(response) {
        // Proses respons dari server di sini (misalnya, memperbarui tampilan)
        // console.log(response);
        $('#read').html(response);
        // console.log('Permintaan icalll yberhasil dikirim.');

      },
      error: function(error) {
        // Tangani kesalahan jika ada
        // console.log('Permintaan erorr huuuu.');

      }
    });
  }


  // Tambahkan listener onchange pada checkbox "Aktif"
  $('#length').on('change', function() {   
    handleStatusChange();
  });

  $('#search').on('keyup', function() {   
    handleStatusChange();
  });

  // Tambahkan listener onchange pada checkbox "Aktif"
  $('#employmentCheckbox1').on('change', function() {
    handleStatusChange();
  });

  // Tambahkan listener onchange pada checkbox "Resign"
  $('#employmentCheckbox2').on('change', function() {
    handleStatusChange();
  });

  $('.statusCheckbox').on('change', function() {
    handleStatusChange();
  });

  $('.cabangCheckbox').on('change', function() {
    handleStatusChange();
  });

  $('.brandCheckbox').on('change', function() {
    handleStatusChange();
  });

  $('.vendorCheckbox').on('change', function() {
    handleStatusChange();
  });

  $('.tableCheckbox').on('change', function() {
    handleStatusChange();
  });

  $('.jabatanCheckbox').on('change', function() {
    handleStatusChange();
  });

  $('.levelCheckbox').on('change', function() {
    handleStatusChange();
  });
  
  
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

<script>
  // Menghitung jumlah checkbox yang dipilih dan menampilkan pada tombol
  function updateSelectedCount() {
    // console.log('updateSelectedCount dipanggil');

    var employStatusCheckboxes = document.querySelectorAll('input[name="employ_status[]"]');
    var branchCheckboxes = document.querySelectorAll('input[name="branch[]"]');
    var organizationCheckboxes = document.querySelectorAll('input[name="organization[]"]');
    var employStatusSelectedText = document.getElementById('employStatusSelectedText');
    var branchSelectedText = document.getElementById('branchSelectedText');
    var organizationSelectedText = document.getElementById('organizationSelectedText');

    var employStatusCheckedCount = 0;
    employStatusCheckboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        employStatusCheckedCount++;
      }
    });

    var branchCheckedCount = 0;
    branchCheckboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        branchCheckedCount++;
      }
    });

    var organizationCheckedCount = 0;
    organizationCheckboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        organizationCheckedCount++;
      }
    });

    employStatusSelectedText.innerHTML = employStatusCheckedCount > 0 ? '(' + employStatusCheckedCount + ') Selected employment status' : 'Select employment status';
    branchSelectedText.innerHTML = branchCheckedCount > 0 ? '(' + branchCheckedCount + ') Selected Branch' : 'Select Branch';
    organizationSelectedText.innerHTML = organizationCheckedCount > 0 ? '(' + organizationCheckedCount + ') Selected Organization' : 'Select Organization';

    if (employStatusCheckedCount === employStatusCheckboxes.length && employStatusCheckedCount !== 1) {
      employStatusSelectedText.innerHTML = 'All Employment Status';
    }

    if (branchCheckedCount === branchCheckboxes.length && branchCheckedCount !== 1) {
      branchSelectedText.innerHTML = 'All Branch';
    }

    if (organizationCheckedCount === organizationCheckboxes.length && organizationCheckedCount !== 1) {
      organizationSelectedText.innerHTML = 'All Organization';
    }
  }

  // Memanggil fungsi updateSelectedCount setiap kali checkbox diubah
  var employStatusCheckboxes = document.querySelectorAll('input[name="employ_status[]"]');
  var branchCheckboxes = document.querySelectorAll('input[name="branch[]"]');
  var organizationCheckboxes = document.querySelectorAll('input[name="organization[]"]');
  var employStatusCheckboxAll = document.getElementById('employStatusCheckboxAll');
  var branchCheckboxAll = document.getElementById('branchCheckboxAll');
  var organizationCheckboxAll = document.getElementById('organizationCheckboxAll');

  employStatusCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', updateSelectedCount);
  });
  branchCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', updateSelectedCount);
  });
  organizationCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', updateSelectedCount);
  });

  employStatusCheckboxAll.addEventListener('change', function() {
    var employStatusCheckboxes = document.querySelectorAll('input[name="employ_status[]"]');
    employStatusCheckboxes.forEach(function(checkbox) {
      checkbox.checked = employStatusCheckboxAll.checked;
    });
    updateSelectedCount();
  });

  branchCheckboxAll.addEventListener('change', function() {
    var branchCheckboxes = document.querySelectorAll('input[name="branch[]"]');
    branchCheckboxes.forEach(function(checkbox) {
      checkbox.checked = branchCheckboxAll.checked;
    });
    updateSelectedCount();
  });

  organizationCheckboxAll.addEventListener('change', function() {
    var organizationCheckboxes = document.querySelectorAll('input[name="organization[]"]');
    organizationCheckboxes.forEach(function(checkbox) {
      checkbox.checked = organizationCheckboxAll.checked;
    });
    updateSelectedCount();
  });
</script>

<script>
  document.getElementById('exportForm').addEventListener('submit', function(event) {
    console.log('Form submitted');
    
    var employStatusSelected = document.getElementById('employStatusSelectedText').textContent;
    var branchSelected = document.getElementById('branchSelectedText').textContent;
    var organizationSelected = document.getElementById('organizationSelectedText').textContent;

    if (employStatusSelected === 'Select Employment status' || branchSelected === 'Select Branch' || organizationSelected === 'Select Organization') {
      event.preventDefault();
      console.log('Form not submitted due to validation error');
      
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please fill in all the fields!',
      });
    } else {
      event.preventDefault(); // Prevent the default form submission
      
      // Tampilkan loader and Swal alert
      Swal.fire({
        title: 'Exporting Data',
        text: 'Please wait...',
        allowOutsideClick: false,
        onBeforeOpen: () => {
          Swal.showLoading();
        },
        timer: 2000, // Adjust the timer value as needed (in milliseconds)
        showCancelButton: false,
        showConfirmButton: false,
        allowEscapeKey: false,
      }).then(() => {
        // After the Swal timer expires, submit the form
        document.getElementById('exportForm').submit();
      });
    }
  });
</script>



@endsection