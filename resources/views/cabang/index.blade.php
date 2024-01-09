@extends('layouts.app-master')

@section('content-employ')
<div class="param-perusahaan">
  <div class="head">
    <h5 class="title-applicant">List Branch</h5>
  </div>
  <div class="container">
    <div class="table-body">
      <div class="border-body">
        <div class="row">
          <div class="col-md-9 justify-content-start">
            <button class="btn btn-sm btn-add" onclick="window.location.href = '{{ route('cabang.create') }}'">
              <a class="text-decoration-none text-light">Add Company</a>
          </button>
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
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Other Phone</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($cabs as $cab)
              <tr class="isi">
                <td class="nomor">{{ $loop->iteration }}.</td>
                <td class="nama">{{ $cab->nama }}</td>
                <td class="code">{{ $cab->kode }}</td>
                <td class="alamat">{{ Str::limit($cab->alamat, 35) }}</td>
                <td class="no-hp">{{ $cab->no_hp }}</td>
                <td class="no-tlp">{{ $cab->no_telp }}</td>
                <td class="status">
                  <div class="bg_status" data-status="{{ $cab->status }}">
                    {{ $cab->status }}
                  </div>
                </td>
                <td class="actions">
                    <a class="bg-download" href="/storage/pelamar/{{$cab->documents}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="22" viewBox="0 0 15 22" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.47053 21.623C7.16528 21.623 6.87423 21.4947 6.66826 21.2695L0.870422 14.9281C0.465298 14.485 0.496026 13.7974 0.939126 13.3923C1.38223 12.9871 2.06985 13.0179 2.47497 13.461L6.38344 17.7359L6.38344 1.69298C6.38344 1.09261 6.87017 0.605883 7.47054 0.605883C8.0709 0.605883 8.55763 1.09261 8.55763 1.69298L8.55763 17.7359L12.4661 13.461C12.8712 13.0179 13.5588 12.9871 14.0019 13.3923C14.445 13.7974 14.4758 14.485 14.0707 14.9281L8.27281 21.2695C8.06684 21.4947 7.77579 21.623 7.47053 21.623Z" fill="#338A2C"/>
                        </svg>
                    </a>
                    <a class="bg-edit" href="{{ route('cabang.edit', $cab->id) }}">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                        <g id="Icon Bulk Update">
                            <path id="Vector" opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M3.75732 21.7134C3.75732 21.3048 4.08852 20.9736 4.49706 20.9736H20.2781C20.6867 20.9736 21.0179 21.3048 21.0179 21.7134C21.0179 22.1219 20.6867 22.4531 20.2781 22.4531H4.49706C4.08852 22.4531 3.75732 22.1219 3.75732 21.7134Z" fill="#C2CFFF"/>
                            <path id="Vector_2" opacity="0.5" d="M19.3724 7.28543C20.5844 6.07342 20.5844 4.10834 19.3724 2.89632C18.1604 1.6843 16.1953 1.6843 14.9833 2.89632L14.2832 3.5964C14.2928 3.62534 14.3027 3.6547 14.3131 3.68442C14.5696 4.42405 15.0538 5.39361 15.9646 6.3044C16.8753 7.21518 17.8449 7.69933 18.5845 7.95593C18.6141 7.9662 18.6433 7.9761 18.6722 7.98565L19.3724 7.28543Z" fill="#E2E7FB"/>
                            <path id="Vector_3" d="M14.312 3.56494L14.2818 3.59508C14.2915 3.62403 14.3013 3.65338 14.3117 3.68311C14.5683 4.42273 15.0524 5.3923 15.9632 6.30309C16.874 7.21386 17.8436 7.69802 18.5832 7.95462C18.6125 7.9648 18.6415 7.97462 18.67 7.98408L11.914 14.7402C11.4585 15.1957 11.2306 15.4235 10.9795 15.6194C10.6833 15.8504 10.3628 16.0486 10.0236 16.2101C9.73613 16.3471 9.43056 16.449 8.81943 16.6528L5.59675 17.727C5.29601 17.8272 4.96444 17.749 4.74028 17.5248C4.51612 17.3006 4.43784 16.9691 4.53809 16.6683L5.61231 13.4456C5.81602 12.8344 5.91788 12.5289 6.0549 12.2414C6.21653 11.9023 6.41462 11.5817 6.64567 11.2855C6.84154 11.0344 7.0693 10.8067 7.52475 10.3512L14.312 3.56494Z" fill="#4A62B4"/>
                        </g>
                        </svg>
                        Edit
                    </a>         
                </td>
              </tr>
            @empty
              <div class="alert alert-danger">
                Data belum Tersedia.
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
@endsection
