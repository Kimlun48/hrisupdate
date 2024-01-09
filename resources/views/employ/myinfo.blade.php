@extends('layouts.app-master')

@section('content-employ')
<div class="employ-myinfo">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-3 content-kiri ">
            <div class="info">
               @if($kary->jabatan->photo)
               <img src="{{ $kary->photo }}" alt="profile" class="foto-profile mt-4">
               @else
               <div class="foto-profile mt-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="116" height="116" viewBox="0 0 116 116" fill="none">
                     <path opacity="0.4" d="M57.7034 106.336C84.2465 106.336 105.764 84.819 105.764 58.2753C105.764 31.732 84.2465 10.2144 57.7034 10.2144C31.16 10.2144 9.64233 31.732 9.64233 58.2753C9.64233 84.819 31.16 106.336 57.7034 106.336Z" fill="#4A62B4"/>
                     <path d="M57.7034 33.908C47.7548 33.908 39.6805 41.9822 39.6805 51.9307C39.6805 61.687 47.3222 69.6171 57.4631 69.9055C57.6073 69.9055 57.7995 69.9055 57.8957 69.9055C57.9918 69.9055 58.136 69.9055 58.2321 69.9055C58.2802 69.9055 58.3282 69.9055 58.3282 69.9055C68.0365 69.569 75.6782 61.687 75.7263 51.9307C75.7263 41.9822 67.6521 33.908 57.7034 33.908Z" fill="#F1F5F9"/>
                     <path d="M90.2921 93.6002C81.7372 101.482 70.2987 106.336 57.7067 106.336C45.1147 106.336 33.6762 101.482 25.1213 93.6002C26.2748 89.2266 29.3988 85.2376 33.9646 82.1616C47.0852 73.4145 68.4243 73.4145 81.4489 82.1616C86.0627 85.2376 89.1386 89.2266 90.2921 93.6002Z" fill="#F1F5F9"/>
                  </svg>
               </div>
               @endif
               <h6 class="text-center fw-bold mt-3">{{ $kary->nama_lengkap }}</h6>
               <h6 class="text-center fw-light">{{$kary->jabatan->nama }}</h6>
            </div>
            <hr class="garis mb-3 mt-3">
            <div class="d-flex flex-column">
               <div class="dropdown mb-2">
                   <a class="btn dropdown-toggle cstmdrop" role="button" data-toggle="collapse" href="#collapse1" aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                        <path d="M18.004 15.0389C21.2061 15.0389 23.8019 12.4431 23.8019 9.24108C23.8019 6.03902 21.2061 3.44324 18.004 3.44324C14.802 3.44324 12.2062 6.03902 12.2062 9.24108C12.2062 12.4431 14.802 15.0389 18.004 15.0389Z" fill="#4A62B4"/>
                        <path opacity="0.5" d="M29.5998 25.9099C29.5998 29.5122 29.5998 32.4325 18.0041 32.4325C6.40845 32.4325 6.40845 29.5122 6.40845 25.9099C6.40845 22.3076 11.6 19.3873 18.0041 19.3873C24.4083 19.3873 29.5998 22.3076 29.5998 25.9099Z" fill="#4A62B4"/>
                     </svg>
                       General
                   </a>
                   <div id="collapse1" class="ml-4 collapse">
                       <a class="dropdown-item" href="#info" onclick="showTab('personal')">Personal</a>
                       <a id="employment-link" class="dropdown-item" href="#employment" onclick="showTab('employment')">Employment</a>
                       <a class="dropdown-item" href="/timeoff/reqtimeoff/{{ $kary->id }}">Education & Experience</a>
                       <a class="dropdown-item" href="/timeoff/reqtimeoff/{{ $kary->id }}">Additional Info</a>
                   </div>
               </div>
           
               <div class="dropdown mb-2">
                   <a class="btn dropdown-toggle" role="button" data-toggle="collapse" href="#collapse2" aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                        <path d="M18.004 15.0389C21.2061 15.0389 23.8019 12.4431 23.8019 9.24108C23.8019 6.03902 21.2061 3.44324 18.004 3.44324C14.802 3.44324 12.2062 6.03902 12.2062 9.24108C12.2062 12.4431 14.802 15.0389 18.004 15.0389Z" fill="#4A62B4"/>
                        <path opacity="0.5" d="M29.5998 25.9099C29.5998 29.5122 29.5998 32.4325 18.0041 32.4325C6.40845 32.4325 6.40845 29.5122 6.40845 25.9099C6.40845 22.3076 11.6 19.3873 18.0041 19.3873C24.4083 19.3873 29.5998 22.3076 29.5998 25.9099Z" fill="#4A62B4"/>
                     </svg>
                     Time Management
                   </a>
                   <div id="collapse2" class="collapse ml-4 ">
                       <a class="ms-2 dropdown-item" href="/attendance">Attendance</a>
                       <a class="ms-2 dropdown-item" href="/attendance_log">Attendance Logs</a>
                       <a class="ms-2 dropdown-item" href="/timeoff/reqtimeoff/{{ $kary->id }}">Time Off</a>
                   </div>
               </div>
           
               <div class="ml-4 dropdown mb-2">
                  <i class="fas fa-credit-card"></i>
                  <a href="/" class="ms-2 text-decoration-none text-dark">Payroll</a>
               </div>
               <div class="ml-5 dropdown ">
                  <a href="" class="ms-2 text-decoration-none text-danger">Resign</a>
               </div>

            </div>
           
         </div>

         <div class="col-md-8 content-kanan">
            <div id="nav_atas">
               <h3 class="headtext">Personal</h3>
               <ul class="nav text-dark">
                  <li class="nav-item">
                     <a class="dropdown-item" href="#personal" onclick="showTab('personal')">Basic Info</a>
                  </li>
                  <li class="nav-item">
                     <a class="dropdown-item" href="#family" onclick="showTab('family')">Family</a>
                  </li>
                  <li class="nav-item">
                     <a class="dropdown-item" href="#emergency" onclick="showTab('emergency')">Emergency</a>
                  </li>
               </ul>
               <!-- <hr class="devider"> -->
            </div>

            <div id="basic-info" class="tab-content">
               <div id="personal" class="tab-pane fade show active">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-3 fw-bold">
                           Personal data
                        </div>
                        <div class="col-md-6">
                           <table class="bio">
                              <tr>
                                 <td class="label_head">Full Name</td>
                                 <td class="label_text fw-bold">{{ $kary->nama_lengkap }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Mobile Phone</td>
                                 <td class="label_text fw-bold">{{ $kary->no_hp }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Email</td>
                                 <td class="label_text fw-bold">{{ $kary->email }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Phone</td>
                                 <td class="label_text fw-bold">{{ $kary->no_telp }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Place Of Birth</td>
                                 <td class="label_text fw-bold">{{ $kary->tempat_lahir }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Birth Date</td>
                                 <td class="label_text fw-bold">
                                    {{ $kary->tgl_lahir }} 
                                    <span class="umur">{{ Carbon\Carbon::parse($kary->tgl_lahir)->diffInYears(Carbon\Carbon::now()) }} years old</span>
                                </td>
                                                              </tr>
                              <tr>
                                 <td class="label_head">Gender</td>
                                 <td class="label_text fw-bold">{{ $kary->gender }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Martial Status</td>
                                 <td class="label_text fw-bold">{{ $kary->status_pernikahan }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Blood Type</td>
                                 <td class="label_text fw-bold">{{ $kary->golongan_darah }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Religion</td>
                                 <td class="label_text fw-bold">{{ $kary->agama }}</td>
                              </tr>
                           </table>
                        </div>

                        <div class="col-md-3 text-center">
                           <button class="btn btn-sm " onclick="showedit_personaldata({{ $kary->id }})">Edit</button>
                        </div>

                        <hr>

                        <div class="col-md-3 fw-bold">
                           Identity & Address
                        </div>
                        <div class="col-md-6">
                           <table class="address">
                              <tr>
                                 <td class="label_head">ID Type</td>
                                 <td class="label_text fw-bold">KTP</td>
                              </tr>
                              <tr>
                                 <td class="label_head">ID Number</td>
                                 <td class="label_text fw-bold">{{ $kary->no_identitas }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">ID Expiration Date</td>
                                 <td class="label_text fw-bold">Permanent</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Postal Code</td>
                                 <td class="label_text fw-bold">{{ $kary->kodepos }}</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Address</td>
                                 <td class="label_text fw-bold">{{ $kary->alamat }}</td>
                              </tr>
                           </table>
                        </div>
                        
                        <div class="col-md-3 text-center">
                           <button class="btn btn-sm" onclick="showedit_identity_and_address({{ $kary->id }})">Edit</button>
                        </div>
                     </div>
                  </div>
               </div>

               <div id="family" class="tab-pane fade">
                  <div class="container">
                     <div class="scrollable-table table-responsive-sm">
                        <div class="row">
                           <div class="col-md-12 d-flex justify-content-end">
                              <button class="btn btn-sm btn-add mt-3 mr-2" onClick="create()">Add New</button>
                           </div>
                       </div>
                        <table class="table mt-2" id="familyTable">
                           <thead>
                              <tr class="ly">
                                 <th class="femi-th fw-bold">No</th>
                                 <th class="femi-th fw-bold">Name</th>
                                 <th class="femi-th fw-bold">Relationship</th>
                                 <th class="femi-th fw-bold">Birthdate</th>
                                 <th class="femi-th fw-bold">ID number</th>
                                 <th class="femi-th fw-bold">Marital status</th>
                                 <th class="femi-th fw-bold">Gender</th>
                                 <th class="femi-th fw-bold">Job</th>
                                 <th class="femi-th fw-bold">Religion</th>
                                 <th class="femi-th fw-bold">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="ly">
                                 <td class="femi-td">1</td>
                                 <td class="femi-td">Spouse</td>
                                 <td class="femi-td">brother</td>
                                 <td class="femi-td">1980-05-15</td>
                                 <td class="femi-td">123456789</td>
                                 <td class="femi-td">Married</td>
                                 <td class="femi-td">Male</td>
                                 <td class="femi-td">Engineer</td>
                                 <td class="femi-td">Christian</td>
                                 <td class="actions" colspan="2">
                                    <div class="bg-edit" >
                                       <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g id="Icon Bulk Update">
                                             <path id="Vector" opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M3.75732 21.7134C3.75732 21.3048 4.08852 20.9736 4.49706 20.9736H20.2781C20.6867 20.9736 21.0179 21.3048 21.0179 21.7134C21.0179 22.1219 20.6867 22.4531 20.2781 22.4531H4.49706C4.08852 22.4531 3.75732 22.1219 3.75732 21.7134Z" fill="#C2CFFF"/>
                                             <path id="Vector_2" opacity="0.5" d="M19.3724 7.28543C20.5844 6.07342 20.5844 4.10834 19.3724 2.89632C18.1604 1.6843 16.1953 1.6843 14.9833 2.89632L14.2832 3.5964C14.2928 3.62534 14.3027 3.6547 14.3131 3.68442C14.5696 4.42405 15.0538 5.39361 15.9646 6.3044C16.8753 7.21518 17.8449 7.69933 18.5845 7.95593C18.6141 7.9662 18.6433 7.9761 18.6722 7.98565L19.3724 7.28543Z" fill="#E2E7FB"/>
                                             <path id="Vector_3" d="M14.312 3.56494L14.2818 3.59508C14.2915 3.62403 14.3013 3.65338 14.3117 3.68311C14.5683 4.42273 15.0524 5.3923 15.9632 6.30309C16.874 7.21386 17.8436 7.69802 18.5832 7.95462C18.6125 7.9648 18.6415 7.97462 18.67 7.98408L11.914 14.7402C11.4585 15.1957 11.2306 15.4235 10.9795 15.6194C10.6833 15.8504 10.3628 16.0486 10.0236 16.2101C9.73613 16.3471 9.43056 16.449 8.81943 16.6528L5.59675 17.727C5.29601 17.8272 4.96444 17.749 4.74028 17.5248C4.51612 17.3006 4.43784 16.9691 4.53809 16.6683L5.61231 13.4456C5.81602 12.8344 5.91788 12.5289 6.0549 12.2414C6.21653 11.9023 6.41462 11.5817 6.64567 11.2855C6.84154 11.0344 7.0693 10.8067 7.52475 10.3512L14.312 3.56494Z" fill="#4A62B4"/>
                                          </g>
                                       </svg>
                                       Edit
                                    </div>  
                                </td>
                              </tr>
                              <!-- Tambahkan baris-baris data lainnya di sini -->
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>

               <div id="emergency" class="tab-pane fade">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-3 fw-bold">
                           Information
                        </div>
                        <div class="col-md-6">
                           <table class="emergency">
                              <tr>
                                 <td class="label_head">Name</td>
                                 <td class="label_text fw-bold">dummy</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Relationship</td>
                                 <td class="label_text fw-bold">-</td>
                              </tr>
                              <tr>
                                 <td class="label_head">Mobile Phone</td>
                                 <td class="label_text fw-bold">
                                    @if($kary->kontak_darurat)
                                       {{ $kary->kontak_darurat }}
                                    @else
                                       -
                                    @endif 
                                 </td>
                              </tr>
                           </table>
                        </div>

                        <div class="col-md-3 text-center">
                           <button class="btn btn-sm">Edit</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

               
            <div id="employment" class="tab-pane fade" >
               <div class="container">
                  <div class="row">
                     <div class="col-md-3 fw-bold">
                        Employment Data
                     </div>
                     <div class="col-md-7 content-table">
                        <table class="bio">
                           <tr>
                              <td class="label_head">Company Name</td>
                              <td class="label_text fw-bold">{{ $kary->cabang->perusahaan->nama }}</td>
                           </tr>
                           <tr>
                              <td class="label_head">Branch</td>
                              <td class="label_text fw-bold">{{ $kary->cabang->nama }}</td>
                           </tr>
                           <tr>
                              <td class="label_head">Employment ID</td>
                              <td class="label_text fw-bold">{{ $kary->nomor_induk_karyawan }}</td>
                           </tr>
                           <tr>
                              <td class="label_head">Organization Name</td>
                              <td class="label_text fw-bold">{{ $kary->bagian->nama }}</td>
                           </tr>
                           <tr>
                              <td class="label_head">Job Position</td>
                              <td class="label_text fw-bold">{{ $kary->jabatan->nama }}</td>
                           </tr>
                           <tr>
                              <td class="label_head">Job Level</td>
                              <td class="label_text fw-bold">{{ $kary->jabatan->paramlevel->nama }}</td>
                           </tr>
                           <tr>
                              <td class="label_head">Employment Status</td>
                              <td class="label_text fw-bold">{{ $kary->status_karyawan }}</td>
                           </tr>
                           <tr>
                              <td class="label_head">Join Date</td>
                              <td class="label_text fw-bold">
                                 @if ($kary->tahun_gabung)
                                    {{ \Carbon\Carbon::parse($kary->tahun_gabung)->format('d-m-Y') }}
                                 @else
                                    N/A
                                 @endif
                              </td>
                           </tr>
                           <tr>
                              <td class="label_head">End Date</td>
                              <td class="label_text fw-bold">
                                 @if ($kary->tahun_keluar)
                                    {{ \Carbon\Carbon::parse($kary->tahun_keluar)->format('d-m-Y') }}
                                 @else
                                    N/A
                                 @endif
                              </td>
                           </tr>
                        </table>
                     </div>
                     <div class="col-md-2 text-center">
                        <button class="btn btn-sm" onclick="showedit_employ_data({{ $kary->id }})">Edit</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<script>
   function showTab(tab) {
   // Show or hide the relevant tabs based on the selected option
   if (tab === 'personal') {
      document.getElementById('personal').classList.add('show', 'active');
      document.getElementById('employment').style.display = 'none';
      document.getElementById('family').classList.remove('show', 'active');
      document.getElementById('emergency').classList.remove('show', 'active');
      document.getElementById('nav_atas').style.display = 'block'; // Show the nav_atas element
   } else if (tab === 'employment') {
      document.getElementById('nav_atas').style.display = 'none'; // Hide the nav_atas element
      document.getElementById('personal').classList.remove('show', 'active');
      document.getElementById('employment').classList.add('show', 'active');
      document.getElementById('employment').style.display = 'block'; // Show the nav_atas element
      document.getElementById('family').classList.remove('show', 'active');
      document.getElementById('emergency').classList.remove('show', 'active');
   } else if (tab === 'family') {
      document.getElementById('personal').classList.remove('show', 'active');
      document.getElementById('employment').style.display = 'none';
      document.getElementById('family').classList.add('show', 'active');
      document.getElementById('emergency').classList.remove('show', 'active');
      document.getElementById('nav_atas').style.display = 'block'; // Show the nav_atas element
   } else if (tab === 'emergency') {
      document.getElementById('personal').classList.remove('show', 'active');
      document.getElementById('employment').style.display = 'none';
      document.getElementById('family').classList.remove('show', 'active');
      document.getElementById('emergency').classList.add('show', 'active');
      document.getElementById('nav_atas').style.display = 'block'; // Show the nav_atas element
   }
   }

   
   // Add the following line to show the "Employment" tab by default on page load
   showTab('personal');
   
   // Add an event listener to the "Employment" link to show the tab content when clicked
   document.getElementById('employment-link').addEventListener('click', function() {
      showTab('employment');
   });
</script>



<!-- Modal phk internal -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel" aria-hidden="true">
  {{-- <div class="modal-dialog" role="document"> --}}
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalEditLabel"></h5>
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
@include('employ.partials.script_edit_kar_profil')


@endsection