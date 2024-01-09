<div class="">

<table class="table data-table">
    <thead class="table-head">
        <tr class="judul">
            <th scope="col" >Request Date</th>
            <th scope="col" >Overtime date</th>
            <th scope="col" >Employee ID</th>
            <th scope="col" >Employee</th>
            <th scope="col" >Compensation</th>
            <th scope="col" >Time Start</th>
            <th scope="col" >End Time</th>
            <th scope="col" >Duration</th>
            <th scope="col" >Status</th>
            <th scope="col" >action</th>                
        </tr>
    </thead>
    <tbody>
    @foreach ($ovtime as $ot)
             
        <tr class="isi">
            <td class="nomor">{{ $ot->tanggal }}</td>
            <td class="nomor">{{ $ot->tanggal_overtime }}</td>
            <td class="name">{{$ot->getkar->nomor_induk_karyawan}}</td>
            <td class="name" >{{$ot->getkar->nama_lengkap}}</td>
            <td class="name">{{ $ot->kompensasi }}</td>
            <td class="name">{{ $ot->mulai }}</td>
            <td class="name">{{ $ot->akhir }}</td>
            <td class="name">{{ $ot->durasi }}</td>
            <td class="name">{{ $ot->status_approve}}</td>
            <td class="actions">
                <button class="btn btn-sm btn-primary mb-2" onClick="detail({{$ot->id}})">
                <i class="fas fa-pencil-alt" style="color:#fff; width:20px"></i></button> 
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
