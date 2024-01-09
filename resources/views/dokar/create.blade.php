<form action="/dokar/storecreate" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="input_fields_container" class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-sm">Name</th>
                        <th class="col-sm">Document Name</th>
                        <th class="col-sm">Document Number</th>
                        <th class="col-sm">Storage Location</th>
                        <th class="col-sm">Document Type</th>
                        <th class="col-sm">Document</th>
                        <th class="col-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="input-row">
                        <input type="hidden" name="tanggal[]" value="{{$skr}}">
                        <td class="col-sm" style="width: auto;">
                            <select class="selectize" name="id_kar[]" data-placeholder="Choose Employee"  style="width: auto;">
                                <option value="">Choose Employee</option>
                                @foreach ($kar as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }} - {{ $item->nomor_induk_karyawan }}</option>
                                @endforeach
                            </select>

                        </td>

                        <td class="col-sm">
                            <input class="form-control form-control-sm" type="text" name="nama[]" placeholder="Name">
                        </td>
                        <td class="col-sm">
                            <input class="form-control form-control-sm" type="text" name="nomor_dok[]"  placeholder="Document Number">
                        </td>
                        <td class="col-sm">
                            <input class="form-control form-control-sm" type="text" name="lokasi_penyimpanan[]"  placeholder="Storage Location">
                        </td>

                        <td class="col-sm">
                            <select class="selectize" name="tipe_dok[]" data-placeholder="Choose Document">
                                <option value="">--- Pilih Jenis ---</option>
                                <option value="Ijazah">Ijazah</option>
                                <option value="SK">SK</option>
                                <option value="Kontrak Kerja">Kontrak Kerja</option>
                                <option value="SP">SP</option>
                            </select>
                        </td>
                        <td class="col-sm">
                            <input class="form-control form-control-sm file" type="file" name="dok_file[]"  accept="image/png, image/gif, image/jpeg, application/pdf">
                        </td>
                        <td class="col-sm">
                            <button type="button" class="btn  btn-sm add_field">Add New</button>
                            <button type="button" class="btn btn btn-sm remove_field">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn bg-cancel" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-submit">Submit</button>
    </div>

</form>

<script>
    $(document).ready(function () {
        // Function to destroy Selectize instances



        function destroySelectize(selectizeElements) {
            selectizeElements.each(function () {
                var selectize = $(this)[0].selectize;
                if (selectize) {
                    selectize.destroy();
                }
            });
        }

        // Initialize Selectize elements
        $('.selectize').each(function () {
            var placeholder = $(this).data('placeholder');
            $(this).selectize({
                // create: true,
                placeholder: placeholder,
            });
        });

        var karOptions = [
            @foreach ($kar as $item)
            { id: "{{ $item->id }}", nama_lengkap: "{{ $item->nama_lengkap }} - {{ $item->nomor_induk_karyawan }}" },
            @endforeach
        ];

        var tipeDokOptions = [
            { value: "Ijazah", text: "Ijazah" },
            { value: "SK", text: "SK" },
            { value: "Kontrak Kerja", text: "Kontrak Kerja" },
            { value: "SP", text: "SP" },
        ];

        // Initialize Selectize for "id_kar[]" and "tipe_dok[]"
        $("select[name='id_kar[]']").selectize({
            // plugins: ["restore_on_backspace", "clear_button"],
            // delimiter: " - ",
            // persist: false,
            // maxItems: null,
            valueField: "id",
            labelField: "nama_lengkap",
            searchField: ["nama_lengkap"],
            options: karOptions,
        });

        $("select[name='tipe_dok[]']").selectize({
            // plugins: ["restore_on_backspace", "clear_button"],
            dataAttr: 'data-selectize',
            options: tipeDokOptions,
        });

        var max_fields = 20;
        var wrapper = $("#input_fields_container .table tbody");
        var x = 1;

        // Add new row when the "Add" button is clicked
        $(wrapper).on("click", ".add_field", function (e) {
            // console.log('ke klik....')
            e.preventDefault();
            e.stopPropagation();
            if (x < max_fields) {
                x++;
                var row = $(".input-row:first").clone();
                row.find("input[type='file']").val("");
                row.find("select, input[type='text']").val("");
                // Destroy the Selectize instances in the cloned row
                var selectizeElements = row.find('.selectize.selectize-control.single');
                selectizeElements.hide();

                // Initialize the cloned select elements
                row.find("select[name='id_kar[]']").selectize({
                    plugins: ["restore_on_backspace", "clear_button"],
                    valueField: "id",
                    labelField: "nama_lengkap",
                    searchField: ["nama_lengkap"],
                    options: karOptions,
                });

                row.find("select[name='tipe_dok[]']").selectize({
                    plugins: ["restore_on_backspace", "clear_button"],
                    dataAttr: 'data-selectize',
                    options: tipeDokOptions,
                });

                wrapper.append(row);
                // Show the "Remove" button for the new row
                row.find(".add_field").hide();
                row.find(".remove_field").show();
            }
        });

        // Remove row when the "Remove" button is clicked
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).closest(".input-row").remove();
            x--;
        });

        // Initially hide the "Remove" button in the first row
        $(".input-row:first .remove_field").hide();
    });


        // Close Modal
        function Close() {
        $('#ModalDokar').modal('hide');
    }

</script>

<style>
.selectize-dropdown {
  width: auto !important;
}
</style>