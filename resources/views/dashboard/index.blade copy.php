
@section('content')


<div class="dash-karyawan">
    @auth
    @extends('layouts.app-master')
      
    <div class="container container-karyawan">
		<div class="row row-content-hallo">
			<div class="col col-12 col-content-hallo">
				<div class="card card-hallo">           
                    <div class="row justify-content-between row-hallo">
                        <div class="col-hallo-1 col-xl-9 col-lg-4 col-12">
                            <h2 class="title-1"><span id="greetings"></span>, <span id="name">{{ Auth::user()->name }}</span></h2>
                            <h5 class="title-2 ">It's <span id="time"></span></h5>
                            <div class="row row-button">
                                <div class="col-btn col-xl-3 col-lg-3 col-md-12 col-sm-12 col-6">
                                   <a href="/reqattendkar" class="menu">
                                        <div class="btn btn-sm btn-menu">Requst Attendance</div>
                                    </a>
                                </div>
                                <div class="col-btn col-xl-3 col-lg-3 col-md-12 col-sm-12 col-6">
				                    <a href="/timeoff/reqtimeoff/{{ auth()->user()->getkaryawan->id }}" class="menu">
                                        <div class="btn btn-sm btn-menu">Time Off</div>
                                    </a>
				                </div>
				                <div class="col-btn col-xl-3 col-lg-3 col-md-12 col-sm-12 col-6">
                                    <a href="/shift/shiftkar" class="menu">
                                        <div class="btn btn-sm btn-menu">Shift</div>
                                    </a>
				                </div>
				                <div class="col-btn col-xl-3 col-lg-3 col-md-12 col-sm-12 col-6">
                                    <a href="" class="menu">
                                        <div class="btn btn-sm btn-menu">watcher</div>
                                    </a>
				                </div>
				                <div class="col-btn col-xl-3 col-lg-3 col-md-12 col-sm-12 col-6">
                                    <a href="/reqattend/showbreaktime" class="menu">
                                    	<div class="btn btn-sm btn-menu">Break Time </div>
                                    </a>
                            	</div>
                                <div class="col-btn col-xl-3 col-lg-3 col-md-12 col-sm-12 col-6 mt-2">
                                    <a href="{{ url('/ovtime/ovtimekar')}}" class="menu">
                                        <div class="btn btn-sm btn-menu">Over Time</div>
                                    </a>
                                </div>
				                @if ($kary->jabatan->kode == "1" or $pics >= 0 )
                                    <div class="col-btn col-xl-3 col-lg-3 col-md-12 col-sm-12 col-6 mt-2">
                                        <a href="/reqattendance" class="menu">
                                            <div class="btn btn-sm btn-menu">Approvals</div>
                                        </a>
                                    </div>
				                @endif
                
                            </div>  
                        </div>
                       <div class="col-hallo-2 col-xl-3 col-lg-4 col-12">
                        @if($kary->gender == 'Laki-laki')
                        <img src="../assets/bootstrap/img/karyawan1.svg" alt="dashboard">
                        @else
                        <img src="../assets/bootstrap/img/karyawan2.svg" alt="dashboard">
                        @endif
                        </div> 
                        {{-- <h5 class="title-2 "> <span id="word"></span></h5> --}}
                    </div>			
		</div>
	    </div> 
            <div class="col col-12 col-content-karyawan">
                <div class="row row-content-karyawan">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-cont">
                        <div class="col col-card-access">
                            <div class="card card-access">
                                <p class="title-head">Quick Access</p>
				<a href="/myinfo" class="title-link"><h5 class="title-text"><i class="fas fa-user"></i> My Info</h5></a>
				<a href="https://karir.anyargroup.co.id/presensi" class="title-link"><h5 class="title-text"><i class="fas fa-solid fa-id-badge"></i> Presensi</h5></a>
                                <a href="{{ url('/logpresensi', auth()->user()->getkaryawan->id) }}" class="title-link"><h5 class="title-text"><i class="fas fa-clock"></i> My Attendance logs</h5></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-cont">
                        <div class="col col-title-announ">
                            <div class="card card-title-announ">
                                <h5 class="title-head">Announcement</h5>
                            </div>
                        </div>
                        <div class="col col-card-announ">
                            <div class="card card-announ">
                              <div class="cards-announ">
                                @forelse($anns as $ann)
                                    <div class="row row-head">
                                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col-head-announ">
                                            <img src="../assets/bootstrap/img/person.png" alt="dashboard" class="img-announ">
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-3 col-sm-12 col-head-announ">
                                            <div class="row row-title-announ">
                                                <div class="col-xl-12 col-lg-12 col-12 col-title-announ">
                                                    <h5 class="title-head-announ">{{ $ann->getuser->name }}</h5>
                                                </div>
						<div class="col-xl-12 col-lg-12 col-12 col-title-announ">
						    @if(empty($ann->getuser->getkaryawan->jabatan))
                                                    <h5 class="title-head-position">&nbsp;</h5>
                                                    @else
						    <h5 class="title-head-position">{{ $ann->getuser->getkaryawan->jabatan->nama }}</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-head-announ">
                                            <h5 class="title-tanggal">{{ $ann->tanggal }}</h5>
                                        </div>
                                    </div>
                                    <div class="judul">
                                        <h5 class="title-judul">{{ $ann->judul }}</h5>
                                    </div>
                                    <div class="isi-text">
                                        {!! $ann->isi !!}
                                    </div>
                                    <div class="download">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-file"></i></span>
                                            <div class="text-download">
                                                <h5 class="title-download">{{ $ann->dokumen }}</h5>
                                            </div>
                                            <span class="input-group-text icon-download" id="addon-wrapping">
                                                <a href="/storage/announcement/{{$ann->dokumen}}" class="download-icon">
                                                    <i class="fas fa-download down"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                    @empty
                                @endforelse
                                </div>
                                 
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-cont">
                        <div class="col col-card-dayoff">
                            <div class="card card-dayoff">
                                <p class="title-head">Sakit Dengan Surat Dokter</p>
                                <h5 class="jumlah-hari">1 Day</h5>
                                <a href="#" class="title-link"><h5 class="title-text">Request sakit dengan surat dokter  <i class="fas fa-arrow-right"></i></h5></a><br>
                                <p class="title-head">Sisa Cuti Tahunan Tersisa</p>
                                @if($sisacuti)
                                <h5 class="jumlah-hari">{{$sisacuti->sisa_cuti}}</h5>
                                @else
                                <h5 class="jumlah-hari">0</h5>
                                @endif
                                <a href="#" class="title-link"><h5 class="title-text">Request cuti tahunan</h5></a>
                            </div>
                        </div>

                        <div class="col col-card-whosoff">
                            <div class="card card-whosoff">
                                <p class="title-head">Who’s Off</p>
                                <div class="card card-tanggal"><span id="tanggal" class="tanggal"></span></div>

                                <div class="container container-people">
                                    <!-- <div class="row row-people">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-img">
                                        <img src="../assets/bootstrap/img/person.png" alt="dashboard" class="img-people">
                                        </div> 
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-title">
                                            <div class="col-12 col-name">
                                                <h5 class="title-name">Skylar Siphron</h5>
                                            </div>
                                            <div class="col-12 col-keterangan">
                                                <h5 class="title-keterangan">Cuti Tahunan</h5>
                                            </div>
                                        </div> 
                                    </div> -->
                                    @forelse($tmfs as $tmf)
                                    <div class="row row-people">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-img">
                                        <img src="../assets/bootstrap/img/person.png" alt="dashboard" class="img-people">
                                        </div> 
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-title">
                                            <div class="col-12 col-name">
                                                <h5 class="title-name">{{$tmf->statusoff}}</h5>
                                            </div>
                                            <div class="col-12 col-keterangan">
                                                <h5 class="title-keterangan">{{$tmf->karyawan->nama_lengkap}}</h5>
                                            </div>
                                        </div> 
                                    </div>
                                    @empty
                                    <p>Nobody Was Absent</p>
                                    @endforelse
                                    <!-- <div class="row row-people">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-img">
                                        <img src="../assets/bootstrap/img/person.png" alt="dashboard" class="img-people">
                                        </div> 
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-title">
                                            <div class="col-12 col-name">
                                                <h5 class="title-name">Skylar Siphron</h5>
                                            </div>
                                            <div class="col-12 col-keterangan">
                                                <h5 class="title-keterangan">Cuti Tahunan</h5>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row row-people">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-img">
                                        <img src="../assets/bootstrap/img/person.png" alt="dashboard" class="img-people">
                                        </div> 
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-title">
                                            <div class="col-12 col-name">
                                                <h5 class="title-name">Skylar Siphron</h5>
                                            </div>
                                            <div class="col-12 col-keterangan">
                                                <h5 class="title-keterangan">Cuti Tahunan</h5>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row row-people">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-img">
                                        <img src="../assets/bootstrap/img/person.png" alt="dashboard" class="img-people">
                                        </div> 
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-title">
                                            <div class="col-12 col-name">
                                                <h5 class="title-name">Skylar Siphron</h5>
                                            </div>
                                            <div class="col-12 col-keterangan">
                                                <h5 class="title-keterangan">Cuti Tahunan</h5>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row row-people">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-img">
                                        <img src="../assets/bootstrap/img/person.png" alt="dashboard" class="img-people">
                                        </div> 
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-title">
                                            <div class="col-12 col-name">
                                                <h5 class="title-name">Skylar Siphron</h5>
                                            </div>
                                            <div class="col-12 col-keterangan">
                                                <h5 class="title-keterangan">Cuti Tahunan</h5>
                                            </div>
                                        </div> 
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
  	
    @include('home.partials.scripts')
    @endauth

  
    </div>

@endsection

