<html>
  <head>
    <style>
      body {
        font-family: Arial, sans-serif;
        font-size: 9pt;
 
      }
      
      .header {
        
        
        padding: 20px;
        text-align: center;
      }
      
      .content {
        margin: 10px;
      }
      
      .table {
        border-collapse: collapse;
        width: 100%;
      }
      
      .table td, .table th {
        border: 1px solid #333;
        padding: 10px;
      }
      
      .footer {
        
        color: #fff;
        padding: 20px;
        text-align: center;
        position: absolute;
        bottom: 0;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <h2>Data Employees Attendance</h2>
      <h3>From {{ date('d-m-Y',strtotime($start_date)) }} To {{ date('d-m-Y',strtotime($end_date)) }}</h3>
    </div>
    <div class="content">
      <!-- isi halaman -->
      <table class="table">
        <tr>
        <th scope="col" >No</th>
				    <th >NIK</th>
				    <th >Nama</th>
				    <th >Departemen</th>
				    <th >Status</th>
				    <th >Cabang</th>
				    <th >Jabatan</th>
				    <th >Job Level</th>
				    <th >Tanggal</th>
				    <th >Shift</th>
				    <th >Jam Masuk</th>
				    <th >Jam Keluar</th>
				    <th >Keterangan</th>
        </tr>
        @forelse ($prs as $presensi)
                                  <tr  @if($presensi->presensi_status === 'Off') style="color: red;" @endif>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $presensi->preskaryawan->nomor_induk_karyawan }}</td>
                                    <td>{{ $presensi->preskaryawan->nama_lengkap }}</td>
                                    <td>{{ $presensi->preskaryawan->bagian->nama}}</td>
                                    <td>{{ $presensi->preskaryawan->status_karyawan }}</td>
                                    <td>{{ $presensi->preskaryawan->cabang->nama}}</td>
                                    <td>{{ $presensi->preskaryawan->jabatan->nama }}</td>
                                    <td>{{ $presensi->preskaryawan->bagian->nama }}</td>
                                    @if(empty($presensi->jam_masuk))
                                    <td></td>
                                    @else
                                    <td>{{ date('d-m-Y',strtotime($presensi->jam_masuk)) }}</td>
                                    @endif
                                    <td>{{ $presensi->parampresensi->jenis_shift }}</td>
                                    @if(empty($presensi->jam_masuk))
                                    <td></td>
                                    <td></td>
                                    @else
                                    <td> {{ date('H:i:s',strtotime($presensi->jam_masuk)) }} </td>
                                    <td>{{ date('H:i:s',strtotime($presensi->jam_pulang)) }}</td>
                                    @endif 
                                    <td>{{ $presensi->keterangan }}</td>
                                    </tr>  
                                   
                              @empty
                              
                                  <div class="alert alert-danger">
                                      Data belum Tersedia.
                                  </div>
                               
                              @endforelse
      </table>
    </div>
    <div class="footer">
    </div>
  </body>
</html>

