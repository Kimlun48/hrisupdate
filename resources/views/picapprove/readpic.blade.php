<div class="border-body">
    <div class="row">
        <div class="col-md-9 justify-content-start">
            <button class="btn btn-sm btn-add" onClick="create()"><a  class="text-decoration-none text-light" >Add PIC Approval</a></button>
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
                    <th scope="col" >No</th>
                    <th scope="col" >NIK</th>
                    <th scope="col" >Nama</th>
                    <th scope="col" >Cabang</th>
                    <th scope="col" >></th>
                    <th scope="col" >NIK</th>
                    <th scope="col" >PIC Approval</th>
                    <th scope="col" >Cabang</th>
                    <th scope="col" >Status</th>
                    <th scope="col" >Action</th>   
                </tr>
            </thead>
            <tbody>
            @forelse ($pics as $pic)                    
                <tr class="isi">
                    <td class="nomor">{{ $loop->iteration }}.</td>
                    <td class="name">{{ $pic->get_kar->nomor_induk_karyawan }}</td>
                    <td class="name">{{ $pic->get_kar->nama_lengkap }}</td>
                    <td class="name">{{ $pic->get_kar->cabang->nama }}</td>
                    <td class="name">></td>
                    <td class="name">{{ $pic->get_kar_approve->nomor_induk_karyawan }}</td>
                    <td class="name">{{ $pic->get_kar_approve->nama_lengkap }}</td>
                    <td class="name">{{ $pic->get_kar_approve->cabang->nama }}</td>
                    <td class="status text-uppercase">
                      <div class="bg_status " data-status="{{ $pic->status }}">
                        @if($pic->status == "aktif")
                          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                            <circle cx="6.17969" cy="6.96997" r="6" fill="#4A62B4"/>
                          </svg>
                        @endif
                        {{ $pic->status }}
                      </div>
                    </td>  
                    <td class="actions">
                        <div class="bg-detail" onClick="showisi({{$pic->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                                <path opacity="0.5" d="M2.16602 13.1044C2.16602 14.8804 2.62639 15.4785 3.54715 16.6748C5.38564 19.0632 8.46897 21.7711 12.9993 21.7711C17.5297 21.7711 20.613 19.0632 22.4515 16.6748C23.3723 15.4785 23.8327 14.8804 23.8327 13.1044C23.8327 11.3284 23.3723 10.7303 22.4515 9.5341C20.613 7.1456 17.5297 4.43774 12.9993 4.43774C8.46897 4.43774 5.38564 7.1456 3.54715 9.5341C2.62639 10.7303 2.16602 11.3284 2.16602 13.1044Z" fill="#4A62B4"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.9375 13.1044C8.9375 10.8607 10.7563 9.0419 13 9.0419C15.2437 9.0419 17.0625 10.8607 17.0625 13.1044C17.0625 15.3481 15.2437 17.1669 13 17.1669C10.7563 17.1669 8.9375 15.3481 8.9375 13.1044ZM10.5625 13.1044C10.5625 11.7583 11.6538 10.6669 13 10.6669C14.3461 10.6669 15.4375 11.7583 15.4375 13.1044C15.4375 14.4506 14.3461 15.5419 13 15.5419C11.6538 15.5419 10.5625 14.4506 10.5625 13.1044Z" fill="white"/>
                            </svg>
                        </div>
                        <div class="bg-edit" onClick="edit({{$pic->id}})">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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

@include('loadjs.pagination') 
@include('loadjs.searchtable')


<!-- Modal edit -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="Modalpasal" tabindex="-1" role="dialog" aria-labelledby="ModalpasalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	      <h5 class="modal-title" id="ModalpasalLabel"></h5>
        <button type="button" class="close" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="page" class="p-2"></div>
      </div>
    </div>
  </div>
</div>
            


<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">

    // $(document).ready(function(){
    //   read();
    // });

    

  function read() {
        $.get("{{ url('/picapprove/readpic') }}",{}, 
	    function(data,status){
        $("#read").html(data);
	    });
    }
    
      // Close Modal
    function Close() {
    $("#Modalpasal").modal("hide");
    }

   //Membuat Halaman Modal Dan Form Create
   function edit(id) {
    $.get("{{ url('/picapprove/edit/') }}/"+id,{}, 	    
          function(data,status){
          $("#ModalpasalLabel").html('EDIT PIC APPROVE');
	        $("#page").html(data);
	        $("#Modalpasal").modal('show');    
        });
    }
    
   function create() {
     $.get("{{ url('/picapprove/create') }}",{}, 
          function(data,status){
            $("#ModalpasalLabel").html('ADD PIC APPROVE');
	        $("#page").html(data);
	        $("#Modalpasal").modal('show');    
        });
    }
    
    function showisi(id) {
      $.get("{{ url('/picapprove/showisi/') }}/"+id,{}, 	    
        function(data,status){
            $("#ModalpasalLabel").html('Isi jabatan parent');
            $("#page").html(data);
            $("#Modalpasal").modal('show');    
        });
    }

function storeedit(){
  event.preventDefault();
  var form = $('#editForm')[0];
  var formData = new FormData(form);
  console.log("ini datanya = ", formData)
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:"{{ url('/picapprove/storeedit') }}",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
      $("#page").html('');
      $("#Modalpasal").modal("hide");
      $("#page").html(data);
      read();
      Swal.fire({
        icon: 'success',
          title: data.message,
          showDenyButton: false,
          showCancelButton: false,
          confirmButtonText: 'Yes',
          timer: 1500 
      }).then(function () {
            loadTabContent('pic', 1); // Panggil fungsi untuk menampilkan tab branch setelah AJAX berhasil
        });
    },
      error:function(data){
        
    }
      });
    }

    function createpic() {
    event.preventDefault();
    var form = $('#createForm')[0];
    var formData = new FormData(form);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{ url('/picapprove/storecreate') }}",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data, textStatus, xhr) {
            // Handle success here
            $("#page").html('');
            $("#Modalpasal").modal("hide");
            read();
            $("#page").html(data);
            Swal.fire({
                icon: 'success',
                title: data.message,
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: 'Yes',
                timer: 1500 
            }).then(function () {
            loadTabContent('pic', 1); // Panggil fungsi untuk menampilkan tab branch setelah AJAX berhasil
        });
        },
        error: function (data) {
            // Handle error here
            Swal.fire({
                icon: 'error', // Use 'error' instead of 'Error'
                title: data.responseJSON.message, // Use 'responseJSON' to access the JSON response
                showDenyButton: false,
                showCancelButton: false,
                timer: 2000 
            });
        }
    });
}

    function hapus(id){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  $.ajax({
    url: "{{ url('/picapprove/delete/') }}/" + id,
    type: 'DELETE',
    success: function(data, textStatus, xhr){
      $("#page").html('');
      read();
      Swal.fire({
        icon: 'success',
        title: data.message,
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: 'Yes',
        timer: 1500 
      });
    },
    error:function(data){
    }
  });
}


$(document).ready(function() {
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    
    // Menemukan semua baris dalam tabel
    var rows = $('#myTable tbody tr');
    
    var anyRowMatches = false; // Apakah ada baris yang cocok
    
    rows.each(function() {
      // Mengambil semua teks dalam baris
      var rowText = $(this).text().toLowerCase();
      
      // Memeriksa apakah teks dalam baris cocok dengan nilai pencarian
      if (rowText.includes(value)) {
        $(this).show(); // Menampilkan baris jika cocok
        anyRowMatches = true; // Setel flag menjadi true
      } else {
        $(this).hide(); // Menyembunyikan baris jika tidak cocok
      }
    });
    
    // Memeriksa apakah ada baris yang cocok
    if (!anyRowMatches) {
      // Jika tidak ada baris yang cocok, tampilkan pesan
      $("#myTable tbody").append('<tr id="no-data-row"><td colspan="7"><div class="alert alert-danger text-center">Data yang ada cari tidak tersedia.</div></td></tr>');
    } else {
      // Jika ada baris yang cocok, hapus pesan jika ada
      $("#no-data-row").remove();
    }
  });
});
</script>

<style>
    .has-search .form-control {
    padding-left: 2.375rem;
    border-radius: 10px;

  }

  .has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
  }
</style>



