@extends('layouts.app-master')

@section('content')



    <div class="loker">
        <div class="container">
        <h5 class="title-vacancy">Vacancies</h5>
        <hr class="border"></hr>
        <form action="/loker" method="GET" class="search">
    
    </form>
		<div class="table-body">
            <h5 class="list-vacancy">List Vacancies</h5>
            <a href="{{ route('loker.create') }}" class="btn btn-sm btn-add mb-3"><i class="fas fa-plus"></i> Add Vacancy</a>	
            <!-- <div class="input-group group-search"> -->
                <div class="search-loker">
                    <form class="search">
                    <div class="searching">
                        <input type="text" class="search__input" placeholder="Type your text" id="search" name="search">
                        <button  class="search__button" >
                            <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                                <g>
                                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                    </form>
                </div>	
			<table class="table data-table">
				<thead>
				<tr class="judul">
				    <th scope="col">No</th>
				    <th scope="col">Position</th>
				    <th scope="col">Department</th>
				    <th scope="col">Placement</th>
				    <th scope="col">Total Applicant</th>
				    <th scope="col">Post Date</th>
				    <th scope="col">Status</th>
				    <th scope="col">Actions</th>
				</tr>
				</thead>
				<tbody >
                       
                    @forelse ($loks as $key => $lok)

                                <tr class="isi">
                                    <td class="nomor">{{ $loks->firstItem() + $key }}.</td>
                                        <td class="position">{{ Str::limit($lok->lowongan_kerja,15) }}</td>
                                        <td class="departement">{{ Str::limit($lok->posisi->nama,15) }}</td>
                                        <td class="placment">{{ Str::limit($lok->cabang->nama,15) }}</td>
                                        <td class="total-app"><a class="btn btn-sm btn-grey total-applicant" href="/loker/listapply/{{$lok->id}}">{{ $lok->apply->count('pivot.id') }}</a></td>
                                        <td class="post-date">{{ date('d-m-Y', strtotime($lok->tanggal)) }}</td>
                                        <td class="status">{{ $lok->status }}</td>
                                        <td class="btn-action">
                                        <a href="/loker/detail/{{$lok->id}}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"><i class="fas fa-eye" style="color:#fff; width:20px; "></i></a>
                                        <a href="{{ route('loker.edit', $lok->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="fas fa-pencil-alt" style="color:#fff; width:20px;"></i></a>
                                    </td>
                                </tr>
                              @empty
                              
                                  <div class="alert alert-danger">
                                      Data belum Tersedia.
                                  </div>
                                  <a href="{{ route('loker.create') }}" class="btn btn-sm btn-add mb-3"><i class="fas fa-plus"></i> Add Vacancy</a>			
                              @endforelse
                </tbody>
            </table>
            <div class="d-flex" id="pagination_links">
      {!! $loks->links() !!}
   </div>

   <div class="mb-2">
      showing
      {{$loks->firstItem()}}
      to
      {{$loks->lastItem()}}
      of
      {{$loks->total()}}
      entries
   </div>

        </div>
    </div>
    </div>
    

@endsection

