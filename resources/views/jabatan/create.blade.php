<div class="modal-body">
        <form id="createForm">
          <input type="hidden" id="id" name="id">
          <div class="form-group">
            <label for="pasal">nama</label>
            <input type="text"  class="form-control" id="nama" name="nama">
          </div>
          
          <div class="form-group">
            <label for="ayat">kode</label>
            <select class="form-control" id="kode" name="kode" required>
            <option value=1>Approve</option>
            <option value=0>Non-Approve</option>
          </select>
          </div>

          <div class="form-group">
            <label for="ayat">parent jabatan</label>
            <input class="form-control" id="answerInput" name="answer" list="answers" required>
            <datalist id="answers">
              @foreach ($jabs as $jab)
              <option value="{{ $jab->id }}">{{ $jab->nama }}</option>
              @endforeach
            </datalist>
            <input type="hidden" name="parent_id" id="answerInput-hidden">
          </div>

          
          
         <!-- <div class="form-group">
      <label for="example">Example Select</label>
      <select class="form-control livesearch" id="parent_id" name="parent_id">
	@foreach ($jabs as $jab)
          <option value="{{ $jab->id }}">{{$jab->nama}}</option>
        @endforeach

      </select>
    </div> -->

          <input type="hidden"  class="form-control" id="id" name="id">
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="createpasal()">Save</button>
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

