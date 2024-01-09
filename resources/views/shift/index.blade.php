@extends('layouts.app-master')

@section('content-employ')
<div class="sceduler">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h5 class="title-detail">Scheduler</h5>
      </div>
      <!-- <div class="col" style="margin-left: 10%;"> -->
      <div class="col-md-4"> 
        <!-- <a class="btn btn-primary custombtn" data-toggle="modal" data-target="#exampleModalkehadiran"><i class="fas fa-upload"></i> Export Kehadiran</a> -->
        <!-- <a class="btn btn-primary custombtn" data-toggle="modal" data-target="#exampleModalexport" data-whatever="@mdo" href=""><i class="fas fa-upload"></i> Export Shift</a>
        <a class="btn btn-light custombtn-2" data-toggle="modal" data-target="#exampleModal" href=""><i class="fas fa-download"></i> Import Shift</a>  -->
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#contohCollapse">
          Import/Export Data
        </button>
        <div id="contohCollapse" class="collapse ">
          <div class="card">
            <div class="card-body">
              <input type="radio" name="option" id="option1" onclick="showContent(1)">
              <label for="option1">Import Shift</label>
              
              <input type="radio" name="option" id="option2" onclick="showContent(2)"> 
              <label for="option2">Export Presensi</label>
              
              <input type="radio" name="option" id="option3" onclick="showContent(3)"> 
              <label for="option3">Tamplate Shift</label>
              

              <div id="content1" style="display: none;">
                <form action="{{ route('shift.shiftimport') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="mb-3 row row-body"></div>
                      <div class="input-group mb-3">
                        <div class="custom-file">
                        <input type="file"   accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="file" >
                          <!-- <input  type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  class="custom-file-input" id="inputGroupFile01" name="file">
                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label> -->
                        </div>
                      </div>
                    </div> 
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-md btn-primary">Import</button>
                    </div>
                  </div>
                </form>
              </div>
              <div id="content2" style="display: none;">
                <form action="/shift/shiftexportkehadiran" method="GET" class="report">
                  @csrf
                  <div class="modal-body">
                    <div class="mb-3 row row-body">
                      <label class="col-form-label">Start Date Presence<span class="wajib">* :</span></label>
                      <div class="col-12">
                        <input type="date" class="form-control form-control-sm col-form-input" name="startdate" value="{{ request('startdate') }}">
                      </div>
                    </div>
                    <div class="mb-3 row row-body">
                      <label class="col-form-label">End Date Presence<span class="wajib">* :</span></label>
                      <div class="col-12">
                        <input type="date" class="form-control form-control-sm col-form-input" name="enddate" value="{{ request('enddate') }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="mr-sm-2" for="choices-select">Branch</label>
                      <select id="choices-select" multiple name="cabang[]" custom-select mr-sm-2>
                        <option value="select-all">Select All</option>
                        <option value="all-rkm">All RKM</option>
                        <option value="all-ld">All Lantai Dinding</option>
                        <option value="all-triwarna">All Triwarna</option>                        
                        @foreach ($cabang as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                      </select>
                      @error('cabang')
                      <div class="alert alert-danger mt-2">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <!--<div class="mb-3 row row-body">
                      <label class="col-form-label">Cabang<span class="wajib">* :</span></label>
                      <div class="col-12">
                        <select class="form-control form-control-sm col-form-input" id="cabang" name="cabang">
                          @foreach ($cabang as $cab)
                          <option value="{{ $cab->id }}">{{ $cab->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>-->
                  </div>

                  <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Export</button>
                  </div>
                </form>
              </div>
              <div id="content3" style="display: none;">
                <form action="/shift/shiftexport" method="GET" class="report">
                  @csrf
                  <div class="modal-body">
                    <div class="mb-3 row row-body">
                      <label class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-form-label">Start Date <span class="wajib">* :</span></label>
                      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <input type="date" class="form-control form-control-sm col-form-input" name="startdate" value="{{request('startdate')}}">
                      </div>
                    </div>              
                    <div class="mb-3 row row-body">
                      <label class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-form-label">End Date <span class="wajib">* :</span></label>
                      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <input type="date" class="form-control form-control-sm col-form-input " name="enddate" value="{{request('enddate')}}">
                      </div>
                    </div>         
                    <div class="mb-3 row row-body">
                      <label class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-form-label">End Date <span class="wajib">* :</span></label>
                      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <select class="form-control form-control-sm col-form-input-1" id="cabang" name="cabang">
                          @foreach ($cabang as $cab)
                          <option value="{{ $cab->id }}">{{ $cab->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>         
            
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Export</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>             
  </div>
</div>


<div class="container headtext-sceduler">
  <div class="row conten-head mt-3 md-3">
    <div class="col-md-2 dropdown drop-cztmng" style="">
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
        @foreach ($employes as $status)
          <label class="dropdown-item" for="{{ $status->id }}">
          <input class="statusCheckbox" type="checkbox" id="{{ $status->id }}" value="{{ $status->status_karyawan }}">
          {{ $status->status_karyawan }}
          </label>
        @endforeach
      </div>

      <div class="dropdown-menu dropcrl" id="branchSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('branchSubMenu')"><i class="fas fa-arrow-left"></i> Branch</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('branchSubMenu', this)">
        @foreach ($cabang as $cbg)
          <label class="dropdown-item" for="{{ $cbg->id }}">
            <input class="cabangCheckbox" type="checkbox" id="{{ $cbg->id }}" value="{{ $cbg->nama }}">
            {{ $cbg->nama }}
          </label>
        @endforeach
      </div>

      <div class="dropdown-menu dropcrl" id="organizationSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('organizationSubMenu')"><i class="fas fa-arrow-left"></i> Organization</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('organizationSubMenu', this)">
        @foreach ($bgn as $table)
        <label class="dropdown-item" for="{{ $table->id }}">
          <input class="tableCheckbox" type="checkbox" id="{{ $table->id }}" value="{{ $table->nama }}">
          {{ $table->nama }}
        </label>
        @endforeach
      </div>

      <div class="dropdown-menu dropcrl" id="jobpositionSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('jobpositionSubMenu')"><i class="fas fa-arrow-left"></i> Job Position</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('jobpositionSubMenu', this)">
        @foreach ($jabs as $jab)
          <label class="dropdown-item" for="{{ $jab->id }}">
            <input class="jabatanCheckbox" type="checkbox" id="{{ $jab->id }}" value="{{ $jab->nama }}">
            {{ $jab->nama }}
          </label>
        @endforeach
      </div>

      <div class="dropdown-menu dropcrl" id="joblevelSubMenu">
        <a class="dropdown-item" href="#" onclick="goBackToMainMenu('joblevelSubMenu')"><i class="fas fa-arrow-left"></i> Job Level</a>
        <input type="text" class="form-control" placeholder="Cari..." onkeyup="searchSubMenu('joblevelSubMenu', this)">
        @foreach($lvl as $lvl)
          <label class="dropdown-item" for="{{ $lvl->nama }}">
            <input class="levelCheckbox" type="checkbox" id="{{ $lvl->nama }}" value="{{ $lvl->nama }}">
            {{ $lvl->nama }}
          </label>
        @endforeach
      </div>
    </div>

    <div class="form-group col-md-2" style="width:auto; height:auto;" hidden>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-custom active">
          <input type="radio" name="weekType" value="30" checked> Monthly
        </label>
        <label class="btn btn-custom">
          <input type="radio" name="weekType" value="2"> Biweekly
        </label>
        <label class="btn btn-custom">
          <input type="radio" name="weekType" value="1"> Weekly
        </label>
      </div>
    </div>

    <div class="form-group col-md-3" style="width:auto; height:auto;">
      <div class="input-group">
        <div class="input-group-prepend" >
          <span class="input-group-text" style="border-right: none;background-color: #ffffff;">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
              <path d="M2.38577 27.242C1.63527 27.242 1.0269 26.6332 1.0269 25.8831V21.263H7.00592V27.242H2.38577Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M7.00592 14.7405V20.7195H1.0269V14.7405H7.00592Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M13.5284 21.263V27.242H7.54936V21.263H13.5284Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M20.0511 21.263V27.242H14.0721V21.263H20.0511Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M13.5284 14.7405V20.7195H7.54936V14.7405H13.5284Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M20.0511 14.7405V20.7195H14.0721V14.7405H20.0511Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M26.5735 14.7405V20.7195H20.5945V14.7405H26.5735Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M7.00592 8.21806V14.1971H1.0269V8.21806H7.00592Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M13.5284 8.21806V14.1971H7.54936V8.21806H13.5284Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M20.0511 8.21806V14.1971H14.0721V8.21806H20.0511Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M26.5735 8.21806V14.1971H20.5945V8.21806H26.5735Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M2.38577 1.6956H25.2148C25.9653 1.6956 26.5736 2.30439 26.5736 3.05447V7.67462H1.0269V3.05447C1.0269 2.30439 1.63527 1.6956 2.38577 1.6956Z" fill="#4A62B4" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path d="M25.2147 27.242H20.5945V21.263H26.5735V25.8831C26.5735 26.6332 25.9652 27.242 25.2147 27.242Z" fill="#E2E7FB" stroke="#DEDEDE" stroke-width="0.543547"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M25.2148 1.42383H2.38577C1.48511 1.42383 0.755127 2.15381 0.755127 3.05447V25.8835C0.755127 26.7841 1.48511 27.5141 2.38577 27.5141H25.2148C26.1154 27.5141 26.8454 26.7841 26.8454 25.8835V3.05447C26.8454 2.15381 26.1154 1.42383 25.2148 1.42383Z" stroke="#DEDEDE" stroke-width="1.08709" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M0.755127 7.94629H26.8454" stroke="#DEDEDE" stroke-width="1.08709" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M0.755127 14.4688H26.8454" stroke="#DEDEDE" stroke-width="1.08709" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M0.755127 20.9912H26.8454" stroke="#DEDEDE" stroke-width="1.08709" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M13.8003 7.94629V27.514" stroke="#DEDEDE" stroke-width="1.08709" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M20.3228 7.94629V27.514" stroke="#DEDEDE" stroke-width="1.08709" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M7.27759 7.94629V27.514" stroke="#DEDEDE" stroke-width="1.08709" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </div>
        <input class="form-control" type="text" id="datepicker" style="width:auto; height:auto;border-left: none;" onchange="onclik_read_data()">
      </div>
    </div>

    <div class="form-group col-md-2" hidden>
      <input class="form-control" name="start" type="date" id="dateRangeStart" readonly onchange="onclik_read_data()">
    </div>

    <div class="form-group col-md-2" hidden>
      <input class="form-control" name="end" type="date" id="dateRangeEnd" readonly>
    </div>
    
    <div class="form-group col">
      <form id="ExportForm" >
        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="46" viewBox="0 0 35 36" fill="none" style="cursor:pointer;">
          <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M4.34833 21.3643C4.94871 21.3643 5.43542 21.851 5.43542 22.4514C5.43542 24.5319 5.43773 25.983 5.58493 27.0779C5.72792 28.1415 5.98948 28.7046 6.39063 29.1058C6.79178 29.507 7.35501 29.7685 8.41858 29.9116C9.51343 30.0587 10.9645 30.061 13.0451 30.061H21.7418C23.8224 30.061 25.2735 30.0587 26.3684 29.9116C27.432 29.7685 27.9951 29.507 28.3963 29.1058C28.7975 28.7046 29.059 28.1415 29.2021 27.0779C29.3492 25.983 29.3515 24.5319 29.3515 22.4514C29.3515 21.851 29.8382 21.3643 30.4386 21.3643C31.039 21.3643 31.5257 21.851 31.5257 22.4514V22.5309C31.5257 24.5132 31.5257 26.1109 31.3568 27.3676C31.1814 28.6723 30.8062 29.7707 29.9338 30.6431C29.0612 31.5157 27.9628 31.891 26.6581 32.0663C25.4014 32.2352 23.8037 32.2352 21.8214 32.2352H12.9656C10.9833 32.2352 9.38552 32.2352 8.12888 32.0663C6.82421 31.891 5.7257 31.5157 4.85325 30.6433C3.98079 29.7707 3.60554 28.6723 3.43012 27.3676C3.26117 26.1109 3.2612 24.5132 3.26123 22.5309C3.26123 22.5044 3.26123 22.4779 3.26123 22.4514C3.26123 21.851 3.74795 21.3643 4.34833 21.3643Z" fill="#E2E7FB"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M17.3935 3.9707C17.6987 3.9707 17.9898 4.09901 18.1958 4.32426L23.9936 10.6656C24.3987 11.1087 24.368 11.7964 23.9249 12.2015C23.4818 12.6066 22.7942 12.5758 22.389 12.1327L18.4806 7.85786V23.9008C18.4806 24.5011 17.9938 24.9879 17.3935 24.9879C16.7931 24.9879 16.3064 24.5011 16.3064 23.9008V7.85786L12.398 12.1327C11.9928 12.5758 11.3052 12.6066 10.8621 12.2015C10.419 11.7964 10.3882 11.1087 10.7933 10.6656L16.5912 4.32426C16.7972 4.09901 17.0882 3.9707 17.3935 3.9707Z" fill="#4A62B4"/>
        </svg>
      </form>
    </div>

    <div class="col-md-4 d-flex justify-content-end">
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control" placeholder="Search" id="search" name="search" onkeyup="onclik_read_data()">
        </div>
    </div>

  </div>

  <div class="row cuztom-grid" >
    <div class="filter-data">
      <div class="present-data">
        <div class="tabeling-data">
          <div id="sceduler"></div>
        </div>
      </div>
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

    </div>
  </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Shift</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('shift.shiftimport') }}" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
          <div class="mb-3 row row-body"></div>
            <div class="input-group mb-3">
              <div class="custom-file">
              <input type="file"   accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="file" >
                <!-- <input  type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  class="custom-file-input" id="inputGroupFile01" name="file">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label> -->
              </div>
            </div>
          </div> 
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-md btn-primary">Import</button>
          </div>
        </div>
      </form>
    </div>
</div>
<!-- Akhir Modal Import -->

<!-- Modal Export -->
<div class="modal fade" id="exampleModalexport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Shift</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/shift/shiftexport" method="GET" class="report">
      @csrf
      <div class="modal-body">
        <!-- Coba -->
        <div class="mb-3 row row-body">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">Start Date <span class="wajib">* :</span></label>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <input type="date" class="form-control form-control-sm col-form-input" name="startdate" value="{{request('startdate')}}">
            </div>
        </div>              
        <div class="mb-3 row row-body">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">End Date <span class="wajib">* :</span></label>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <input type="date" class="form-control form-control-sm col-form-input " name="enddate" value="{{request('enddate')}}">
            </div>
        </div>         
        <!-- Akhir Coba -->
        <div class="mb-3 row row-body">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">End Date <span class="wajib">* :</span></label>
          <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <select class="form-control form-control-sm col-form-input-1" id="cabang" name="cabang">
              @foreach ($cabang as $cab)
              <option value="{{ $cab->id }}">{{ $cab->nama }}</option>
              @endforeach
		        </select>
          </div>
        </div>         
 
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Export</button>
      </div>
    </div>
</form>
  </div>
</div>
<!-- Akhir Modal Export -->


<!-- Kehadiran -->

<!-- Modal Export -->
<div class="modal fade" id="exampleModalkehadiran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export KEHADIRAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/shift/shiftexportkehadiran" method="GET" class="report">
      @csrf
      <div class="modal-body">
        <!-- Coba -->
        <div class="mb-3 row row-body">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">Start Date Kehadiran<span class="wajib">* :</span></label>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <input type="date" class="form-control form-control-sm col-form-input" name="startdate" value="{{request('startdate')}}">
            </div>
        </div>              
        <div class="mb-3 row row-body">
            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">End Date Kehadiran<span class="wajib">* :</span></label>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <input type="date" class="form-control form-control-sm col-form-input " name="enddate" value="{{request('enddate')}}">
            </div>
        </div>         
        <!-- Akhir Coba -->
        <div class="mb-3 row row-body">
          <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">End Date Kehadiran<span class="wajib">* :</span></label>
          <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <select class="form-control form-control-sm col-form-input-1" id="cabang" name="cabang">
              @foreach ($cabang as $cab)
              <option value="{{ $cab->id }}">{{ $cab->nama }}</option>
              @endforeach
		        </select>
          </div>
        </div>         
 
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Export</button>
      </div>
    </div>
</form>
  </div>
</div>
<!-- Akhir Modal Export -->
<!-- Akhir Kehadiran -->

@include('shift.partials.script')

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>
  function showContent(option) {
    for (let i = 1; i <= 4; i++) {
      const content = document.getElementById('content' + i);
      const radio = document.getElementById('option' + i);
      if (i === option) {
        content.style.display = 'block';
      } else {
        content.style.display = 'none';
      }
    }
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

<script>
    var choicesSelect = new Choices('#choices-select', {
        removeItemButton: true, // Menampilkan tombol hapus untuk setiap pilihan
        searchPlaceholderValue: 'Cari opsi', // Placeholder untuk kotak pencarian
        shouldSort: false, // Untuk mempertahankan urutan opsi
    });

    // Menemukan elemen "Select All"
    var selectAllOption = choicesSelect._store.choices.find(choice => choice.value === 'select-all');
    var allRkmOption = choicesSelect._store.choices.find(choice => choice.value === 'all-rkm');
    var allLdOption = choicesSelect._store.choices.find(choice => choice.value === 'all-ld');
    var allTriwarnaOption = choicesSelect._store.choices.find(choice => choice.value === 'all-triwarna');

    // Menambahkan event listener untuk pemilihan opsi di atas
    choicesSelect.passedElement.element.addEventListener('choice', function(event) {
        var selectedValue = event.detail.choice.value;
        if (selectedValue === 'select-all') {
            if (selectAllOption.isSelected) {
                // Uncheck "Select All" jika sudah dipilih
                selectAllOption.unselect();
            } else {
                // Check "Select All" jika belum dipilih
                selectAllOption.select();
            }
        } else if (selectedValue === 'all-rkm' || selectedValue === 'all-ld' || selectedValue === 'all-triwarna') {
            // Pilih semua opsi yang awalannya sesuai dengan pilihan
            var prefix = selectedValue === 'all-rkm' ? 'RKM' : (selectedValue === 'all-ld' ? 'LD' : 'Triwarna');
            var matchingChoices = choicesSelect._store.choices
                .filter(choice => choice.value !== selectedValue && choice.label.startsWith(prefix))
                .map(choice => choice.value);
            choicesSelect.setChoiceByValue(matchingChoices);
        } else {
            // Jika memilih cabang selain "All RKM," "All LD," atau "All Triwarna," uncheck semua opsi khusus
            if (selectAllOption.isSelected) {
                selectAllOption.unselect();
            }
            if (allRkmOption.isSelected) {
                allRkmOption.unselect();
            }
            if (allLdOption.isSelected) {
                allLdOption.unselect();
            }
            if (allTriwarnaOption.isSelected) {
                allTriwarnaOption.unselect();
            }
        }
    });
</script>
@endsection
