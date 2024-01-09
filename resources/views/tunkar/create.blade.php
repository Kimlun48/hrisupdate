<div class="col-md-12 d-flex">
<div class="row">
        
        <div class="col-md-4">
            <!-- <label for="items">Items</label> -->
            <button type="button" id="btn-add-all" class="btn btn-primary mb-2">=></button>
            <select name="items[]" id="items" style="min-width: 300px;width: 300px;height: 350px;" multiple>
                @foreach ($kar as $kar)
                    <option value="{{ $kar->id }}">{{ $kar->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            
            <button type="button" id="btn-add" class="btn btn-primary">Add</button>
            <button type="button" id="btn-remove" class="btn btn-primary">Remove</button>
            
        </div>  
        
        <div class="col-md-4">
        <button type="button" id="btn-remove-all" class="btn btn-primary mb-2"><=</button>
            <!-- <label for="selected">Terpilih</label> -->
            <select name="selectedItems[]" id="selected" style="min-width: 300px;width: 300px;height: 350px;" multiple></select>
        </div>
    </div>
  </div>
        
        
    <div class="row mt-3">
        <div class="col-md-12">
            <button type="button" id="btn-save" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</div>

<script>
    // Get references to the select elements
    var itemsSelect = document.getElementById('items');
    var selectedSelect = document.getElementById('selected');

    // Add event listener to add button
    document.getElementById('btn-add').addEventListener('click', function() {
        moveItems(itemsSelect, selectedSelect);
    });

    // Add event listener to remove button
    document.getElementById('btn-remove').addEventListener('click', function() {
        moveItems(selectedSelect, itemsSelect);
    });

    // Add event listener to add all button
    document.getElementById('btn-add-all').addEventListener('click', function() {
        moveAllItems(itemsSelect, selectedSelect);
    });

    // Add event listener to remove all button
    document.getElementById('btn-remove-all').addEventListener('click', function() {
        moveAllItems(selectedSelect, itemsSelect);
    });

    // Function to move selected items between select elements
    function moveItems(source, destination) {
        var selectedOptions = Array.from(source.selectedOptions);
        selectedOptions.forEach(function(option) {
            destination.appendChild(option);
        });
    }

    // Function to move all items between select elements
    function moveAllItems(source, destination) {
        var options = Array.from(source.options);
        options.forEach(function(option) {
            destination.appendChild(option);
        });
    }

    // Add event listener to save button
    document.getElementById('btn-save').addEventListener('click', function() {
        var selectedItems = Array.from(selectedSelect.options).map(function(option) {
            return option.value;
        });

        // Mengirim data ke server menggunakan AJAX
        var formData = new FormData();
        formData.append('selectedItems', selectedItems);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', "{{ url('/tunkar/store') }}", true);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    // Handle response from the server
                    // Tampilkan pesan sukses atau lakukan tindakan lain yang diinginkan
                } else {
                    console.error('Error:', xhr.status);
                    // Handle error response from the server
                    // Tampilkan pesan error atau lakukan tindakan lain yang diinginkan
                }
            }
        };
        xhr.send(formData);
    });
</script>

