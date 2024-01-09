@extends('layouts.app-master')


@section('content')
    <div class="dash">
        @auth
            <div class="content-dashboard">
                <div class="container"> 
                    <div class="row row-content-hallo">
                        <div class="col col-10 col-content-hallo">
                            <div class="card card-hallo">
                                
                                <div class="row justify-content-between row-hallo">
                                    <div class="col-hallo-1 col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="title-1"><span id="greetings"></span>, <span id="name"> {{ Auth::user()->name }}</span></h2>
                                        <h5 class="title-2 ">It's <span id="time"></span></h5>
                                    </div>
                                    <div class="col-hallo-2 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <img src="../assets/bootstrap/img/salam1.svg" alt="dashboard">
                                    </div>
                                </div>               
                                
                            </div>
                        </div>
                    </div>
                    <h5 class="title-static">Statistics</h5>
                    <div class="row justify-content-center row-content">

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-content">
                            <div class="card card-content">
                                <div class="title-head">
                                    <h5 class="text-title">Applicant</h5>
                                </div>
                                <div class="garis"></div>
                                <div class="scrol-applicant">
                                    @forelse ($list as $det)
                                        <div class="card card-content-applicant">
                                            <div class="container container-card-content-applicant">
                                                <a data-toggle="modal" onclick="showdetailaplicant({{$det->id}})"  data-id="{{$det->id}}" style="text-decoration: none; cursor: pointer;">
                                                    <div class="row row-app" >
                                                        <div class="col-xl-2 col-2 col-app">
                                                            <img src="{{ asset('storage/pelamar/' . $det->pelamar->photo) }}" class="img-app">
                                                        </div>
                                                        <div class="col-xl-6 col-6 col-app">
                                                            <div class="row row-app-1">
                                                                <div class="col-12 col-app-1">
                                                                    <h5 class="text-nama-lengkap text-truncate">{!! Str::limit($det->pelamar->nama_lengkap,15) !!}</h5>
                                                                </div>
                                                                <div class="col-12 col-app-1">
                                                                    <h6 class="text-posisi text-truncate">{{ Str::limit($det->loker->posisi->nama, 8)  }} - {{ $det->loker->cabang->nama}}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-4 col-app">
                                                            <h5 class="text-date">{{ date('d-m-Y', strtotime($det->tanggal)) }}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert alert-danger">Data belum Tersedia. </div>
                                    @endforelse
                                </div>                                                               
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-content">
                            <div class="card card-content">
                                <div class="title-head">
                                    <h5 class="text-title">Vacancies</h5>
                                </div>

                                <div class="garis"></div>

                                <div class="scrol-vacanci">
                                    @forelse ($loks as $lok)
                                        <div class="card card-content-vacanci">
                                            <div class="container container-card-content-vacanci">
                                                <div class="row row-vac">
                                                    <div class="col-xl-5 col-10 col-vac">
                                                        <h5 class="text-loker">{{ Str::limit($lok->lowongan_kerja,11) }}</h5>
                                                    </div>
                                                    <div class="col-xl-5 col-10 col-vac">
                                                        <h6 class="text-loker" >{{ Str::limit($lok->cabang->nama,10) }}</h6>
                                                    </div>
                                                    <div class="col-xl-2 col-2 col-vac">
                                                        <h5 class="text-jumlah"><a class="btn btn-sm btn-grey total-applicant" href="/loker/listapply/{{$lok->id}}">{{ $lok->apply->count('pivot.id') }}</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    <div class="alert alert-danger">Data belum Tersedia. </div>
                                    
                                    @endforelse
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-content">
                            <div class="card card-content">
                                <div class="title-head">
                                    <h5 class="text-title">Employees</h5>
                                </div>

                                <div class="garis"></div>
                                <div class="scrol-employ">
                                    @forelse ($employes as $employ)
                                        <div class="card card-content-employ">
                                            <div class="container container-card-content-employ">
                                                <a data-toggle="modal" onclick="showdetail({{$employ->id}})" data-id="{{$employ->id}}" style="text-decoration: none; cursor: pointer;">

                                                    <div class="row row-app">
                                                        <div class="col-xl-2 col-2 col-app">
                                                            @if($employ->gender == 'Laki-laki')
                                                                <img src="{{ url('assets/bootstrap/img/male-avatar.png')}}" alt="" class="img-app"/> 
                                                            @else
                                                                <img src="{{ url('assets/bootstrap/img/woman-avatar.png')}}" alt="" class="img-app"/> 
                                                            @endif
                                                        </div>
                                                        <div class="col-xl-6 col-6 col-app">
                                                            <div class="row row-app-1">
                                                                <div class="col-12 col-app-1">
                                                                    <h5 class="text-nama-lengkap text-truncate">{{ $employ->nama_lengkap }}</h5>
                                                                </div>
                                                                <div class="col-12 col-app-1">
                                                                    <h5 class="text-posisi text-truncate">{{ $employ->jabatan->nama}}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                    <div class="data-app-empty">
                                        <h5 class="text-empty">Data belum Tersedia</h5>
                                    </div>
                                    
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-content">
                            <div class="card card-content">
                                <div class="title-head">
                                    <h5 class="text-title">Static Vacancies</h5>
                                </div>
                                <div class="garis"></div>
                                    <canvas id="grafikpelamar" width="70" height="50" style="padding:0px 15px 0px 5px;"></canvas>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-content">
                                <div class="card card-content">
                                    <div class="title-head">
                                        <h5 class="text-title">Static Reference</h5>
                                    </div>
                                    <div class="garis"></div>
                                    <canvas id="chartline" width="60" height="50" style="padding:0px 15px 0px 15px;" ></canvas>
                                </div>
                            </div>                   
                        </div>
                    </div>
                </div>	
            </div>
            @include('home.partials.scripts')
            @include('employ.partials.script')	
        @endauth
    </div>
@endsection

        

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade detail-pelamar" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-pelamar" role="document">
        <div class="modal-content modal-content-pelamar">
            <div class="modal-header">
                <h5 class="modal-title" id="labeldetail"></h5>
                <button type="button" class="close" onClick="closeDetail()"  id="close-button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    <div class="modal-body modal-body-pelamar">
        <div id="detail" class="p-2"></div>
    </div>
</div>       

@guest
    @include('layouts.apps-master')
@endguest
