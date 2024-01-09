@extends('layouts.app-master')

@section('content')
        @auth
        <div class="detail">
        <img src="{{ asset('storage/images/posts/'.$list->dok_header) }}" class="rounded img-detail-1" >
        <div class="container container-detail">
        <div class="detail-content">
            <div class="row row-detail">
                <div class="col-lg-3 col-detail">
                    <div class="card card-detail">
                        <img src="{{ asset('storage/images/posts/' . $list->dok_poster) }}" class="img-detail"></img>
                    </div>
                </div>
            </div>

            <div class="row row-detail-title">
                <div class="col-lg-12 col-detail-title-1">
                   <h5 class="title-head">{{ $list->level_job }} - {{ $list->lowongan_kerja }}</h5>
                </div>
                <div class="col-lg-12 col-detail-title-2">
                   <h5 class="title-text-1"><i class="fas fa-map-marker-alt"></i> {{ $list->cabang->nama }} - {{ $list->cabang->alamat }}, Indonesia</h5>
                </div>
                <div class="col-lg-12 col-detail-title-3">
                    <div class="row row-detail-title-3">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-title-text-1">     
                        <h5 class="title-text-1"><i class="fas fa-shopping-bag"></i> Full Time </h5>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-12 col-title-text-2">
                        <h5 class="title-text-2"><i class="fas fa-calendar-alt"></i> {{ date('d F Y', strtotime($list->tanggal))  }}</h5>
                        </div>
                    </div>
                  
                </div>
            </div>
           
            @csrf
            <!-- <div class="row justify-content-between row-button">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-button-1">
                       
                        <button type="submit" class="btn btn-aplly"><h5 class="text-aplly">Aplly</h5></button>
                </div>
            
            </div> -->
            </form>
            <hr></hr>

            <div class="row row-rekrut">
                <div class="col-lg-12 col-deskripsi">
                    <h5 class="title-deskripsi">Job Description</h5>
                    <div class="list-deskripsi">
                    {!! $list->deskripsi !!}
                    </div>
                </div>

                <div class="col-lg-12 col-requirement">
                    <h5 class="title-requirement">Requirement</h5>
                    <div class="list-requirement">
                    {!! $list->kualifikasi !!}
                    </div>
                </div>

                <div class="col-lg-12 col-summary">
                    <h5 class="title-summary">Jobs Summary</h5>
                    <div class="container container-summary">
                        <div class="row row-summary">
                        <div class="col-lg-4 col-summary">
                            <h5 class="title-summary">Job Level</h5>
                            <h5 class="text-summary">{{ $list->level_job }}</h5>
                        </div>
                        <div class="col-lg-8 col-summary">
                            <h5 class="title-summary">Education</h5>
                            <h5 class="text-summary">{{ $list->pendidikan }}</h5>
                        </div>
                        <div class="col-lg-4 col-summary">
                            <h5 class="title-summary">Experience</h5>
                            <h5 class="text-summary">{{ $list->pengalaman }} Tahun</h5>
                        </div>
                        <div class="col-lg-8 col-summary">
                            <h5 class="title-summary">Job Category</h5>
                            <h5 class="text-summary">{{ $list->kategory_job }}</h5>
                        </div>
                        </div>
                    </div>
                     
                </div>
                
            </div>
        </div>
        </div>
    </div>


    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>
        @endauth

				
 </tbody>
 </table>
 
 </div>
     
   
@endsection
