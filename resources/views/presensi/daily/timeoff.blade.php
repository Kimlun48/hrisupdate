              <!-- Modal Karyawan Time Off Today-->
              <div class="table-responsive">
                <table class="table data-table table-responsive table-striped">
                  <thead class="table-head">
                    <tr class="judul">
                      <th scope="col" width="auto">No</th>
                      <th scope="col" width="auto">NIK</th>
                      <th scope="col" width="auto">Name</th>
                      <th scope="col" width="auto">Description</th>
                    </tr>
                  </thead>
                  <tbody class="table-content">
                  @forelse($timeofftoday as $timeoff)
                    <tr class="isi">
                      <td class="nomor">{{$loop->iteration }}.</td>
                      <td class="id">{{$timeoff->preskaryawan->nomor_induk_karyawan }}</td>
                      <td class="name" >{{$timeoff->preskaryawan->nama_lengkap }}</td>
                      <td class="keterangan"> {{$timeoff->presensi_status}}</td>
                    </tr>                          
                  @empty
                    <tr class="text-center"> <td colspan="4"> No Data </td> </tr>  
                  @endforelse
                  </tbody>
                </table>
              </div>


              <script>
                  function Close() {
      $("#todayPresensi").modal("hide");
    }
              </script>