@extends('layouts.app-master')




<label class="dropdown-item" for="employmentCheckbox1">
  <input class="" type="checkbox" id="employmentCheckbox1" value="Option 1" checked>
  Aktif
</label>

<label class="dropdown-item" for="employmentCheckbox2">
<input class="" type="checkbox" id="employmentCheckbox2" value="Option 2" >
  Resign
</label>

------------

<label class="statusCheckbox" for="employmentCheckbox1">
  <input class="statusCheckbox" type="checkbox" id="employmentCheckbox1" value="PHL" >
    PHL
  </label>
<label class="statusCheckbox" for="employmentCheckbox2">
  <input class="statusCheckbox" type="checkbox" id="employmentCheckbox2" value="aktif" >
    aktif
  </label>
<label class="statusCheckbox" for="employmentCheckbox3">
  <input class="statusCheckbox" type="checkbox" id="employmentCheckbox3" value="permanent" >
  permanent
  </label>


  @foreach ($cabs as $cbg)
    <label class="dropdown-item" for="{{ $cbg->id }}">
      <input class="cabangCheckbox" type="checkbox" id="{{ $cbg->id }}" value="{{ $cbg->id }}">
      {{ $cbg->nama }}
    </label>
  @endforeach

  @foreach ($vendor as $vdr)
  <label class="dropdown-item" for="{{ $vdr }}">
    <input class="vendorCheckbox" type="checkbox" id="{{ $vdr }}" value="{{ $vdr }}">
    {{ $vdr }}
  </label>
@endforeach



<div class="head-employ container">
  <div class="table-body">
    <div class="tabcontent" id="employee">
      <div id="read">
      
      </div>
    </div>
  </div>


</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
    reademploy();
    });

  function reademploy() {
    // Mendapatkan nilai checkbox "Aktif"
    var statusAktif = $('#employmentCheckbox1').is(':checked') ? 'aktif' : '';
    var statusNonAktif = $('#employmentCheckbox2').is(':checked') ? 'Non Aktif' : '';

    var selectedStatus = [];
    $('.statusCheckbox:checked').each(function() {
      selectedStatus.push($(this).val());
    });

    const selectedCabangs = [];
    $('.cabangCheckbox:checked').each(function() {
      selectedCabangs.push($(this).val());
    });

    const selectedvendor = [];
    $('.vendorCheckbox:checked').each(function() {
      selectedvendor.push($(this).val());
    });

    // console.log(statusAktif);
    $.ajax({
      url: "{{ url('/employ/index_read') }}", 
      type: "GET",
      data: { 
        status: statusAktif,
        statusNonAktif:statusNonAktif,
        employmentStatus: selectedStatus.join(','),
        employmentcabang: selectedCabangs.join(','),
        employmentvendor: selectedvendor.join(','),


       },
      success: function(response) {
        // Pastikan Anda memiliki elemen dengan ID 'read' di HTML Anda
        $("#read").html(response); // Perbarui kontennya
        console.log('Permintaan icalll yberhasil dikirim.');
      },
      error: function(xhr, status, error) {
        console.error("Error:", status, error);
        console.log('Permintaan berhasil dikirim.');

      }
    });
  }

  $('#employmentCheckbox1').on('change', function() {
    reademploy();
  });

  // Tambahkan listener onchange pada checkbox "Resign"
  $('#employmentCheckbox2').on('change', function() {
    reademploy();
  });

  $('.statusCheckbox').on('change', function() {
    reademploy();
  });

  $('.cabangCheckbox').on('change', function() {
    reademploy();
  });

  $('.vendorCheckbox').on('change', function() {
    reademploy();
  });


  
</script>
