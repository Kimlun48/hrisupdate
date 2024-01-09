<div class="border-body">
    <div class="row">
        <div class="col-md-9 justify-content-start">
            <button class="btn btn-sm btn-add" onClick="create()"><a  class="text-decoration-none text-light" >Add Pasal</a></button>
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
                    <th scope="col" >Chapter</th>
                    <th scope="col" >Paragrapgh</th>
                    <th scope="col" >Fill</th>
                    <th scope="col" >Status</th>
                    <th scope="col" >Action</th>
                        
                </tr>
            </thead>
            <tbody>
                @forelse ($pas as $Pas)                 
                    <tr class="isi">
                        <td class="name" >{{$Pas->pasal}}</td>
                        <td class="name">{{ $Pas->ayat }}</td>
                        <td class="name">{{ substr($Pas->isiayat, 0, 50) . (strlen($Pas->isiayat) > 50 ? '....' : '') }}</td>
                        <td class="status">
                            <div class="bg_status" data-status="{{ $Pas->status }}">
                                {{ $Pas->status }}
                            </div>
                        </td>                        
                        <td class="actions">
                            <div class="bg-detail" onClick="showisi({{$Pas->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                                    <path opacity="0.5" d="M2.16602 13.1044C2.16602 14.8804 2.62639 15.4785 3.54715 16.6748C5.38564 19.0632 8.46897 21.7711 12.9993 21.7711C17.5297 21.7711 20.613 19.0632 22.4515 16.6748C23.3723 15.4785 23.8327 14.8804 23.8327 13.1044C23.8327 11.3284 23.3723 10.7303 22.4515 9.5341C20.613 7.1456 17.5297 4.43774 12.9993 4.43774C8.46897 4.43774 5.38564 7.1456 3.54715 9.5341C2.62639 10.7303 2.16602 11.3284 2.16602 13.1044Z" fill="#4A62B4"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.9375 13.1044C8.9375 10.8607 10.7563 9.0419 13 9.0419C15.2437 9.0419 17.0625 10.8607 17.0625 13.1044C17.0625 15.3481 15.2437 17.1669 13 17.1669C10.7563 17.1669 8.9375 15.3481 8.9375 13.1044ZM10.5625 13.1044C10.5625 11.7583 11.6538 10.6669 13 10.6669C14.3461 10.6669 15.4375 11.7583 15.4375 13.1044C15.4375 14.4506 14.3461 15.5419 13 15.5419C11.6538 15.5419 10.5625 14.4506 10.5625 13.1044Z" fill="white"/>
                                </svg>
                            </div>
                            <div class="bg-edit" onClick="edit({{$Pas->id}})">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="Icon Bulk Update">
                                        <path id="Vector" opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M3.75732 21.7134C3.75732 21.3048 4.08852 20.9736 4.49706 20.9736H20.2781C20.6867 20.9736 21.0179 21.3048 21.0179 21.7134C21.0179 22.1219 20.6867 22.4531 20.2781 22.4531H4.49706C4.08852 22.4531 3.75732 22.1219 3.75732 21.7134Z" fill="#C2CFFF"/>
                                        <path id="Vector_2" opacity="0.5" d="M19.3724 7.28543C20.5844 6.07342 20.5844 4.10834 19.3724 2.89632C18.1604 1.6843 16.1953 1.6843 14.9833 2.89632L14.2832 3.5964C14.2928 3.62534 14.3027 3.6547 14.3131 3.68442C14.5696 4.42405 15.0538 5.39361 15.9646 6.3044C16.8753 7.21518 17.8449 7.69933 18.5845 7.95593C18.6141 7.9662 18.6433 7.9761 18.6722 7.98565L19.3724 7.28543Z" fill="#E2E7FB"/>
                                        <path id="Vector_3" d="M14.312 3.56494L14.2818 3.59508C14.2915 3.62403 14.3013 3.65338 14.3117 3.68311C14.5683 4.42273 15.0524 5.3923 15.9632 6.30309C16.874 7.21386 17.8436 7.69802 18.5832 7.95462C18.6125 7.9648 18.6415 7.97462 18.67 7.98408L11.914 14.7402C11.4585 15.1957 11.2306 15.4235 10.9795 15.6194C10.6833 15.8504 10.3628 16.0486 10.0236 16.2101C9.73613 16.3471 9.43056 16.449 8.81943 16.6528L5.59675 17.727C5.29601 17.8272 4.96444 17.749 4.74028 17.5248C4.51612 17.3006 4.43784 16.9691 4.53809 16.6683L5.61231 13.4456C5.81602 12.8344 5.91788 12.5289 6.0549 12.2414C6.21653 11.9023 6.41462 11.5817 6.64567 11.2855C6.84154 11.0344 7.0693 10.8067 7.52475 10.3512L14.312 3.56494Z" fill="#4A62B4"/>
                                    </g>
                                </svg>
                                Edit
                            </div>  
                            <!-- <button class="btn btn-sm btn-info mb-2" onClick="showisi({{$Pas->id}})">
                            <i  class="fas fa-eye" style="color:#fff; width:20px"></i></button> 
                            <button class="btn btn-sm btn-primary mb-2" onClick="edit({{$Pas->id}})">
                            <i class="fas fa-pencil-alt" style="color:#fff; width:20px"></i></button>  -->
                            <!-- <button class="btn btn-sm btn-danger mb-2" onClick="hapus({{$Pas->id}})">
                            <i  class="fas fa-trash" style="color:#fff; width:20px"></i></button>  -->
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

@include('loadjs.pagination') 
@include('loadjs.searchtable')



