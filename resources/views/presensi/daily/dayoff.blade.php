              <!-- Modal Karyawan Day Off Today-->
            <div class="table-responsive">
              <table class="table data-table table-responsive table-striped">
                <thead class="table-head">
                  <tr class="judul">
                    <th scope="col" width="auto">No</th>
                    <th scope="col" width="auto">NIK</th>
                    <th scope="col" width="auto">Name</th>
                    <th scope="col" width="auto">Cabang</th>
                    <th scope="col" width="auto">Description</th>
                  </tr>
                </thead>
                <tbody class="table-content">
                @forelse($dayofftoday as $dayoff)
                  <tr class="isi">
                    <td class="nomor">{{$loop->iteration }}.</td>
                    <td class="id">{{$dayoff->preskaryawan->nomor_induk_karyawan }}</td>
                    <td class="name" >{{$dayoff->preskaryawan->nama_lengkap }}</td>
                    <td class="name" >{{$dayoff->preskaryawan->cabang->nama }}</td>
                    <td class="keterangan">{{$dayoff->presensi_status}}</td>                          
                  </tr>
                @empty
                  <tr class="text-center"> <td colspan="5"> No Data </td> </tr>
                @endforelse
                </tbody>
              </table>
            </div>


            <script>
                  function Close() {
      $("#todayPresensi").modal("hide");
    }
              </script>