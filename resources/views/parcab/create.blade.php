<div class="modal-body">
    <form id="createForm">
        <div class="form-group">
            <label for="pasal">Employee Name</label>
            <select class="selectize" name="karyawan[]" data-placeholder="Choose Employee"  style="width: auto;" multiple>
                <option value="" disable>Choose Employee</option>
                @foreach ($kr as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="pasal">Branch Name</label>
            <select class="selectize" name="cabang" data-placeholder="Choose Branch"  style="width: auto;">
                <option value="" disable>Choose Branch</option>
                @foreach ($cabs as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn bg-cancel" onclick="Close()" data-dismiss="modal">Close</button>
    <button type="button" class="btn bg-submit" onclick="saveparam()">Save</button>
</div>

<!-- selectize -->
<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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