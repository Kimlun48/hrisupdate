<h5 class="title-pelamar">Profile Applicant</h5>
        
                    <div class="pelamar-content">
                    <div class="row justify-content-center row-pelamar">
                        <div class="col-lg-3 col-pelamar">
                            <div class="card card-pelamar">
                                <img src="{{ asset('storage/pelamar/' . $det->pelamar->photo) }}" class="img-pelamar" >
                            </div>
                        </div>
                    </div>
            <h5 class="nama-pelamar text-center">{{ $det->pelamar->nama_lengkap }}</h5>
            <h5 class="nik-pelamar text-center">Job Applicant : {{ $det->loker->lowongan_kerja }} - {{ $det->loker->cabang->nama }}</h5>
            <h5 class="nik-pelamar text-center">No Induk Karyawan : {{ $det->pelamar->nik }}</h5>
        </div>
        <hr class="garis-pelamar" />

        <div class="container container-list-pelamar"></div>

        <div class="container container-list-pelamar">
        <div class="row justify-content-center row-list-pelamar">
            <div class="col-lg-6 col-list-pelamar-1">
                <div class="card card-list-pelamar">
                    <div class="title-list-pelamar"><h5 class="gris">Personal Data</h5></div>
                    <div class="container">
                    <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">Address</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                        <div class="text">{{ $det->pelamar->alamat}}
                                                        Rt. {{ $det->pelamar->rt}} 
                                                        Rw. {{ $det->pelamar->rw}} 
                                                        Desa. {{ $det->pelamar->desa}} 
                                                        Kecamatan. {{ $det->pelamar->kecamatan}} 
                                                        Kota/Kabupaten. {{ $det->pelamar->kota}} 
                                                        Provinsi. {{ $det->pelamar->provinsi}} 
                                                        Kodepos. {{ $det->pelamar->kodepos}}</div>
                        </div>
                </div>

                <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">Email</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                        <div class="text">{{ $det->pelamar->userlamar->email}}</div>
                        </div>
                </div>

                <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">Phone</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                        <div class="text">{{ $det->pelamar->no_hp}}</div>
                        </div>
                </div>

                <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">DOB</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                            <div class="text">{{ $det->pelamar->tempat_lahir}}, {{ date('d-m-Y', strtotime($det->pelamar->tgl_lahir)) }}</div>
                        </div>
                </div>
                
                <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">Family Relationship</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                            <div class="text">{{ $det->pelamar->hubungan_keluarga}}</div>
                        </div>
                </div>

                

                
                </div>

                </div>
                
                
                
                
            </div>
            
            <div class="col-lg-6 col-list-pelamar-2">
            <div class="card card-list-pelamar">
            <div class="title-list-pelamar" style="margin-top:30px;"><h5 class="gris">Education</h5></div>
            <div class="container">
            <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">Education</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                        <div class="text">{{ $det->pelamar->pendidikan_terakhir}}</div>
                        </div>
                </div>
            <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">School</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                        <div class="text">{{ $det->pelamar->nama_sekolah}}</div>
                        </div>
                </div>
                <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">Major</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                        <div class="text">{{ $det->pelamar->jurusan}}</div>
                        </div>
                </div>
                <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">Star From</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                            <div class="text">{{ date('d-m-Y', strtotime($det->pelamar->tahun_masuk)) }}</div>
                        </div>
                </div>
                <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">Until</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                            <div class="text">{{ date('d-m-Y', strtotime($det->pelamar->tahun_lulus)) }}</div>
                        </div>
                </div>
                <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">GPA</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                            <div class="text"> <div class="text">{{ $det->pelamar->ipk}}</div></div>
                        </div>
                </div>
                <div class="mb-3 row row-body">
                    <label class="col-lg-3 col-form-label">Tanggal Lamar</label>
                    <div class="col-lg-1">:</div>
                        <div class="col-lg-8 col-content">
                            <div class="text"> <div class="text">{{ $det->tanggal}}</div></div>
                        </div>
                </div>
            </div>
            </div>
            </div>
            </div>
            
        </div>


            </div>
    </div>
    </div>
    </div>

