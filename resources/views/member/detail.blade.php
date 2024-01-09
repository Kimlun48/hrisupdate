@foreach ($mems as $lok)
    <div class="modal fade detail-pelamar" id="exampleModalCenter2{{$lok->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-pelamar" role="document">
          <div class="modal-content modal-content-pelamar">
            <div class="modal-body modal-body-pelamar">
                <h5 class="title-pelamar">Detail Member</h5>
           
                <div class="pelamar-content">
                    <div class="row justify-content-center row-pelamar">
                    </div>
                    <h5 class="nik-pelamar">idnum : {{ $lok->idnum}}</h5>
                </div>
                <hr class="garis-pelamar" />

                <div class="container container-list-pelamar">
                    <div class="row justify-content-center row-list-pelamar">
                        <div class="col-lg-6 col-list-pelamar-1">
                            <div class="card card-list-pelamar">
                                <div class="title-list-pelamar"><h5 class="gris">Data Member</h5></div>
                                <div class="container">

                                    <div class="mb-3 row row-body">
                                        <label class="col-lg-3 col-form-label">Name</label>
                                        <div class="col-lg-1">:</div>
                                            <div class="col-lg-8 col-content">
                                                <div class="text">{{ $lok->nama}}</div>
                                            </div>
                                    </div>

                                    <div class="mb-3 row row-body">
                                        <label class="col-lg-3 col-form-label">ID Type</label>
                                        <div class="col-lg-1">:</div>
                                            <div class="col-lg-8 col-content">
                                                <div class="text">{{ $lok->idtype}}</div>
                                            </div>
                                    </div>

				    <div class="mb-3 row row-body">
                                        <label class="col-lg-3 col-form-label">Phone</label>
                                        <div class="col-lg-1">:</div>
                                            <div class="col-lg-8 col-content">
                                                <div class="text">{{ $lok->notelp}}</div>
                                            </div>
                                    </div>


                                    <div class="mb-3 row row-body">
                                        <label class="col-lg-3 col-form-label">DOB</label>
                                        <div class="col-lg-1">:</div>
                                            <div class="col-lg-8 col-content">
                                                <div class="text">{{ $lok->tempatlahir}}, {{ date('d-m-Y', strtotime($lok->tgllahir)) }}</div>
                                            </div>
                                    </div>
                                    

                                <div class="mb-3 row row-body">
                                <label class="col-lg-3 col-form-label">Address</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-8 col-content">
                                    <div class="text">{{ $lok->alamat}}
                                                        Desa. {{ $lok->kelurahan}} 
                                                        Kecamatan. {{ $lok->kecamatan}} 
                                                        Kota/Kabupaten. {{ $lok->kota}} 
                                                        Provinsi. {{ $lok->provinsi}} 
                                                        Kodepos. {{ $lok->kodepos}}</div>
                                    </div>
                            </div>
    
                            <div class="mb-3 row row-body">
                                <label class="col-lg-3 col-form-label">Email</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-8 col-content">
                                        <div class="text">{{ $lok->email}}</div>
                                    </div>
                            </div>

                            <div class="mb-3 row row-body">
                                <label class="col-lg-3 col-form-label">Job</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-8 col-content">
                                        <div class="text">{{ $lok->job}}</div>
                                    </div>
                            </div>

                            </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-list-pelamar-2">
                        <div class="card card-list-pelamar">
                        <div class="title-list-pelamar"><h5>&nbsp;</h5></div>
                        <div class="container">
                            <div class="mb-3 row row-body">
                                <label class="col-lg-4 col-form-label">Last Education</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-7 col-content">
                                        <div class="text">{{ $lok->pendididkan}}</div>
                                    </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-lg-4 col-form-label">Gender</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-7 col-content">
                                        <div class="text">{{ $lok->gender}}</div>
                                    </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-lg-4 col-form-label">Religion</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-7 col-content">
                                        <div class="text">{{ $lok->agama}}</div>
                                    </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-lg-4 col-form-label">Status Member</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-7 col-content">
                                        <div class="text">@if($lok->statusaktif == 0) NONAKTIF @else AKTIF @endif</div>
                                    </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-lg-4 col-form-label">loyalty Code</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-7 col-content">
                                        <div class="text">{{ $lok->loyaltycode}}</div>
                                    </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-lg-4 col-form-label">Loyalty Categori</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-7 col-content">
                                        <div class="text">{{ $lok->loyaltykategori}}</div>
                                    </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-lg-4 col-form-label">Loyalty Potensi</label>
                                <div class="col-lg-1">:</div>
                                    <div class="col-lg-7 col-content">
                                        <div class="text">{{ $lok->loyaltypotensi}}</div>
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
      </div>

@endforeach









