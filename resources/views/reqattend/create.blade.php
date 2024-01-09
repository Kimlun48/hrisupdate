<div class="p2">
<form id="myform" enctype="multipart/form-data">
   @csrf
      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Request Date</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="date" id="dt" class="ms-1 form-control" onkeydown='event.preventDefault()' name="tanggal" style="width: 360px;">
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Pick Time</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="time" class="ms-1 form-control" name="clockin" style="width: 360px;">
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Request <span class="wajib">*</span></label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
         <select class="ms-1 form-control" id="jenis" name="jenis" style="width: 360px;">
               <option value="Masuk">Masuk</option>
               <option value="Pulang">Pulang</option>
         </select>
         </div>
      </div> 

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Reason</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
           <textarea type="text" class="ms-1 form-control form-control-sm col-form-input" name="reason" style="width: 360px;"></textarea>
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


<script>

   const datePicker = document.getElementById("dt");
   datePicker.min = getDate(-3);
   datePicker.max = getDate();
   function getDate(days) {
      let date;

      if (days !== undefined) {
         date = new Date(Date.now() + days * 24 * 60 * 60 * 1000);
      } else {
         date = new Date();
      }

      const offset = date.getTimezoneOffset();

      date = new Date(date.getTime() - (offset*60*1000));

      return date.toISOString().split("T")[0];
   }
   
</script>
