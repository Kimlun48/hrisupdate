<div class="modal-body">
    <form id="createForm">
        <input type="hidden" id="id" name="id" value="{{ $param->id }}">

        <div class="form-group">
            <label for="pasal">Employee Name</label>
            <select class="selectize" name="karyawan" data-placeholder="Choose Employee" style="width: auto;" >
                <option value="" disable>Choose Employee</option>
                @foreach ($kr as $item)
                    <option value="{{ $item->id }}" {{ $param->getkaryawan->id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="pasal">Branch Name</label>
            <select class="selectize" name="cabang" data-placeholder="Choose Branch" style="width: auto;">
                <option value="" disable>Choose Branch</option>
                @foreach ($cabs as $item)
                    <option value="{{ $item->id }}" {{ $param->getcabang->id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="selectize" id="status" name="status">
                <option value="aktif" {{ $param->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $param->status == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
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