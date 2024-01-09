@if($data)
    <table style='font-family:"Courier New", Courier, monospace; font-size:40%'>
        <thead>
            <tr>
                @foreach($data[0][0] as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data[0]->skip(1) as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
