@extends('layouts.app-master')

@section('content-employ')
    <div class="vacancies">
        <div class="container">
            <div class="head">
                <span class="title-applicant">Vacancies</span>
            </div>
            <div class="row">

                <div class="col-md-7 justify-content-start">
                    <a href="{{ route('loker.create') }}" class="text-decoration-none btn btn-sm btn-add text-light" >Add New Vacancies</a>
                </div>

                <div class="col-md-2 d-flex justify-content-end">
                    <span class="text-switch mr-2 mt-2" id="statusText">Active</span>
                    <label class="switch mt-1">
                        <input type="checkbox" id="toggleStatus" checked>
                        <span class="slider round"></span>
                    </label>            
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" placeholder="Search" id="search" name="search">
                    </div>
                </div>

            </div>
           
            <!-- <hr class="border"></hr> -->
            <div class="table-body">
                <!-- <h5 class="list-applicant">Data Quota Cuti</h5> -->
    
                <div id="read" class=""></div>
            </div>
        </div>
    </div>


    
    @include('loker.partials.script')


    <script type="text/javascript">
        var isChecked = true; // Set nilai awal menjadi true (active)
    
        $(document).ready(function() {
            loadVacanciesData();
            var isLoading = false; // Tambahkan variabel isLoading
        });
    
            var isLoading = false; // Tambahkan variabel isLoading

        $('#toggleStatus').change(function() {
            isChecked = $(this).prop('checked');
            var status = isChecked ? 'active' : 'nonactive';
    
            loadVacanciesData();
            $('#statusText').text(isChecked ? 'Active' : 'Non Active');
        });

        

    
        function loadVacanciesData() {
            // if (isLoading) {
            //     console.log('Loading is already in progress. Please wait.');
            //     return;
            // }
            isLoading = true; // Set isLoading menjadi true saat memulai pengambilan data
            // Menggunakan variabel isChecked yang sudah diset pada change
            var search = $('#search').val();
            var coba = $("#length").val();
            $.ajax({
                url: '/loker/readdata',
                type: 'GET',
                data: {
                    status: isChecked ? 'active' : 'nonactive',
                    search: search,
                    choiceValue:coba,
                },
                success: function(data) {
                    $('#read').html(data);
                    
                },
                complete: function() {
                    isLoading = true; // Set isLoading kembali ke false setelah selesai
                }
            
            });
        
        }
      
    
        // $('#search').on('keyup', function() {
        //     loadVacanciesData();
        // });

        $('#search').on('keyup', function() {
            var searchValue = $('#search').val();

            // Tambahkan kondisi di sini sesuai dengan keinginan Anda
            if (searchValue.length >= 3) {
                loadVacanciesData();
                isLoading = true;

            } else {
                // Kondisi jika panjang kurang dari 3
                // Menetapkan data dari AJAX sebagai konten awal
                // $('#read').html("Data dari AJAX sebelumnya");
                loadVacanciesData();
                isLoading = true;

                // Anda juga bisa menetapkan konten lain atau tindakan lain sesuai kebutuhan
                // Contoh: $('#read').html("Ketik setidaknya 3 karakter untuk mencari...");
            }
        });


    </script>
    
    
    
    

@endsection

