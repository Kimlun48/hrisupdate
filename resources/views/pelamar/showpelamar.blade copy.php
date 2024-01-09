<div id=pelamar>            
            <table class="table data-table">
	            <thead>
                    <tr class="judul">
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Relationship</th>
                        <th scope="col">Education</th>
                        <th scope="col">Position Applied</th>
                        <th scope="col">Placement</th>
                        <th scope="col">Progres</th>
                        <th scope="col">Actions</th>
                    </tr>
	            </thead>
                <tbody>
                @foreach($list as $index => $det)
                <tr class="isi">
                <td class="nomor">{{ $list->firstItem() + $index }}.</td>
  	            <td class="name">{{ Str::limit($det->pelamar->nama_lengkap,12) }}</td>
                <td class="hub">{{ $det->pelamar->hubungan_keluarga}}</td>
                <td class="pendidikan">{{ $det->pelamar->pendidikan_terakhir }}</td>
                <td class="position">{{ Str::limit($det->loker->lowongan_kerja,15) }}</td>
                <td class="cabang">{{ Str::limit($det->loker->cabang->nama,15) }}</td>
                <td class="progres">{{ Str::limit($det->progres,8)}}</td>
                <td class="btn-action">
                    <a href="/storage/pelamar/{{$det->pelamar->cv}}" target="_blank" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download CV">
                    <i class="fas fa-download" style="color:#fff; "></i></a>
	                <!-- <a href="/pelamar/detail/{{$det->id}}" target="_blank" class="btn btn-s          <i class="fas fa-eye" style="color:#fff;"></i></a>
                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter2{{$det->id}}" data-id="{{$det->id}}" class="btn btn-sm btn-info" data-whatever="@mdo" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail Pelamar">
                    <i class="fas fa-eye" style="color:#fff;"></i></button>
                  -->
                    <button type="button" class="btn btn-sm btn-info" onclick="showdetail({{$det->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail Pelamar">
                    <i class="fas fa-eye" style="color:#fff;"></i></button>

	                @if( $det->status =='Rejected')
	                    <button class="btn btn-sm btn-danger">Has Rejected</button>
	                @elseif( $det->status =='Finish')
                        <button class="btn btn-sm btn-success">Has Finish</button> 
                    @elseif( $det->status =='In Process')

	                @if( $det->progres =='Offering Letter')  
		                <a href="{{ route('verif.createoffering', $det->id) }}" class="btn btn-sm btn-primary" target="_blank">Create Ol</a>
                        <button class="btn btn-sm btn-danger btn-reject" onclick="showreject({{$det->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject">
                        <i class="fas fa-window-close"></i></button>
               
                    @elseif( $det->progres =='Contract')
		                <a href="{{ route('verif.createemploye', $det->id) }}" class="btn btn-sm btn-primary">Contract</a>
                        <button class="btn btn-sm btn-danger btn-reject" onclick="showreject({{$det->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject">
                        <i class="fas fa-window-close"></i></button>
                    @else   
	                    <button class="btn btn-sm btn-success btn-approve" onclick="showapprove({{$det->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Approve {{ $det->progres }}">
                      <i class="fas fa-calendar-check"></i></button>
              
                        <button class="btn btn-sm btn-danger btn-reject" onclick="showreject({{$det->id}})" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reject">
                        <i class="fas fa-window-close"></i></button>
               
                        <!--<a href="{{ route('verif.create', $det->id) }}" class="btn btn-sm btn-primary">Proses</a>-->
                    @endif
                    @endif
                </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex">
                {{ $list->links() }}
            </div>
            <div class="mb-2">
            showing
            {{$list->firstItem()}}
            to
            {{$list->lastItem()}}
            of
            {{$list->total()}}
            entries
            </div>


            <!-- Start Modals Detail 
              @include('pelamar.detailpelamar')
            -->
            <!-- <div class="modal fade bd-example-modal-lg" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div id="detail"></div>
                </div>
              </div>
            </div> -->
            <!-- End Modals Detail -->

            <!-- cobaindong -->
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
                  <div class="modal-body modal-body-pelamar">
                    <div id="detail" class="p-2"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Start Modals Approve -->
            <div class="modal fade bd-example-modal-lg" id="modalAppr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div id="appr"></div>
                </div>
              </div>
            </div>
            <!-- End Modals Approve -->

            <!-- Modal Reject -->
            <div class="modal fade bd-example-modal-lg" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div id="rej">
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal Reject-->
          
          <!--End Table-->
          </div>