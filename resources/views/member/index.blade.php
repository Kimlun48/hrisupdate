@extends('layouts.app-master')

@section('member')
    <div class="loker">
        <div class="container">
        <h5 class="title-vacancy">Customer Member</h5>
        <hr class="border"></hr>
		<div class="table-body">
            <h5 class="list-vacancy">List Customer Member</h5>
            <a href="{{ route('member.create') }}" class="btn btn-sm btn-add mb-3"><i class="fas fa-plus"></i> Add Member</a>			
			<table class="table data-table">
				<thead>
				<tr class="judul">
				    <th scope="col">No</th>
				    <th scope="col">Name</th>
				    <th scope="col">Loyalty Code</th>
				    <th scope="col">Loyalty Categori</th>
				    <th scope="col">Loyalty Potensi</th>
				    <th scope="col">Address</th>
				    <th scope="col">Email</th>
				    <th scope="col">Actions</th>
				</tr>
				</thead>
				<tbody >
					@forelse ($mems as $lok)
                    @include('member.detail')
                                <tr class="isi">
                                    <td class="nomor">{{ $loop->iteration }}.</td>
                                    <td >{{$lok->nama}}</td>
                                    <td class="code">{{ $lok->loyaltycode }}</td>
                                    <td class="kategori">{{ $lok->loyaltykategori }}</td>
                                    <td class="potemsi">{{ $lok->loyaltypotensi }}</td>
                                    <td class="address">{{ $lok->alamat }} KELURAHAN  {{ $lok->kelurahan }} KECAMATAN {{ $lok->kecamatan }}
                                         KOTA {{ $lok->kota }} PROVINSI {{ $lok->provinsi }} KODEPOS {{ $lok->kodepos }}</td>
                                    <td class="email">{{ $lok->email }}</td>
                                    <td class="btn-action">
                                        <button type="button" data-toggle="modal" data-target="#exampleModalCenter2{{$lok->id}}" data-id="{{$lok->id}}" class="btn btn-sm btn-info" data-whatever="@mdo">
                                            <i class="fas fa-eye" style="color:#fff;"></i>
                                        </button>
                                   <!-- <a href="{{ route('member.edit', $lok->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="fas fa-pencil-alt" style="color:#fff; width:20px;"></i></a>-->
                                    </td>
                                </tr>
                              @empty
                              
                                  <div class="alert alert-danger">
                                      Data belum Tersedia.
                                  </div>
                                  <a href="{{ route('member.create') }}" class="btn btn-sm btn-add mb-3"><i class="fas fa-plus"></i> Add Member</a>			
                              @endforelse
                </tbody>
            </table>
            <div class="d-flex">
                {!! $mems->links() !!}
            </div>

        </div>
    </div>
    </div>
    

@endsection

