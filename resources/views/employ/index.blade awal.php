@extends('layouts.app-master')
@section('content')
<div class="employ">
  <div class="container">
    <h5 class="title-employ">Employees</h5>
    <hr class="border"></hr>
		  <div class="table-body">

        <div class="tab mb-4">
          <div id="nav_atas" style="display: block;">
            <ul class="nav text-dark">
                <li class="nav-item" id="defaultOpen">
                  <a class="nav-link tablinks" href="#employee" onclick="tabGeneral(event, 'employee'); cekdataemploy();">
                  <span class="fa-stack fa-1x me-2" >
                      <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #808080"></i>
                  </span>
                  Internal Employees
                  </a>
                </li>
                <li class="nav-item" id="defaultexternal">
                  <a class="nav-link tablinks" href="#external" onclick="tabGeneral(event, 'external'); cekdataexternal();" >
                  <span class="fa-stack fa-1x me-2" >
                      <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #F6C381"></i>
                  </span>
                  External Employees
                  </a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link tablinks" href="#list" onclick="tabGeneral(event, 'list'); cekdataalmostexpired();">
                  <span class="fa-stack fa-1x me-2" >
                      <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #F46060"></i>
                  </span>
                  Almost Exp
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link tablinks" href="#expired" onclick="tabGeneral(event, 'expired'); cekdataexpired();">
                  <span class="fa-stack fa-1x me-2" >
                      <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #630606"></i>
                  </span>
                  Expired At
                  </a>
                </li> 
            </ul>
          </div>
        </div>

        <div class="tabcontent" id="list">
            <div class="container">
              <div class="row">
                <div id="readalmostexpired" class="mt-3"></div>
              </div>
            </div>
        </div>

        <div class="tabcontent" id="expired">
          <div class="container">
            <div class="row">
              <div id="readexpired" class="mt-3"></div>
            </div>
          </div>
        </div>

        <div class="tabcontent" id="external">
          <div class="container">
            <div class="row">
              <div id="readexternal" class="mt-3"></div>
            </div>
          </div>
        </div>


        <div class="tabcontent" id="employee">
            <div id="read">
              @include('employ.reademploy')
            </div>
        </div>

        </div>            
      </div>
  </div>
</div>

  <!-- Modal phk internal -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="modal fade" id="ModalResign" tabindex="-1" role="dialog" aria-labelledby="ModalResignLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalResignLabel"></h5>
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


  <!-- Modal phk external -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="modal fade" id="ModalResign" tabindex="-1" role="dialog" aria-labelledby="ModalResignLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalResignLabel"></h5>
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


  
  <!-- Modal Transfer -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="modal fade" id="ModalTransfer" tabindex="-1" role="dialog" aria-labelledby="ModalTransferLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalTransferLabel"></h5>
          <button type="button" class="close" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="pagetransfer" class="p-2"></div>
        </div>
      </div>
    </div>
  </div>

  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="modal fade detail-pelamar" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="ModalTransferLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-pelamar" role="document">
      <div class="modal-content modal-content-pelamar">
        <div class="modal-header">
          <h5 class="modal-title" id="labeldetail"></h5>
          <button type="button" class="close" onClick="Close()"  id="close-button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modal-body-pelamar">
          <div id="detail" class="p-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!--External -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="modal fade detail-pelamar" id="modalDetailExternal" tabindex="-1" role="dialog" aria-labelledby="ModalTransferLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-pelamar" role="document">
      <div class="modal-content modal-content-pelamar">
        <div class="modal-header">
          <h5 class="modal-title" id="labeldetailexternal"></h5>
          <button type="button" class="close" onClick="CloseExternal()"  id="close-button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modal-body-pelamar">
          <div id="detailexternal" class="p-2"></div>
        </div>
      </div>
    </div>
  </div>


@include('employ.partials.script')

<div id="cover-spin"></div>
<style>
    #cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
    display:none;
}

@-webkit-keyframes spin {
	from {-webkit-transform:rotate(0deg);}
	to {-webkit-transform:rotate(360deg);}
}

@keyframes spin {
	from {transform:rotate(0deg);}
	to {transform:rotate(360deg);}
}

#cover-spin::after {
    content:'';
    display:block;
    position:absolute;
    left:48%;top:40%;
    width:40px;height:40px;
    border-style:solid;
    border-color:black;
    border-top-color:transparent;
    border-width: 4px;
    border-radius:50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}
</style>

@endsection
