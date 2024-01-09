
<div class="row">
<div class="col-sm-3">
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">Employee</div>
  <div class="card-body d-print-inline">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex align-items-center">
          <img src="{{ asset('storage/' . $details->getkaryawan->photo) }}"  class="rounded-circle mr-3" alt="imgtrns" width="55" height="56" float="left">
          <span>{{ $details->getkaryawan->nama_lengkap }} <br> {{ $details->getkaryawan->nomor_induk_karyawan }}</span>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
  <div class="col-sm-3">
  <div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">Effective Date</div>
  <div class="card-body">
   <p class="card-text">{{ $details->tanggal }}</p>
  </div>
</div>
  </div>    
  <div class="col-sm-3">
  <div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">Transfer Type</div>
  <div class="card-body">
   <p class="card-text">{{ $details->type }}</p>
  </div>
</div>
  </div>
  <div class="col-sm-3">
  <div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">Status</div>
  <div class="card-body">
   <p class="card-text">Approved</p>
  </div>
</div>
</div>


<table class="table data-table table-bordered table-hover">
    <thead class="table-head">
        <tr class="table-Dark">
        <th scope="col">Type</th>
        <th scope="col">From</th>
        <th scope="col">To</th>
        </tr>
    </thead>
    <tbody>
        <tr class="isi">
            @if($details->cabang_lama->nama == $details->cabang->nama)
            <td class="name">Branch</td>
              <td class="name">{{ $details->cabang_lama->nama }}</td> <!--Data From-->
              <td class="name">{{ $details->cabang->nama }}</td> <!--Data To-->
            @else
              <td class="name" style="background-color:#ADD8E6">Branch</td>
              <td class="name" style="background-color:#ADD8E6">{{ $details->cabang_lama->nama }} <span class="text-right" style="float:right;">></span></td> <!--Data From-->
              <td class="name" style="background-color:#ADD8E6">{{ $details->cabang->nama }}</td> <!--Data To-->
            @endif
        </tr>
        <tr class="isi">
        @if($details->status_karyawan_lama == $details->status_karyawan )
            <td class="name">Employment Status</td>
              <td class="name">{{ $details->status_karyawan_lama}}</td> <!--Data From-->
              <td class="name">{{ $details->status_karyawan  }}</td> <!--Data To-->
            @else
              <td class="name" style="background-color:#ADD8E6">Employment Status</td>
              <td class="name" style="background-color:#ADD8E6">{{ $details->status_karyawan_lama }} <span class="text-right" style="float:right;">></span></td> <!--Data From-->
              <td class="name" style="background-color:#ADD8E6">{{ $details->status_karyawan  }}</td> <!--Data To-->
            @endif    
        </tr>
        <tr class="isi">
            <td class="name">End Employment Status Date</td>
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data From-->
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data To-->
        </tr>
        <tr class="isi">
            <td class="name">Job Position</td>
            <td class="name">{{ $details->jabatan_lama->nama }}</td> <!--Data From-->
            <td class="name">{{ $details->jabatan->nama }}</td> <!--Data To-->
        </tr>
        <tr class="isi">
            <td class="name">Organization</td>
            <td class="name">{{ $details->bagian_lama->nama }}</td> <!--Data From-->
            <td class="name">{{ $details->bagian->nama }}</td> <!--Data To-->
        </tr>
        <tr class="isi">
            <td class="name">Title</td>
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data From-->
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data To-->
        </tr>
        <tr class="isi">
            <td class="name">Class</td>
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data From-->
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data To-->
        </tr>
        <tr class="isi">
            <td class="name">Grade</td>
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data From-->
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data To-->
        </tr>
        <tr class="isi">
            <td class="name">Cost Center</td>
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data From-->
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data To-->
        </tr>
        <tr class="isi">
            <td class="name">Cost Center Category</td>
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data From-->
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data To-->
        </tr>
        <tr class="isi">
            <td class="name">Approval Line</td>
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data From-->
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data To-->
        </tr>
        <tr class="isi">
            <td class="name">Manager</td>
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data From-->
            <td class="name">{{ $details->getkaryawan->nama_lengkap }}</td> <!--Data To-->
        </tr>
    </tbody>
</table>