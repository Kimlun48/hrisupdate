@extends('layouts.app-master')

@section('content-employ')
<div class="bulkcuti">
  <div class="head">
    <h5 class="title-applicant">Quota Cuti</h5>
  </div>
  <div class="container">
      <!-- <hr class="border"></hr> -->
	    <div class="table-body">
		    <!-- <h5 class="list-applicant">Data Quota Cuti</h5> -->

        <div id="read" class=""></div>
      </div>
  </div>
</div>


<!-- Modal -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="Modalparam" tabindex="-1" role="dialog" aria-labelledby="ModalparamLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	      <h5 class="modal-title" id="ModalparamLabel"></h5>
        <button type="button" class="close" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="page" class="p-2"></div>
      </div>
    </div>
  </div>
</div> 
@include('cuti.partials.script')



@endsection


