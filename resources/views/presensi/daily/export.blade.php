<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<div class="modal-body">
    
<form id="MyForm" method="post">
        @csrf
        <div class="form-group">
            <label class="mr-sm-2" for="startdate">Start Date: </label>
            <input type="text" name="startdate" class="ms-1 form-control form-control-sm col-form-input datepicker">
            @error('startdate')
                <div class="alert alert-danger mt-2">
                {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="mr-sm-2" for="enddate">End Date: </label>
            <input type="text" name="enddate" class="ms-1 form-control form-control-sm col-form-input datepicker">
            @error('enddate')
                <div class="alert alert-danger mt-2">
                {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="mr-sm-2" for="inlineFormCustomSelect">Branch</label>
            <select id="choices-select" multiple id="cabang" name="cabang[]" custom-select mr-sm-2>
                <!-- <option value="all-cabang">All Cabang</option> -->
                <option value="select-all">Select All</option>
            @foreach ($cabang as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            @error('cabang')
                <div class="alert alert-danger mt-2">
                {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="mr-sm-2" for="inlineFormCustomSelect">Name Employees:</label>
            <select id="mySelect2" multiple id="karyawan" name="karyawan[]" custom-select mr-sm-2>
            @foreach ($employ as $item)
                <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
            @endforeach
            </select>
            @error('karyawan')
                <div class="alert alert-danger mt-2">
                {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group" >
            <label for="end-date">Format</label>
            <select class="form-control" name="format" value="format" required id="formatdata">
                <option value="view">View</option>
                <option value="excel">Excel</option>
                <option value="Kehadiran">Kehadiran</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
</form>
</div>
<script>
  $(function() {
    // Inisialisasi datepicker
    $(".datepicker").datepicker({
      changeMonth: true, // Enable month dropdown
      changeYear: true,
      dateFormat: "dd-mm-yy", // Format tampilan tanggal
      altFormat: "dd-mm-yy", // Format tanggal yang akan disubmit (dapat disesuaikan sesuai kebutuhan)
      altField: "#datepicker", // ID elemen input yang akan menerima tanggal yang diformat
    });
  });
</script>
<script>
   var select2 = new Choices('#mySelect2', { removeItemButton: true });
   var selectedValues2 = select2.getValue();
    //    const select = new Choices('#mySelect', { removeItemButton: true });
    //    const selectedValues = select.getValue();
</script>
<script>
    $(document).ready(function() {
    $('#MyForm').on('submit', function(event) {
        const JikaView = $('#formatdata').val();
        console.log('aaaaaaaaaaaaaaaaaaaaaaaassssssssssssssssssssssssssssss');
        if(JikaView == 'view'){
            console.log('tessssssssssssssssss');
            event.preventDefault(); // Mencegah form submit normal
            var form = $(this);
            var formData = form.serialize(); 
            $.ajax({
                url: "{{ url('presensi/readpresensifilterview') }}", // Menggunakan route yang sudah didefinisikan sebelumnya
                method: "GET",
                data: formData,
                success: function(response) {
                    $("#modalexport").modal('hide');
                    if(JikaView == 'view'){
                        $("#readpresensi").html(response);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        };
        if(JikaView == 'excel'){
            event.preventDefault(); // Mencegah form submit normal
            var form = $(this);
            var formData = form.serialize();
            console.log('aaaaaaaaaaaaaaaaaaaaaaaaaa');
            $.ajax({
                url: "{{ url('presensi/readpresensifilterview') }}", // Menggunakan route yang sudah didefinisikan sebelumnya
                method: "GET",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#modalexport").modal('hide');
                    window.location.href = "{{ route('presensi.readpresensifilterview') }}" + "?" + formData;
                },
                error: function(error) {
                    console.error(error);
                }
            });

        };
        if(JikaView == 'Kehadiran'){
            event.preventDefault(); // Mencegah form submit normal
            var form = $(this);
            var formData = form.serialize();
            console.log('bbbbbbbbbbbbbbbbbbbbbbbbbbbbbb');
            $.ajax({
                // url: "{{ url('presensi/kehadiran') }}", // Menggunakan route yang sudah didefinisikan sebelumnya
                url: "{{ url('presensi') }}",
                method: "GET",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#modalexport").modal('hide');
                    window.location.href = "{{ url('presensi/kehadiran') }}" + "?" + formData;
                },
                error: function(error) {
                    console.error(error);
                }
            });
        };
    });
});
</script>

<script>
    var choicesSelect = new Choices('#choices-select', {
        removeItemButton: true, // Menampilkan tombol hapus untuk setiap pilihan
        searchPlaceholderValue: 'Cari opsi', // Placeholder untuk kotak pencarian
        shouldSort: false, // Untuk mempertahankan urutan opsi
    });

    // Menemukan elemen "Select All"
    var selectAllOption = choicesSelect._store.choices.find(choice => choice.value === 'select-all');

    // Menambahkan event listener untuk memilih opsi "Select All" di atas
    choicesSelect.passedElement.element.addEventListener('choice', function(event) {
        var selectedValue = event.detail.choice.value;
        if (selectedValue === 'select-all') {
            // Pilih semua opsi kecuali "Select All"
            var selectedChoices = choicesSelect._store.choices
                .filter(choice => choice.value !== 'select-all')
                .map(choice => choice.value);
            choicesSelect.removeActiveItems();
            choicesSelect.setChoiceByValue(selectedChoices);
        } else {
            // Jika "Select All" dipilih bersama dengan opsi lain, batalkan pemilihan "Select All"
            if (selectAllOption && selectAllOption.isSelected) {
                selectAllOption.unselect();
            }
            // Jika "Select All" di-uncheck, pindahkan semua pilihan ke area choice
            else if (!selectAllOption.isSelected) {
                var allChoices = choicesSelect._store.choices.map(choice => choice.value);
                choicesSelect.removeActiveItems();
                choicesSelect.setChoiceByValue(allChoices);
            }
        }
    });
</script>