@extends('layouts.app-master')

@section('content')
<div class="applicant">
  <div class="container">
    <h5 class="title-applicant">Over Time</h5>
      <hr class="border"></hr>
	    <div class="table-body">
		    <h5 class="list-applicant">Data list Over Time</h5>
        
        <div id="read" class="mt-3"></div>
      </div>
  </div>
</div>
           

  <div class="modal fade" id="Modalparam" tabindex="-1" role="dialog" aria-labelledby="ModalparamLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalparamLabel"></h5>
          <button type="button" class="close" onclick="CloseModal()"  id="close-button" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="page" class="p-2"></div>
        </div>
      </div>
    </div>
  </div>

@include('overtime.partials.read_data_js')
@endsection


