@extends('layouts.app-master')

@section('content')
</body>
<div class="applicant">
  <div class="container">
    <h5 class="title-applicant">Tunjangan Karyawan</h5>
      <!-- <hr class="border"></hr> -->
        <div class="table-body">
          <h5 class="list-applicant">Tunjangan Karyawan</h5>
            <!-- <button class="btn btn-sm btn-primary mt-1 d-flex me-auto" onClick="create()"><a  class="text-decoration-none text-light" >Add Karyawan</a></button>
            <button class="btn btn-sm btn-primary mt-1 d-flex me-auto" onClick="createcomponen()"><a  class="text-decoration-none text-light" >Add Component</a></button> -->
            <button type="button" class="btn btn-sm btn-primary mt-1 d-flex me-auto" data-toggle="modal" data-target=".bd-example-modal-lg">Add Kar</button>
            <button type="button" class="btn btn-sm btn-primary mt-1 mb-1 d-flex me-auto" data-toggle="modal" data-target=".bd-example-modal-lg-komponen">Add Komponen</button>
        <div>
    <table class="table table-bordered">
    <!-- <form id="createForm" method = "Post" action="/tunkar/store/" enctype="multipart/form-data">  -->
    <form id="createForm"> 
        @csrf
        <thead>
        <tr>
            <th  class="align-middle">Employee ID</th>
            <th  class="align-middle">Name</th>
            <th  class="align-middle">Component</th>
            <th  class="align-middle">type</th>
            <th  class="align-middle">Salary</th>
            <th  class="align-middle">Change Salary</th>
        </tr>
        </thead>
        <tbody>
        
        <tr>
            <td></td>
            <td id="target"></td> 
            <td id ="targettunjangan"></td>
            <td id="type"></td>
            <td id ="targetnominaltunjanganaa"></td>        
            <td id="targetchangenominal"></td>
            <!-- <input type="text" class="form-control dataparam mb-1" id="0" name="inputparamku" value="1-MAKAN-Tunjangan Tetap">
<input type="text" class="form-control dataparam mb-1" id="0" name="inputparamku" value="2-TRANSPORT-Tunjangan Tetap">
<input type="text" class="form-control dataparam mb-1" id="1" name="inputparamku" value="1-MAKAN-Tunjangan Tetap">
<input type="text" class="form-control dataparam mb-1" id="1" name="inputparamku" value="2-TRANSPORT-Tunjangan Tetap">
<input type="text" class="form-control dataparam mb-1" id="2" name="inputparamku" value="1-MAKAN-Tunjangan Tetap">
<input type="text" class="form-control dataparam mb-1" id="3" name="inputparamku" value="2-TRANSPORT-Tunjangan Tetap"> -->
            
            <!-- <td id ="targetnominaltunjanganaa"></td> -->
            <!-- <input type="text" class="form-control datanominal mb-1" id="undefined" name="1-MAKAN-Tunjangan Tetap" value="1">
<input type="text" class="form-control datanominal mb-1" id="undefined" name="2-TRANSPORT-Tunjangan Tetap" value="2">
<input type="text" class="form-control datanominal mb-1" id="undefined" name="1-MAKAN-Tunjangan Tetap" value="3">
<input type="text" class="form-control datanominal mb-1" id="undefined" name="2-TRANSPORT-Tunjangan Tetap" value ="3">
<input type="text" class="form-control datanominal mb-1" id="undefined" name="1-MAKAN-Tunjangan Tetap" value="4">
<input type="text" class="form-control datanominal mb-1" id="undefined" name="2-TRANSPORT-Tunjangan Tetap" value="5"> -->
            
        </tr>
        </tbody>
          
    </table>
    <button type="submit" class="btn btn-success" style="float:right;" id="savecuy">Simpan Cuyy</button>
    </form>
        <p id="tes" hidden></p>
    <!-- <table class="table" style="width:100%;">
        <thead>
            <tr>
                <th rowspan="3" style="text-align:middle;">Name</th>
            </tr>
            <tr>
                <th colspan="2">tunjangan</th>
            </tr>
            <tr>
                <td style="width:540px;">nama</td>
                <td >Nilai</td>
            </tr>
        </thead>
        <tbody>
        
            <tr>
            <td id="target"></td>
            </tr>
                
                <tr>
                    
                    <td id ="targettunjangan"></td>
                    <td>aa</td>
                </tr>   
                
            </tr>
            
             <div id="cobaaaan"></div>
             <div id="target"></div> 
        </tbody>
    </table> -->
    <!-- <button type="submit" class="btn btn-success" style="float:right;" onclick="savestore()">Simpan Cuyy</button>
    </form> -->
</div>
      </div>
  </div>
</div>

 <!-- Large modal Add Karyawan-->
 <div class="modal fade bd-example-modal-lg" id="modaldata" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
            <div class="modal-content" >
                <div class="col-md-12 d-flex">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- <label for="items">Items</label> -->
                            <button type="button" id="btn-add-all" class="btn btn-primary mb-2">=></button>
                            <select name="items[]" id="items" style="min-width: 300px;width: 300px;height: 350px;" multiple>
                                 @foreach ($kar as $kar)
                                    <option value="{{$kar->id}}-{{ $kar->nama_lengkap }}" class="dataku" name="{{ $kar->id }}">{{ $kar->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="btn-add" class="btn btn-primary">Add</button>
                            <button type="button" id="btn-remove" class="btn btn-primary">Remove</button>

                        </div>

                        <div class="col-md-4">
                            <button type="button" id="btn-remove-all" class="btn btn-primary mb-2"><=</button>
                            <!-- <label for="selected">Terpilih</label> -->
                            <select name="selectedItems[]" id="selected" style="min-width: 300px;width: 300px;height: 350px;" multiple></select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                   <div class="col-md-12">
                       <button type="button" id="btn-save" class="btn btn-primary" style="float:right;">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal Komponen -->
<div class="modal fade bd-example-modal-lg-komponen" id="modalkomponen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="col-md-12 d-flex">
            <div class="row">
                <div class="col-md-4">
                    <!-- <label for="items">Items</label> -->
                    <button type="button" id="btn-add-all" class="btn btn-primary mb-2">Pindah Kanan =></button>
                    <select name="items[]" id="paramitems" style="min-width: 300px;width: 300px;height: 350px;" multiple>
                        @foreach ($param as $par)
                            <option value="{{$par->id}}-{{$par->nama}}-{{$par->status_tunjangan}}" class="dataparamku" name="{{ $par->id }}">{{ $par->id }}-{{$par->nama}}-{{$par->status_tunjangan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="button" id="btn-add-param" class="btn btn-primary">Add</button>
                    <button type="button" id="btn-remove-param" class="btn btn-primary">Remove</button>
                    </div>
                <div class="col-md-4">
                    <button type="button" id="btn-remove-all" class="btn btn-primary mb-2"><= Pindah Kiri</button>
                    <!-- <label for="selected">Terpilih</label> -->
                    <select name="selectedItems[]" id="paramselected" style="min-width: 300px;width: 300px;height: 350px;" multiple></select>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="button" id="btn-save-param" class="btn btn-primary" style="float:right;">Simpan</button>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- Akhir Modal Komponen -->
<script>
    // Get references to the select elements
    var itemsSelect = document.getElementById('items');
    var selectedSelect = document.getElementById('selected');
    var show = document.getElementById('tes');
    

    
    // Add event listener to add button
    document.getElementById('btn-add').addEventListener('click', function() {
        moveItems(itemsSelect, selectedSelect);
        console.log('ini broo',selectedSelect)
    });

    // Add event listener to remove button
    document.getElementById('btn-remove').addEventListener('click', function() {
        moveItems(selectedSelect, itemsSelect);
        
    });

    // Add event listener to SHOW TES
    document.getElementById('btn-save').addEventListener('click', function() {
        cekclas();
        moveshowItems(selectedSelect, show);
        
        // Menutup modal
        // $('#modaldata').modal('hide');
        // $('body').removeClass('modal-open');
        // $('.modal').hide();
        // $('.modal-backdrop').remove();
    });
 

    // Add event listener to add all button
    document.getElementById('btn-add-all').addEventListener('click', function() {
        moveAllItems(itemsSelect, selectedSelect);
    });

    // Add event listener to remove all button
    document.getElementById('btn-remove-all').addEventListener('click', function() {
        moveAllItems(selectedSelect, itemsSelect);
    });

    // Function to move selected items between select elements
    function moveItems(source, destination) {
        var selectedOptions = Array.from(source.selectedOptions);
        selectedOptions.forEach(function(option) {
            destination.appendChild(option);
        });
    }

    // Function to move all items between select elements
    function moveAllItems(source, destination) {
        var options = Array.from(source.options);
        options.forEach(function(option) {
            destination.appendChild(option);
            
        });
        
    }

    // Function to move all selectselected to show
    function moveshowItems(source, destination) {
        var options = Array.from(source.options);
        options.forEach(function(option) {
            destination.appendChild(option);
            cekclas();
        });
    }
    // // Add event listener to save button
    // document.getElementById('btn-save').addEventListener('click', function() {
    //     var selectedItems = Array.from(selectedSelect.options).map(function(option) {
    //         return option.value;
    //     });

    //     // Mengirim data ke server menggunakan AJAX
    //     var formData = new FormData();
    //     formData.append('selectedItems', selectedItems);

    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', "{{ url('/tunkar/store') }}", true);
    //     xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === XMLHttpRequest.DONE) {
    //             if (xhr.status === 200) {
    //                 console.log(xhr.responseText);
    //                 // Handle response from the server
    //                 // Tampilkan pesan sukses atau lakukan tindakan lain yang diinginkan
    //             } else {
    //                 console.error('Error:', xhr.status);
    //                 // Handle error response from the server
    //                 // Tampilkan pesan error atau lakukan tindakan lain yang diinginkan
    //             }
    //         }
    //     };
    //     xhr.send(formData);
    // });


// Menambahkan elemen input ke dalam elemen dengan ID "form-container"
var formContainer = document.getElementById('form-container');
formContainer.innerHTML = formInputs;

</script>
<script>
    // function cekclas() {
    //     var a = $(".dataku"); // Mendapatkan elemen dengan kelas "dataku"
    //     // var b = a.split(" ");
    //     console.log('jum aaaaa',a.find(''));
    //     // var dataArray = [a];
    //     // var firstElement = [];
    //     // // console.log('aaaaa',dataArray());
    //     // a.each(function() {
    //     // var dataText = $(this).text(); // Mendapatkan teks dari setiap elemen
    //     // var splittedData = dataText.split(","); // Memecah teks menjadi array menggunakan koma sebagai pemisah
    //     // dataArray.push(splittedData); // Menyimpan hasil pecahan ke dalam array
    //     // });

    //     // console.log('ini===',dataArray[0]);
    // };
</script>
 <script>
    function cekclas() {
    var a = selectedSelect[0] ;
    // var b= [a];
    console.log('aaaaaaa11 iddd=', a.value);
    var ini = a.value+'-';
    var jadi = ini.split("-");
    // console.log('cekkkkkkk =',a[0]);
    // $("#cobaaaan").append(a.value+'-');

    var inputElement = document.createElement("input");
    inputElement.type = "text";
    inputElement.className = "form-control datasubmit mb-1";
    inputElement.id = a.value;
    inputElement.name = "inputku[]";
    // inputElement.value =a.value;
    inputElement.setAttribute("value", a.value);
    // Menemukan elemen target tempat Anda ingin menambahkan elemen input
    var targetElement = document.getElementById("target");

    // Menambahkan elemen input ke dalam elemen target
    targetElement.appendChild(inputElement);

    var dataElements = document.querySelectorAll('.dataku');
    dataElements.forEach(function(element) {
    // console.log(element.textContent);
});
    };
    
</script>

<!-- Js Add Param -->
<script>
    // Get references to the select elements
    var itemsSelectparam = document.getElementById('paramitems');
    var selectedSelectparam = document.getElementById('paramselected');
    var showparam = document.getElementById('targettunjangan');
    

    
    // Add event listener to add button
    document.getElementById('btn-add-param').addEventListener('click', function() {
        moveItems(itemsSelectparam, selectedSelectparam);
        // console.log('ini broo',selectedSelectparam)
    });

    // Add event listener to remove button
    document.getElementById('btn-remove-param').addEventListener('click', function() {
        moveItems(selectedSelectparam, itemsSelectparam);
        
    });

    // Add event listener to SHOW TES
    document.getElementById('btn-save-param').addEventListener('click', function() {
        moveshowItemsParam(selectedSelectparam, showparam);
        // Menutup modal
        // $('#modalkomponen').modal('hide');
        // $('body').removeClass('modal-open');
        // $('.modal').removeClass('show');
        // $('.modal-backdrop').remove();
    });
 

    // Add event listener to add all button
    document.getElementById('btn-add-all-param').addEventListener('click', function() {
        moveAllItems(itemsSelectparam, selectedSelectparam);
    });

    // Add event listener to remove all button
    document.getElementById('btn-remove-all-param').addEventListener('click', function() {
        moveAllItems(selectedSelectparam, itemsSelectparam);
    });

    // Function to move selected items between select elements
    function moveItems(source, destination) {
        var selectedOptions = Array.from(source.selectedOptions);
        selectedOptions.forEach(function(option) {
            destination.appendChild(option);
        });



    }

    // Function to move all items between select elements
    function moveAllItems(source, destination) {
        var options = Array.from(source.options);
        options.forEach(function(option) {
            destination.appendChild(option);
            
        });
        
    }

    // Function to move all selectselected to show
    function moveshowItemsParam(source, destination) {
        var dataawal = document.getElementsByClassName("datasubmit"); 
        for (let i = 0; i < dataawal.length; i++) {
                var element = dataawal[i];
                var data_awal_id = element.id;

                var options = Array.from(source.options);
                options.forEach(function(option) {
                var string = option.value;
                var parts = string.split("-");
                var nama = parts[1]+"[]";

                var inputtunjanganaa = document.createElement("input");
                inputtunjanganaa.type = "text";
                inputtunjanganaa.className = "form-control dataparam mb-1";
                inputtunjanganaa.id = option.value;
                // inputtunjanganaa.id = data_awal_id;
                inputtunjanganaa.name = nama;
                // inputtunjanganaa.name = "inputparamku[]";
                inputtunjanganaa.value = option.value;
                inputtunjanganaa.setAttribute("value", option.value);
                // destination.appendChild(inputtunjanganaa);
                // Mendapatkan Id Karyawan
                var str = dataawal[i].value;
                var res = str.split("-");
                // Mendapatkan Id Parameter
                var opv = option.value;
                var res_opv = opv.split("-");
                
                var nilaiku="";
                var nilaitext="";
                var nilaichange="";
                    $.ajax({
                    url: "{{ url('/tunkar/cekkomponen') }}/" + res[0],
                    // url: "{{ url('/tunkar/cekkomponen') }}/" + option.value[0],
                    success: function(data, textStatus, xhr) {
                        $('#nilaikuu-'+res[0]+'-'+res_opv[0]).val(data.data);
                        $('#nilaitext-'+res[0]+'-'+res_opv[0]).val(data.data);
                        $('#nilaichange-'+res[0]+'-'+res_opv[0]).val(data.data);
                        nilaiku = data.data;
                        nilaitext = data.data;
                        nilaichange = data.data;
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(errorThrown);
                    }
                    });
                    nilai = nilaiku;
                    nilaitext = nilaiku;
                    nilaichange = nilaiku;
                var inputnominaltunjanganaa = document.createElement("input");
                inputnominaltunjanganaa.type = "text";
                inputnominaltunjanganaa.className = "form-control datanominal defult mb-1";
                // inputnominaltunjanganaa.id = options.value;
                inputnominaltunjanganaa.id = "nilaikuu-"+res[0]+"-"+res_opv[0];
                // inputnominaltunjanganaa.name = option.value;
                inputnominaltunjanganaa.name = "nominal_param";
                // inputnominaltunjanganaa.value = nilai;
                inputnominaltunjanganaa.setAttribute("value", nilai);

                var textnominaltunjanganaa = document.createElement("input");
                textnominaltunjanganaa.type = "text";
                textnominaltunjanganaa.className = "form-control datanominal tunjangan mb-1";
                // inputnominaltunjanganaa.id = options.value;
                textnominaltunjanganaa.id = "nilaitext-"+res[0]+"-"+res_opv[0];
                // inputnominaltunjanganaa.name = option.value;
                textnominaltunjanganaa.name = "nominal_text";
                // inputnominaltunjanganaa.value = nilai;
                textnominaltunjanganaa.setAttribute("value", nilaitext);
                
                var changenominal = document.createElement("input");
                changenominal.type = "text";
                changenominal.className = "form-control datanominal change mb-1";
                // inputnominaltunjanganaa.id = options.value;
                changenominal.id = "nilaichange-"+res[0]+"-"+res_opv[0];
                // inputnominaltunjanganaa.name = option.value;
                changenominal.name = "nominal_change";
                // inputnominaltunjanganaa.value = nilai;
                changenominal.setAttribute("value", nilaichange);

                changenominal.addEventListener("input", function() {
                var newValue = changenominal.value;
                if (newValue === "") {
                    inputnominaltunjanganaa.value = nilai; // Set ke nilai default di sini
                } else {
                    inputnominaltunjanganaa.value = newValue;
                }
                });

                changenominal.addEventListener("blur", function() {
                var newValue = changenominal.value;
                if (newValue === "") {
                    inputnominaltunjanganaa.value = nilai; // Set ke nilai default di sini
                }
                });

                var inputkar = document.createElement("input");
                inputkar.type = "hidden";
                inputkar.className = "form-control datanominal mb-1";
                // inputnominaltunjanganaa.id = options.value;
                // inputkar.id = data_awal_id;
                inputkar.id = data_awal_id.split("-")[0];
                inputkar.name ="id_kar_param";
                inputkar.setAttribute("value", data_awal_id.split("-")[0]);
                // targetnominaltunjanganaa.appendChild(inputnominaltunjanganaa);
                destination.appendChild(inputkar);
                destination.appendChild(inputtunjanganaa);
                destination.appendChild(inputnominaltunjanganaa);

                targetchangenominal.appendChild(changenominal);
                targetnominaltunjanganaa.appendChild(textnominaltunjanganaa);

                var namas = Array.from(document.getElementsByClassName("datasubmit"));
                var elemenSebelum = namas[i];

                var inputtambahsubmit1 = document.createElement("p");
                inputtambahsubmit1.type = "text";
                inputtambahsubmit1.className = "form-control datasumbit1 mb-1 hidden"; // Tambahkan class "hidden" di sini
                inputtambahsubmit1.id = "inputtambahsubmit1 =" + i;
                inputtambahsubmit1.name = "inputtambahsubmit1";
                inputtambahsubmit1.value = ".";
                elemenSebelum.parentNode.insertBefore(inputtambahsubmit1, elemenSebelum.nextSibling);
                });

                var namase = document.getElementsByClassName("dataparam");
                var naman = namase[i];

                var inputtambahparam = document.createElement("p");
                inputtambahparam.type = "text";
                inputtambahparam.className = "form-control datatambah mb-1 hidden ";
                inputtambahparam.id = "inputtambahparam =" + i; // Menggunakan ID yang unik berdasarkan indeks
                inputtambahparam.name = "inputtambahparam";
                inputtambahparam.value = ".";
                naman.parentNode.insertBefore(inputtambahparam, naman.firstChild); //menambah appen ke paling akhir 

                var nomi = document.getElementsByClassName("tunjangan");
                var nal = nomi[i];

                var inputtambahnominal = document.createElement("p");
                inputtambahnominal.type = "text";
                inputtambahnominal.className = "form-control datatambah nominal mb-1 hidden";
                inputtambahnominal.id = "inputtambahnominal =" + i; // Menggunakan ID yang unik berdasarkan indeks
                inputtambahnominal.name = "inputtambahnominal";
                inputtambahnominal.value = ".";
                nal.parentNode.insertBefore(inputtambahnominal, nal.firstChild);
                
                var nomi = document.getElementsByClassName("change");
                var nal = nomi[i];

                var inputtambahnominal = document.createElement("p");
                inputtambahnominal.type = "text";
                inputtambahnominal.className = "form-control datatambah change mb-1 hidden";
                inputtambahnominal.id = "changetambahnominal =" + i; // Menggunakan ID yang unik berdasarkan indeks
                inputtambahnominal.name = "changetambahnominal";
                inputtambahnominal.value = ".";
                nal.parentNode.insertBefore(inputtambahnominal, nal.firstChild);
        } 
    }
// Menambahkan elemen input ke dalam elemen dengan ID "form-container"
var formContainer = document.getElementById('form-container');
formContainer.innerHTML = formInputs;

</script>
<!-- Akhir Js Add Param -->

    </div>
  </div>
</div>

<!-- TESSSS -->

<!-- Akhir Tes -->

<!-- Modal edit -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="Modalparam" tabindex="-1" role="dialog" aria-labelledby="ModalparamLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
              <h5 class="modal-title" id="ModalparamLabel"></h5>
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


<script>
//  $(document).ready(function() {
//     $('#createForm').on('submit', function(e) {
//         e.preventDefault();
//         var tes =  document.getElementById("createForm"); 
//         console.log('INI DATANYA 1111===', tes);
//         var formData = $('#createForm').serialize();
//         console.log('INI DATANYA===', formData);
//         $.ajax({
//             url: '/tunkar/store',
//             type: 'POST',
//             data: formData,
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function(response) {
//                 // Handle success response from server
//                 console.log('Data berhasil disimpan.');
//             },
//             error: function(xhr) {
//                 // Handle error response from server
//                 console.log('Terjadi kesalahan saat menyimpan data.', xhr);
//             }
//         });
//     });
// });

// Sudah Bisa Save data karyawannya
//   document.getElementById("createForm").addEventListener("submit", function(event) {
//   event.preventDefault(); // Mencegah aksi default form (misalnya refresh halaman)

//   // Mendapatkan nilai input
//   var inputs = document.querySelectorAll("#target input");
//   var inputValues = Array.from(inputs).map(function(input) {
//     return input.value;
//   });
//   var i_target = 0;
//   // Kirim data melalui AJAX
//   var formData = new FormData();
//   inputValues.forEach(function(value) {
//     formData.append("inputku[]", value);
//     // console.log('ini form===',inputValues[i_target]);
//     i_target++;

//   });
  
//   var xhr = new XMLHttpRequest();
//   xhr.open("POST", "/tunkar/store");
//   xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}"); // Jika menggunakan Laravel CSRF token
//   xhr.onload = function() {
//     if (xhr.status === 200) {
//         console.log('berhasil===',xhr.status);
//         window.location.reload();
//       // Sukses: Lakukan tindakan yang diperlukan setelah pengiriman data berhasil
//       console.log(xhr.responseText);
//     } else {
//       // Gagal: Lakukan tindakan yang diperlukan jika pengiriman data gagal
//       console.log('gagal===',xhr.status);
//       console.error(xhr.responseText);
//     }
//   };
//   xhr.send(formData);
// //   
//   // Reset form jika diinginkan
//   document.getElementById("createForm").reset();
// });

// Kedua Setelah array form kebaca
  document.getElementById("createForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Mencegah aksi default form (misalnya refresh halaman)

  // Mendapatkan nilai input dari elemen dengan ID "target"
  var inputs = document.querySelectorAll("#target input");
  var inputValues = Array.from(inputs).map(function(input) {
    return input.value;
  });

  // Mendapatkan nilai input dari elemen dengan ID "targettunjangan"
  var tunjanganInputs = document.querySelectorAll("#targettunjangan input");
  var tunjanganInputValues = Array.from(tunjanganInputs).map(function(input) {
    // return input.value;
    return input.value;
  });

  // Mendapatkan nilai input dari elemen dengan ID "targetnominaltunjanganaa"
  var nominalInputs = document.querySelectorAll("#targetnominaltunjanganaa input");
  var nominalInputValues = Array.from(nominalInputs).map(function(input) {
    return input.value;
  });


    if (inputValues === tunjanganInputValues) {
        console.log("Good day");
    } else {
     console.log(inputValues,tunjanganInputValues);
    }

  // Menggabungkan semua nilai input dalam satu objek data
  var formData = new FormData();
  formData.append("inputku[]", inputValues);
  formData.append("tunjangan[]", tunjanganInputValues);
  formData.append("nominal[]", nominalInputValues);
 
  
  // Kirim data melalui AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/tunkar/store");
  xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}"); // Jika menggunakan Laravel CSRF token
  xhr.onload = function() {
    if (xhr.status === 200) {
      console.log('berhasil===',xhr.status);
      console.log('inputValues==',inputValues,'tunjanganInputValues==',tunjanganInputValues,'nominalInputValues==',nominalInputValues)
      window.location.reload();
      // Sukses: Lakukan tindakan yang diperlukan setelah pengiriman data berhasil
      console.log(xhr.responseText);
    } else {
      // Gagal: Lakukan tindakan yang diperlukan jika pengiriman data gagal
      console.log('gagal===',xhr.status);
      console.error(xhr.responseText);
    }
  };
  xhr.send(formData);

  // Reset form jika diinginkan
  document.getElementById("createForm").reset();
});

// Bentuk ARray Rapi Tahap3
// document.getElementById("createForm").addEventListener("submit", function(event) {
//   event.preventDefault(); // Mencegah aksi default form (misalnya refresh halaman)

//   // Mendapatkan nilai input dari elemen dengan ID "target"
//   var inputs = document.querySelectorAll("#target input");
//   var inputValues = Array.from(inputs).map(function(input) {
//     return input.value;
//   });

//   // Mendapatkan nilai input dari elemen dengan ID "targettunjangan"
//   var tunjanganInputs = document.querySelectorAll("#targettunjangan input");
//   var tunjanganInputValues = Array.from(tunjanganInputs).map(function(input) {
//     return input.value;
//   });

//   // Mendapatkan nilai input dari elemen dengan ID "targetnominaltunjanganaa"
//   var nominalInputs = document.querySelectorAll("#targetnominaltunjanganaa input");
//   var nominalInputValues = Array.from(nominalInputs).map(function(input) {
//     return input.value;
//   });

//   // Menggabungkan semua nilai input dalam satu objek data
//   var formData = new FormData();
//   formData.append("inputku", inputValues.join(","));
//   formData.append("tunjangan", tunjanganInputValues.join(","));
//   formData.append("nominal", nominalInputValues.join(","));

//   // Kirim data melalui AJAX
//   var xhr = new XMLHttpRequest();
//   xhr.open("POST", "/tunkar/store");
//   xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}"); // Jika menggunakan Laravel CSRF token
//   xhr.onload = function() {
//     if (xhr.status === 200) {
//       console.log('berhasil===',xhr.status);
//       window.location.reload();
//       // Sukses: Lakukan tindakan yang diperlukan setelah pengiriman data berhasil
//       console.log(xhr.responseText);
//     } else {
//       // Gagal: Lakukan tindakan yang diperlukan jika pengiriman data gagal
//       console.log('gagal===',xhr.status);
//       console.error(xhr.responseText);
//     }
//   };
//   xhr.send(formData);

//   // Reset form jika diinginkan
//   document.getElementById("createForm").reset();
// });

</script> 
@endsection


