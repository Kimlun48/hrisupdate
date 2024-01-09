<html>
  <head>
    <style>
      body {
        font-family: Arial, sans-serif;
        font-size: 9pt;
      }
      
      .header {
        padding: 5px;
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
        padding: 2px;
      }
      
      .footer {
        
        color: #fff;
        padding: 20px;
        text-align: center;
        position: absolute;
        bottom: 0;
        width: 100%;
      }

      .table1 {
        border-collapse: collapse;
        width: 30%;
        float:right;
        margin-right:10px;
      }
      
      .table1 td, .table1 th {
        border: 2px solid #333;
        padding: 5px;
      }
      .table2 {
        border-collapse: collapse;
        width: 100%;
        float:center;
        margin-top:130px;
      }
      
      .table2 td, .table2 th {
        border: none;
        padding: 5px;
        text-align: center;
      }      

      hr.s5 {
        height:2px;
        border-top:2px solid black;
        border-bottom:1px solid black;
      }
    </style>

  </head>
  <body>
    <div class="header">
      <h4>FORM PENILAIAN KARYAWAN ANYAR GROUP</h4>
    </div>
    <hr class="s5">
    <div class="content">
    <table class="table" >
        <tr>
            <td >Nama</td><td>{{ $kar->nama_lengkap }}</td>
            <td >Periode</td><td>-</td>
        </tr><tr>
            <td >Jabatan</td><td>{{ $kar->jabatan->nama }}</td>
            <td >Kontrak Ke</td><td>-</td>
        </tr><tr>
            <td >Store</td><td>{{ $kar->cabang->nama }}</td>
            <td >Tgl Mulai Kontrak</td><td>-</td>
        </tr><tr>            
            <td >Tanggal Join</td><td>{{ $kar->tahun_gabung }}</td>
            <td >Tanggal Akhir Kontrak</td><td>{{$kar->expired_kontrak}}</td>
        </tr>
      </table>
      <br>
      
      <table class="table">
        <tr>
            <th scope="col" >NO</th>
            <th >DESCRIPTION</th>
            <th >NILAI</th>
            <th >KETERANGAN</th>
        </tr>
        <!-- Kedisiplinan -->
        <tr>
            <td colspan = "4" ><b style="margin:55px;">I. Kedisiplinan (DISCILPINE)</b></td>
        </tr>  
        <tr>
            <td rowspan="2" style="text-align: center;">1.</td>
            <td>1.1  Kehadiran.</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>1.2.  Kepatuhan Terhadap Peraturan Perusahaan</td>
            <td></td>
            <td></td>
        </tr>  
        <!--Akhir Kedisiplinan-->
        <!--Standart Operasional-->
        <tr>
            <td colspan = "4"><b style="margin:55px;">II. Standart Operasional Procedure (SOP)</b></td>
        </tr>  
        <tr>
            <td rowspan="4" style="text-align: center;">2.</td>
            <td>2.1  Pelaksaan SOP.</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>2.2.  Keterampilan Kerja</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>2.3.  Pemecahan Masalah</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>2.4.  Kualitas Pekerjaan</td>
            <td></td>
            <td></td>
        </tr>  
        <!--Akhir Standart Operasional-->
        <!--Loyalitas-->
        <tr>
            <td colspan = "4"><b style="margin:55px;">III. LOYALITAS (LOYALITY)</b></td>
        </tr>  
        <tr>
            <td rowspan="4" style="text-align: center;">3.</td>
            <td>3.1  Ketekunan</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>3.2.  Tanggung Jawab</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>3.3.  Motivasi</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>3.4.  Orientasi Pencapaian hasil</td>
            <td></td>
            <td></td>
        </tr>  
        <!--Akhir Loyalitas-->
        <!--Sikap & Perilaku-->
        <tr>
            <td colspan = "4"><b style="margin:55px;">IV. SIKAP & PERILAKU (ATITUDE)</b></td>
        </tr>  
        <tr>
            <td rowspan="5" style="text-align: center;">4.</td>
            <td>4.1  Kemauan Untuk Belajar</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>4.2.  Inisiatif & Inovatif</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>4.3.  Hubungan Antar Individu</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>4.4.  Kerjasama & Komunikasi</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>4.5.  Kesediaan Menerima Saran & Kritik</td>
            <td></td>
            <td></td>
        </tr>  
        <!--Akhir Sikap & Perilaku-->
        <!-- Kedisiplinan -->
        <tr>
            <td colspan = "4" ><b style="margin:55px;">V. Kebersihan & Kerapihan (GROOMING)</b></td>
        </tr>  
        <tr>
            <td rowspan="2" style="text-align: center;">5.</td>
            <td>5.1  Kebersihan Diri Sendiri</td>
            <td></td>
            <td></td>
        </tr>  
        <tr>
            <td>5.2.  Kebersihan Lingkungan</td>
            <td></td>
            <td></td>
        </tr>  
        <!--Akhir Kedisiplinan-->
        <!--TOTAL-->
        <tr>
            <td colspan = "2" style="text-align: center;"><b>TOTAL</b></td>
            <td></td>
            <td></td>
        </tr>  
        <!--Nilai Akhir-->
        <tr>
            <td colspan = "2" style="text-align: center;"><b>NILAI AKHIR</b></td>
            <td></td>
            <td></td>
        </tr>  
      </table>
    </div>
    <div>
    <table class="table1" >
        <tr>
            <th>Nilai</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td>9 - 10</td>
            <td>= BAIK</td>
        </tr>
        <tr>
            <td>7 - 8,99</td>
            <td>= CUKUP</td>
        </tr>
        <tr>
            <td>5 - 6,99</td>
            <td>= KURANG</td>
        </tr>
    </table>
    </div><div>
    <table class="table2" >
        <tr>
            <th >Karyawan</th>
            <th >Atasan Langsung,</th>
        </tr>
        <tr>
            <td height="30"></td>
            <td height="30"></td>
        </tr>
        <tr>
            <td>(<u>{{ $kar->nama_lengkap }}</u>)</td>
            <td>(________________________)</td>
        </tr>
    </table>
    </div>
  </body>
</html>

