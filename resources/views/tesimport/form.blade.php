<form action="{{ url('import/preview') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".xlsx, .xls">
    <button type="submit">Preview</button>
</form>
