<div class="modal-body">
    
<form id="MyForm">
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
            <select id="mySelect" multiple id="cabang" name="cabang[]" custom-select mr-sm-2>
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
   const select = new Choices('#mySelect', { removeItemButton: true });
   const select2 = new Choices('#mySelect2', { removeItemButton: true });
   const selectedValues = select.getValue();
   const selectedValues2 = select2.getValue();
</script>
<script>
    $(document).ready(function() {
    $('#MyForm').on('submit', function(event) {
        const JikaView = $('#formatdata').val();
        console.log('tesssssssssssssssssssssssssssssssssssssyaaawwwwwwwwwwww')
        if(JikaView == 'view'){
            event.preventDefault(); // Mencegah form submit normal
            var form = $(this);
            var formData = form.serialize(); 
            $.ajax({
                url: "{{ url('presensi/readpresensifilterview_external') }}", // Menggunakan route yang sudah didefinisikan sebelumnya
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
        }
        if(JikaView == 'excel'){
            event.preventDefault(); // Mencegah form submit normal
            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                url: "{{ url('presensi/readpresensifilterview_external') }}", // Menggunakan route yang sudah didefinisikan sebelumnya
                method: "GET",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#modalexport").modal('hide');
                    window.location.href = "{{ route('presensi.readpresensifilterview_external') }}" + "?" + formData;
                },
                error: function(error) {
                    console.error(error);
                }
            });


        };
    });
});
</script>