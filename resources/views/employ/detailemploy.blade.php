
            <h5 class="title-pelamar">Profile Employ</h5>
        
            <div class="pelamar-content">
                @if(empty($lm->photo))
                @if($kary->gender == 'Laki-laki')
                <div class="row justify-content-center row-pelamar">
                    <div class="col-lg-3 col-pelamar">
                    <div class="card card-pelamar" style="border:none;height:80%;">
                    
                    <img src="{{ url('assets/bootstrap/img/male-avatar.png')}}" alt="" class="img-pelamar"/> 
                        </div>
                    </div>
                </div>
                                    
                                    @else
                                    <div class="row justify-content-center row-pelamar">
                    <div class="col-lg-3 col-pelamar">
                    <div class="card card-pelamar" style="border:none; height:80%;">
                    
                    <img src="{{ url('assets/bootstrap/img/woman-avatar.png')}}" alt="" class="img-pelamar"/> 
                        </div>
                    </div>
                </div>
                                    
                                    @endif
                @else
                <div class="row justify-content-center row-pelamar">
                    <div class="col-lg-3 col-pelamar">
                    <div class="card card-pelamar" style="width:30px; height:20px;">
                    
                        <img src="{{ asset('storage/pelamar/' . $lm->photo) }}" class="img-pelamar" >
                        </div>
                    </div>
                </div>
                @endif
                <h5 class="nama-pelamar text-center">{{ $kary->nama_lengkap }}</h5>
                <h5 class="nik-pelamar text-center">No Identitas (KTP) : {{$kary->no_identitas}}</h5>
                <h5 class="nik-pelamar text-center">No Induk Karyawan : {{ $kary->nomor_induk_karyawan }}</h5>
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
                            <div class="text">{{ $kary->alamat}}
                                                Rt. {{ $kary->rt}} 
                                                Rw. {{ $kary->alamat}} 
                                                Desa. {{ $kary->desa}} 
                                                Kecamatan. {{ $kary->kecamatan}} 
                                                Kota/Kabupaten. {{ $kary->kota}} 
                                                Provinsi. {{ $kary->provinsi}} 
                                                Kode Pos. {{ $kary->kodepos}}</div>
                            </div>
                    </div>

                    <div class="mb-3 row row-body">
                        <label class="col-lg-3 col-form-label">Email</label>
                        <div class="col-lg-1">:</div>
                            <div class="col-lg-8 col-content">
                            <div class="text">{{ $kary->user->email}}</div>
                            </div>
                    </div>

                    <div class="mb-3 row row-body">
                        <label class="col-lg-3 col-form-label">Phone</label>
                        <div class="col-lg-1">:</div>
                            <div class="col-lg-8 col-content">
                            <div class="text">{{ $kary->no_hp}}</div>
                            </div>
                    </div>

                    <div class="mb-3 row row-body">
                        <label class="col-lg-3 col-form-label">DOB</label>
                        <div class="col-lg-1">:</div>
                            <div class="col-lg-8 col-content">
                                <div class="text">{{ $kary->tempat_lahir}}, {{ date('d-m-Y', strtotime($kary->tgl_lahir)) }}</div>
                            </div>
                    </div>

                    
                    </div>

                    </div>
                    
                    
                    
                    
                </div>
                
                <div class="col-lg-6 col-list-pelamar-2">
                <div class="card card-list-pelamar">
                <div class="title-list-pelamar" style="margin-top:30px;"></div>
                <div class="container">
                <div class="mb-3 row row-body">
                        <label class="col-lg-3 col-form-label">Status</label>
                        <div class="col-lg-1">:</div>
                            <div class="col-lg-8 col-content">
                            <div class="text">{{ $kary->status_karyawan}}</div>
                            </div>
                    </div>
                <div class="mb-3 row row-body">
                        <label class="col-lg-3 col-form-label">Branch</label>
                        <div class="col-lg-1">:</div>
                            <div class="col-lg-8 col-content">
                            <div class="text">{{ $kary->cabang->nama}}</div>
                            </div>
                    </div>
                    <div class="mb-3 row row-body">
                        <label class="col-lg-3 col-form-label">Position</label>
                        <div class="col-lg-1">:</div>
                            <div class="col-lg-8 col-content">
                            <div class="text">{{ $kary->jabatan->nama}}</div>
                            </div>
                    </div>
                    <div class="mb-3 row row-body">
                        <label class="col-lg-3 col-form-label">Star From</label>
                        <div class="col-lg-1">:</div>
                            <div class="col-lg-8 col-content">
                                <div class="text">{{ date('d-m-Y', strtotime($kary->tahun_gabung)) }}</div>
                            </div>
                    </div>
                    <div class="mb-3 row row-body">
                        <label class="col-lg-3 col-form-label">Until</label>
                        <div class="col-lg-1">:</div>
                            <div class="col-lg-8 col-content">
                                <div class="text">{{ date('d-m-Y H:i:s', strtotime($kary->tahun_keluar)) }}</div>
                            </div>
                    </div>
                    <div class="mb-3 row row-body">
                        <label class="col-lg-3 col-form-label">Salary</label>
                        <div class="col-lg-1">:</div>
                            <div class="col-lg-8 col-content">
                                <div class="text"> <div class="text">Rp.{{$english_format_number = number_format($kary->upah)}},00,-</div></div>
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
