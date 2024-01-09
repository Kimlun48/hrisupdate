

<table>
    <thead>    
        <tr>
            <th>nama</th>
            <th>haha</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($newData as $item)
        <td>{{ $item->id_karyawan }}</td>
        @foreach($item as $key => $value)
        <td>
            @if($key != 'id_karyawan')
             {{ $value }}
            @endif
        </td>
        @endforeach
    </tr>
</tbody>
@endforeach
</table>