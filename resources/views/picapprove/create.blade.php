<div class="modal-body">
    <form id="createForm">
        <div class="form-group">
            <label for="pasal">Employee Name</label>
            <select class="selectize" name="nama[]" data-placeholder="Choose Employee"  style="width: auto;" multiple>
                <option value="" disable>Choose Employee</option>
                @foreach ($kar as $item)
                    <option value="{{ $item->id }}">{{$item->nomor_induk_karyawan}} - {{ $item->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="pasal">Pic Name</label>
            <select class="selectize" name="pic" data-placeholder="Choose PIC"  style="width: auto;">
                <option value="" disable>Choose PIC</option>
                @foreach ($kar as $item)
                    <option value="{{ $item->id }}">{{$item->nomor_induk_karyawan}} - {{ $item->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn bg-cancel" onclick="Close()" data-dismiss="modal">Close</button>
    <button type="button" class="btn bg-submit" onclick="createpic()">Save</button>
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
            // create: true,
            placeholder: placeholder,
            multiple: multiple, // Set the 'multiple' option based on the attribute of the select element
        });
    });
</script>