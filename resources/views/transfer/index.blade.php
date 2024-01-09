@extends('layouts.app-master')

@section('content-employ')

<div class="transfer-employ">
  <div class="head">
    <h5 class="title-applicant">Transfer Karyawan Internal</h5>
  </div>
  <div class="container">
      <!-- <hr class="border"></hr> -->
	    <div class="table-body">
		    <!-- <h5 class="list-applicant">Data Quota Cuti</h5> -->

        <div id="read" class=""></div>
      </div>
  </div>
</div>



@include('transfer.partials.read_data_js')
@endsection