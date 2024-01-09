@extends('layouts.app-master')

@section('content')
    <div class="applicant">
        <div class="container">
        <h5 class="title-applicant">Applicant</h5>
        <hr class="border"></hr>
	<div class="table-body">
          <h5 class="list-applicant">List Applicant</h5>
          <div class="search-applicant">
            <form action="/loker/listapply/{{$getid->id}}" method="GET" class="search">
              <div class="input-group group-search">
                <input type="text" class="form-control form-control-sm col-form-input" name="search" value="{{request('search')}}">
                <input type="submit" class="btn btn-sm btn-search" value="Search">
              </div>
	          </form>
          </div>

          <div class="export-applicant mb-3">
            <form  method="GET" class="report">
              <div class="input-group group-export">
                <input type="date" class="form-control form-control-sm col-form-input-1" name="startdate" value="{{request('startdate')}}">
                <input type="date" class="form-control form-control-sm col-form-input-2" name="enddate" value="{{request('enddate')}}">
                  <select class="custom-select form-control form-control-sm col-form-input-3" name="format" value="{{request('format')}}">
                    <option value="">Select Option</option>
                    <option value="view">View</option>
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                  </select>
                <input type="submit" class="btn form-control-sm btn-sm btn-process" value="Process" name="report">
            </div>
            </form>
          </div>
	@include('loker.listdetail')
	  
        </div>
        </div>
    </div>

@include('pelamar.partials.script')

<script>
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        getLoker(url);
        window.history.pushState("", "", url);

        function getLoker(url) {
          $.ajax({
              url : url
          }).done(function (data) {
              $('#lokerdetail').html(data);  
          });
        };

    });

</script>

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


