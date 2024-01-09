@extends('layouts.app-master')

@section('content')
<div class="applicant">
    <div class="container">
        <h5 class="title-applicant">Applicant</h5>
        <hr class="border"></hr>
	    <div class="table-body">
		    <h5 class="list-applicant">Table All Applicant</h5>
            
            <div class="search-applicant">
                <form class="search">
                <h5 class="list-applicant">Search Applicant</h5>
                <!-- <div class="input-group group-search">
                    <input type="text" class="form-control form-control-sm col-form-input" name="search" id="search" placeholder="Search Here...">
                    <button type="submit" class="btn btn-primary btn-sm btn-search col-auto">
                    <i class="fas fa-search"></i>
                </div> -->
                <div class="searching">
                        <input type="text" class="search__input" placeholder="Type your text" name="search" id="search" placeholder="Search Here...">
                        <button disabled class="search__button" >
                            <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                                <g>
                                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <!--End Div Search-->

            <div class="export-applicant">
                <form action="/pelamar" method="GET" class="report">
                <h5 class="list-applicant">Export Applicant</h5>
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
            <!--End Div Report-->
            <br>
            @include('pelamar.showpelamar')
            
        </div>
        <!--End Div Table Body-->
    </div>
    <!--End Div Container-->
</div>

@include('pelamar.partials.script')

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


