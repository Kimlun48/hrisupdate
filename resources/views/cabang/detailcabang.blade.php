@extends('layouts.app-master')

@section('content-employ')
        @auth
        <div class="detail">
        <img src="{{ asset('storage/images/posts/' . $cab->dok_header) }}" class="rounded img-detail-1" >
        <div class="container container-detail">
        <div class="detail-content">
             <div class="row row-detail">
                <div class="col-lg-3 col-detail">
                    <div class="card card-detail">
                        <img src="{{ asset('storage/images/posts/' . $cab->dok_poster) }}" class="img-detail"></img>
                    </div>
                </div>
            </div> 

            <div class="row row-detail-title">
                <div class="col-lg-12 col-detail-title-1">
                   <h5 class="title-head">{{ $cab->parent->nama }} {{ $cab->nama }} </h5>
                </div>
                <div class="col-lg-12 col-detail-title-1">
                   <h5 class="title-text">Branch Code {{$cab->kode}}</h5>
                </div>
                <div class="col-lg-12 col-detail-title-2">
                   <h5 class="title-text-1"><i class="fas fa-map-marker-alt"></i>  {{ $cab->alamat }}, Indonesia</h5>
                </div>
                <div class="col-lg-12 col-detail-title-3">
                    <div class="row row-detail-title-3">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-title-text-1">     
                        <h5 class="title-text-1"><i class="fas fa-shopping-bag"></i> {{ $cab->no_telp }} / {{ $cab->no_hp }}</h5>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-12 col-title-text-2">
                        <h5 class="title-text-2"><i class="fas fa-calendar-alt"></i> {{ $cab->status }}</h5>
                        </div>
                    </div>
                  
                </div>
            </div>
            </div>
            </form>

        @endauth
@endsection
