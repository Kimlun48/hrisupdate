@extends('layouts.app-master')

@section('content')

    <div class="create-employ" >
        <div id="loading-spinner" style="display: none;">Loading...</div>
        <div class="container" id="ploy" style="display: block;">
            <h5 class="title-create-employ">Add Employe External</h5>
            <hr class="border"></hr>
            <div class="table-body" >
                <h5 class="list-create-employ">Add new employe External and complite data you must add down bellow.</h5>
                <div class="content-employ">

                <div class="row row-employ">
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12 col-employ"> 
                    <div class="step">Personal Data</div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12 col-employ">
                    <div class="step">Address</div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12 col-employ">
                    <div class="step">Education</div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12 col-employ">
                    <div class="step">Data Employee</div>
                  </div>
                </div>

                <form action="{{ route('employ.simpanaa_external') }}" method="POST" enctype="multipart/form-data" id="createEmployExternal">
                @csrf

                  <!-- Personal data -->
                  <div class="tab">
                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">First Name <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="First name..." oninput="this.value = this.value.toUpperCase()"  name="nama_panggilan" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('nama_panggilan') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Full Name <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Full name..." oninput="this.value = this.value.toUpperCase()"  name="nama_lengkap" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('nama_lengkap') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Martial Status <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <select class="form-select"  name="status_pernikahan">
                            <option selected disabled>---Pilih---</option>
                            <option value="Belum menikah">Belum menikah</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Duda">Duda</option>
                            <option value="Janda">Janda</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Gender <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                            <select class="form-select"  name="gender">
                              <option selected disabled>---Pilih---</option>
                              <option value="laki-laki">Laki-Laki</option>
                              <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Email <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Email..." id="email" name="email" type="email"
                          value="{{ old('email') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Handphone Number</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Handphone number..."  name="no_hp" type="number" pattern="[^()/><\][\\\x22,;|]+" maxlength="15"
                          value="{{ old('no_hp') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Date Of Birth <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Date Of Birth..."  name="tgl_lahir" type="date" value="{{ old('tgl_lahir') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">City Of Birth <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="City of birth..." oninput="this.value = this.value.toUpperCase()"  name="tempat_lahir" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('tempat_lahir') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">No KTP <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="No KTP..."  name="no_identitas" id="no_identitas" type="text" maxlength="16" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('no_identitas') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Religion <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <select class="form-select"  name="agama">
                            <option selected disabled>---Pilih---</option>
                            <option value="Islam">Islam</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Katolik">katolik</option>
                            <option value="Budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Konghucu">Konghucu</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- address -->
                  <div class="tab">
                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Address<span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Address..." oninput="this.value = this.value.toUpperCase()"  name="alamat" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('alamat') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Residence address <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Residence address..." oninput="this.value = this.value.toUpperCase()"  name="alamat_domisili" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('alamat_domisili') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">City / county <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="City..." oninput="this.value = this.value.toUpperCase()"  name="kota" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('kota') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Postal Code <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Postal Code..." oninput="this.value = this.value.toUpperCase()"  name="kodepos" type="number" pattern="[^()/><\][\\\x22,;|]+" maxlength="5"
                          value="{{ old('kodepos') }}">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Education -->
                   <div class="tab">
                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Last Education</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <select class="form-select"  name="pendidikan_terakhir">
                            <option selected disabled>---Pilih---</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Institute Name</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Institute Name..." oninput="this.value = this.value.toUpperCase()"  name="nama_institusi" type="text"pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('nama_institusi') }}">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Data employee -->
                  <div class="tab">
                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Job Level</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <select class="form-select" name="fk_level_jabatan">
                            <option value="" selected disabled>---Pilih---</option>
                              @foreach($jabatan as $jbtn)
                                <option value="{{$jbtn->id}}">{{$jbtn->nama}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Branch</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                            <select class="form-select" name="fk_cabang">
                              <option value="" selected disabled>---Pilih---</option>
                              @foreach($cabs as $cabang)
                                <option value="{{$cabang->id}}">{{$cabang->nama}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Employment Status</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <select class="form-select" name="status_karyawan">
                              <option value="" selected disabled>---Pilih---</option>
                              <option value="AKTIF">AKTIF</option>
                              <option value="NONAKTIF">NONAKTIF</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Masa Kerja</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input oninput="this.value = this.value.toUpperCase()"  name="masa_kerja" type="date" value="{{ old('masa_kerja') }}">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Brand</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Brand..." name="brand" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Vendor</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Vendor..." name="vendor" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Join Date</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Join Date..." name="tahun_gabung" type="date" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('tahun_gabung') }}">
                        </div>
                      </div>


                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Expired Date</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Join Date..." name="tahun_keluar" type="date" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('tahun_keluar') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Employment Type</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <select class="form-select" name="jenis_karyawan">
                              @foreach($parjnkar as $jns)
                                <option value="{{$jns->id}}">{{$jns->nama}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                  </div>
                </div >
              

                  <div class="container">
                  <div class="row justify-content-between row-next">
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-xs-12 col-12 col-prev">
                      <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn-prev">Previous</button>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-2 col-sm-12 col-xs-12 col-12 col-next">
                      <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn-next submit">Next</button>
                    </div>
                  </div>
                  </div>

              </form>
                
                </div>
            

            </div>
        </div>

    </div>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("createEmployExternal").submit();
    document.getElementById('ploy').style.display = 'none';
    document.getElementById('loading-spinner').style.display = 'block';
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateEmail(email) {
  var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

function emailDuplicate(email) {
  $.ajax({
    type: "GET",
    url: "/employ/cek_email",
    data: { email: email },
    success: function(response) {
        if (response.status) {
          Swal.fire({
            title: 'Oops..',
            text: 'Email sudah dipakai',
            icon: 'warning',
            timer: 1500,
            timerProgressBar: true,
            showConfirmButton: false
          })
          document.getElementById('email').value = '';
          document.getElementById('email').focus();
          valid = false;
        }
    },
    error: function() {
    }
  });
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, i, z, o, nik, email,  valid = true;
  x = document.getElementsByClassName("tab");
  z = x[currentTab].getElementsByTagName("input");
  nik = document.getElementById("no_identitas").value;
  email = document.getElementById("email").value;

  for (i = 0; i < z.length; i++) {
    // If a field is empty...
    if (z[i].value == "") {
      // add an "invalid" class ti the field:
      z[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }

  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }else {
    if (nik.length < 16){
      Swal.fire("NIK kurang dan lengkapi data !")
    }
    if(!validateEmail(email)) {
      Swal.fire("Masukan email yang benar !")
    }
  }

  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

</script>

<script>
    $('#email').on('input', function() {
      emailDuplicate($(this).val());
    });
</script>


@endsection
