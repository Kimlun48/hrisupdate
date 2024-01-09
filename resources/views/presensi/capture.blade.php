<!DOCTYPE html>
<html>
<head>
    <title>HRIS || ANYAR GROUP</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        //#results { padding:20px; border:1px solid; background:#ccc; }
    </style>
    <!-- bootstrap  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body onload="getLocation()">
    <div class="container"  align="center">
        <br>
        <div class="alert alert-success" align="center">
            <h1>Presensi Camera</h1>
            <h5>PT Anyar Retai Indonesia</h5>
        </div>
        <hr>
            <div class="col-md-6" >
                <div class="card">
                    <div class="card-body d-flex justify-content-center align-item-center">
                        <!-- form  -->
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <form id="form">
                            <!-- kamera webcam akan ditampilkan di dalam id="my_camera" -->
                            <div id="my_camera"></div>
                            <div class="form-group">
                                <!--<label>NIK</label>-->
                                <input type="hidden" class="form-control" name="nik" id="nik" value={{Auth::user()->getkaryawan->nomor_induk_karyawan}} required>
                            </div>
                            
                            <div class="form-group">
                                <label>Cabang LAT</label>
                                <input type="text" class="form-control" name="cablatitude" id="cablatitude" value={{$cek_lat_cabang}}>
                            </div>
                            <div class="form-group">
                                <label>Cabang Long</label>
                                <input type="text" class="form-control" name="cablongitude" id="cablongitude" value={{$cek_lon_cabang}}>
                            </div>

                            <div class="form-group">
                                <label>Live LAT</label>
                                <input type="text" class="form-control" name="lat" id="lat" required>
                            </div>
                            <div class="form-group">
                                <label>Live Long</label>
                                <input type="text" class="form-control" name="long" id="long" required>
                            </div>

                            
                            <button type="submit" id="submitButton" class="tombol-simpan btn btn-primary">Upload presensi</button>
                        </form>
                    </div>
                </div>
            <div class="col-md-6">
                <div id="data">
            </div>
            </div>
        </div>
    </div>
    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- bootstrap js  -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <!-- webcamjs  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script language="JavaScript">
        // menampilkan kamera dengan menentukan ukuran, format dan kualitas 
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        //menampilkan webcam di dalam file html dengan id my_camera
        Webcam.attach('#my_camera');

    </script>
    <script>
                var x = document.getElementById("lat");
		var y = document.getElementById("long");
		function getLocation() {
		  if (navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(showPosition);
		  } else { 
		    x.innerHTML = "Geolocation is not supported by this browser.";
		  }
		}

		function showPosition(position) {
		  x = position.coords.latitude;
		  y = position.coords.longitude;
                  document.getElementById("lat").value= x;
		  document.getElementById("long").value= y;
                  console.log(x,y)

		}
		function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      alert("User denied the request for Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      alert("Location information is unavailable.");
      break;
    case error.TIMEOUT:
      alert("The request to get user location timed out.");
      break;
    case error.UNKNOWN_ERROR:
      alert("An unknown error occurred.");
      break;
  }
}
    </script>

    <script type="text/javascript">
        // saat dokumen selesai dibuat jalankan fungsi update
        $(document).ready(function () {
        getLocation(); 
        });

        // jalankan aksi saat tombol register disubmit
        $(".tombol-simpan").click(function (event) {
            event.preventDefault();
            // membuat variabel image
            var foto = '';
            //mengambil data uername dari form di atas dengan id name
            var name = $('#name').val();
            //mengambil data email dari form di atas dengan id email
            var nik = $('#nik').val();
            var lat = $('#lat').val();
            var long = $('#long').val();
            //memasukkan data gambar ke dalam variabel image
            Webcam.snap(function (data_uri) {
                image = data_uri;
		document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
            });
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //mengirimkan data ke file action.php dengan teknik ajax
            $.ajax({
                url:"{{ url('/presensi/capturestore/') }}",
                type: 'POST',
                data: {
                    foto: foto,
                    lat: lat,
                    long: long,
                    nik: nik,
                    image: image,
                },
                success: function (data, textStatus, xhr) {
                    Swal.fire({
                    icon: 'success',
                    title: data.message,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    timer: 15000
                }).then(function() {
                // Redirect to another page
                window.location.href = "{{ url('/presensi/foto/') }}";
                });
            },
                
                //     //alert('input data berhasil');
                //     // menjalankan fungsi update setelah kirim data selesai dilakukan 
                // // update()
                // },
                error:function(data, textStatus){
                    Swal.fire({
                    icon: 'warning',
                    title:  data.responseJSON.message,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    timer: 15000
                }).then(function() {
                // Redirect to another page
                window.location.href = "{{ url('/presensi/foto/') }}";
                });
                }
            })
        });


        //fungsi update untuk menampilkan data
        // function update() {
        //     $.ajax({
        //         url: '/presensi/foto    ',
        //         type: 'get',
        //         success: function (data) {
        //             $('#data').html(data);
        //         }
        //     });
        // }


        
    </script>
    <!--<script language="JavaScript">
    $(".tombol-simpan").click(function (event) {
    event.preventDefault();
    // mengambil gambar dari webcam
    Webcam.snap(function (data_uri) {
    // menambahkan gambar ke dalam form
    document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
    // menampilkan SweetAlert setelah 2 detik
    // setTimeout(function() {
    // Swal.fire({
    // title: 'Presensi berhasil diupload',
    // text: 'Terima kasih telah melakukan presensi',
    // icon: 'success',
    // timer: 000
    // });
    // // mengaktifkan kamera kembali setelah SweetAlert ditampilkan
    // Webcam.attach('#my_camera');
    // }, 1000);
    });
    });

    </script>
    -->
    </body>

</html>

