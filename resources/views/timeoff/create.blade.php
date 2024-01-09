<div class="p2">
<form id="myform" enctype="multipart/form-data">
   @csrf

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Type </label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <div class="form-group">
                  <select name="typeoff" id="typeoff" class="ms-1 form-control form-control-sm col-form-input @error('typeoff') is-invalid @enderror" style="width: 360px;">
                     <option value="" disabled selected>Select Type Off</option>
                     @foreach($types as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                     @endforeach
                  </select>
               </div>
         
            <!-- error message untuk title -->
            @error('typeoff')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Reason </label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" id="note">
            <select name="statusoff" id="statusoff" class="ms-1 form-control form-control-sm col-form-input @error('statusoff') is-invalid @enderror" style="width: 360px;">
               <option value="" disabled selected>Select Status Off</option>
               <!-- Opsi-opsi lain di sini -->
            </select>

            @error('statusoff')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror

         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label"> Date</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="date" id="tanggal" class="ms-1 form-control form-control-sm col-form-input @error('tanggal') is-invalid @enderror"  onkeydown='event.preventDefault()'  name="tanggal"
               value="{{ old('tanggal') }}" style="width: 360px;">
         
            <!-- error message untuk title -->
            @error('tanggal')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Document</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="file" class="ms-1 form-control form-control-sm col-form-input @error('dokumen') is-invalid @enderror" name="dokumen"
               value="{{ old('dokumen') }}" style="width: 360px;">
         
            <!-- error message untuk title -->
            @error('dokumen')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         
         </div>
      </div>

      <div class="mb-3 row row-body">
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="hidden" id="id_karyawan" name="id_karyawan" class="ms-1 form-control form-control-sm col-form-input" value="{{ auth()->user()->getkaryawan->id}}"
            style="width: 360px;"> 
         </div>
      </div>
      

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="store()">Request</button>
         </div>
   </form>
</div>


<!-- UNTUK VALIDASI DATE -->

<script>
   var datePicker = document.getElementById("tanggal");
   var typeOffSelect = document.getElementById("typeoff");

   datePicker.addEventListener("change", handleInputChange);
   typeOffSelect.addEventListener("change", handleInputChange);

   function handleInputChange() {
      handleDateChange(datePicker.value, typeOffSelect.value);
   }

   function handleDateChange(selectedDate, typeoff) {
      let maxDate, minDate;

      if (!typeoff) {
         showAlert("Silakan pilih Type Off terlebih dahulu!");
         resetDatePicker();
         return;
      }

      if (typeoff === "IZIN" || typeoff === "SAKIT") {
         maxDate = getDate(3);
         minDate = getDate();
      } else if (typeoff === "CUTI") {
         maxDate = null;
         minDate = null;
      } else {
         maxDate = null;
         minDate = null;
      }

      setDatePickerLimits(maxDate, minDate);
   }

   function showAlert(message) {
      alert(message);
   }

   function resetDatePicker() {
      datePicker.value = "";
      setDatePickerLimits(null, null);
   }

   function setDatePickerLimits(maxDate, minDate) {
      datePicker.max = maxDate;
      datePicker.min = minDate;
   }

   function getDate(days) {
      let date = new Date(days !== undefined ? Date.now() + days * 24 * 60 * 60 * 1000 : Date.now());
      const offset = date.getTimezoneOffset();
      date = new Date(date.getTime() - offset * 60 * 1000);
      return date.toISOString().split("T")[0];
   }

</script>






<!--UNTUK TYPE DAN SELECT NYA SUSAI TYPE -->
<script>
   function createSelectElement(id, className, width) {
      var select = document.createElement("select");
      select.name = "statusoff";
      select.id = id;
      select.className = className;
      select.style.width = width;
      return select;
   }

   function createTextareaElement(id, className, width) {
      var textarea = document.createElement("textarea");
      textarea.name = "other";
      textarea.id = id;
      textarea.className = className;
      textarea.style.width = width;
      textarea.placeholder = "Enter Status Off";
      return textarea;
   }

   function removeElementById(id) {
      var element = document.getElementById(id);
      if (element) {
         element.remove();
      }
   }

   document.getElementById("typeoff").addEventListener("change", function() {
      var selectedType = this.value;
      var container = document.getElementById("note");
      removeElementById("statusoff");
      removeElementById("textareaInput");

      if (selectedType === "OTHER") {
         var select = createSelectElement("statusoff", "ms-1 mb-3 form-control form-control-sm col-form-input", "360px","hidden");
         select.style.display = "none"; // Menyembunyikan elemen
         var textarea = createTextareaElement("textareaInput", "ms-1 mb-3 form-control form-control-sm col-form-input", "360px");
         container.appendChild(select);
         container.appendChild(textarea);
      } else {
         var select = createSelectElement("statusoff", "ms-1 form-control form-control-sm col-form-input", "360px");
         container.appendChild(select);
      }
   });

   $(document).ready(function() {
      $('#typeoff').change(function() {
         var selectedType = $(this).val();
         var statusDropdown = $('#statusoff');
         statusDropdown.empty();

         // Tambahkan opsi ke dropdown "statusoff" sesuai dengan tipe yang dipilih
         @foreach($pars as $par)
         if ("{{ $par->type }}" === selectedType) {
               statusDropdown.append('<option value="{{ $par->id }}">{{ $par->nama }}</option>');
         } 
         @endforeach
      });
   });
</script>


<script>
    function handleChange(selectElement) {
        var selectedValue = selectElement.value;
        document.getElementById('result').innerHTML = 'Anda memilih: ' + selectedValue;
    }
</script>