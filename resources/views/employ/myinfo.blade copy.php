
@extends('layouts.app-master')


@section('content')

<div class="employ-myinfo">

   <div class="container-fluid">
      <div class="row">
      
         <div class="col-md-3 content-kiri me-2">
            <div class="info">
               @if($kary->jabatan->photo)
               <img src="{{ $kary->photo }}" alt="profile" class="foto-profile mt-4">
               @else
               <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/256px-No-Image-Placeholder.svg.png" alt="default_image" class="foto-profile mt-4">
               @endif
               <h6 class="text-center fw-bold mt-3">{{ $kary->nama_lengkap }}</h6>
               <h6 class="text-center fw-light">{{$kary->jabatan->nama }}</h6>
            </div>
            <hr class="garis mb-3 mt-3">
            <ul class="list-group list bg-transparent border-0 mb-3">
               <li class="list-group-item bg-transparent border-0">
                  <div class="dropdown bg-transparent border-0">
                     <a class="btn dropdown-toggle" role="button" data-toggle="collapse" href="#collapse1" aria-expanded="false">
                        General
                     </a>
                     <div id="collapse1" class="collapse">
                           <a class="dropdown-item" href="#info">Personal</a>
                           <a class="dropdown-item" href="/attendance_log">Employment</a>
                           <a class="dropdown-item" href="/timeoff/reqtimeoff/{{ $kary->id }}">Education & Experience</a>
                           <a class="dropdown-item" href="/timeoff/reqtimeoff/{{ $kary->id }}">Additional Info</a>
                     </div>
                  </div>
               </li>
                  <li class="list-group-item bg-transparent border-0">
                  <div class="dropdown bg-transparent border-0">
                     <a class="btn dropdown-toggle" role="button" data-toggle="collapse" href="#collapse2" aria-expanded="false">
                        Time Management
                     </a>
                     <div id="collapse2" class="collapse">
                        <a class="dropdown-item" href="/attendance">Attendance</a>
                        <a class="dropdown-item" href="/attendance_log">Attendance Logs</a>
                        <a class="dropdown-item" href="/timeoff/reqtimeoff/{{ $kary->id }}">Time Off</a>
                     </div>
                  </div>
                  </li>

               <li class="list-group-item bg-transparent border-0">
                  <i class="fas fa-credit-card"></i>
                  <a href="/" class="ms-3 text-decoration-none text-dark">Payrol</a>
               </li>
            </ul>
         </div>

         <div class="col-md-8 content-kanan">

           

            <!-- general -->
            <div class="tab">
               <div id="nav_atas" style="display: block;">
                  <ul class="nav text-dark">
                     <li class="nav-item">
                        <a class="nav-link tablinks" href="#info" onclick="tabGeneral(event, 'info')" id="defaultOpen">Basic Info</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link tablinks" href="#employment" onclick="tabGeneral(event, 'employment')" id="defaultOpen">Employment</a>
                     </li> 
                     <li class="nav-item">
                        <a class="nav-link tablinks" href="#emergency" onclick="tabGeneral(event, 'emergency')">Emergency Contact</a>
                     </li>
                  </ul>
                  <hr class="devider">
               </div>   
               <div class="tabcontent" id="info">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-3 fw-bold">
                           Personal data
                        </div>
                        <div class="col-md-6">
                           <table class="bio">
                              <tr>
                                 <td class="fw-bold">Full Name</td>
                                 <td>{{ $kary->nama_lengkap }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Mobile Phone</td>
                                 <td>{{ $kary->no_hp }}</td>
                              </tr>
                              <tr>
                              <tr>
                                 <td class="fw-bold">Email</td>
                                 <td>{{ $kary->email }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Phone</td>
                                 <td>{{ $kary->no_telp }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Place Of Birth</td>
                                 <td>{{ $kary->tempat_lahir }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Birth Date</td>
                                 <td>{{ $kary->tgl_lahir }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Gender</td>
                                 <td>{{ $kary->gender }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Martial Status</td>
                                 <td>{{ $kary->status_pernikahan }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Blood Type</td>
                                 <td>{{ $kary->golongan_darah }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Religion</td>
                                 <td>{{ $kary->agama }}</td>
                              </tr>
                           </table>
                        </div>

                        <div class="col-md-3 text-center">
                           <button class="btn btn-sm btn-primary">Edit</button>
                        </div>

                        <hr>

                        <div class="col-md-3 fw-bold">
                           Identity & Address
                        </div>
                        <div class="col-md-6">
                           <table class="address">
                              <tr>
                                 <td class="fw-bold">ID Type</td>
                                 <td>KTP</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">ID Number</td>
                                 <td>{{ $kary->no_identitas }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">ID Expiration Date</td>
                                 <td>Permanent</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Postal Code</td>
                                 <td>{{ $kary->kodepos }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Address</td>
                                 <td>{{ $kary->alamat }}</td>
                              </tr>
                           </table>
                        </div>
                        
                        <div class="col-md-3 text-center">
                           <button class="btn btn-sm btn-primary">Edit</button>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="tabcontent" id="emergency">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-3 fw-bold">
                           Personal data
                        </div>
                        <div class="col-md-6">
                           <table class="bio">
                              <tr>
                                 <td class="fw-bold">Name</td>
                                 <td>{{ $kary->nama_ibu_kandung }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Mobile Phone</td>
                                 @if($kary->kontak_darurat)
                                 <td>{{ $kary->kontak_darurat }}</td>
                                 @else
                                 <td>-</td>
                                 @endif 
                              </tr>
                           </table>
                        </div>

                        <div class="col-md-3 text-center">
                           <button class="btn btn-sm btn-primary">Edit</button>
                        </div>

                     </div>
                  </div>
               </div>

               <div class="tabcontent" id="employment">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-3 fw-bold">
                        Employment
                        </div>
                        <div class="col-md-6">
                           <table class="bio">
                              <tr>
                                 <td class="fw-bold">Branch</td>
                                 <td>{{ $kary->cabang->nama }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Employment ID</td>
                                 <td>{{ $kary->nomor_induk_karyawan }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Organization Name</td>
                                 <td>{{ $kary->bagian->nama }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Job Position</td>
                                 <td>{{ $kary->jabatan->nama }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Job level</td>
                                 <td>{{ $kary->bagian->nama }}</td>
                              </tr>
                              <tr>
                                 <td class="fw-bold">Employment status</td>
                                 <td>{{ $kary->status_karyawan }}</td>
                              </tr>

                           </table>
                        </div>

                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>

      
   </div>
  

</div> 

<script>

   document.getElementById("info").style.display="block"
   document.getElementById("defaultOpen").click(); 

   function tabGeneral(evt, tab) {
      var i, tabcontent, tablinks, hide_nav, nav_atas;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
         tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
         tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(tab).style.display = "block";
      evt.currentTarget.className += " active";

      hide_nav =  document.getElementsByClassName("hide_nav");
      nav_atas =  document.getElementsByClassName("nav_atas");

      
      

      if($(hide_nav).attr('id') === "") {
         nav_atas.style.display = "none"
      }else {
         nav_atas.style.display = "block"
         
      }
   }




</script>

<!-- ini buat according myinfo -->
<script>
  $(document).ready(function() {
  $('.accordion-header').click(function() {
    $(this).parent().toggleClass('active');
  });
});

</script>

<style>
   .accordion-header {
  cursor: pointer;
}

.accordion-content {
  display: none;
}

.accordion-item.active .accordion-content {
  display: block;
}

.accordion-item.border-0 {
   background-color: #f9f9f9;
}

.icon-kanan{
   float: right;
}

.accordion-content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out;
}

.accordion-item.active .accordion-content {
  max-height: 500px; /* Sesuaikan tinggi maksimal sesuai kebutuhan */
  transition: max-height 0.3s ease-in;
}


</style>

@endsection
