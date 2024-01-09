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
                <li class="nav-item">
                  <a class="nav-link tablinks" href="#employee" onclick="tabGeneral(event, 'employee')" id="defaultOpen">
                  <span class="fa-stack fa-1x me-2" >
                      <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #808080"></i>
                  </span>
                  Sub Ordinate
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link tablinks" href="#list" onclick="tabGeneral(event, 'list')">
                  <span class="fa-stack fa-1x me-2" >
                      <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #F3D179"></i>
                  </span>
                  Almost Exp
                  </a>
                </li> 
                </li>
                <li class="nav-item">
                  <a class="nav-link tablinks" href="#list" onclick="tabGeneral(event, 'list')">
                  <span class="fa-stack fa-1x me-2" >
                      <i class="fas fa-solid fa-circle fa-stack-2x" style="color: #F3D179"></i>
                  </span>
                  Sub Ordinate Absensi
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

        <div class="tabcontent" id="employee">
            <div id="read">
              @include('employ.suborkaryawan')
            </div>
        </div>

        </div>            
      </div>
  </div>
</div>

 <!-- Modal -->
 <meta name="csrf-token" content="{{ csrf_token() }}" />
      <div class="modal fade" id="changeshift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" onClick="Close()" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="pagechange" class="p-2"></div>
            </div>
          </div>
        </div>
      </div>

@include('employ.partials.scriptsubor')
@endsection
