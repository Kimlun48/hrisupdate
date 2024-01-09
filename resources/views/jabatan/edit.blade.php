      <div class="modal-body">
        <form id="editForm">
        <input type="hidden" id="id" name="id" value="{{$jabsn->id}}">
          <div class="form-group">
            <label for="pasal">Nama</label>
            <input type="text" value="{{$jabsn->nama}}" class="form-control" id="nama" name="nama">
          </div>
          <div class="form-group">
            <label for="ayat">kode</label>
            <select type="text" value="{{$jabsn->kode}}" class="form-control" id="kode" name="kode">
              <option value=1>Approve</option>
              <option value=0>Non-Approve</option>
            </select>          
          </div>

          <div class="form-group"> 
            <label for="status" >status</label>
            <select class="form-control" id="status" name="status">{{$jabsn->status}}
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Non-Aktif</option>
            </select>
          </div>

          <div class="form-group">
  <label for="ayat">parent jabatan</label>
  <input class="form-control" id="answerInput" name="answer" list="answers" required value="{{ $parent_id ?? '' }}">
  <datalist id="answers">
    @foreach ($jabs as $jab)
      <option value="{{ $jab->id }}">{{ $jab->nama }}</option>
    @endforeach
  </datalist>
  <input type="hidden" name="parent_id" id="answerInput-hidden" >
</div>


          
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="storeedit()">Save</button>
      </div>


      <script>
      document.querySelector('#answerInput').addEventListener('input', function(e) {
        var input = e.target,	
            list = input.getAttribute('list'),
            options = document.querySelectorAll('#' + list + ' option[value="'+input.value+'"]'),
            hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden');

        if (options.length > 0) {
          hiddenInput.value = input.value;
          input.value = options[0].innerText;
          }
    });
      </script>