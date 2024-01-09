<div class="tableling " id="employee-content">
  <table id="myTable" class="table uppercase-text data-table table-sort text-nowrap table-responsive">
    <thead class="table-head">
      <tr class="judul">
        <th colspan="2" scope="col" class="cckbx sticky-col-ckbx">
          <input type="checkbox" onclick="pilihsemua(this)" />
        </th>
        <th scope="col" class="Employee name sticky-col-name" onclick="sortTable(1)">Employee name <span class="sort-icon" id="sortIcon1"></span></th>
        <th scope="col" class="Employee-Id sticky-col-id" onclick="sortTable(2)">Employee Id <span class="sort-icon" id="sortIcon2"></span></th>
        <th scope="col" class="Branch col3" onclick="sortTable(3)">Branch <span class="sort-icon" id="sortIcon3"></span></th>
        <th scope="col" class=" col4" onclick="sortTable(4)">Type Employee <span class="sort-icon" id="sortIcon4"></span></th>
        <th scope="col" class="Organization col5" onclick="sortTable(5)">Organization <span class="sort-icon" id="sortIcon5"></span></th>
        <th scope="col" class="Job-Position col6" onclick="sortTable(6)">Job Position <span class="sort-icon" id="sortIcon6"></span></th>
        <th scope="col" class="Job-Level col7" onclick="sortTable(7)">Job Level <span class="sort-icon" id="sortIcon7"></span></th>
        <th scope="col" class="Employment-Status col8" onclick="sortTable(8)">Employment Status <span class="sort-icon" id="sortIcon8"></span></th>
        <th scope="col" class="Join-Date col9" onclick="sortTable(9)">Join Date <span class="sort-icon" id="sortIcon9"></span></th>
        <th scope="col" class="End-Date col10" onclick="sortTable(10)">End Date <span class="sort-icon" id="sortIcon10"></span></th>
        <th scope="col" class="End-Date col10" onclick="sortTable(10)">End Date New <span class="sort-icon" id="sortIcon10"></span></th>
        <th scope="col" class="Sign-Date col11" onclick="sortTable(11)">Sign Date <span class="sort-icon" id="sortIcon10"></span></th>
        <th scope="col" class="Resign-Date col12" onclick="sortTable(12)">Resign Date <span class="sort-icon" id="sortIcon11"></span></th>
        <th scope="col" class="Barcode col13" onclick="sortTable(13)">Barcode <span class="sort-icon" id="sortIcon12"></span></th>
        <th scope="col" class="Email col14" onclick="sortTable(14)">Email <span class="sort-icon" id="sortIcon13"></span></th>
        <th scope="col" class="Birth-Date col15" onclick="sortTable(15)">Birth Date <span class="sort-icon" id="sortIcon14"></span></th>
        <th scope="col" class="Birth-Place col16" onclick="sortTable(16)">Birth Place <span class="sort-icon" id="sortIcon15"></span></th>
        <th scope="col" class="Address col17" onclick="sortTable(17)">Address <span class="sort-icon" id="sortIcon16"></span></th>
        <th scope="col" class="Mobile-Phone col18" onclick="sortTable(18)">Mobile Phone <span class="sort-icon" id="sortIcon17"></span></th>
        <th scope="col" class="Relegion col19" onclick="sortTable(19)">Relegion <span class="sort-icon" id="sortIcon18"></span></th>
        <th scope="col" class="Gender 20" onclick="sortTable(20)">Gender <span class="sort-icon" id="sortIcon19"></span></th>
        <th scope="col" class="Marital-Status col21" onclick="sortTable(21)">Marital Status <span class="sort-icon" id="sortIcon20"></span></th>
        <th scope="col" class="Marital-Status col21" onclick="sortTable(21)">jumlah tidak absen <span class="sort-icon" id="sortIcon20"></span></th>
        <th scope="col" class="Actions zui-sticky-col">Actions</th>
      </tr>
    </thead>
    <tbody class="table-body">
      @forelse ($employes as $employ)
      <tr class="isi">
        <td colspan="2" class="costum-checkbox col0 sticky-col-ckbx" style="background-color: #ffffff !important;">
        
          <input type="checkbox" name="check{{ $employ->id }}" value="{{ $employ->id }}" title="{{ $employ->id }}-{{ $employ->nama_lengkap }}" onclick="cekPilihan()">
          <!-- <input type="checkbox" name="check{{ $employ }}" value="bar{{ $employ }}" onclick="cekPilihan()"> -->
        
        <td class="nama hover-column sticky-col-name"  style="background-color: #ffffff !important;">
          <a href="/myinfo/{{$employ->id}}" target="_blank">{{$employ->nama_lengkap}}</a>
        </td>
        <td class="id c sticky-col-id" id="id" style="background-color: #ffffff !important;">{{ $employ->nomor_induk_karyawan}}</td>
        <td class="cabang col3" id="cabang" >{{ $employ->cabang->nama}}</td>               
        <td class="brand col4" >{{ $employ->getjeniskar->nama}}</td>               
        <td class="bagian col5" id="bagian" >{{ $employ->bagian->nama}}</td>
        <td class="jabatan col6" id="jabatan">{{ $employ->jabatan->nama}}</td>
        <td class="level col7" id="level" >{{ isset($employ->jabatan->paramlevel->nama) ? $employ->jabatan->paramlevel->nama : 'Tidak Ada Data' }}</td>
        <td class="posisi col8" id="posisi" >{{ $employ->status_karyawan}}</td>
        <td class="tahun_gabung col9" id="tahun_gabung">{{ date('d F Y', strtotime($employ->tahun_gabung)) }}</td>
        <td class="expired_kontrak col10" id="expired_kontrak">{{date('d F Y', strtotime($employ->expired_kontrak)) }}</td>
        <td class="expired_kontrak col10" id="expired_kontrak">  
          @if(empty($employ->expired_kontrak_baru))
            -
          @else
            {{date('d F Y', strtotime($employ->expired_kontrak_baru)) }}
          @endif
        </td>
        <td class="sign col11" id="sign"></td>
        <td class="tahun_keluar col12" id="tahun_keluar">{{ date('d F Y', strtotime($employ->tahun_keluar)) }}</td>
        <td class="no_finger col13" id="no_finger">{{ $employ->no_finger}}</td>
        <td class="email col14" id="email">{{ $employ->email}}</td>
        <td class="tgl_lahir col15" id="tgl_lahir">{{ date('d F Y', strtotime($employ->tgl_lahir)) }}</td>
        <td class="tempat_lahir col16" id="tempat_lahir">{{ $employ->tempat_lahir}}</td>
        <td class="alamat col17" id="alamat">{{ $employ->alamat}}</td>
        <td class="no_hp col18" id="no_hp">{{ $employ->no_hp}}</td>
        <td class="agama col19" id="agama">{{ $employ->agama}}</td>
        <td class="gender col20" id="gender">{{ $employ->gender}}</td>
        <td class="status_pernikahan col21" id="status_pernikahan">{{ $employ->status_pernikahan}}</td>
        <td class="status_pernikahan col21" id="status_pernikahan">{{ $employ->getAbsensiCount() }}</td>
        <td class="btn-action zui-sticky-col" style="background-color: #ffffff !important;padding: 5px 15px;">
          <div class="btn-group dropleft">
            <button type="button" class="btn acti-btn btn-sm dropdown-toggle" id="btnchg" data-toggle="dropdown" aria-expanded="false">
                Actions
            </button>
            <div class="dropdown-menu scrollable-dropdown" id="drp" style="z-index:-9999;">
              <a class="dropdown-item dtl" onClick="showdetail({{$employ->id}})" style="display: flex; justify-content: space-between; align-items: center;">
                <span>Detail</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                  <g clip-path="url(#clip0_576_45365)">
                    <path d="M7.99935 3C4.66602 3 1.81935 5.07333 0.666016 8C1.81935 10.9267 4.66602 13 7.99935 13C11.3327 13 14.1793 10.9267 15.3327 8C14.1793 5.07333 11.3327 3 7.99935 3ZM7.99935 11.3333C6.15935 11.3333 4.66602 9.84 4.66602 8C4.66602 6.16 6.15935 4.66667 7.99935 4.66667C9.83935 4.66667 11.3327 6.16 11.3327 8C11.3327 9.84 9.83935 11.3333 7.99935 11.3333ZM7.99935 6C6.89268 6 5.99935 6.89333 5.99935 8C5.99935 9.10667 6.89268 10 7.99935 10C9.10602 10 9.99935 9.10667 9.99935 8C9.99935 6.89333 9.10602 6 7.99935 6Z" fill="#616161"/>
                  </g>
                  <defs>
                    <clipPath id="clip0_576_45365">
                      <rect width="16" height="16" fill="white"/>
                    </clipPath>
                  </defs>
                </svg>
              </a>
              <a class="dropdown-item phk" onClick="show({{$employ->id}})" style="display: flex; justify-content: space-between; align-items: center;">
                <span>PHK</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                  <g clip-path="url(#clip0_377_19051)">
                    <path d="M15.0384 3.33301H3.18656C2.36434 3.33301 1.71249 4.07467 1.71249 4.99967L1.70508 14.9997C1.70508 15.9247 2.36434 16.6663 3.18656 16.6663H15.0384C15.8606 16.6663 16.5199 15.9247 16.5199 14.9997V4.99967C16.5199 4.07467 15.8606 3.33301 15.0384 3.33301ZM14.2977 14.9997H3.9273C3.51989 14.9997 3.18656 14.6247 3.18656 14.1663V9.99968H15.0384V14.1663C15.0384 14.6247 14.7051 14.9997 14.2977 14.9997ZM15.0384 6.66634H3.18656V4.99967H15.0384V6.66634Z" fill="#616161"/>
                  </g>
                  <defs>
                    <clipPath id="clip0_377_19051">
                      <rect width="17.7778" height="20" fill="white" transform="translate(0.222656)"/>
                    </clipPath>
                  </defs>
                </svg>
              </a>
              <a class="dropdown-item edit" onClick="showedit({{$employ->id}})" style="display: flex; justify-content: space-between; align-items: center;">
                <span>Edit</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                  <path d="M0 11.247V13.6112C0 13.8289 0.171087 14 0.388835 14H2.75295C2.85405 14 2.95515 13.9611 3.02514 13.8833L11.5173 5.39897L8.60103 2.48271L0.116651 10.9671C0.0388836 11.0449 0 11.1382 0 11.247ZM13.7725 3.14373C14.0758 2.84044 14.0758 2.35051 13.7725 2.04722L11.9528 0.227468C11.6495 -0.0758228 11.1596 -0.0758228 10.8563 0.227468L9.43314 1.6506L12.3494 4.56687L13.7725 3.14373Z" fill="#616161"/>
                </svg>
              </a>
              <a class="dropdown-item sp" onClick="showsp({{$employ->id}})" style="display: flex; justify-content: space-between; align-items: center;">
                <span>SP</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 17 15" fill="none">
                  <path d="M1.78481 14.5H15.2152C16.5886 14.5 17.4447 13.1253 16.758 12.0305L10.0428 1.32111C9.35612 0.226297 7.64388 0.226297 6.9572 1.32111L0.242007 12.0305C-0.444673 13.1253 0.411447 14.5 1.78481 14.5ZM8.5 8.73784C8.00951 8.73784 7.60821 8.36741 7.60821 7.91467V6.26834C7.60821 5.8156 8.00951 5.44517 8.5 5.44517C8.99049 5.44517 9.39179 5.8156 9.39179 6.26834V7.91467C9.39179 8.36741 8.99049 8.73784 8.5 8.73784ZM9.39179 12.0305H7.60821V10.3842H9.39179V12.0305Z" fill="#616161"/>
                </svg>
              </a>
              @if (strtolower($employ->status_karyawan) == 'phk' || strtolower($employ->status_karyawan) == 'resign')
              <a class="dropdown-item rehire" onClick="showtrehire({{$employ->id}})" style="display: flex; justify-content: space-between; align-items: center;">
                <span>Rehire</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                  <path d="M6.66673 11.334H5.33398C3.12484 11.334 1.33398 9.54312 1.33398 7.33398C1.33398 5.12484 3.12484 3.33398 5.33398 3.33398H10.6667C12.8759 3.33398 14.6667 5.12484 14.6667 7.33398C14.6667 9.54312 12.8759 11.334 10.6667 11.334H9.3334M9.3334 11.334L11.3334 13.334M9.3334 11.334L11.3334 9.33398" stroke="#616161" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </a>
              @endif
              <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Document</h6>
                <div class="grp-doc">
                  <a href="/employ/kontrak/{{$employ->id}}" target="_blank" class="btn-doc btn btn-sm" title="SPHK Download">Kontrak</a>
                  <a href="/employ/pkwt/{{$employ->id}}" target="_blank" class="btn-doc btn btn-sm" title="PKWT Download">PKWT</a>
                  <a href="/employ/sp/{{$employ->id}}" target="_blank" class="btn-doc btn btn-sm" title="SP Download">SP</a>
                </div>
            </div>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="14" class="text-center alert alert-danger ">Data belum tersedia.</td>
      </tr>
      @endforelse
    </tbody>
  </table>


  <div class="row">
    <div class="pagination-length col-md-6">
      <label for="length">Row Per Page:</label>
      <select name="length" id="length">
          <option value="10">10</option>
          <option value="20">20</option>
          <!-- Tambahkan pilihan lain sesuai kebutuhan -->
        </select>
    </div>

    <div class="pagination-links col-md-6 d-flex justify-content-end" id="pagination-links">
      {{ $employes->links() }}
    </div>
  </div>


</div>



<script>
  $(document).ready(function () {
    aturTinggiTabel();
  });

  // Fungsi untuk menyesuaikan tinggi tabel berdasarkan jumlah baris
  function aturTinggiTabel() {
    var jumlahBaris = $('#myTable tbody tr').length;

    // Tetapkan tinggi minimum untuk mencegah terlalu kecil
    var tinggiMinimum = 400;

    // Jika jumlah baris kurang dari sepuluh, tetapkan tinggi minimum
    if (jumlahBaris < 6) {
      $('#myTable').css('height', tinggiMinimum + 'px');
      console.log("teesss");
    } else {
      console.log("tos");
      // Jika sepuluh atau lebih, hitung tinggi dinamis
      // Terapkan tinggi dinamis ke kontainer tabel
      $('#myTable').css('height', ''); // Menghapus properti CSS untuk kembali ke default

    }
  }
</script>



<script>
  $(document).ready(function () {
    var isLoading = false; // Tambahkan variabel isLoading

    $(document).on('click', '.pagination a', function (e) {
      e.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      loadPage(page);
    });

    $(document).on('change', '#length', function () {
        var rowsPerPage = parseInt($('#showEntries').val());
        var coba = $("#length").val();
        loadPage(1, coba);
    })

    function loadPage(page) {
      if (isLoading) {
        console.log('Loading is already in progress. Please wait.');
        return;
      }

      isLoading = true; // Set isLoading menjadi true saat memulai pengambilan data

      var coba = $("#length").val();
      var search = $('#search').val();

      // Ambil nilai terpilih dari dropdown
      var statusAktif = $('#employmentCheckbox1').is(':checked') ? 'aktif' : '';
      var statusNonAktif = $('#employmentCheckbox2').is(':checked') ? 'Non Aktif' : '';

      var selectedStatus = [];
      $('.statusCheckbox:checked').each(function () {
        selectedStatus.push($(this).val());
      });

      var selectedCabangs = [];
      $('.cabangCheckbox:checked').each(function() {
        selectedCabangs.push($(this).val());
      });

      var selectedbrand = [];
      $('.brandCheckbox:checked').each(function() {
        selectedbrand.push($(this).val());
      });

      var selectedvendor = [];
      $('.vendorCheckbox:checked').each(function() {
        selectedvendor.push($(this).val());
      });

      var selectedBagians = [];
      $('.tableCheckbox:checked').each(function() {
        selectedBagians.push($(this).val());
      });

      var selectedJabatan = [];
      $('.jabatanCheckbox:checked').each(function() {
        selectedJabatan.push($(this).val());
      });

      var selectedLevel = [];
      $('.levelCheckbox:checked').each(function() {
        selectedLevel.push($(this).val());
      });

      $.ajax({
        url: '/employ/index_read?page=' + page,
        type: 'GET',
        data: {
          status: statusAktif,
          statusNonAktif:statusNonAktif,
          employmentStatus: selectedStatus.join(','),
          employmentcabang: selectedCabangs.join(','),
          employmentbrand: selectedbrand.join(','),
          employmentvendor: selectedvendor.join(','),
          employmentbagian: selectedBagians.join(','),
          employmentjabatan: selectedJabatan.join(','),
          employmentlevel: selectedLevel.join(','),
          choiceValue:coba,
          search:search,
        },
        success: function (data) {
          $('#employee-content').html(data);
          // console.log('Success loading page.');
          $("#length").val(coba);


        },
        error: function () {
          // console.log('Error loading page.');
        },
        complete: function () {
          isLoading = true; // Set isLoading kembali ke false setelah selesai
        }
      });
    }
  });

</script>





<script>
  function showtransferbarubulk() {
      var checkboxes = document.querySelectorAll('td input[type="checkbox"]:checked');
      var values = [];
      var datakar = [];

      for (var i = 0; i < checkboxes.length; i++) {
        var nilai = values.push(checkboxes[i].title);
      }
      $.get("{{ url('/trans/transferonclick/') }}/",
        function(data, status) {
          // // var checkboxes = document.querySelectorAll('td input[type="checkbox"]:checked');
          // console.log('inin=',checkboxes);
          $("#ModalTransLabel").html('Detail karyawan');
          $("#pagetransferbulk").html(data);
          $("#ModalTrans").modal('show');
          $("#inputku").val(values);
        });
    }

    function Close() {
      $("#ModalTransLabel").modal("hide");
      $("#pagetransferbulk").modal("hide");
      $("#ModalTrans").modal("hide");
  }
</script>
  <!-- Untukk Hide Show Form-->

  <!-- Akhir Untuk Hide Show Form--
{{-- </script> --}}

