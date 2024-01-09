<table>
   <thead>
   <tr>
      <th>No</th>
      <th>Dates</th>
      <th>Employee Name</th>
      
      @foreach($dateRange as $date)
         <th>
            {{ date('Y-m-d', strtotime($date)) }}
         </th>
      @endforeach
   </tr>
</thead>
<tbody>

@forelse ($shift as $sh)
    <tr>
        <td>{{ $loop->iteration }}.</td>
        <td>{{ $sh->nomor_induk_karyawan}}</td>
        <td>{{ $sh->nama_lengkap}}</td>
        @foreach ($absen as $item)
          @if($item->nomor_induk_karyawan == $sh->nomor_induk_karyawan)
              <td>{{$item->jenis_shift}}</td>
          @endif
        @endforeach
    </tr>
  @empty
  @endforelse


</tbody>
</table>

