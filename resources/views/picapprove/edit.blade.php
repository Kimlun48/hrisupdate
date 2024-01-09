<div class="modal-body">
    <form id="editForm">
        <div class="form-group">
        <input type="hidden" class="form-control form-control-sm col-form-input" name="idpic" value ="{{$pic->id}}">
        </div> 

        <div class="form-group">
            <label for="pasal">Pic Name</label>
            <select class="selectize" name="nama" data-placeholder="Choose PIC"  style="width: auto;">
                <option value="" disable>Employee Name</option>
                @foreach ($kar as $item)
                  <option value="{{ $item->id }}" {{ $item->id == $pic->id_kar  ? 'selected' :''}}>{{ $item->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>



        <div class="form-group">
            <label for="pasal">Pic Name</label>
            <select class="selectize" name="pic" data-placeholder="Choose PIC"  style="width: auto;">
                <option value="" disable>Choose PIC</option>
                @foreach ($kar as $item)
                  <option value="{{ $item->id }}" {{ $item->id == $pic->kar_approve  ? 'selected' :''}}>{{ $item->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control form-control-sm col-form-input" id="status" name="status">
              <option value="aktif" {{ $pic->status == 'aktif'  ? 'selected' :''}} >Aktif</option>
              <option value="nonaktif" {{ $pic->status == 'nonaktif'  ? 'selected' :''}} >Non Aktif</option>
            </select>
        </div>

    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn bg-cancel" onclick="Close()" data-dismiss="modal">Close</button>
    <button type="button" class="btn bg-submit" onclick="storeedit()">Save</button>
</div>


<script>
    // Initialize Selectize elements
    $('.selectize').each(function () {
        var placeholder = $(this).data('placeholder');
        var multiple = $(this).prop('multiple'); // Check if the select should allow multiple selections
        $(this).selectize({
            plugins: ["remove_button", "clear_button"],
            delimiter: ',',
            persist: false,
            create: false,
            placeholder: placeholder,
            multiple: multiple, // Set the 'multiple' option based on the attribute of the select element
        });
    });
</script>