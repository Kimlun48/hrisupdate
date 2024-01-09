@extends('layouts.app-master')

@section('content-employ')
<div class="param-doker">
  <div class="head">
    <h5 class="title-applicant">Dokumen Karyawan</h5>
  </div>
  <div class="container">
	    <div class="table-body">
            <div id="read" class=""></div>
        </div>
  </div>
</div>
           
           
<!-- Modal Create -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="modal fade" id="ModalDokar" tabindex="-1" role="dialog" aria-labelledby="ModalDokarLabel" aria-hidden="true">
  <div class="modal-dialog  " role="document">
    <div class="modal-content">
      <div class="modal-header">
	      <h5 class="modal-title" id="ModalDokarLabel"></h5>
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

@include('dokar.partials.script')
@endsection


<style>
    .modal-dialog {
  position: relative;
  display: table;
  width: auto;
  min-width: 300px;
}

.modal-content{
  width: auto;

}
.modal-body { /* Restrict Modal width to 90% */
  /* overflow-x: auto !important; */
  max-width: 100vw !important;
}
</style>