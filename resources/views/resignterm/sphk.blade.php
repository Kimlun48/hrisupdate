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
        margin: 10;
      }
      
      .table {
        border-collapse: collapse;
        width: 60%;
        margin-bottom: 40;
        font-size:12px;
      }
      
      .table td, .table th {
        border: none;
        padding: 5px;
        font-size:12px;
      }

        
      .table1 {
        border-collapse: collapse;
        width: 40%;
        margin-bottom:20;
        font-size:12px;
      }
      
      .table1 td, .table1 th {
        border: none;
        padding: 5px;
        font-size:12px;
      }

      .table2 {
        border-collapse: collapse;
        width: 30%;
        float:left;
        margin-top:10px;
        font-size:12px;
      }
      
      .table2 td, .table2 th {
        border: none;
        padding: 10px;
        text-align: center;
        font-size:12px;
      }      

      .footer {  
        color: #fff;
        padding: 5px;
        text-align: center;
        position: absolute;
        bottom: 0;
        width: 100%;
      }
      
      p {
        text-align: justify;
        font-size:12px;
        margin-top: -7px;
    }
    </style>
  </head>
  <body>
    <div class="header">
      <h4><u>SURAT PEMBERITAHUAN</u></h4>
    </div>
    <div class="content">
    <table class="table" >
        <tr>
          <td>Nomor</td>
          <td>:</td>
          <td>xxxx</td>
        </tr><tr>
          <td>Perihal</td>
          <td>:</td>
          <td>Pemberitahuan Berakhirnya Komtrak Kerja Karyawan</td>
        </tr><tr>
          <td>Lampiran</td>
          <td>:</td>
          <td>-</td>
        </tr>
    </table>
    <p>Dengan Hormat,</p>
    <p>Berdasarkan dengan surat ini, kami memberitahukan mengenai masa berakhirnya kontrak karyawan di bawah ini:<p>   
    <table class="table1" >
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>{{ $kar->nama_lengkap }}</td>
        </tr><tr>
          <td>NIK</td>
          <td>:</td>
          <td>{{ $kar->nomor_induk_karyawan }}</td>
        </tr><tr>
          <td>Jabatan</td>
          <td>:</td>
          <td>{{ $kar->jabatan->nama }}</td>
        </tr><tr>
          <td>Cabang</td>
          <td>:</td>
          <td>{{ $kar->cabang->nama }}</td>
        </tr><tr>
          <td>Periode Kontrak</td>
          <td>:</td>
          <td>xxx</td>
        </tr>
    </table>

<p>Sehubungan dengan <b>berakhirnya kontrak karyawan</b> tersebut pada tanggal <b>{{$kar->expired_kontrak}}</b>
di PT Anyar Retaill Indonesia, maka kami memutuskan untuk tidak memperpanjang kontrak darai karyawan yang bersangkutan.<p>   

<p>Atas pemberitahuan diatas tersebut diharapkan karyawan mengembalikan <i>ID Card</i> ke pihak
<i>Store Manager</i> pada hari terakhir bekerjanya dan melengkapi persyaratan administrasi mengisi <i>form exit clearance.</i><p>   

<p>Demikian surat pemberitahuan masa berakhir kontrak karyawan tersebut kami buat, segenap pimpinan dan jajaran mengucapkan terimakasih
atas kerjasama selama ini.<p>   
<p>Atas kerjasamanya kami ucapkan terimakasih.<p>   
</div>
<table class="table2" >
        <tr>
            <th >Hormat Kami,</th>
        </tr>
        <tr>
            <td height="30"></td>
        </tr>
        <tr>
            <td><b><u>( Ritanti Prasuseno )</u><br>Human Capital Supervisor</b></td>
        </tr>
    </table>
  </body>
</html>

