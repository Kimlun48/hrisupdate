@extends('layouts.app-master')

@section('content-employ')
<div class="employ">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h5 class="title-employ">Annual Shifts</h5>
      </div>
      <hr class="border">
      <div class="row">
        <div class="col-md-8">
          
         
        </div>
        <div class="col-md-2">

            <div class="form-group has-search" >
              <span class="fa fa-search form-control-feedback"></span>
              <input type="text" class="form-control" placeholder="Search" id="search" name="search">
            </div>

        </div>
      </div>

      <form action="/presensi/eksekusicreateshift" method="post" enctype="multipart/form-data">
      
        @csrf
  <div class="form-row align-items-center">
    <div class="col-md-1">
      <label class="sr-only" for="inlineFormInput">Tahun</label>
      <!-- <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Jane Doe"> -->
      <select class="form-control mb-2" name="tahun" required>
      @foreach($years as $year) 
      <option value="{{$year}}">{{$year}}</option>
      @endforeach
      </select>

    </div>
    <div class="col-md-1">
      <label class="sr-only" for="inlineFormInputGroup">Username</label>
      <div class="input-group mb-2">
        <!-- <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username"> -->
      <select class="form-control" required name="jenis_karyawan">
      <option value="Internal">Internal</option>
      <option value="External">External</option>
      </select>

      </div>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </div>
  </div>
</form>
      <div class="table-body">
       <div id="read"></div>
      </div>
    </div>
  </div>
</div>
@endsection
