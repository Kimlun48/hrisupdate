@extends('layouts.app-master')
@section('content-employ')

<div class="employ">
  <div class="container">
    <!-- <h5 class="title-employ">Bulk Employees</h5> -->
    <div class="row align-items-center">
      <div class="container headtext">
        <div class="row">
          <div class="col-md-6">
            <h5 class="title-employ">Employees External</h5>
          </div>
        </div>
      </div>
    </div>
    <!-- <hr class="border"> -->
      <div class="table-body" style="border: none;">
        <div class="tab mb-4">
	        <div class="container card-container">
            <div class="row ">
                  <!-- Bulk Edit Data Kary  awan external -->
                  <form id='form1' class="form col importcztm" action="{{ route('employ.externalimport') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <span class="form-title">Import Bulk Employee External</span>
                    <p class="form-paragraph">
                        File should be an Excel
                    </p>
                    <a type="button" href="/employ/exporteksternal" data-toggle="tooltip" data-placement="top" title="Format Data External" class="btncztmex"> Download Template Import </a>
                    <label for="file-input" class="drop-container">
                    <span class="drop-title">Click Me Here</span>
                    or
                    <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="file-input" name="fileimportexternal">
                    <button type="submit" class="submitBtn">
                      Submit
                      <svg fill="white" viewBox="0 0 448 512" height="1em" class="arrow"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
                    </button>
                  </label>
                  </form>
                  <!-- Akhir Bulk Edit Data Karyawan -->	
                  <!-- Bulk Edit Data Kary  awan external -->
                  <form id='form3' class="form editczm col" action="{{ route('employ.editbulkkaryawanexternal') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <span class="form-title">Update Bulk Employee External</span>
                    <p class="form-paragraph">
                        File should be an Excel
                    </p>
                      <button type="button" class="btncztmex" data-toggle="modal" data-target="#exampleModal"> Download Template Update </button>
                    <label for="file-input" class="drop-container">
                    <span class="drop-title">Click Me Here</span>
                    or
                    <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="file-input" name="fileeditexternal">
                    <button type="submit" class="submitBtn">
                      Submit
                      <svg fill="white" viewBox="0 0 448 512" height="1em" class="arrow"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
                    </button>
                  </label>
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


@include('employ.partials.script_bulk')
<style>

.submitBtn {
  width: 120px;
  height: 40px;
  border-radius: 30px;
  border: none;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.13);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  font-weight: 600;
  cursor: pointer;
  color: white;
  background: linear-gradient(to left,rgb(230, 35, 0),rgb(255, 174, 0));
  letter-spacing: 0.7px;
  margin: auto;
}

.submitBtn:hover .arrow {
  animation: slide-in-left 0.6s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}

@keyframes slide-in-left {
  0% {
    transform: translateX(-10px);
    opacity: 0;
  }

  100% {
    transform: translateX(0px);
    opacity: 1;
  }
}

.submitBtn:active {
  transform: scale(0.97);
}

.editczm {
    margin-left: 21%;
}

.importcztm {
    margin-left: 9%;
}

.btncztmex {
  padding: 1.3em 3em;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 500;
  color: #000;
  background-color: #fff;
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  outline: none;
}

.btncztmex:hover {
  background-color: #23c483;
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  color: #fff;
  transform: translateY(-7px);
}

.btncztmex:active {
  transform: translateY(-1px);
}

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
	/* display: flex; */
	/* justify-content: center;	 */
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


.form {
  background-color: #fff;
  box-shadow: 0 10px 60px rgb(218, 229, 255);
  border: 1px solid rgb(159, 159, 160);
  border-radius: 20px;
  padding: 2rem .7rem .7rem .7rem;
  text-align: center;
  font-size: 1.125rem;
  max-width: 375px;
}

.form-title {
  color: #000000;
  font-size: 1.8rem;
  font-weight: 500;
}

.form-paragraph {
  margin-top: 10px;
  font-size: 0.9375rem;
  color: rgb(105, 105, 105);
}

.drop-container {
  background-color: #fff;
  position: relative;
  display: flex;
  gap: 10px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 10px;
  margin-top: 2.1875rem;
  border-radius: 10px;
  border: 2px dashed rgb(171, 202, 255);
  color: #444;
  cursor: pointer;
  transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover {
  background: rgba(0, 140, 255, 0.164);
  border-color: rgba(17, 17, 17, 0.616);
}

.drop-container:hover .drop-title {
  color: #222;
}

.drop-title {
  color: #444;
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  transition: color .2s ease-in-out;
}

#file-input {
  width: 350px;
  max-width: 100%;
  color: #444;
  padding: 2px;
  background: #fff;
  border-radius: 10px;
  border: 1px solid rgba(8, 8, 8, 0.288);
}

#file-input::file-selector-button {
  margin-right: 20px;
  border: none;
  background: #084cdf;
  padding: 10px 20px;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

#file-input::file-selector-button:hover {
  background: #0d45a5;
}
</style>
@endsection
