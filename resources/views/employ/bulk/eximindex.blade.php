@extends('layouts.app-master')
@section('content')

<div class="employ">
  <div class="container">
    <h5 class="title-employ">Bulk Employees</h5>
    <hr class="border">
      <div class="table-body">
        <div class="tab mb-4">
	        <div class="container card-container">
            <div class="row row-cols-2 ml-5">
	            <!-- Import Data Karyawan External -->
                <form id='form1' class="col" action="{{ route('employ.externalimport') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card">
                    <div class="card-top1 card2"></div>
                    <div class="card-text">
                      <div class="card-contents">
                        <a href="/employ/exporteksternal" class="btn btn-warning mb-2" data-toggle="tooltip" data-placement="top" title="Format Data External">Format Data : External</a>
                        <input style="	width: 95%;" type="file" name="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="fileimportexternal">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
		          <!-- Akhir Import Data Karyawan External -->	
		          <!-- Import Data Karyawan Internal -->
                <form id='form2' class="col" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card">
                    <div class="card-top1 card1"></div>
                    <div class="card-text">
                      <div class="card-contents">
                        <a href="/employ/exportinternal" class="btn btn-warning mb-2" data-toggle="tooltip" data-placement="top" title="Format Data External">Format Data : Internal</a>
                        <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="fileimportinter">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
		          <!-- Akhir Import Data Karyawan Internal -->	
	            <!-- Bulk Edit Data Karyawan external -->
                <form id='form3' class="col" action="{{ route('employ.editbulkkaryawanexternal') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div div class="card">
                    <div class="card-top card3"></div>
                    <div class="card-text">
                      <div class="card-contents">
                        <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#exampleModal">
                          Template Update Bulk External
                        </button>
                        <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="fileeditexternal">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
					    <!-- Akhir Bulk Edit Data Karyawan -->	
              <!-- Bulk Edit Data Karyawan Internal -->
                <form id='form4' class="col" action="{{ route('employ.editbulkkaryawaninternal') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card">
                    <div class="card-top card4"></div>
                    <div class="card-text">
                      <div class="card-contents">
                      <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#modaleditinternal">
                          Template Update Bulk Internal
                        </button>     
                        <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="fileeditinternal">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
              <!-- Akhir Bulk Edit Data Karyawan -->	
				  	</div>          
				</div>          
			</div>
		</div>
  </div>
</div>
<!-- Modal edit external -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter Pencarian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form untuk filter pencarian -->
        <form class="col" action="{{ route('employ.eksetempbulkex') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="cabang">Pilih Cabang:</label>
                <input class="form-control" list="list-cabang" name="cabang[]" required>
                <datalist id="list-cabang">
                    @foreach($cabs as $cbg)
                        <option value="{{ $cbg->nama }}" data-value="{{ $cbg->id }}"></option>
                    @endforeach
                </datalist>
                <input type="hidden" name="cabang_id[]" value="">
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <input class="form-control" list="list-jabatan" name="jabatan[]" required>
		<datalist id="list-jabatan">
                    <option value="All" data-value="All"></option>
                    @foreach ($jabs as $jab)
                        <option value="{{ $jab->nama }}" data-value="{{ $jab->id }}"></option>
                    @endforeach
                </datalist>
                <input type="hidden" name="jabatan_id[]" value="">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal edit internal -->
<div class="modal fade" id="modaleditinternal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter Pencarian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form untuk filter pencarian -->
        <form class="col" action="{{ route('employ.intetempbulkex') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="cabang">Pilih Cabang:</label>
                <input class="form-control" list="list-cabang" name="cabang[]" required>
		<datalist id="list-cabang">
                    @foreach($cabs as $cbg)
                        <option value="{{ $cbg->nama }}" data-value="{{ $cbg->id }}"></option>
                    @endforeach
                </datalist>
                <input type="hidden" name="cabang_id[]" value="">
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <input class="form-control" list="list-jabatan" name="jabatan[]" required>
		<datalist id="list-jabatan">
                        <option value="All" data-value="All"></option>
                    @foreach ($jabs as $jab)
                        <option value="{{ $jab->nama }}" data-value="{{ $jab->id }}"></option>
                    @endforeach
                </datalist>
                <input type="hidden" name="jabatan_id[]" value="">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('employ.partials.script_bulk')
<style>

.form-control {
    border-radius: 0;
    box-shadow: none;
    border-color: #d2d6de
}

.select2-hidden-accessible {
    border: 0 !important;
    clip: rect(0 0 0 0) !important;
    height: 1px !important;
    margin: -1px !important;
    overflow: hidden !important;
    padding: 0 !important;
    position: absolute !important;
    width: 1px !important
}

.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 6px 12px;
    height: 34px
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px
}

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 28px;
    user-select: none;
    -webkit-user-select: none
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-right: 10px
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    padding-right: 0;
    height: auto;
    margin-top: -3px
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0 !important;
    padding: 6px 12px;
    height: 40px !important
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 6px !important;
    right: 1px;
    width: 20px
}


.alert-box {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
}

.card-container {
	display: flex;
	justify-content: center;	
	margin-top: 20px;
}
.card {
	height: 150px;
	width:  300px;
	display: inline-flex;
	justify-content: center;
	text-decoration: none;
  position: relative;
}
.card-top {
	border-radius: 8px;
    width: 307px;
    background: white;
    height: 150px;
    margin-left: -6px;
    position: absolute;
    z-index: 8;
    transition: transform .5s;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
.card-top1 {
	border-radius: 8px;
    width: 307px;
    background: white;
    height: 150px;
    margin-left: -6px;
    position: absolute;
    z-index: 8;
    transition: transform .5s;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}

.card1 {
	/* background: url('https://www.questionpro.com/blog/wp-content/uploads/2022/06/employee-involment.jpg');	 */
	background-size: cover;
	background-image: url("../assets/bootstrap/img/interkar.png");
	/* border: 3px ; */
	
}
.card2 {
	/* background: url('https://www.questionpro.com/blog/wp-content/uploads/2022/06/employee-involment.jpg');	 */
	background-size: cover;
	background-image: url("../assets/bootstrap/img/kareks.png");
	/* border: 3px ; */
	
}
.card3 {
	/* background: url('https://www.questionpro.com/blog/wp-content/uploads/2022/06/employee-involment.jpg');	 */
	background-size: cover;
	background-image: url("../assets/bootstrap/img/updateeks.png");
	/* border: 3px ; */
	
}
.card4 {
	/* background: url('https://www.questionpro.com/blog/wp-content/uploads/2022/06/employee-involment.jpg');	 */
	background-size: cover;
	background-image: url("../assets/bootstrap/img/updateinter.png");
	/* border: 3px ; */
	
}
.card:hover .card-top {
	transform: translatey(-165px);
  /* position: absolute; */

}
.card:hover .card-top1 {
	transform: translatey(165px);
  /* position: absolute; */

}
.card-bottom {
	background: #FAF9F6;
	width: 100%;
	height: 200px;
	border-radius: 8px;
}
.card-contents {
	color: black;
	display: flex;
	flex-direction: column;
	align-items: center;
}
.card-contents p{
	margin: 7px 0px;
}
.card-title {
	font-weight: bold;
	font-size: 1.3em;
}
</style>
@endsection
