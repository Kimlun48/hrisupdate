
<div class="row">
<div class="col-sm-12">
<div class="card bg-light mb-12" style="max-width: 1200px;">
  <div class="card-header">Detail</div>
  <div class="card-body d-print-inline">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex align-items-center">
        @if($ovtime->getkar->photo)
          <img src="{{ asset('storage/' . $ovtime->getkar->photo) }}"  class="rounded-circle mr-3" alt="imgtrns" width="55" height="56" float="left">
          <span>{{ $ovtime->getkar->nama_lengkap }} <br> {{ $ovtime->getkar->nomor_induk_karyawan }}</span>
          <span style="display:flex">{{ $ovtime->status_approve }}</span>
          @else
          <img src="data:image/png;base64,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"  class="rounded-circle mr-3" alt="imgtrns" width="55" height="56" float="left">
          <span>{{ $ovtime->getkar->nama_lengkap }} <br> {{ $ovtime->getkar->nomor_induk_karyawan }}</span>
          <span style="display:flex">{{ $ovtime->status_approve }}</span>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
</div>

</div>
<table class="table table-sm">
  
  <tbody>
    <tr>
      <td>Request date</td>
      <td>{{$ovtime->tanggal}}</td>      
    </tr>
    <tr>
      <td>Overtime</td>
      <td>{{$ovtime->tanggal_overtime}}</td>      
    </tr>
    <tr>
      <td>Duration</td>
      <td>{{$ovtime->durasi}}h</td>      
    </tr>
    <tr>
      <td>Compentation</td>
      <td>{{$ovtime->kompensasi}}</td>      
    </tr>
  </tbody>
</table>