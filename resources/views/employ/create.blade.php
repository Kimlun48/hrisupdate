@extends('layouts.app-master')

@section('content')

    <div class="create-employ" >
        <div id="loading-spinner" style="display: none;">Loading...</div>
        <div class="container" id="ploy" style="display: block;">
            <h5 class="title-create-employ">Add Employe</h5>
            <hr class="border"></hr>
            <div class="table-body" >
                <h5 class="list-create-employ">Add new employe and complite data you must add down bellow.</h5>
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

                <form action="{{ route('employ.simpanaa') }}" method="POST" enctype="multipart/form-data" id="createEmploy">
                @csrf

                  <!-- Personal data -->
                  <div class="tab">
                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Full Name <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Full name..." oninput="this.value = this.value.toUpperCase()"  name="nama_lengkap" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('nama_lengkap') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Blood Type</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                            <select class="form-control"  name="golongan_darah">
                              <option selected disabled>---Pilih---</option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="AB">AB</option>
                              <option value="O">O</option>
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Nick Name <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Nick name..." oninput="this.value = this.value.toUpperCase()"  name="nama_panggilan" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('nama_panggilan') }}">
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
                          <input placeholder="Email..."  name="email" type="email"
                          value="{{ old('email') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Date Of Birth <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Date Of Birth..."  name="tgl_lahir" type="date" value="{{ old('tgl_lahir') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">No KTP <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="No KTP..."  name="no_identitas" type="text" maxlength="16" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('no_identitas') }}">
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

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Mother's Name <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Mother's name..." oninput="this.value = this.value.toUpperCase()"  name="nama_ibu_kandung" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('nama_ibu_kandung') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Sosial Media</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Sosial media..."  name="medsos" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('sosmed') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Photo</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input  name="photo" type="file" accept="image/*"
                          value="{{ old('photo') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Emergency Contact</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Emergency contact..."  name="kontak_darurat" type="number" pattern="[^()/><\][\\\x22,;|]+" maxlength="15"
                          value="{{ old('kontak_darurat') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Phone Number</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Phone number..."  name="no_telp" type="number" pattern="[^()/><\][\\\x22,;|]+" maxlength="15"
                          value="{{ old('no_telp') }}">
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
                  </div>

                  <!-- address -->
                  <div class="tab">
                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Address <span class="wajib">*</span></h5>
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
                          <h5 class="title-name">RT <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="RT..." oninput="this.value = this.value.toUpperCase()"  name="rt" type="text" pattern="[^()/><\][\\\x22,;|]+" maxlength="2"
                          value="{{ old('rt') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">RW <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="RW..." oninput="this.value = this.value.toUpperCase()"  name="rw" type="text" pattern="[^()/><\][\\\x22,;|]+" maxlength="2"
                          value="{{ old('rw') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Village <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Village..." oninput="this.value = this.value.toUpperCase()"  name="desa" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('desa') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">District <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="District..." oninput="this.value = this.value.toUpperCase()"  name="kecamatan" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('kecamatan') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">City <span class="wajib">*</span></h5>
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

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Province <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Province..." oninput="this.value = this.value.toUpperCase()"  name="provinsi" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('provinsi') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Residential Status  <span class="wajib">*</span></h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Residential Status ..." oninput="this.value = this.value.toUpperCase()"  name="status_rumah" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('status_rumah') }}">
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
                          <h5 class="title-name">No. Ijasah</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="No Ijasah..." oninput="this.value = this.value.toUpperCase()"  name="no_ijazah" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('no_ijazah') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Institute Name</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Institute Name..." oninput="this.value = this.value.toUpperCase()"  name="nama_institusi" type="text"pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('nama_institusi') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">Instansi Ijasah</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Instansi Ijasah..." oninput="this.value = this.value.toUpperCase()"  name="instansi_ijazah" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('instansi_ijazah') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Major</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Major..." oninput="this.value = this.value.toUpperCase()"  name="jurusan" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('jurusan') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">GPA</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="GPA..." name="gpa" type="text" pattern="[^()/><\][\\\x22,;|]+" maxlength="4"
                          value="{{ old('gpa') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Start From</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Start From ..." name="tahun_masuk_pendidikan" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('tahun_masuk_pendidikan') }}">
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                      <div class="col-12 col-tab-name">
                          <h5 class="title-name">End From </h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="End From..." name="tahun_lulus" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('tahun_lulus') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Grade</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Grade..." name="grade" type="text" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('grade') }}">
                        </div>
                      </div>
                    </div>

                  </div>

                  <!-- Data employee -->
                  <div class="tab">
                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Company</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                            <select class="form-select" name="fk_nama_perusahaan">
                              <option value="" selected disabled>---Pilih---</option>
                              @foreach($pt as $perusahaan)
                               <option value="{{$perusahaan->id}}">{{$perusahaan->nama}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Join Date</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="Join Date..." name="tahun_gabung" type="date" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('tahun_gabung') }}">
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">End Date</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <input placeholder="End Date..." name="tahun_keluar" type="date" pattern="[^()/><\][\\\x22,;|]+"
                          value="{{ old('tahun_keluar') }}">
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
                          <h5 class="title-name">Bagian</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <select class="form-select" oninput="this.value = this.value.toUpperCase()"  name="fk_bagian">
                            <option value="" selected disabled>---Pilih---</option>
                              @foreach($bagian as $bgn)
                                <option value="{{$bgn->id}}">{{$bgn->nama}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Ptpk Status</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <select class="form-select" name="ptpk_status">
                            <option value="" selected disabled>---Pilih---</option>
                            <option value="K0">K0</option>
                            <option value="K1">K1</option>
                            <option value="K2">K2</option>
                            <option value="K3">K3</option>
                            <option value="TK0">TK0</option>
                            <option value="TK1">TK1</option>
                            <option value="TK2">TK2</option>
                            <option value="TK3">TK3</option>
                          </select>
                        </div>
                      </div>
                    </div>

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
                          <h5 class="title-name">Bank 1</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="Bank 1..." name="bank1" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('bank1') }}">
                          </div>
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
                            <option value="Probation">Probation</option>
                            <option value="PHL">PHL</option>
                            <option value="PKWT">PKWT</option>
                            <option value="PKWTT">PKWTT</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">No. Rekening 1</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="No. Rekening 1..." oninput="this.value = this.value.toUpperCase()"  name="no_rek1" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('no_rek1') }}">
                          </div>
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
                          <!-- <select class="form-select" name="jenis_karyawan">
                            <option value="" selected disabled>---Pilih---</option>
                            <option value="Internal">Internal</option>
                            <option value="Eksternal">Eksternal</option>
                          </select> -->
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Bank 2</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="Bank 2..." oninput="this.value = this.value.toUpperCase()"  name="bank2" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('bank2') }}">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">NPWP</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="NPWP..." oninput="this.value = this.value.toUpperCase()"  name="npwp" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('npwp') }}">
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">No. rekening 2</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="No. Rerkening 2..." oninput="this.value = this.value.toUpperCase()"  name="no_rek2" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('no_rek2') }}">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">BPJS Kesehatan</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <select class="form-select" name="bpjs_kesehatan">
                              <option value="" selected disabled>---Pilih---</option>
                              <option value="AKTIF">AKTIF</option>
                              <option value="BELUM">BELUM</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Pay</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="Pay..." oninput="this.value = this.value.toUpperCase()"  id="upah" name="upah" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('upah') }}">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">No.BPJS Kesehatan</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="No.BPJS Kesehatan..." oninput="this.value = this.value.toUpperCase()"  name="no_bpjs_kesehatan" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('no_bpjs_kesehatan') }}">
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Another Jamkes</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="Another Jamkes..." oninput="this.value = this.value.toUpperCase()"  name="jamkes_lainnya" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('jamkes_lainnya') }}">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Keterangan BPJS Kesehatan</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="Keterangan BPJS Kesehatan..." oninput="this.value = this.value.toUpperCase()"  name="keterangan_bpjs" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('keterangan_bpjs') }}">
                          </div>
                        </div>
                      </div>
                      {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Expired Contract</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="Expired Contract..." oninput="this.value = this.value.toUpperCase()"  name="expired_kontrak" type="date" value="{{ old('expired_kontrak') }}">
                          </div>
                        </div>
                      </div> --}}
                    </div>

                    <div class="row row-tab">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">BPJS Tenaga Kerja</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <select class="form-select" name="bpjs_tenaga_kerja">
                              <option value="" selected disabled>---Pilih---</option>
                              <option value="AKTIF">AKTIF</option>
                              <option value="BELUM">BELUM</option>
                            </select>
                          </div>
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
                          <h5 class="title-name">No.BPJS Tenaga Kerja</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="No.BPJS Tenaga Kerja..." oninput="this.value = this.value.toUpperCase()"  name="no_bpjs_tenaga_kerja" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('no_bpjs_tenaga_kerja') }}">
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 col-tab">
                        <div class="col-12 col-tab-name">
                          <h5 class="title-name">Keterangan BPJS Tenaga Kerja</h5>
                        </div>
                        <div class="col-12 col-tab-input">
                          <div class="col-12 col-tab-input">
                            <input placeholder="No.BPJS Kesehatan..." oninput="this.value = this.value.toUpperCase()"  name="keterangan_bpjs_tenaga_kerja" type="text" pattern="[^()/><\][\\\x22,;|]+"
                            value="{{ old('keterangan_bpjs_tenaga_kerja') }}">
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
              

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
    document.getElementById("createEmploy").submit();
    document.getElementById('ploy').style.display = 'none';
    document.getElementById('loading-spinner').style.display = 'block';
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, z, o, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  z = x[currentTab].getElementsByTagName("option");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  for (i = 0; o < z.length; i++) {
    // If a field is empty...
    if (y[o].value == "") {
      // add an "invalid" class to the field:
      y[o].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }else {
    alert("Harap lengkapi data !")
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

<script type="text/javascript">
  /* Tanpa Rupiah */
  var tanpa_rupiah = document.getElementById('upah');
  tanpa_rupiah.addEventListener('input', function(e) {
    // Hapus semua tanda titik sebelum mengirimkan nilai
    var valueWithoutDot = this.value.replace(/\./g, '');
    this.value = formatRupiah(valueWithoutDot);
  });

  tanpa_rupiah.addEventListener('keydown', function(event) {
    limitCharacter(event);
  });

  /* Fungsi */
  function formatRupiah(bilangan, prefix) {
    var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }

  function limitCharacter(event) {
    key = event.which || event.keyCode;
    if ( key != 188 // Comma
      && key != 8 // Backspace
      && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
      && (key < 48 || key > 57) // Non digit
      // Dan masih banyak lagi seperti tombol del, panah kiri dan kanan, tombol tab, dll
    )
    {
      event.preventDefault();
      return false;
    }
  }
</script>

@endsection
