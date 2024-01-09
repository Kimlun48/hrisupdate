<table class="table data-table">
    <thead>
        <tr class="judul">
        <th scope="col">No</th>
        <th scope="col">No Induk Karyawan</th>
        <th scope="col">Nama</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Jam Keluar</th>
        <th scope="col">Jam Masuk</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($data as $tm)
        <tr class="isi">
            <td class="nomor">{{ $loop->iteration }}.</td>
            <td>{{ $tm->preskaryawan->nomor_induk_karyawan }}</td>
            <td>{{ $tm->preskaryawan->nama_lengkap }}</td>
            <td>{{ $tm->tanggal }}</td>
            <td>{{ $tm->istirahat_keluar }}</td>
            <td>{{ $tm->istirahat_masuk }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
