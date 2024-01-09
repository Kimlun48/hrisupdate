<div class="modal-body">
    <form id="editForm" method="post">
        @csrf
        <div class="form-group" hidden>
            <label for="date">id</label>
            <input type="text" class="form-control" id="id"  name="id" readonly>
        </div>
        <div class="form-group">
            <label for="date">Employee ID</label>
            <input type="text" class="form-control"  value="{{$presensi->preskaryawan->nomor_induk_karyawan}}"  name="nama" readonly>
        </div>

        <div class="form-group">
            <label for="shift">Shift:</label>
            <select id="shift" name="shift_id" class="form-control ">
                <!-- <option value=""></option> -->
                @foreach ($shift as $item)
                    <option value="{{ $item->id }}">{{ $item->jenis_shift }} ({{ $item->jam_masuk }} - {{ $item->jam_pulang }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="text" class="form-control" id="date" value="{{ date('d-m-Y', strtotime($presensi->tanggal)) }}"  name="date" readonly>
        </div>

    </form>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="Close()">Close</button>
        <button type="button" class="btn btn-primary" id="updateButton" onclick="updateData()" >Save</button>
    </div>
</div>


<script>
    function updateData() {
        var id = $('#id').val();
        var shift_id = $('#shift').val();

        // Lakukan validasi di sini
        if (!id || !shift_id) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Isi semua field yang diperlukan!'
            });
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/shift/update/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
                'shift_id': shift_id
                // tambahkan data lain sesuai kebutuhan
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Shift updated successfully!'
                });
                $("#editmodal").modal("hide");
                read_data();
                console.log(data);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan: ' + error
                });
                console.log(xhr.responseText);
            }
        });
    }
</script>


