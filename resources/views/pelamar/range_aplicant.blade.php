  <table class="table table-responsive  data-table">
	    <thead>
            <tr class="judul">
	      <th scope="col">No</th>
	      <!-- <th scope="col">NIK</th> -->
	      <th scope="col">Name</th>
	      <th scope="col">Family relationship</th>
	      <th scope="col">E-mail</th>
	      <!-- <th scope="col">Handphone</th> -->
	      <th scope="col">Position Applied</th>
	      <th scope="col">Progres</th>
	    </tr>
	   </thead>
	   <tbody>
	   @foreach ($list as $det)
        <tr class="isi">
            <td>{{ $loop->iteration }}.</td>
            <td class="name">{{ ucfirst(trans($det->pelamar->nama_lengkap)) }}</td>
            <td>{{ $det->pelamar->hubungan_keluarga}}</td>
            <td>{{ $det->pelamar->userlamar->email}}</td>
            <!-- <td>{{ $det->pelamar->no_hp}} / {{ $det->pelamar->no_telp}}</td> -->
            <td class="position">{{ $det->loker->posisi->nama}}</td>
            <td class="position">{{ $det->progres}}</td>
        <td>
	      @endforeach
                </tbody>
	    </table>


        </div>
        </div>
    </div>






