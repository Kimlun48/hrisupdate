@extends('layouts.app-master')

@section('content-attend')
<div class="attendancing">
  <div class="container">
    <div class="row">
      <div class="head-title col-md-6">
        <h5 class="title-employ">Attendance Internal</h5>
      </div>
      <div class="lay-button col-md-6 d-flex justify-content-end align-items-center">
        <!-- <a class="btn mr-3 custombtn" href="/trans">Employee Transfer</a>
        <a class="btn btn-primary custombtn-2" href="{{route('employ.create')}}">Add Employees Internal</a> -->
      </div>
    </div>
  </div>
</div>
	
<div class="head-attend container">
  <div class="row content-head mt-3 md-3">

    <div class="filter-date col-md-2 form-group">
      <form action="/presensi" method="get">
        <input type="date" class="form-control cstom-input" name="tglpresen" id="tanggalInput" value="{{$skr}}">
        <!-- <button type="submit" class="btn btn-primary">Filter</button> -->
      </form>
    </div>
    
    <div class="col-md-5 dropdown drop-cztmng" style="">
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
        <a class="dropdown-item" href="#" onclick="showSubMenu('clockInSubMenu')">Clock In
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
        <a class="dropdown-item" href="#" onclick="showSubMenu('clockOutSubMenu')">Clock Out
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
        <a class="dropdown-item" href="#" onclick="showSubMenu('timeOffCodeSubMenu')">Time Off Code
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
        <a class="dropdown-item" href="#" onclick="showSubMenu('overtimeSubMenu')">Overtime
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
        <a class="dropdown-item" href="#" onclick="showSubMenu('jobSubMenu')">Job Position
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
        <a class="dropdown-item" href="#" onclick="showSubMenu('employmentstatusSubMenu')">Employment Status
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M9.07929 15.5058L12.6312 11.9538L9.07929 8.4019C8.72227 8.04488 8.72227 7.46815 9.07929 7.11112C9.43632 6.7541 10.013 6.7541 10.3701 7.11112L14.572 11.313C14.929 11.6701 14.929 12.2468 14.572 12.6038L10.3701 16.8057C10.013 17.1627 9.43632 17.1627 9.07929 16.8057C8.73142 16.4487 8.72227 15.8628 9.07929 15.5058Z" fill="#323232"/>
          </svg>
        </a>
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
          Late Clock In
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
          <label class="dropdown-item" for="{{ $bgn->nama }}">
            <input class="tableCheckbox" type="checkbox" id="{{ $bgn->nama }}" value="{{ $bgn->nama }}">
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
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('employmentstatusSubMenu')"><i class="fas fa-arrow-left"></i> Employment Status</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('employmentstatusSubMenu', this)">
        @foreach ($krs as $empl)
          <label class="dropdown-item" for="{{ $empl->status_karyawan }}">
          <input class="statusCheckbox" type="checkbox" id="{{ $empl->status_karyawan }}" value="{{ $empl->status_karyawan }}">
          {{ $empl->status_karyawan }}
          </label>
        @endforeach
      </div>
    </div>


    <div class="dropdown col-md-3 d-flex justify-content-end align-items-center custom-filter" >
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
        <!-- <label class="dropdown-item">
          <input type="checkbox" name="check" id="colCheckbox" onchange="toggleColumn('col')" checked/>
          All
        </label> -->
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col3Checkbox" onchange="toggleColumn('col3')"checked />
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
          <input type="checkbox" name="check" id="col15Checkbox" onchange="toggleColumn('col15')" checked/>
          Time Off Code 
        </label>
        <label class="dropdown-item">
          <input type="checkbox" name="check" id="col16Checkbox" onchange="toggleColumn('col16')" checked/>
          Overtime
        </label>
        <!-- Add other labels for each checkbox -->
      </div>
      <!-- Tambahkan button lainnya di sini --> 
      <!-- Untuk Exoirt Data Icon Pencil -->
      <a class="export mr-3" onclick="exportdata()" style="cursor: pointer;">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 38 38" fill="none">
          <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M4.75 22.5625C5.40583 22.5625 5.9375 23.0942 5.9375 23.75C5.9375 26.0227 5.94002 27.6078 6.10082 28.8038C6.25702 29.9657 6.54273 30.5808 6.98093 31.0191C7.41914 31.4573 8.03439 31.743 9.19619 31.8993C10.3922 32.06 11.9773 32.0625 14.25 32.0625H23.75C26.0227 32.0625 27.6078 32.06 28.8038 31.8993C29.9657 31.743 30.5808 31.4573 31.0191 31.0191C31.4573 30.5808 31.743 29.9657 31.8993 28.8038C32.06 27.6078 32.0625 26.0227 32.0625 23.75C32.0625 23.0942 32.5942 22.5625 33.25 22.5625C33.9058 22.5625 34.4375 23.0942 34.4375 23.75V23.8369C34.4375 26.0023 34.4375 27.7476 34.253 29.1203C34.0615 30.5455 33.6515 31.7454 32.6985 32.6984C31.7454 33.6515 30.5455 34.0615 29.1203 34.253C27.7476 34.4375 26.0023 34.4375 23.8369 34.4375H14.1631C11.9978 34.4375 10.2524 34.4375 8.87973 34.253C7.45456 34.0615 6.2546 33.6515 5.30156 32.6985C4.34851 31.7454 3.93861 30.5455 3.74699 29.1203C3.56244 27.7476 3.56247 26.0023 3.5625 23.8369C3.5625 23.808 3.5625 23.779 3.5625 23.75C3.5625 23.0942 4.09417 22.5625 4.75 22.5625Z" fill="#E2E7FB"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M18.9998 3.5625C19.3333 3.5625 19.6512 3.70266 19.8762 3.94871L26.2095 10.8758C26.6521 11.3598 26.6185 12.1109 26.1345 12.5535C25.6505 12.996 24.8993 12.9624 24.4568 12.4784L20.1873 7.80868V25.3333C20.1873 25.9891 19.6557 26.5208 18.9998 26.5208C18.344 26.5208 17.8123 25.9891 17.8123 25.3333V7.80868L13.5429 12.4784C13.1004 12.9624 12.3493 12.996 11.8652 12.5535C11.3812 12.1109 11.3476 11.3598 11.7901 10.8758L18.1235 3.94871C18.3485 3.70266 18.6664 3.5625 18.9998 3.5625Z" fill="#4A62B4"/>
        </svg>
      </a>
      
    </div>

    <div class="col-md-2 d-flex justify-content-end align-items-center">
      <form class="search" id="searchForm" style="">
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
      <div id=".en"></div>
    </div>
  </div>


</div>

@include('presensi.partials.scripts')
@include('loadjs.filtertable')
@include('loadjs.searchtable')



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
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="todayLabel"></h4>
      </div>
      <div class="modal-body modal-daily" id="todaydata"></div>
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
      $("#exportlabel").html('Export Presensi Data Internal');
      $("#exportdata").html(data);
      $("#modalexport").modal('show');    
      // const select = new Choices('#mySelect', { removeItemButton: true });
      // const select2 = new Choices('#mySelect2', { removeItemButton: true });
      // const selectedValues = select.getValue();
      // const selectedValues2 = select2.getValue();
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


@endsection



