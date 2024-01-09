<table>
        <tr>
            <th colspan="7" ><b>Data Apply Job</b></th>
        </tr>
        <tr>
            <th colspan="7" >Periode {{$start_date}} - {{$end_date}}</th>
        </tr>
</table>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Family relationship</th>
            <th>E-mail</th>
            <th>Position Applied</th>
            <th>Progres</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($list as $det)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ ucfirst(trans($det->pelamar->nama_lengkap)) }}</td>
            <td>{{ $det->pelamar->hubungan_keluarga}}</td>
            <td>{{ $det->pelamar->userlamar->email}}</td>     
            <td>{{ $det->loker->posisi->nama}}</td>
            <td>{{ $det->progres}}</td>
            <td>
        </tr>
    @endforeach
    </tbody>
</table>






