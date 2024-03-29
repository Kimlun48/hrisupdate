@extends('layouts.app-master')

@section('content-employ')
<div class="param-posisi">
  <div class="head">
    <h5 class="title-applicant">List Job Postion</h5>
  </div>
  <div class="container">
    <div class="table-body">
      <div class="border-body">
        <div class="row">
          <div class="col-md-9 justify-content-start">
            <button class="btn btn-sm btn-add" data-toggle="modal" data-target="#exampleModalCenter1" ><a  class="text-decoration-none text-light" >Add Param Position </a></button>
          </div>
          <div class="col-md-3 d-flex justify-content-end">
            <div class="form-group has-search">
              <span class="fa fa-search form-control-feedback"></span>
              <input type="text" class="form-control" placeholder="Search" id="search" name="search">
            </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table data-table" id="myTable">
          <thead class="table-head">
            <tr class="judul">
              <th scope="col">No</th>
              <th scope="col">Nama Position</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($jobs as $job)
              <tr class="isi">
                <td class="nomor">{{ $loop->iteration }}.</td>
                <td class="nama"><span class="name" value="{{$job->nama}}">{{ $job->nama }}</span></td>
                <td class="status">
                  <div class="bg_status" data-status="{{ $job->status }}">
                    {{ $job->status }}
                  </div>
                </td>
                <td class="actions">
                  <div class="bg-edit" data-toggle="modal" data-target="#exampleModalCenter2{{$job->id}}" data-id ="{{$job->id}}">
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                      <g id="Icon Bulk Update">
                        <path id="Vector" opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M3.75732 21.7134C3.75732 21.3048 4.08852 20.9736 4.49706 20.9736H20.2781C20.6867 20.9736 21.0179 21.3048 21.0179 21.7134C21.0179 22.1219 20.6867 22.4531 20.2781 22.4531H4.49706C4.08852 22.4531 3.75732 22.1219 3.75732 21.7134Z" fill="#C2CFFF"/>
                        <path id="Vector_2" opacity="0.5" d="M19.3724 7.28543C20.5844 6.07342 20.5844 4.10834 19.3724 2.89632C18.1604 1.6843 16.1953 1.6843 14.9833 2.89632L14.2832 3.5964C14.2928 3.62534 14.3027 3.6547 14.3131 3.68442C14.5696 4.42405 15.0538 5.39361 15.9646 6.3044C16.8753 7.21518 17.8449 7.69933 18.5845 7.95593C18.6141 7.9662 18.6433 7.9761 18.6722 7.98565L19.3724 7.28543Z" fill="#E2E7FB"/>
                        <path id="Vector_3" d="M14.312 3.56494L14.2818 3.59508C14.2915 3.62403 14.3013 3.65338 14.3117 3.68311C14.5683 4.42273 15.0524 5.3923 15.9632 6.30309C16.874 7.21386 17.8436 7.69802 18.5832 7.95462C18.6125 7.9648 18.6415 7.97462 18.67 7.98408L11.914 14.7402C11.4585 15.1957 11.2306 15.4235 10.9795 15.6194C10.6833 15.8504 10.3628 16.0486 10.0236 16.2101C9.73613 16.3471 9.43056 16.449 8.81943 16.6528L5.59675 17.727C5.29601 17.8272 4.96444 17.749 4.74028 17.5248C4.51612 17.3006 4.43784 16.9691 4.53809 16.6683L5.61231 13.4456C5.81602 12.8344 5.91788 12.5289 6.0549 12.2414C6.21653 11.9023 6.41462 11.5817 6.64567 11.2855C6.84154 11.0344 7.0693 10.8067 7.52475 10.3512L14.312 3.56494Z" fill="#4A62B4"/>
                      </g>
                    </svg>
                    Edit
                  </div>         
                </td>
              </tr>
            @empty
              <div class="alert alert-danger">
                Data Post belum Tersedia.
              </div>
            @endforelse
          </tbody>
        </table>
    </div>
  </div>
  <div class="row mb-3 mt-3">
    <div class="col-md-6 d-flex justify-content-start">
      <label for="showEntries" class="">Showing</label>
      <select id="showEntries" class="show-entries form-control form-control-sm">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select>
      <div id="dataCount"></div>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
      <div class="pagination" id="pagination">
        <a href="javascript:void(0)" id="prevPage">Previous</a>
        <a href="javascript:void(0)" id="nextPage">Next</a>
      </div>
    </div>
  </div>
</div>
  
@include('loadjs.pagination') 
@include('loadjs.searchtable')
@include('posisi.create')
@include('layouts.partials.messages')



<!-- Start Modals Approve -->
@foreach ($jobs as $job)
<div class="modal fade" id="exampleModalCenter2{{$job->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Position Job Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/posisijob/storeedit/{{ $job->id }}" method="POST" enctype="multipart/form-data">
        <div class="container container-create-verif">
           <div class="row row-create">
             <div class="col col-create">
               <div class="card card-create">
		 <div class="card-body" name="bookId" id="bookId">
         @csrf
    
                <div class="form-group">
                <input type="text"  class="form-control form-control-sm col-form-input" name="nama"  id="nama" value="{{ $job->nama}}">
                
                </div>
                <div class="form-group">
                <select class="form-control form-control-sm col-form-input  @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">--Please Select--</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                 </select>
                                 @error('status_kerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror    
                 
                </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
	    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-sm btn-primary" onclick="$('#cover-spin').show(0)">Submit</button>
      
      </div>
    </div>
    </form>
   
  </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Modals Approve -->
  <script>
      //message with toastr
      @if(session()->has('success'))
      
          toastr.success('{{ session('success') }}', 'BERHASIL!'); 

      @elseif(session()->has('error'))

          toastr.error('{{ session('error') }}', 'GAGAL!'); 
          
      @endif
  </script>
@endsection
