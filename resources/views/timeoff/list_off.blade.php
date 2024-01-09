@extends('layouts.app-master')

@section('content')
<div class="employ">
  <div class="container">
    <h5 class="title-employ">Time Off</h5>
      <hr class="border"></hr>
		<div class="table-body">
        <h5 class="list-employ">List Time Off</h5>

	        <div class="search-employ">
            <form action="/employ" method="GET" class="search">
                <div class="input-group group-search">
                    <input type="text" class="form-control form-control-sm col-form-input" name="search" value="{{request('search')}}">
                    <input type="submit" class="btn btn-sm btn-search" value="Search">
                </div>
	          </form>
        </div>
			<table class="table data-table">
				<thead>
				<tr class="judul">
				    <th scope="col">No</th>
                    <th scope="col">Nama</th>
				    <th scope="col">Tanggal Pengajuan</th> 
                    <th scope="col">Alasan</th>
				    <th scope="col">Actions</th>
				</tr>
				</thead>
				<tbody >
        
				@forelse ($offs as $off)
            <tr class="isi">
                <td class="nomor">{{ $loop->iteration }}.</td>
                <td>{{ $off->nama_lengkap }}</td>
                <td>{{ $off->tanggal }}</td>
                <td>{{ $off->statusoff }}</td>
                <td class="btn-action">
                <button class="btn btn-sm btn-success " data-toggle="modal" data-target="#exampleModalReject" data-id ="{{$off->id}}" data-whatever="@mdo">
                <i class="fas fa-calendar-check"></i></button>
        
                <button class="btn btn-sm btn-danger btn-reject" data-toggle="modal" data-target="#exampleModalReject{{$off->id}}" data-id ="{{$off->id}}" data-whatever="@mdo">
                <i class="fas fa-window-close"></i></button>              
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
    </div>
    </div>
    

@endsection

