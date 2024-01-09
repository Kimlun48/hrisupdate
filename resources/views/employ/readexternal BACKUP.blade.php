

<div class="dropdown mb-2">
  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-plus"></i> Add Employee
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{route('employ.create')}}">Internal</a>
    <a class="dropdown-item" href="{{route('employ.create_external')}}">External</a>
  </div>
</div>
<form>
  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
      <select>
        <option>Select an option</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div id="checkboxes">	
      <label for="one">
        <input type="checkbox" id="one" />First checkbox</label>
      <label for="two">
        <input type="checkbox" id="two" />Second checkbox</label>
      <label for="three">
        <input type="checkbox" id="three" />Third checkbox</label>
    </div>
  </div>
</form>



<div class="form-trans" id="formContainer" style="display: none;">
    <form>
      <button class="btn btn-sm btn-primary" id='transfer' type="button" data-toggle="dropdown" aria-expanded="false"> Transfer Karyawan </button>
    </form>
    <form>
        <button class="btn btn-sm btn-danger" id='transfer' type="button" data-toggle="dropdown" aria-expanded="false"> Cancel </button>
    </form>
  </div>
<div class="dropdown">
<!-- <svg class="dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false" width="21" height="20" viewBox="0 0 21 20" fill="none">
       <path d="M7.3724 18.1253V1.87533M13.6224 18.1253V1.87533M7.9974 18.3337H12.9974C17.1641 18.3337 18.8307 16.667 18.8307 12.5003V7.50033C18.8307 3.33366 17.1641 1.66699 12.9974 1.66699H7.9974C3.83073 1.66699 2.16406 3.33366 2.16406 7.50033V12.5003C2.16406 16.667 3.83073 18.3337 7.9974 18.3337Z" stroke="#626B79" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
</svg> -->

  <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <svg width="21" height="20" viewBox="0 0 21 20" fill="none">
   <path d="M7.3724 18.1253V1.87533M13.6224 18.1253V1.87533M7.9974 18.3337H12.9974C17.1641 18.3337 18.8307 16.667 18.8307 12.5003V7.50033C18.8307 3.33366 17.1641 1.66699 12.9974 1.66699H7.9974C3.83073 1.66699 2.16406 3.33366 2.16406 7.50033V12.5003C2.16406 16.667 3.83073 18.3337 7.9974 18.3337Z" stroke="#626B79" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>
  </button>
  <div class="dropdown-menu check" aria-labelledby="dropdownMenuButton">
    <!-- <p class="dropdown-item"><input type="checkbox" name="check" id="col0Checkbox" onchange="toggleColumn('col0')" checked/> CheckBox</p>
    <p class="dropdown-item"><input type="checkbox" name="check" id="col1Checkbox" onchange="toggleColumn('col1')" checked/> NIK</p>
    <p class="dropdown-item"><input type="checkbox" name="check" id="col2Checkbox" onchange="toggleColumn('col2')" checked/> Name</p> -->
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
<table id="myTable" class="table data-table table-sort">
    <thead>
    <tr class="judul">
         <!-- <th scope="col" class ="table-sort tombols"></th> -->
         <th colspan="2" scope="colku" class="col0"> <input type="checkbox" onclick="pilihsemua(this)" /></th>
         <!-- <th scope="col" class="sortable" onclick="sortTableAngka(1)">No  <span class="sort-icon" id="sortIcon1"></span></th> -->
         <th scope="col" class="colku" onclick="sortTable(1)">Name <span class="sort-icon" id="sortIcon1"></th>
         <th scope="col" class="colku" onclick="sortTable(2)">NIK <span class="sort-icon" id="sortIcon2"></th>
         <th scope="col" class="colku" onclick="sortTable(3)">No Identity <span class="sort-icon" id="sortIcon4"></th>
         <th scope="col" class="colku" onclick="sortTable(4)">Branch <span class="sort-icon" id="sortIcon(5)"></th>
         <th scope="col" class="colku" onclick="sortTable(5)">Position <span class="sort-icon" id="sortIcon(6)"></th>
         <th scope="col" class="colku" onclick="sortTable(6)">Jenis Karyawan <span class="sort-icon" id="sortIcon(7)"></th>
         <th scope="col" class="colku" onclick="sortTable(7)">Years of service <span class="sort-icon" id="sortIcon(8)"></th>
         <th scope="col" class="colku" class="tahuns">aa</th>
         <th scope="col" class="colku" class="tahuns">bb</th>
         <th scope="col" class="colku" class="tahuns">cc</th>
         <th scope="col" class="colku" class="tahuns">dd</th>
         <th scope="col" class="colku" class="tahuns">ee</th>
         <th scope="col" class="colku" class="tahuns">ff</th>
         <th scope="col" class="colku" class="tahuns">gg</th>
         <th scope="col" class="colku" class="tahuns">hh</th>
         <th scope="col" class="colku" class="tahuns">ii</th>
         <th scope="col" class="colku" class="tahuns">jj</th>
         <th scope="col" class="colku">Actions</th>
      </tr>
    </thead>
    <tbody>
    @forelse ($employes as $employ)
        <tr class="isi">
               <td colspan="2" class="nik col0">
                  <input type="checkbox" name="check{{ $employ }}" value="bar{{ $employ }}" onclick="cekPilihan()">
                </td>
               <td class="nama col1" onclick="toprofile({{$employ->id}})">{{ Str::limit($employ->nama_lengkap,15) }}</td>
               <td class="nik col2">{{ $employ->nomor_induk_karyawan }}</td>
               <td class="id col3" id="id">{{ $employ->no_identitas}}</td>
               <td class="cabang col4" id="cabang">{{ $employ->cabang->nama}}</td>
               <td class="posisi col5" id="posisi">{{ Str::limit($employ->jabatan->nama,15) }}</td>
               <td class="tahun col6" id="tahun">{{ $employ->jenis_karyawan }}</td>
               <td class="tahun col7" id="tahun">{{ $employ->get_masakerja() }}</td>
               <td class="col8">aa</td>
               <td class="col9">bb</td>
               <td class="col10">cc</td>
               <td class="col11">dd</td>
               <td class="col12">ee</td>
               <td class="col13">ff</td>
               <td class="col14">gg</td>
               <td class="col15">hh</td>
               <td class="col16">ii</td>
               <td class="col17">jj</td>
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
               </td>
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


@include('loadjs.sepur_table')
