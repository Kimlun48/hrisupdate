<script>
$(document).ready(function() {
  // console.log("filterTable function called."); // Debug console log
  // Tambahkan event listener pada tombol "Apply"
  // $('.dropdown-item').on('click', filterTable);
  $('#employmentCheckbox1, #employmentCheckbox2, .cabangCheckbox, .statusCheckbox, .tableCheckbox, .jabatanCheckbox, .levelCheckbox, .brandCheckbox, .vendorCheckbox').on('change', filterTable);
  filterTable();
  showRows(); // Call the showRows function when filters change

    


  function filterTable() {
    // Dapatkan nilai checkbox untuk status
    const checkboxAktif = $('#employmentCheckbox1');
    const checkboxResign = $('#employmentCheckbox2');


  // console.log("Checkbox 'aktif' checked:", checkboxAktif.is(':checked'));
  // console.log("Checkbox 'resign' checked:", checkboxResign.is(':checked'));

  // Dapatkan nilai checkbox untuk cabang
  const selectedStatus = [];
  
  if (checkboxAktif.is(':checked')) {
    selectedStatus.push('aktif');
  }
  
  if (checkboxResign.is(':checked')) {
    selectedStatus.push('resign');
  }

  const selectedCabangs = [];
  $('.cabangCheckbox:checked').each(function() {
    selectedCabangs.push($(this).val());
  });

  const selectedemploystat = [];
  $('.statusCheckbox:checked').each(function() {
    selectedemploystat.push($(this).val());
  });

  const selectedbrand = [];
  $('.brandCheckbox:checked').each(function() {
    selectedbrand.push($(this).val());
  });


  const selectedvendor = [];
  $('.vendorCheckbox:checked').each(function() {
    selectedvendor.push($(this).val());
  });


  const selectedBagians = [];
  $('.tableCheckbox:checked').each(function() {
    selectedBagians.push($(this).val());
  });

  const selectedJabatan = [];
  $('.jabatanCheckbox:checked').each(function() {
    selectedJabatan.push($(this).val());
  });

  const selectedLevel = [];
  $('.levelCheckbox:checked').each(function() {
    selectedLevel.push($(this).val());
  });

  const rows = $('#myTable tbody tr');

    rows.each(function() {
      const row = $(this);
      const posisi = row.find('.posisi').data('posisi'); // Dapatkan nilai dari data-posisi
      const cabang = row.find('.cabang').text();
      const bagian = row.find('.bagian').text();
      const jabatan = row.find('.jabatan').text();
      const brand = row.find('.brand').text();
      const vendor = row.find('.vendor').text();
      const level = row.find('.level').text();
      const empoystat = row.find('.posisi').text();

      // console.log("Checkbox 'data' checked:", posisi);

      row.show();

      if (selectedCabangs.length > 0 && !selectedCabangs.includes(cabang)) {
        row.hide();
      } else if (selectedBagians.length > 0 && !selectedBagians.includes(bagian)) {
        row.hide();
      } else if (selectedJabatan.length > 0 && !selectedJabatan.includes(jabatan)) {
        row.hide();
      } else if (selectedbrand.length > 0 && !selectedbrand.includes(brand)) {
        row.hide();
      } else if (selectedvendor.length > 0 && !selectedvendor.includes(vendor)) {
        row.hide();
      } else if (selectedemploystat.length > 0 && !selectedemploystat.includes(empoystat)) {
        row.hide();
      } else if (selectedLevel.length > 0 && !selectedLevel.includes(level)) {
        row.hide();
      } else {
      if (checkboxAktif.is(':checked') && checkboxResign.is(':checked')) {
        // Kedua checkbox dipilih, jadi tampilkan baris tanpa memeriksa status atau posisi
      } else {
        if (selectedStatus.length > 0) {
          // Kondisi status yang sudah ada
          if (
            (selectedStatus.includes('aktif') && posisi !== 'Permanent' && posisi !== 'Probation' && posisi !== 'PHL' && posisi !== 'aktif' && posisi !== 'AKTIF' && posisi !== 'Contract') ||
            (selectedStatus.includes('resign') && posisi !== 'phk' && posisi !== 'PHK' && posisi !== 'Resign')
          ) {
            row.hide();
          }
        }
      }
    }
  });
  }
});

</script>