@extends('layouts.app-master')

@section('content-employ')


    <div class="dash-karyawan">
        @auth
        
            <div class="container container-karyawan">
                <div class="row row-content-hallo">
                    {{-- Dasbord Hallo --}}
                    <div class="col col-9 col-content-hallo">
                        <div class="card card-hallo">           
                            <div class="row justify-content-between row-hallo">
                                <div class="col-hallo-1 col-xl-9 col-lg-4 col-12">
                                    <h2 class="title-1"><span id="greetings"></span>, <span id="name">{{ Auth::user()->name }}</span></h2>
                                    <h5 class="title-2 ">It's <span id="time"></span></h5>
                                    <div class="row row-button">
                                        <h5 class="title-3">Shortcut Request <i class="fas fa-external-link-alt"></i></h5>
                                        <br>
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
                                            <a href="/reqattend/showbreaktime" class="menu">
                                                <div class="btn btn-sm btn-menu">Break Time </div>
                                            </a>
                                        </div>
                                        <div class="col-btn col-xl-3 col-lg-3 col-md-12 col-sm-12 col-6">
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
                                <div class="col-hallo-2 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <img src="../assets/bootstrap/img/halodas.svg" alt="dashboard">
                                </div>
                            </div>			
                        </div>
                    </div> 

                    {{-- calender --}}
                    <div class="col col-3 col-content-calender">
                        <div class="card card-access">
                            <div class="calendar">
                                <div class="header">
                                    <button id="prevMonth">&lt;</button>
                                    <h5 id="monthAndYear"></h2>
                                    <button id="nextMonth">&gt;</button>
                                </div>
                                <div class="days">
                                    <div>S</div>
                                    <div>M</div>
                                    <div>T</div>
                                    <div>W</div>
                                    <div>T</div>
                                    <div>F</div>
                                    <div>S</div>
                                </div>
                                <div class="dates" id="dates"></div>
                                <a class="text-view" href="{{ route('calender.index') }}">Go to the calendar</a>
                            </div>
                            

                            <div class="card card-access-whooff">
                                <p class="title-head">Who’s Off</p>
                                <p class="title-date">{{ $currentDate }}</p>
                                <div class="scrol-applicant">
                                    @forelse ($off as $who)
                                        <div class="card card-content-applicant">
                                            <div class=" container-card-content-applicant">
                                                    <div class="row row-app" >
                                                        <div class="col-xl-2 col-2 col-app">
                                                            <img src="{{ $who->preskaryawan->photo }}" class="img-app">
                                                        </div>
                                                        <div class="col-xl-6 col-6 col-app">
                                                            <div class="row row-app-1">
                                                                <div class="col-12 col-app-1">
                                                                    <span class="text-nama-lengkap text-truncate">{!! Str::limit($who->preskaryawan->nama_lengkap,15) !!}</span>
                                                                </div>
                                                                <div class="col-12 col-app-1">
                                                                    <p class="text-posisi text-truncate">{{ $who->presensi_status }} </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-4 col-app">
                                                            <h5 class="text-date">{{ date('d M', strtotime($who->tanggal)) }}</h5>
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

                            <div class="card card-access-whooff">
                                <p class="title-head">
                                    Birthdays
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M13.5891 7.98639L13.5553 7.86826L13.4991 7.80076L13.4316 7.72201C13.3843 7.67267 13.3275 7.6334 13.2647 7.60657C13.2019 7.57975 13.1343 7.56592 13.0659 7.56592C12.9976 7.56592 12.93 7.57975 12.8672 7.60657C12.8043 7.6334 12.7476 7.67267 12.7003 7.72201L12.6328 7.80076L12.5878 7.89076C12.5854 7.92447 12.5854 7.95831 12.5878 7.99201C12.5827 8.02557 12.5827 8.05971 12.5878 8.09326C12.586 8.16047 12.5975 8.22737 12.6216 8.29014C12.6478 8.35312 12.686 8.41043 12.7341 8.45889C12.7811 8.50859 12.8388 8.54704 12.9028 8.57139C12.9673 8.59689 13.036 8.61024 13.1053 8.61076H13.2066L13.3078 8.57701L13.3978 8.53201C13.4184 8.50102 13.4336 8.4668 13.4428 8.43076C13.4925 8.38368 13.531 8.326 13.5553 8.26201C13.5813 8.19963 13.5947 8.13272 13.5947 8.06514C13.5943 8.0388 13.5924 8.01251 13.5891 7.98639Z" fill="url(#paint0_linear_1339_73439)"/>
                                        <path d="M14.6247 5.911L14.5909 5.80975L14.5459 5.71975L14.4784 5.6185C14.4312 5.56915 14.3744 5.52989 14.3116 5.50306C14.2487 5.47623 14.1811 5.4624 14.1128 5.4624C14.0445 5.4624 13.9769 5.47623 13.914 5.50306C13.8512 5.52989 13.7944 5.56915 13.7472 5.6185L13.6797 5.69725L13.6347 5.78725C13.6323 5.82096 13.6323 5.85479 13.6347 5.8885C13.6296 5.92206 13.6296 5.95619 13.6347 5.98975C13.6329 6.05695 13.6444 6.12385 13.6684 6.18662C13.6947 6.24961 13.7329 6.30691 13.7809 6.35537C13.828 6.40508 13.8857 6.44353 13.9497 6.46787C14.0142 6.49337 14.0828 6.50672 14.1522 6.50725H14.2534L14.3547 6.4735L14.4447 6.4285C14.4743 6.41027 14.5009 6.38749 14.5234 6.361C14.5731 6.31392 14.6116 6.25624 14.6359 6.19225C14.6429 6.13206 14.6391 6.07111 14.6247 6.01225C14.6272 5.97854 14.6272 5.9447 14.6247 5.911Z" fill="url(#paint1_linear_1339_73439)"/>
                                        <path d="M12.0309 3.31233L11.9972 3.21108L11.9522 3.12108L11.8847 3.04233C11.8374 2.99298 11.7807 2.95371 11.7178 2.92689C11.655 2.90006 11.5874 2.88623 11.5191 2.88623C11.4507 2.88623 11.3831 2.90006 11.3203 2.92689C11.2574 2.95371 11.2007 2.99298 11.1534 3.04233L11.0859 3.12108L11.0409 3.21108C11.0385 3.24478 11.0385 3.27862 11.0409 3.31233C11.0358 3.34589 11.0358 3.38002 11.0409 3.41358C11.0391 3.48078 11.0506 3.54768 11.0747 3.61045C11.1009 3.67343 11.1391 3.73074 11.1872 3.7792C11.2343 3.8289 11.2919 3.86736 11.3559 3.8917C11.4204 3.9172 11.4891 3.93055 11.5584 3.93108H11.6597L11.7609 3.89733L11.8116 3.8467C11.8412 3.82847 11.8678 3.80569 11.8903 3.7792C11.94 3.73212 11.9785 3.67444 12.0028 3.61045C12.0288 3.54807 12.0422 3.48116 12.0422 3.41358C12.0409 3.37959 12.0372 3.34575 12.0309 3.31233Z" fill="url(#paint2_linear_1339_73439)"/>
                                        <path d="M9.95062 5.3885L9.91686 5.28725L9.87186 5.19725L9.80437 5.1185C9.75711 5.06915 9.70035 5.02989 9.63752 5.00306C9.57468 4.97623 9.50706 4.9624 9.43874 4.9624C9.37042 4.9624 9.3028 4.97623 9.23996 5.00306C9.17713 5.02989 9.12037 5.06915 9.07311 5.1185L8.99999 5.20287L8.95499 5.29287C8.95258 5.32658 8.95258 5.36042 8.95499 5.39412C8.9499 5.42768 8.9499 5.46182 8.95499 5.49537C8.9532 5.56258 8.96467 5.62948 8.98874 5.69225C9.015 5.75523 9.0532 5.81254 9.10124 5.861C9.14832 5.9107 9.206 5.94915 9.26999 5.9735C9.33449 5.999 9.40314 6.01234 9.47249 6.01287H9.57374L9.67499 5.97912L9.76499 5.93412C9.79462 5.91589 9.82119 5.89311 9.84374 5.86662C9.89344 5.81954 9.9319 5.76186 9.95624 5.69787C9.98223 5.63549 9.99562 5.56858 9.99562 5.501C9.98396 5.46225 9.9689 5.4246 9.95062 5.3885Z" fill="url(#paint3_linear_1339_73439)"/>
                                        <path d="M6.83343 3.31256L6.79968 3.21131L6.74905 3.12694L6.68155 3.04819C6.6343 2.99884 6.57754 2.95957 6.5147 2.93275C6.45187 2.90592 6.38425 2.89209 6.31593 2.89209C6.2476 2.89209 6.17999 2.90592 6.11715 2.93275C6.05432 2.95957 5.99756 2.99884 5.9503 3.04819L5.8828 3.12694L5.8378 3.21694C5.83539 3.25064 5.83539 3.28448 5.8378 3.31819C5.83271 3.35174 5.83271 3.38588 5.8378 3.41944C5.83602 3.48664 5.84748 3.55354 5.87155 3.61631C5.89781 3.67929 5.93602 3.7366 5.98405 3.78506C6.03114 3.83476 6.08881 3.87322 6.1528 3.89756C6.2173 3.92306 6.28595 3.93641 6.3553 3.93694H6.45655L6.5578 3.90319L6.6478 3.85819C6.67743 3.83995 6.704 3.81717 6.72655 3.79069C6.77625 3.7436 6.81471 3.68592 6.83905 3.62194C6.86505 3.55955 6.87843 3.49264 6.87843 3.42506C6.86677 3.38631 6.85172 3.34866 6.83343 3.31256Z" fill="url(#paint4_linear_1339_73439)"/>
                                        <path d="M9.85408 13.73C9.87379 13.6441 9.87121 13.5546 9.8466 13.4699C9.82199 13.3852 9.77616 13.3083 9.71345 13.2463L4.57783 8.10504C4.5155 8.04177 4.43795 7.9956 4.35262 7.97097C4.26729 7.94635 4.17706 7.9441 4.09061 7.96444C4.00416 7.98478 3.9244 8.02703 3.859 8.08712C3.7936 8.14721 3.74477 8.22312 3.7172 8.30754L1.12408 16.0194C1.09238 16.1112 1.08712 16.21 1.10891 16.3046C1.13069 16.3991 1.17864 16.4857 1.24728 16.5543C1.31591 16.623 1.40247 16.6709 1.49706 16.6927C1.59165 16.7145 1.69046 16.7092 1.7822 16.6775L9.48845 14.1069C9.57747 14.0824 9.65832 14.0346 9.72261 13.9683C9.7869 13.902 9.83229 13.8198 9.85408 13.73ZM5.6747 14.2925L3.5372 12.1494L3.81845 11.3057L6.52408 14.0113L5.6747 14.2925ZM3.16595 13.2519L4.5722 14.6582L2.46283 15.3613L3.16595 13.2519ZM7.62095 13.6457L4.18408 10.2032L4.4372 9.43816L8.3747 13.3757L7.62095 13.6457Z" fill="url(#paint5_linear_1339_73439)"/>
                                        <path d="M10.8297 8.32983L11.0716 6.91796L12.4835 6.67608C12.5887 6.6579 12.6858 6.60759 12.7613 6.53206C12.8368 6.45653 12.8871 6.35947 12.9053 6.25421L13.1472 4.84233L14.5591 4.60046C14.6263 4.58901 14.6906 4.56443 14.7483 4.52813C14.806 4.49183 14.8561 4.44451 14.8955 4.38888C14.9349 4.33325 14.963 4.2704 14.9782 4.20392C14.9933 4.13743 14.9952 4.06862 14.9838 4.0014C14.9723 3.93418 14.9477 3.86987 14.9114 3.81215C14.8751 3.75442 14.8278 3.70442 14.7722 3.66498C14.7166 3.62555 14.6537 3.59745 14.5872 3.58231C14.5207 3.56716 14.4519 3.56526 14.3847 3.57671L12.6128 3.88046C12.5076 3.89864 12.4105 3.94895 12.335 4.02448C12.2594 4.10001 12.2091 4.19707 12.191 4.30233L11.9491 5.71421L10.5372 5.95608C10.4319 5.97426 10.3349 6.02457 10.2593 6.10011C10.1838 6.17564 10.1335 6.2727 10.1153 6.37796L9.87345 7.78983L8.43908 8.03733C8.30833 8.05636 8.18982 8.12467 8.10782 8.22826C8.02582 8.33186 7.98655 8.4629 7.99806 8.59451C8.00957 8.72613 8.07098 8.84836 8.16971 8.93616C8.26844 9.02395 8.39701 9.07066 8.52908 9.06671H8.61908L10.391 8.76296C10.5009 8.74737 10.6029 8.69686 10.6819 8.61886C10.7609 8.54087 10.8127 8.43954 10.8297 8.32983Z" fill="url(#paint6_linear_1339_73439)"/>
                                        <path d="M16.5384 8.9206L15.0421 8.3581C14.9262 8.31393 14.7981 8.31291 14.6815 8.35525C14.5648 8.39759 14.4672 8.48045 14.4065 8.58873L13.844 9.5956L12.764 9.1906C12.648 9.14643 12.52 9.14541 12.4033 9.18775C12.2867 9.23009 12.1891 9.31295 12.1284 9.42123L11.5659 10.4225L10.4859 10.0175C10.422 9.99384 10.3541 9.98302 10.286 9.98563C10.2179 9.98825 10.151 10.0042 10.0891 10.0327C10.0272 10.0612 9.97155 10.1016 9.92526 10.1515C9.87897 10.2015 9.84297 10.2601 9.81934 10.324C9.7957 10.3879 9.78488 10.4559 9.78749 10.5239C9.7901 10.592 9.8061 10.6589 9.83457 10.7208C9.86304 10.7827 9.90341 10.8384 9.9534 10.8847C10.0034 10.931 10.062 10.967 10.1259 10.9906L11.6221 11.5531C11.7381 11.5973 11.8662 11.5983 11.9828 11.556C12.0995 11.5136 12.1971 11.4308 12.2578 11.3225L12.8203 10.3156L13.9003 10.7206C14.0163 10.7648 14.1443 10.7658 14.261 10.7235C14.3776 10.6811 14.4752 10.5983 14.5359 10.49L15.0984 9.4831L16.1784 9.8881C16.2423 9.91211 16.3103 9.9233 16.3785 9.92102C16.4467 9.91875 16.5138 9.90307 16.576 9.87486C16.6382 9.84666 16.6941 9.80648 16.7408 9.75664C16.7874 9.70679 16.8238 9.64825 16.8478 9.58435C16.8718 9.52046 16.883 9.45246 16.8807 9.38424C16.8784 9.31602 16.8627 9.24891 16.8345 9.18676C16.8063 9.1246 16.7662 9.06861 16.7163 9.02198C16.6665 8.97534 16.6079 8.93899 16.544 8.91498L16.5384 8.9206Z" fill="url(#paint7_linear_1339_73439)"/>
                                        <path d="M8.17876 6.18105L7.78501 5.09542L8.79189 4.53292C8.8999 4.47331 8.98306 4.37707 9.02637 4.26156C9.06969 4.14605 9.07032 4.01886 9.02814 3.90292L8.64001 2.80605L9.64689 2.24355C9.76773 2.17716 9.85725 2.06549 9.89575 1.9331C9.93425 1.80071 9.91859 1.65845 9.8522 1.53761C9.78581 1.41677 9.67414 1.32725 9.54175 1.28875C9.40937 1.25025 9.2671 1.26591 9.14626 1.3323L7.75126 2.1198C7.64325 2.17941 7.5601 2.27565 7.51678 2.39116C7.47346 2.50668 7.47283 2.63386 7.51501 2.7498L7.90876 3.8298L6.90189 4.3923C6.79388 4.45191 6.71072 4.54815 6.6674 4.66366C6.62409 4.77918 6.62346 4.90636 6.66564 5.0223L7.05939 6.10792L6.04689 6.67042C5.98705 6.7033 5.93428 6.74763 5.89158 6.8009C5.84888 6.85416 5.81709 6.91532 5.79803 6.98087C5.75952 7.11326 5.77519 7.25552 5.84158 7.37636C5.90796 7.4972 6.01963 7.58672 6.15202 7.62522C6.28441 7.66373 6.42667 7.64806 6.54751 7.58167L7.94814 6.81105C8.05514 6.75054 8.13711 6.65392 8.17937 6.53848C8.22162 6.42305 8.22141 6.29634 8.17876 6.18105Z" fill="url(#paint8_linear_1339_73439)"/>
                                        <path d="M4.24781 5.43276C4.1824 5.45153 4.12133 5.48302 4.0681 5.52542C4.01487 5.56783 3.97053 5.62031 3.93761 5.67987C3.90469 5.73944 3.88385 5.80491 3.87627 5.87254C3.86869 5.94017 3.87452 6.00863 3.89343 6.07401L4.10718 6.81088C4.13869 6.91783 4.2039 7.01174 4.29309 7.07863C4.38228 7.14553 4.49069 7.18183 4.60218 7.18213C4.65068 7.18913 4.69994 7.18913 4.74843 7.18213C4.81385 7.16336 4.87492 7.13187 4.92815 7.08947C4.98138 7.04706 5.02572 6.99458 5.05863 6.93501C5.09155 6.87545 5.1124 6.80998 5.11998 6.74235C5.12756 6.67472 5.12172 6.60626 5.10281 6.54088L4.88906 5.80401C4.8721 5.73707 4.84193 5.6742 4.8003 5.61911C4.75868 5.56402 4.70645 5.51781 4.64669 5.48322C4.58693 5.44862 4.52085 5.42633 4.45235 5.41767C4.38385 5.409 4.3143 5.41413 4.24781 5.43276Z" fill="url(#paint9_linear_1339_73439)"/>
                                        <path d="M8.24647 10.8219C8.35334 10.8216 8.45748 10.7882 8.5446 10.7263L8.84835 10.5126C8.90412 10.4731 8.95156 10.4229 8.98796 10.3651C9.02436 10.3072 9.04902 10.2428 9.06051 10.1754C9.072 10.108 9.0701 10.039 9.05494 9.97238C9.03977 9.90573 9.01162 9.84272 8.9721 9.78695C8.93258 9.73118 8.88246 9.68374 8.82461 9.64733C8.76675 9.61093 8.7023 9.58628 8.63492 9.57479C8.56754 9.5633 8.49855 9.56519 8.4319 9.58036C8.36525 9.59553 8.30225 9.62368 8.24647 9.6632L7.94272 9.87695C7.85089 9.93958 7.78166 10.0301 7.74528 10.1352C7.70891 10.2402 7.70733 10.3542 7.74077 10.4602C7.77422 10.5662 7.84091 10.6586 7.93098 10.7238C8.02104 10.7889 8.1297 10.8234 8.24085 10.8219H8.24647Z" fill="url(#paint10_linear_1339_73439)"/>
                                        <path d="M6.1044 8.16152C6.00753 8.25855 5.95312 8.39005 5.95312 8.52715C5.95312 8.66425 6.00753 8.79575 6.1044 8.89277L6.31814 9.10652C6.36541 9.1578 6.42254 9.19899 6.48612 9.22762C6.5497 9.25626 6.61841 9.27176 6.68813 9.27317C6.75784 9.27459 6.82713 9.26191 6.89182 9.23588C6.95651 9.20985 7.01527 9.17102 7.06458 9.12171C7.11389 9.0724 7.15272 9.01364 7.17875 8.94895C7.20478 8.88426 7.21746 8.81497 7.21605 8.74526C7.21463 8.67554 7.19913 8.60683 7.1705 8.54325C7.14186 8.47967 7.10067 8.42253 7.04939 8.37527L6.83564 8.16152C6.73862 8.06466 6.60712 8.01025 6.47002 8.01025C6.33292 8.01025 6.20142 8.06466 6.1044 8.16152Z" fill="url(#paint11_linear_1339_73439)"/>
                                        <path d="M11.8115 13.4094H11.9015C11.9698 13.4135 12.0383 13.4041 12.103 13.3817C12.1677 13.3593 12.2273 13.3243 12.2785 13.2789C12.3297 13.2335 12.3714 13.1784 12.4013 13.1168C12.4312 13.0552 12.4487 12.9884 12.4528 12.92C12.4568 12.8517 12.4474 12.7833 12.425 12.7186C12.4026 12.6539 12.3677 12.5943 12.3222 12.5431C12.2768 12.4919 12.2217 12.4501 12.1601 12.4202C12.0986 12.3903 12.0317 12.3729 11.9634 12.3688L10.6865 12.1719C10.6193 12.1605 10.5505 12.1624 10.484 12.1775C10.4175 12.1927 10.3547 12.2208 10.299 12.2602C10.2434 12.2996 10.1961 12.3496 10.1598 12.4074C10.1235 12.4651 10.0989 12.5294 10.0875 12.5966C10.076 12.6638 10.0779 12.7326 10.093 12.7991C10.1082 12.8656 10.1363 12.9285 10.1757 12.9841C10.2152 13.0397 10.2652 13.087 10.3229 13.1233C10.3806 13.1596 10.4449 13.1842 10.5121 13.1957L11.8115 13.4094Z" fill="url(#paint12_linear_1339_73439)"/>
                                        <defs>
                                          <linearGradient id="paint0_linear_1339_73439" x1="13.0893" y1="7.56592" x2="13.0893" y2="8.61076" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint1_linear_1339_73439" x1="14.1351" y1="5.4624" x2="14.1351" y2="6.50725" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint2_linear_1339_73439" x1="11.5396" y1="2.88623" x2="11.5396" y2="3.93108" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint3_linear_1339_73439" x1="9.47339" y1="4.9624" x2="9.47339" y2="6.01287" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint4_linear_1339_73439" x1="6.35621" y1="2.89209" x2="6.35621" y2="3.93694" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint5_linear_1339_73439" x1="5.48144" y1="7.95068" x2="5.48144" y2="16.7059" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint6_linear_1339_73439" x1="11.4936" y1="3.56934" x2="11.4936" y2="9.06694" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint7_linear_1339_73439" x1="13.334" y1="8.32422" x2="13.334" y2="11.587" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint8_linear_1339_73439" x1="7.84689" y1="1.26807" x2="7.84689" y2="7.64591" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint9_linear_1339_73439" x1="4.49812" y1="5.41357" x2="4.49812" y2="7.18738" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint10_linear_1339_73439" x1="8.39236" y1="9.56738" x2="8.39236" y2="10.822" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint11_linear_1339_73439" x1="6.58464" y1="8.01025" x2="6.58464" y2="9.27328" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                          <linearGradient id="paint12_linear_1339_73439" x1="11.2669" y1="12.1646" x2="11.2669" y2="13.4103" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFE46C"/>
                                            <stop offset="0.49936" stop-color="#F9A825"/>
                                            <stop offset="1" stop-color="#FF6F00"/>
                                          </linearGradient>
                                        </defs>
                                    </svg>
                                </p>

                                <div class="scrol-applicant">
                                    @forelse ($ultah as $ultah)
                                        <div class="card card-content-applicant">
                                            <div class=" container-card-content-applicant">
                                                    <div class="row row-app" >
                                                        <div class="col-xl-2 col-2 col-app">
                                                            <img src="{{ $ultah->photo }}" class="img-app">
                                                        </div>
                                                        <div class="col-xl-6 col-6 col-app">
                                                            <div class="row row-app-1">
                                                                <div class="col-12 col-app-1">
                                                                    <span class="text-nama-lengkap text-truncate">{!! Str::limit($ultah->nama_lengkap,15) !!}</span>
                                                                </div>
                                                                <div class="col-12 col-app-1">
                                                                    <p class="text-posisi text-truncate">{{ $ultah->jabatan->nama }} </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-4 col-app">
                                                            <h5 class="text-date">{{ date('d M', strtotime($ultah->tanggal)) }}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert alert-danger">Data belum Tersedia. </div>
                                    @endforelse
                                </div>
                                <a class="text-view" href="{{ route('calender.index') }}">View All</a>
                            </div>
                        </div>

                        <div class="card card-access"> 
                            <div class="card card-access-whooff">
                                <p class="title-head">Employee</p>
                                <div class="scrol-applicant">
                                    @forelse ($employes as $employ)
                                        <div class="card card-content-applicant">
                                            <div class=" container-card-content-applicant">
                                                    <div class="row row-app" >
                                                        <div class="col-xl-2 col-2 col-app">
                                                            <img src="{{ $employ->photo }}" class="img-app">
                                                        </div>
                                                        <div class="col-xl-6 col-6 col-app">
                                                            <div class="row row-app-1">
                                                                <div class="col-12 col-app-1">
                                                                    <span class="text-nama-lengkap text-truncate">{!! Str::limit($employ->nama_lengkap,15) !!}</span>
                                                                </div>
                                                                <div class="col-12 col-app-1">
                                                                    <p class="text-posisi text-truncate">{{ $employ->jabatan->nama }} </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-4 col-app">
                                                            <h5 class="text-date">{{ date('d M', strtotime($employ->tanggal)) }}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert alert-danger">Data belum Tersedia. </div>
                                    @endforelse
                                </div>
                                <a class="text-view" href="{{ route('employ.index') }}">View All</a>
                            </div>
                        </div>
                    </div>

                    {{-- card sakit izin cuti other --}}
                    <div class="col col-9 col-content-card mb-3">

                        <div class="col-sm content-sakit">
                            <div class="jmlh-employ">
                                3 Employee
                            </div>
                            <div class="requestan">
                                <h5 class="card-title">Sakit</h5>
                                <a class="card-text" href="#">Request Sakit</a>
                            </div>
                        </div>
            
                        <div class="col content-cuti">
                            <div class="jmlh-employ">
                                3 Employee
                            </div>
                            <div class="requestan">
                                <h5 class="card-title">Cuti</h5>
                                <a class="card-text" href="#">Request Cuti</a>
                            </div>
                        </div>
            
                        <div class="col content-izin">
                            <div class="jmlh-employ">
                                3 Employee
                            </div>
                            <div class="requestan">
                                <h5 class="card-title">Izin</h5>
                                <a class="card-text" href="#">Request Izin</a>
                            </div>
                        </div>
            
                        <div class="col content-other">
                            <div class="jmlh-employ">
                                3 Employee
                            </div>
                            <div class="requestan">
                                <h5 class="card-title">Other</h5>
                                <a class="card-text" href="#">Request Other</a>
                            </div>
                        </div>
                    </div>

                    <div class="col col-12 col-content-karyawan">
                        <div class="row row-content-karyawan">

                            {{-- log acces, download, recent aplicant --}}
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-cont">
                                <div class="col col-card-access">
                                    <div class="card card-access">
                                        <p class="title-head">Log Access</p>
                                        <a href="/myinfo" class="title-link"><h5 class="title-text"><i class="fas fa-user"></i> My Info</h5></a>
                                        <a href="https://karir.anyargroup.co.id/presensi" class="title-link"><h5 class="title-text"><i class="fas fa-solid fa-id-badge"></i> Presensi</h5></a>
                                        <a href="{{ url('/logpresensi', auth()->user()->getkaryawan->id) }}" class="title-link mb-2"><h5 class="title-text"><i class="fas fa-clock"></i> My Attendance logs</h5></a>

                                        <p class="title-head">Download Daily A-Team Mobile</p>

                                        <a href="" class="title-link">
                                            <h5 class="title-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M100.5 -8.5H-4.5C-6.70914 -8.5 -8.5 -6.70914 -8.5 -4.5V24.5C-8.5 26.7091 -6.70914 28.5 -4.5 28.5H100.5C102.709 28.5 104.5 26.7091 104.5 24.5V-4.5C104.5 -6.70914 102.709 -8.5 100.5 -8.5Z" fill="white" stroke="#E2E2E2"/>
                                                    <path d="M13.2427 5.84616C13.7765 5.86832 15.2744 6.06232 16.2364 7.47721C16.1604 7.52744 14.4484 8.52854 14.4693 10.6142C14.4903 13.1056 16.6414 13.9337 16.6663 13.945C16.6469 14.0035 16.3225 15.1272 15.5323 16.2882C14.8492 17.2923 14.1425 18.2903 13.0268 18.3112C11.9288 18.3321 11.5768 17.6575 10.3239 17.6575C9.06959 17.6575 8.67723 18.2903 7.6405 18.3321C6.56341 18.3726 5.74441 17.2476 5.05564 16.248C3.6485 14.2042 2.57451 10.4692 4.01891 7.94852C4.73417 6.69671 6.01583 5.90469 7.40471 5.88378C8.46247 5.86421 9.46171 6.60056 10.1078 6.60056C10.7548 6.60056 11.9677 5.71649 13.2427 5.84616ZM13.3157 1.6665C13.4213 2.61922 13.0329 3.57324 12.4593 4.2607C11.8846 4.94692 10.9437 5.48148 10.0203 5.4101C9.89486 4.47801 10.3603 3.50591 10.8934 2.89681C11.4865 2.21093 12.4886 1.70078 13.3157 1.6665Z" fill="#B4B4B4"/>
                                                  </svg>
                                                Apple Store
                                            </h5>
                                        </a>
                                        <a href="https://play.google.com/store/apps/details?id=id.co.anyargroup.hris" class="title-link">
                                            <h5 class="title-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M114.5 -8.5H-4.5C-6.70914 -8.5 -8.5 -6.70914 -8.5 -4.5V24.5C-8.5 26.7091 -6.70914 28.5 -4.5 28.5H114.5C116.709 28.5 118.5 26.7091 118.5 24.5V-4.5C118.5 -6.70914 116.709 -8.5 114.5 -8.5Z" fill="white" stroke="#E2E2E2"/>
                                                    <path d="M2.5 17.1931V2.8083C2.5 2.30633 2.79102 1.87243 3.21333 1.6665L11.5342 9.99822L3.20999 18.3332C2.78948 18.1266 2.5 17.6937 2.5 17.1931ZM14.1741 12.6414L5.07569 17.9011L12.2514 10.7162L14.1741 12.6414ZM17.0022 8.99222C17.3048 9.22415 17.5 9.58961 17.5 10.0007C17.5 10.4056 17.3107 10.7661 17.0159 10.9985L15.0833 12.1157L12.9684 9.99822L15.0818 7.88204L17.0022 8.99222ZM5.08102 2.10063L14.1726 7.35644L12.2514 9.28017L5.08102 2.10063Z" fill="#B4B4B4"/>
                                                </svg>
                                                Google Play
                                            </h5>
                                        </a>
                                    </div>

                                    <div class="card card-access-pelamar">
                                        <p class="title-head">Recent Applicant</p>
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
                                                                            <span class="text-nama-lengkap text-truncate">{!! Str::limit($det->pelamar->nama_lengkap,15) !!}</span>
                                                                        </div>
                                                                        <div class="col-12 col-app-1">
                                                                            <p class="text-posisi text-truncate"> Applied For <span>{{ $det->loker->posisi->nama }} </span></p>
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
                                        <a class="text-view" href="{{ route('pelamar.index') }}">View All</a>
                                    </div>

                                    <div class="card card-grafik-apply">
                                        <p class="title-head">Vacancies Analytics</p>

                                        <canvas id="grafikpelamar" width="100" height="100" style=""></canvas>


                                        <a class="text-view" href="{{ route('pelamar.index') }}">View All</a>
                                    </div>
                                </div>
                            </div>

                            {{-- Annauncement --}}
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-cont">
                                {{-- <div class="col col-title-announ">
                                    <div class="card card-title-announ">
                                        <h5 class="title-head">Announcement</h5>
                                    </div>
                                </div> --}}
                                <div class="col col-card-announ">
                                    <div class="card card-announ">
                                        <h5 class="title-head">Announcement</h5>
                                        <div class="form-group has-search">
                                            <span class="fa fa-search form-control-feedback"></span>
                                            <input type="text" class="form-control input-annaun" placeholder="Search" id="search" name="search">
                                        </div>
                                        <div class="add-annount">
                                            <div class="row content-add">
                                                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 content-img">
                                                    <img src="../assets/bootstrap/img/person.png" alt="dashboard" class="img-announ">
                                                </div>
                                                <div class="col-xl-7 col-lg-7 col-md-3 col-sm-12 content-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                                        <g clip-path="url(#clip0_2703_61107)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3668 17.6285C12.4204 17.6286 12.628 17.6308 12.9397 17.685L12.8974 18.3768C12.8832 18.7438 12.5726 19.0403 12.2056 19.0403C11.3868 19.0403 10.8221 19.2803 10.4409 19.7603C9.5797 20.8615 9.87617 23.0497 10.0597 23.812C10.1162 24.0238 10.0597 24.2497 9.93265 24.4191C9.79148 24.5885 9.59383 24.6873 9.38206 24.6873H6.72794C6.33265 24.6873 6.02206 24.3768 6.02206 23.9815V17.6285H12.3668ZM20.2145 1.07799C20.3599 0.784335 20.6847 0.633285 21.0079 0.705285C21.327 0.781523 21.5515 1.06529 21.5515 1.39281V7.81775C23.1609 8.14529 24.375 9.57116 24.375 11.2752C24.375 12.9792 23.1609 14.4065 21.5515 14.734V21.1575C21.5515 21.485 21.327 21.7702 21.0079 21.845C20.9547 21.8573 20.9002 21.8635 20.8456 21.8634C20.5816 21.8634 20.3359 21.7166 20.2145 21.4737C17.6155 16.277 12.4272 16.2163 12.375 16.2163H5.31617C3.36935 16.2163 1.78676 14.6337 1.78676 12.6869V11.981H1.08089C0.691238 11.981 0.375 11.6662 0.375 11.2752C0.375 10.8855 0.691238 10.5693 1.08088 10.5693H1.78676V9.86341C1.78676 7.91799 3.36935 6.33398 5.31617 6.33398H12.3736C12.5854 6.33257 17.6296 6.24646 20.2145 1.07799Z" fill="#4A62B4"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_2703_61107">
                                                            <rect width="24" height="24" fill="white" transform="translate(0.375 0.6875)"/>
                                                        </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <span class="text-add">Add what do you want to announce</span>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 content-plus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                        <path d="M12 21.6875V12.6875M12 12.6875V3.6875M12 12.6875L21 12.6875M12 12.6875H3" stroke="#4A62B4" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cards-announ">
                                            @forelse($anns as $ann)
                                                <div class="row row-head mb-3">
                                                    <div class="col-xl-1 col-lg-1 col-md-3 col-sm-12 col-head-announ-img">
                                                        <img src="../assets/bootstrap/img/person.png" alt="dashboard" class="img-announ">
                                                    </div>
                                                    <div class="col-xl-6 col-lg-7 col-md-3 col-sm-12 col-head-announ">
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
                                                    <div class="col-xl-4 col-lg-3 col-md-3 col-sm-12 col-head-announ">
                                                        <h5 class="title-tanggal">{{ $ann->tanggal }}</h5>
                                                        <h5 class="title-jam">{{ $ann->created_at->format('H:i') }}</h5>
                                                    </div>
                                                    <div class="col-xl-1 col-lg-1 col-md-3 col-sm-12 col-head-more">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                            <g clip-path="url(#clip0_2502_77878)">
                                                              <path d="M12 8.375C13.1 8.375 14 7.475 14 6.375C14 5.275 13.1 4.375 12 4.375C10.9 4.375 10 5.275 10 6.375C10 7.475 10.9 8.375 12 8.375ZM12 10.375C10.9 10.375 10 11.275 10 12.375C10 13.475 10.9 14.375 12 14.375C13.1 14.375 14 13.475 14 12.375C14 11.275 13.1 10.375 12 10.375ZM12 16.375C10.9 16.375 10 17.275 10 18.375C10 19.475 10.9 20.375 12 20.375C13.1 20.375 14 19.475 14 18.375C14 17.275 13.1 16.375 12 16.375Z" fill="#797979"/>
                                                            </g>
                                                            <defs>
                                                              <clipPath id="clip0_2502_77878">
                                                                <rect width="24" height="24" fill="white" transform="translate(0 0.375)"/>
                                                              </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="judul row">
                                                    <h5 class="col-xl-9 title-judul text-uppercase">{{ $ann->judul }}</h5>
                                                    <span class="col-xl-3 title-type">Uncategorized</span>
                                                </div>
                                                <div class="isi-text">
                                                    {!! $ann->isi !!}
                                                </div>
                                                <div class="download">
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text" id="addon-wrapping">
                                                            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.5" d="M5 17.2083C5 10.9229 5 7.78025 6.95262 5.82762C8.90525 3.875 12.0479 3.875 18.3333 3.875H21.6667C27.952 3.875 31.0948 3.875 33.0473 5.82762C35 7.78025 35 10.9229 35 17.2083V23.875C35 30.1603 35 33.3032 33.0473 35.2557C31.0948 37.2083 27.952 37.2083 21.6667 37.2083H18.3333C12.0479 37.2083 8.90525 37.2083 6.95262 35.2557C5 33.3032 5 30.1603 5 23.875V17.2083Z" fill="#4B61DD"/>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.084 20.5417C12.084 19.8628 12.6436 19.3125 13.334 19.3125H26.6673C27.3577 19.3125 27.9173 19.8628 27.9173 20.5417C27.9173 21.2205 27.3577 21.7708 26.6673 21.7708H13.334C12.6436 21.7708 12.084 21.2205 12.084 20.5417Z" fill="#FAFAFA"/>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.084 13.9865C12.084 13.3076 12.6436 12.7573 13.334 12.7573H26.6673C27.3577 12.7573 27.9173 13.3076 27.9173 13.9865C27.9173 14.6653 27.3577 15.2157 26.6673 15.2157H13.334C12.6436 15.2157 12.084 14.6653 12.084 13.9865Z" fill="#FAFAFA"/>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.084 27.0968C12.084 26.418 12.6436 25.8677 13.334 25.8677H21.6673C22.3577 25.8677 22.9173 26.418 22.9173 27.0968C22.9173 27.7757 22.3577 28.326 21.6673 28.326H13.334C12.6436 28.326 12.084 27.7757 12.084 27.0968Z" fill="#FAFAFA"/>
                                                            </svg>    
                                                        </span>
                                                        <div class="text-download">
                                                            <h5 class="title-download">{{ $ann->dokumen }}</h5>
                                                        </div>
                                                        <span class="input-group-text icon-download" id="addon-wrapping">
                                                            <a href="/storage/announcement/{{$ann->dokumen}}" class="download-icon">
                                                                <svg width="49" height="31" viewBox="0 0 49 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_1352_72347)">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.8124 18.6665C24.5492 18.6665 24.2982 18.5559 24.1205 18.3616L19.1205 12.8929C18.7711 12.5107 18.7976 11.9177 19.1797 11.5684C19.5618 11.219 20.1548 11.2455 20.5042 11.6277L23.8749 15.3143L23.8749 1.47901C23.8749 0.961255 24.2947 0.541505 24.8124 0.541505C25.3302 0.541505 25.7499 0.961256 25.7499 1.47901L25.7499 15.3143L29.1206 11.6277C29.4699 11.2455 30.063 11.219 30.4451 11.5684C30.8272 11.9177 30.8538 12.5107 30.5044 12.8929L25.5043 18.3616C25.3267 18.5559 25.0757 18.6665 24.8124 18.6665Z" fill="#338A2C"/>
                                                                        <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M13.5625 21.1665C14.0803 21.1665 14.5 21.5863 14.5 22.104C14.5 23.8983 14.502 25.1496 14.629 26.0939C14.7523 27.0111 14.9778 27.4968 15.3238 27.8428C15.6698 28.1888 16.1555 28.4143 17.0727 28.5376C18.0169 28.6645 19.2683 28.6665 21.0626 28.6665H28.5627C30.357 28.6665 31.6084 28.6645 32.5527 28.5376C33.4699 28.4143 33.9556 28.1888 34.3016 27.8428C34.6476 27.4968 34.8731 27.0111 34.9964 26.0939C35.1233 25.1496 35.1253 23.8983 35.1253 22.104C35.1253 21.5863 35.5451 21.1665 36.0628 21.1665C36.5806 21.1665 37.0003 21.5863 37.0003 22.104V22.1726C37.0003 23.8821 37.0003 25.26 36.8547 26.3438C36.7035 27.4689 36.3798 28.4161 35.6275 29.1685C34.8749 29.921 33.9277 30.2446 32.8025 30.3959C31.7188 30.5415 30.3409 30.5415 28.6314 30.5415H20.994C19.2845 30.5415 17.9066 30.5415 16.8229 30.3959C15.6977 30.2446 14.7504 29.921 13.998 29.1686C13.2455 28.4161 12.9219 27.4689 12.7707 26.3438C12.625 25.26 12.625 23.8821 12.625 22.1726C12.625 22.1498 12.625 22.1269 12.625 22.104C12.625 21.5863 13.0447 21.1665 13.5625 21.1665Z" fill="#338A2C" fill-opacity="0.5"/>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_1352_72347">
                                                                            <rect x="0.625" y="0.541504" width="48.3754" height="30" rx="4.73688" fill="white"/>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
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

                            {{-- sakit dan off cuti --}}
                            {{-- <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-cont">
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
                                </div> --}}

                                {{-- <div class="col col-card-whosoff">
                                    <div class="card card-whosoff">
                                        <p class="title-head">Who’s Off</p>
                                        <div class="card card-tanggal"><span id="tanggal" class="tanggal"></span></div>

                                        <div class="container container-people">
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
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endauth

    
    </div>


    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="modal fade detail-pelamar" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="ModalTransferLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-pelamar" role="document">
            <div class="modal-content modal-content-pelamar">
                <div class="modal-header">
                    <h5 class="modal-title" id="labeldetail"></h5>
                    <button type="button" class="close" onClick="Close()" id="close-button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-body-pelamar">
                    <div id="detail" class="p-2"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <h2>Selected Date: <span id="selectedDate"></span></h2>
            <button id="closeModal">Close</button>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var chartVacancyData = JSON.parse(`<?php echo json_encode($data) ?>`);
        var chartReferenceData = JSON.parse(`<?php echo json_encode($result) ?>`);

        const ctxVacancy = document.getElementById('grafikpelamar').getContext('2d');
        const myVacancyChart = new Chart(ctxVacancy, {
            type: 'pie',
            data: {
                labels: chartVacancyData.labels,
                datasets: [{
                    label: 'Total Pelamar',
                    data: chartVacancyData.data,
                    backgroundColor: [
                        'var(--CTA-Blue-Default, #4B61DD)', // Head Office
                        '#293D84', // ABM
                        '#F39851', // RKM
                        '#F32424', // Lantai dan Dinding
                        '#493169', // Triwarna
                        '#D9D9D9'  // Distributor Center
                    ],
                    borderColor: '#fff', // Warna border putih
                    borderWidth: 2, // Lebar border
                }]
            },
            options: {
                cutoutPercentage: 50,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom', // Menampilkan legend di bawah chart
                        labels: {
                            boxWidth: 15, // Lebar kotak legend
                            usePointStyle: true, // Menggunakan simbol titik sebagai ikon legend
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                const label = chartVacancyData.labels[context.dataIndex];
                                const value = chartVacancyData.data[context.dataIndex];
                                return `${label}: ${value}`;
                            },
                        },
                    },
                },
            },
        });



        const ctxReference = document.getElementById('grafikreferensi').getContext('2d');
        const myReferenceChart = new Chart(ctxReference, {
            type: 'bar',
            data: {
                labels: chartReferenceData.labels,
                datasets: [{
                    label: 'Jumlah Pelamar',
                    data: chartReferenceData.data,
                    backgroundColor: 'rgba(11, 58, 177, 0.8)',
                    borderColor: 'rgba(11, 58, 177, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var currentDate = new Date();
            var day = 1; // Mulai dari tanggal 1
            var month = currentDate.getMonth();
            var year = currentDate.getFullYear();

            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            function updateCalendar() {
                document.getElementById('monthAndYear').innerHTML = monthNames[month] + ' ' + year;

                var dates = document.getElementById('dates');
                dates.innerHTML = ''; // Membersihkan elemen tanggal sebelumnya

                var firstDay = new Date(year, month, 1).getDay();
                var lastDay = new Date(year, month + 1, 0).getDay();

                var prevMonthDays = new Date(year, month, 0).getDate();
                for (var i = firstDay - 1; i >= 0; i--) {
                    var newDate = createNewDateElement(prevMonthDays - i, 'prev-month-date');
                    dates.appendChild(newDate);
                }

                for (var j = 1; j <= new Date(year, month + 1, 0).getDate(); j++) {
                    var newDate = createNewDateElement(j, 'current-date');
                    dates.appendChild(newDate);
                }

                var nextMonthDays = 7 - lastDay - 1;
                for (var k = 1; k <= nextMonthDays; k++) {
                    var newDate = createNewDateElement(k, 'next-month-date');
                    dates.appendChild(newDate);
                }
            }

            function createNewDateElement(dayNumber, className) {
                var newDate = document.createElement('div');
                newDate.classList.add('date', className);
                newDate.innerHTML = dayNumber;

                // Check if the current date is a Sunday
                if (className === 'current-date' && new Date(year, month, dayNumber).getDay() === 0) {
                    newDate.classList.add('sunday-date');
                }

                newDate.addEventListener('click', function () {
                    document.getElementById('selectedDate').innerHTML = this.innerHTML;
                    document.getElementById('modal').style.display = 'block';
                });
                return newDate;
            }

            updateCalendar();

            var prevMonthBtn = document.getElementById('prevMonth');
            prevMonthBtn.addEventListener('click', function () {
                if (month === 0) {
                    month = 11;
                    year--;
                } else {
                    month--;
                }
                updateCalendar();
            });

            var nextMonthBtn = document.getElementById('nextMonth');
            nextMonthBtn.addEventListener('click', function () {
                if (month === 11) {
                    month = 0;
                    year++;
                } else {
                    month++;
                }
                updateCalendar();
            });

            var closeModal = document.getElementById('closeModal');
            closeModal.addEventListener('click', function () {
                document.getElementById('modal').style.display = 'none';
            });

            window.addEventListener('click', function (event) {
                if (event.target === document.getElementById('modal')) {
                    document.getElementById('modal').style.display = 'none';
                }
            });
        });
    </script>

    {{-- <style>
        body {
            font-family: Arial, sans-serif;
        }

        .calendar {
            width: fit-content;
            /* max-width: 400px; */
            margin: 15px 0px 15px -3px;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.10);
            background: #FDFDFD;


        }

        .header {
            padding: 20px 0;
            text-align: center;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
            align-items: center;
        }

        .days {
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            font-size: 12px
        }

        .dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 5px;
            padding: 0px 0px;
            font-family: 'Nunito Sans';
            font-size: 10px
        }

        .date {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .prev-month-date {
            color: var(--Stroke-Grey, #C2C2C2);
        }

        .next-month-date {
            color: var(--Stroke-Grey, #C2C2C2);
        }

        .sunday-date {
            background-color: #ffc0c0; /* Add your desired style for Sundays */
            color: red;
        }
    </style> --}}


@endsection

