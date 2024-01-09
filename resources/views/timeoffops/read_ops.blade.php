<table class="table data-table">
    <thead>
        <tr class="judul">
        <th scope="col">No</th>
        <th scope="col">No Induk Karyawan</th>
        <th scope="col">Nama</th>
        <th scope="col">Request</th>
        <th scope="col">Tanggal Pengajuan</th>
        <th scope="col">Status Approve</th>
        <th scope="col">Note</th>

        </tr>
    </thead>
    <tbody>
    @foreach ($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>        
            <td>{{$item->karyawan->nomor_induk_karyawan}}</td>   
            <td>{{$item->karyawan->nama_lengkap}}</td> 
            <td>{{$item->statusoff}}</td>   
            <td>{{$item->tanggal}}</td>   
            <td>{{$item->status_approve}}</td>
            <td>{{$item->notes}}</td>
        </tr>

    @endforeach
    </tbody>
</table>
