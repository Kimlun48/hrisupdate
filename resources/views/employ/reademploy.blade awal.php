<div id="employee-content">
  <div class="row conten-head">
  <div class="dropdown">
  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Filter
  </button>
  <div class="dropdown-menu">
  <div class="btn-group dropright">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      Dropright
    </button>
    <div class="dropdown-menu">
      <!-- Dropdown menu links -->
    </div>  
    </div>
    <div class="dropdown-menu dropdown-menu-right">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="checkbox1">
        <label class="form-check-label" for="checkbox1">Checkbox 1</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="checkbox2">
        <label class="form-check-label" for="checkbox2">Checkbox 2</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="checkbox3">
        <label class="form-check-label" for="checkbox3">Checkbox 3</label>
      </div>
    </div>
  </div>
</div>


  <div class="dropdown col-md-2 custom-filter">
    <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <svg width="21" height="20" viewBox="0 0 21 20" fill="none">
        <path d="M7.3724 18.1253V1.87533M13.6224 18.1253V1.87533M7.9974 18.3337H12.9974C17.1641 18.3337 18.8307 16.667 18.8307 12.5003V7.50033C18.8307 3.33366 17.1641 1.66699 12.9974 1.66699H7.9974C3.83073 1.66699 2.16406 3.33366 2.16406 7.50033V12.5003C2.16406 16.667 3.83073 18.3337 7.9974 18.3337Z" stroke="#626B79" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
    <div class="dropdown-menu check" aria-labelledby="dropdownMenuButton">
      <p class="dropdown-item"><input type="checkbox" name="check" id="col3Checkbox" onchange="toggleColumn('col3')" checked/> No Identity</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col4Checkbox" onchange="toggleColumn('col4')" checked/> Column 4</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col5Checkbox" onchange="toggleColumn('col5')" checked/> Column 5</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col6Checkbox" onchange="toggleColumn('col6')" checked/> Column 6</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col7Checkbox" onchange="toggleColumn('col7')" checked/> Column 7</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col8Checkbox" onchange="toggleColumn('col8')" checked/> Column 8</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col9Checkbox" onchange="toggleColumn('col9')" checked/> Column 9</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col10Checkbox" onchange="toggleColumn('col10')" checked/> Column 10</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col11Checkbox" onchange="toggleColumn('col11')" checked/> Column 11</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col12Checkbox" onchange="toggleColumn('col12')" checked/> Column 12</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col13Checkbox" onchange="toggleColumn('col13')" checked/> Column 13</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col14Checkbox" onchange="toggleColumn('col14')" checked/> Column 14</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col15Checkbox" onchange="toggleColumn('col15')" checked/> Column 15</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col16Checkbox" onchange="toggleColumn('col16')" checked/> Column 16</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col17Checkbox" onchange="toggleColumn('col17')" checked/> Column 17</p>
      <p class="dropdown-item"><input type="checkbox" name="check" id="col18Checkbox" onchange="toggleColumn('col18')" checked/> Column 18</p>
    </div>
    <!-- </div>
    <div class="col-md-1"> -->
      <button class="export" data-toggle="modal" data-target="#modaleditinternal">
        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
           <path d="M6.34018 8.13079C6.68532 8.12557 6.96088 7.84155 6.95565 7.49641C6.95044 7.15126 6.66641 6.87571 6.32128 6.88093L6.34018 8.13079ZM14.6735 6.88093C14.3284 6.87571 14.0444 7.15126 14.0391 7.49641C14.0339 7.84155 14.3095 8.12557 14.6546 8.13079L14.6735 6.88093ZM9.87231 14.167C9.87231 14.5121 10.1521 14.792 10.4973 14.792C10.8425 14.792 11.1223 14.5121 11.1223 14.167H9.87231ZM10.4973 1.66699L10.9392 1.22505C10.6951 0.980973 10.2995 0.980973 10.0554 1.22505L10.4973 1.66699ZM7.2637 4.01671C7.01963 4.26079 7.01963 4.65652 7.2637 4.9006C7.50779 5.14467 7.90351 5.14467 8.14759 4.9006L7.2637 4.01671ZM12.8471 4.9006C13.0911 5.14467 13.4868 5.14467 13.7309 4.9006C13.975 4.65652 13.975 4.26079 13.7309 4.01671L12.8471 4.9006ZM13.4141 17.7086H7.58073V18.9586H13.4141V17.7086ZM7.58073 17.7086C6.59721 17.7086 5.89873 17.7081 5.35294 17.6617C4.8149 17.616 4.4829 17.529 4.2207 17.3889L3.63145 18.4912C4.1056 18.7447 4.62817 18.8545 5.247 18.9072C5.85805 18.9591 6.61872 18.9586 7.58073 18.9586V17.7086ZM1.53906 12.917C1.53906 13.4696 1.5388 14.2215 1.58988 14.9301C1.61545 15.285 1.65464 15.6407 1.71617 15.9634C1.77615 16.278 1.86442 16.6005 2.00645 16.8663L3.10886 16.277C3.0541 16.1745 2.99476 15.9952 2.94405 15.7293C2.89488 15.4715 2.86027 15.168 2.83665 14.8403C2.78932 14.1838 2.78906 13.4765 2.78906 12.917H1.53906ZM4.2207 17.3889C3.74829 17.1364 3.36136 16.7494 3.10886 16.277L2.00645 16.8663C2.3755 17.5567 2.941 18.1222 3.63145 18.4912L4.2207 17.3889ZM18.2057 12.917C18.2057 13.4765 18.2055 14.1838 18.1581 14.8403C18.1346 15.168 18.0999 15.4715 18.0507 15.7293C18.0001 15.9952 17.9407 16.1745 17.8859 16.277L18.9883 16.8663C19.1304 16.6005 19.2186 16.278 19.2786 15.9634C19.3401 15.6407 19.3793 15.285 19.4049 14.9301C19.456 14.2215 19.4557 13.4696 19.4557 12.917H18.2057ZM13.4141 18.9586C14.3761 18.9586 15.1367 18.9591 15.7478 18.9072C16.3666 18.8545 16.8891 18.7447 17.3633 18.4912L16.7741 17.3889C16.5119 17.529 16.1799 17.616 15.6419 17.6617C15.0961 17.7081 14.3976 17.7086 13.4141 17.7086V18.9586ZM17.8859 16.277C17.6334 16.7494 17.2465 17.1364 16.7741 17.3889L17.3633 18.4912C18.0538 18.1222 18.6193 17.5567 18.9883 16.8663L17.8859 16.277ZM19.4557 12.917C19.4557 11.955 19.4562 11.1943 19.4043 10.5832C19.3516 9.96438 19.2418 9.44188 18.9883 8.96771L17.8859 9.55696C18.0261 9.81913 18.113 10.1511 18.1588 10.6892C18.2052 11.235 18.2057 11.9335 18.2057 12.917H19.4557ZM16.7741 8.44513C17.2465 8.69763 17.6334 9.08455 17.8859 9.55696L18.9883 8.96771C18.6193 8.27726 18.0538 7.71176 17.3633 7.34271L16.7741 8.44513ZM2.78906 12.917C2.78906 11.9335 2.78959 11.235 2.83601 10.6892C2.88178 10.1511 2.9687 9.81913 3.10886 9.55696L2.00645 8.96771C1.75301 9.44188 1.64315 9.96438 1.59051 10.5832C1.53854 11.1943 1.53906 11.955 1.53906 12.917H2.78906ZM3.63145 7.34271C2.941 7.71176 2.3755 8.27726 2.00645 8.96771L3.10886 9.55696C3.36136 9.08455 3.74829 8.69763 4.2207 8.44513L3.63145 7.34271ZM6.32128 6.88093C5.18006 6.89819 4.3401 6.96392 3.63145 7.34271L4.2207 8.44513C4.62902 8.22685 5.17799 8.14837 6.34018 8.13079L6.32128 6.88093ZM14.6546 8.13079C15.8168 8.14837 16.3657 8.22686 16.7741 8.44513L17.3633 7.34271C16.6547 6.96392 15.8147 6.89819 14.6735 6.88093L14.6546 8.13079ZM11.1223 14.167V1.66699H9.87231V14.167H11.1223ZM8.14759 4.9006L10.9392 2.10893L10.0554 1.22505L7.2637 4.01671L8.14759 4.9006ZM10.0554 2.10893L12.8471 4.9006L13.7309 4.01671L10.9392 1.22505L10.0554 2.10893Z" fill="#626B79"/>
        </svg>
      </button>
    <!-- </div>
    <div class="col-md-2"> -->
    <a href="/employ/bulkupdateinternal" class="Bulk">
        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
         <path d="M3 17.7085C2.65483 17.7085 2.375 17.9884 2.375 18.3335C2.375 18.6787 2.65483 18.9585 3 18.9585V17.7085ZM18 18.9585C18.3452 18.9585 18.625 18.6787 18.625 18.3335C18.625 17.9884 18.3452 17.7085 18 17.7085V18.9585ZM4.70833 10.2419L4.25402 9.81262L4.2528 9.81395L4.70833 10.2419ZM4.15 11.4335L3.53038 11.351L3.52903 11.3626L4.15 11.4335ZM3.84167 14.1335L3.2207 14.0626L3.22049 14.0645L3.84167 14.1335ZM5.4 15.6085L5.29477 14.9925L5.29381 14.9926L5.4 15.6085ZM8.08333 15.1502L8.18857 15.7663L8.19273 15.7655L8.08333 15.1502ZM9.24167 14.5252L8.78728 14.096L8.77982 14.1041L9.24167 14.5252ZM15.9583 2.86687L16.3877 2.41277L16.3866 2.41168L15.9583 2.86687ZM3 18.9585H18V17.7085H3V18.9585ZM4.2528 9.81395C4.06282 10.0162 3.90227 10.2837 3.78461 10.536C3.66652 10.7893 3.56634 11.0812 3.53038 11.351L4.76952 11.5161C4.78355 11.4109 4.83348 11.2445 4.91748 11.0644C5.00189 10.8834 5.09552 10.7425 5.16387 10.6698L4.2528 9.81395ZM3.52903 11.3626L3.2207 14.0626L4.46263 14.2045L4.77097 11.5045L3.52903 11.3626ZM3.22049 14.0645C3.14785 14.7183 3.34392 15.3319 3.78763 15.7527C4.23197 16.174 4.85572 16.3366 5.50619 16.2245L5.29381 14.9926C4.97761 15.0471 4.76803 14.9597 4.64778 14.8457C4.52691 14.731 4.42715 14.5238 4.46284 14.2025L3.22049 14.0645ZM5.50523 16.2246L8.18857 15.7663L7.9781 14.5341L5.29477 14.9925L5.50523 16.2246ZM8.19273 15.7655C8.46339 15.7175 8.75169 15.6034 9.00092 15.4701C9.24875 15.3376 9.51033 15.1582 9.7035 14.9463L8.77982 14.1041C8.71468 14.1755 8.58455 14.2753 8.41157 14.3678C8.23998 14.4595 8.07828 14.5163 7.97394 14.5349L8.19273 15.7655ZM16.5372 7.71321C17.1633 7.05183 17.7125 6.25025 17.7787 5.30316C17.8472 4.32326 17.3907 3.36117 16.3877 2.41277L15.5289 3.32097C16.3677 4.11423 16.5653 4.73548 16.5317 5.216C16.4958 5.72932 16.1867 6.26524 15.6294 6.85387L16.5372 7.71321ZM16.3866 2.41168C15.3871 1.47123 14.4034 1.07363 13.4312 1.19796C12.4916 1.3181 11.7224 1.90897 11.0961 2.57053L12.0039 3.42988C12.5609 2.84143 13.0792 2.50313 13.5897 2.43787C14.0674 2.37678 14.6963 2.53752 15.5301 3.32206L16.3866 2.41168ZM14.7532 8.13064C13.8318 8.0447 12.8466 7.59949 12.0403 6.79324L11.1564 7.67713C12.156 8.6767 13.4082 9.26062 14.637 9.3752L14.7532 8.13064ZM9.696 14.9545L15.1494 9.18212L14.2407 8.32373L8.78728 14.096L9.696 14.9545ZM15.1494 9.18212L16.5372 7.71321L15.6294 6.85387L14.2407 8.32373L15.1494 9.18212ZM12.0403 6.79324C11.3254 6.07838 10.8935 5.22161 10.7455 4.39305L9.515 4.61294C9.70992 5.70398 10.2688 6.78957 11.1564 7.67713L12.0403 6.79324ZM11.0961 2.57053L9.67592 4.07378L10.5845 4.93222L12.0039 3.42988L11.0961 2.57053ZM9.67592 4.07378L4.25402 9.81262L5.16264 10.6711L10.5845 4.93222L9.67592 4.07378Z" fill="#626B79"/>
        </svg>
  </a>
    </div>
    <div class="col-md-2">
      <meta name="_token" content="{{ csrf_token() }}">
      <div class="search-employ">
        <form class="search" id="searchForm">
          <div class="input-group group-search">
            <div class="searching">
              <input type="text" class="search__input" placeholder="Type your text" id="search" name="search">
              <button disabled class="search__button">
                <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                  <!-- SVG path code -->
                </svg>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  
  <div class="form-trans" id="formContainer" style="display: none;">
    <form>
      <button class="btn btn-sm btn-primary" id='transfer' type="button" data-toggle="dropdown" aria-expanded="false">Transfer Karyawan</button>
    </form>
    <form>
      <button class="btn btn-sm btn-danger" id='transfer' type="button" data-toggle="dropdown" aria-expanded="false">Cancel</button>
    </form>
  </div>


<table id="myTable" class="table data-table table-sort">
    <thead>
    <tr class="judul">
         <!-- <th scope="col" class ="table-sort tombols"></th> -->
         <th colspan="2" scope="col" class="col0"> <input type="checkbox" onclick="pilihsemua(this)" /></th>
         <!-- <th scope="col" class="sortable" onclick="sortTableAngka(1)">No  <span class="sort-icon" id="sortIcon1"></span></th> -->
         <th scope="col" class="col1 " onclick="sortTable(1)">Employee name <span class="sort-icon" id="sortIcon1"></th>
         <!-- <th scope="col" class="col2" onclick="sortTable(2)">NIK <span class="sort-icon" id="sortIcon2"></th> -->
         <th scope="col" class="col3" onclick="sortTable(3)">Employee Id <span class="sort-icon" id="sortIcon4"></th>
         <th scope="col" class="col4" onclick="sortTable(4)">Branch <span class="sort-icon" id="sortIcon(5)"></th>
         <th scope="col" class="col9" class="tahuns">Organization</th>
         <th scope="col" class="col5" onclick="sortTable(5)">Job Position <span class="sort-icon" id="sortIcon(6)"></th>
         <!-- <th scope="col" class="col6" onclick="sortTable(6)">Jenis Karyawan <span class="sort-icon" id="sortIcon(7)"></th> -->
         <th scope="col" class="col9" class="tahuns">Job Level</th>
         <th scope="col" class="col9" class="tahuns">Employment Status</th>
         <th scope="col" class="col9" class="tahuns">Join Date</th>
         <th scope="col" class="col9" class="tahuns">End Date</th>
         <th scope="col" class="col9" class="tahuns">Sign Date</th>
         <th scope="col" class="col9" class="tahuns">Resign Date</th>
         <th scope="col" class="col9" class="tahuns">Barcode</th>
         <th scope="col" class="col9" class="tahuns">Email</th>
         <th scope="col" class="col9" class="tahuns">Birth Date</th>
         <th scope="col" class="col9" class="tahuns">Birth Place</th>
         <th scope="col" class="col9" class="tahuns">Address</th>
         <th scope="col" class="col9" class="tahuns">Mobile Phone</th>
         <th scope="col" class="col9" class="tahuns">Relegion</th>
         <th scope="col" class="col9" class="tahuns">Gender</th>
         <th scope="col" class="col9" class="tahuns">Marital Status</th>
         <!-- <th scope="col" class="col7" onclick="sortTable(7)">Years of service <span class="sort-icon" id="sortIcon(8)"></th> -->
         <th scope="col" class="col18">Actions</th>
      </tr>
    </thead>
    <tbody >

    @forelse ($employes as $employ)
        <tr class="isi">
               <td colspan="2" class="nik col0">
                  <input type="checkbox" name="check{{ $employ }}" value="bar{{ $employ }}" onclick="cekPilihan()">
                </td>
               <td class="nama col1 hover-column" onclick="toprofile({{$employ->id}})">{{ Str::limit($employ->nama_lengkap,15) }}</td>
               <!-- <td class="nik col2">{{ $employ->nomor_induk_karyawan }}</td> -->
               <td class="id col3" id="id">{{ $employ->no_identitas}}</td>
               <td class="cabang col4" id="cabang">{{ $employ->cabang->nama}}</td>
               <td class="cabang col4" id="cabang">{{ $employ->bagian->nama}}</td>
               <td class="posisi col5" id="posisi">{{ Str::limit($employ->jabatan->nama,15) }}</td>
               <td class="posisi col5" id="posisi"></td>
               <td class="posisi col5" id="posisi">{{ $employ->status_karyawan}}</td>
               <td class="posisi col5" id="posisi">{{ date('d F Y', strtotime($employ->tahun_gabung)) }}</td>
               <td class="posisi col5" id="posisi">{{ $employ->expired_kontrak}}</td>
               <td class="posisi col5" id="posisi"></td>
               <td class="posisi col5" id="posisi">{{ $employ->tahun_keluar}}</td>
               <td class="posisi col5" id="posisi">{{ $employ->no_finger}}</td>
               <td class="posisi col5" id="posisi">{{ $employ->email}}</td>
               <td class="posisi col5" id="posisi">{{ date('d F Y', strtotime($employ->tgl_lahir)) }}</td>
               <td class="posisi col5" id="posisi">{{ $employ->tempat_lahir}}</td>
               <td class="posisi col5" id="posisi">{{ $employ->alamat}}</td>
               <td class="posisi col5" id="posisi">{{ $employ->no_hp}}</td>
               <td class="posisi col5" id="posisi">{{ $employ->agama}}</td>
               <td class="posisi col5" id="posisi">{{ $employ->gender}}</td>
               <td class="posisi col5" id="posisi">{{ $employ->status_pernikahan}}</td>
               <!-- <td class="tahun col6" id="tahun">{{ $employ->jenis_karyawan }}</td> -->
               <!-- <td class="tahun col7" id="tahun">{{ $employ->get_masakerja() }}</td> -->
               <td class="btn-action col18">
                  <!-- <button type="button" data-toggle="modal" onClick="showexternal({{$employ->id}})" data-id="{{$employ->id}}" class="btn btn-sm btn-info" data-whatever="@mdo">
                  <i class="fas fa-eye" style="color:#fff;"></i></button> -->
                  <div class="btn-group">
                     <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Actions
                     </button>
                     <div class="dropdown-menu">
                        <div class="ms-2">
                           <h6 class="dropdown-header">Action</h6>
                           <button class="btn btn-sm btn-info mb-2" onClick="toprofile({{$employ->id}})">
                              <i class="fas fa-eye"></i></button> Detail
                              <br>

                           <button class="btn btn-sm btn-danger mb-2" onClick="show({{$employ->id}})">
                              <i class="far fa-id-card"></i></button> PHK
                              <br>
                           <button class="btn btn-sm btn-success mb-2" onClick="showedit({{$employ->id}})">
                              <i class="fas fa-edit"></i></button> Edit Karyawan
                              <br>
                           <button class="btn btn-sm btn-primary mb-2" onClick="showtransfer({{$employ->id}})">
                              <i class="fas fa-exchange-alt"></i></button> Transfer
                              <br>
                           <button class="btn btn-sm btn-warning mb-2" onClick="showsp({{$employ->id}})">
                           <i class="fas fa-exclamation-triangle"></i></i></button> SP
                              <br>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="ms-auto">
                           <h6 class="dropdown-header">Document</h6>
                           <a href="/employ/kontrak/{{$employ->id}}" target="_blank" class="btn btn-sm btn-info" style="width: 60px"title="SPHK Download">Kontrak</a>
                           <a href="/employ/pkwt/{{$employ->id}}" target="_blank" class="btn btn-sm btn-info" style="width: 60px"title="PKWT Download">PKWT</a>
                           <a href="/employ/sp/{{$employ->id}}" target="_blank" class="btn btn-sm btn-info" style="width: 60px"title="SP Download">SP</a>
                        </div>
                     </div>
		  </div>
    </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Data belum tersedia.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<select id="showEntries" onchange="cekdatashow()">
  <option value="25">25</option>
  <option value="50">50</option>
  <option value="100">100</option>
</select>

<div class="pagination" id="pagination">
  <a href="#" id="prevPage">Previous</a>
  <a href="#" id="nextPage">Next</a>
</div>

<div id="dataCount"></div>
   
<br><br>
</div>
<div id="table-data"></div> <!-- Menampilkan isi tabel yang difilter -->

<!-- Modal edit internal -->
<div class="modal fade" id="modaleditinternal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Employee Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form untuk filter pencarian -->
        <form class="col" action="{{ route('employ.intetempbulkex') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="cabang">Employment status</label>
                <div class="dropdown custom-dropdown">
                  <button class="form-control dropdown-toggle" style="text-align: left;" type="button" id="employStatusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <i class="fas fa-chevron-down"></i> -->
                    <span id="employStatusSelectedText">Select Employment status</span>
                  </button>
                  <div class="dropdown-menu custom-dropdown-menu" onclick="event.stopPropagation();" aria-labelledby="employStatusDropdown">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="All" name="employ_status[]" id="employStatusCheckboxAll">
                      <label class="form-check-label" for="employStatusCheckboxAll" onclick="event.stopPropagation();">
                        All
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="active" name="employ_status[]" id="employStatusCheckboxActive">
                      <label class="form-check-label" for="employStatusCheckboxActive" onclick="event.stopPropagation();">
                        Active
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="resign" name="employ_status[]" id="employStatusCheckboxResign">
                      <label class="form-check-label" for="employStatusCheckboxResign" onclick="event.stopPropagation();">
                        Resign
                      </label>
                    </div>
                    <!-- <div class="dropdown-close">
                      <button class="btn btn-secondary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="employStatusSelectedBtn">
                        Close
                      </button>
                    </div> -->
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label for="cabang">Branch</label>
                <div class="dropdown custom-dropdown">
                  <button class="form-control dropdown-toggle" style="text-align: left;" type="button" id="branchDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <i class="fas fa-chevron-down"></i> -->
                    <span id="branchSelectedText">Select Branch</span>
                  </button>
                  <div class="dropdown-menu custom-dropdown-menu" onclick="event.stopPropagation();" aria-labelledby="branchDropdown">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="All" name="branch[]" id="branchCheckboxAll">
                      <label class="form-check-label" for="branchCheckboxAll" onclick="event.stopPropagation();">
                        All
                      </label>
                    </div>
                    @foreach($cabs as $cbg)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $cbg->id }}" name="branch[]" id="branchCheckbox{{ $cbg->id }}">
                        <label class="form-check-label" for="branchCheckbox{{ $cbg->id }}" onclick="event.stopPropagation();">
                          {{ $cbg->nama }}
                        </label>
                      </div>
                    @endforeach
                    <!-- <div class="dropdown-close">
                      <button class="btn btn-secondary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="branchSelectedBtn">
                        Close
                      </button>
                    </div> -->
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label for="jabatan">Organization</label>
                <div class="dropdown custom-dropdown">
                  <button class="form-control dropdown-toggle" style="text-align: left;" type="button" id="organizationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <i class="fas fa-chevron-down"></i> -->
                    <span id="organizationSelectedText" >Select Organization</span>
                  </button>
                  <div class="dropdown-menu custom-dropdown-menu" onclick="event.stopPropagation();" aria-labelledby="organizationDropdown">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="All" name="organization[]" id="organizationCheckboxAll">
                      <label class="form-check-label" for="organizationCheckboxAll" onclick="event.stopPropagation();">
                        All
                      </label>
                    </div>
                    @foreach($bgn as $bgn)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $bgn->id }}" name="organization[]" id="organizationCheckboxAll{{ $bgn->id }}">
                        <label class="form-check-label" for="organizationCheckboxAll{{ $bgn->id }}" onclick="event.stopPropagation();">
                          {{ $bgn->nama }}
                        </label>
                      </div>
                    @endforeach
                    <!-- <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="supporting" name="organization[]" id="organizationCheckboxSupporting">
                      <label class="form-check-label" for="organizationCheckboxSupporting" onclick="event.stopPropagation();">
                        Supporting
                      </label>
                    </div> -->
                    <!-- <div class="dropdown-close">
                      <button class="btn btn-secondary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="organizationSelectedBtn">
                        Close
                      </button>
                    </div> -->
                  </div>
                </div>
            </div>
            <button type="submit" style="float: right;" class="btn btn-primary">Export</button>
            <button data-dismiss="modal" style="float: right;" class="btn btn-danger mr-1">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>


@include('loadjs.ical_table')




