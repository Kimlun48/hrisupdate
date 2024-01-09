<div class="card card-attendance" >
    <div class="container-card-attendance">
        <div class="row row-card-attendance text-center">
            <div class="col-sm col-card-attendance">
            <div class="texthead">
            <h5 class="text-content-1">Present</h5>
            </div>
            <div class="card card-content ">
                <h4 onClick="ontime_detail_internal()" class="text-content-3">{{$ontime}}</h4>
                <h4 class="text-title-1">On Time</h4>
            </div>
            </div>
            <div class="col-sm col-card-attendance">
            <div class="card card-content">
                <h4 onClick="late_detail_internal()" class="text-content-3">{{$late}}</h4>
                <h4 class="text-title-1">Late Clock In</h4>
            </div>
            </div>
            <div class="col-sm col-card-attendance">
            <div class="card card-content">
                <h4 onClick="earlyin_detail_internal()" class="text-content-3">{{$earlyin}}</h4>
                <h4 class="text-title-1">Early Clock In</h4>
            </div>
            </div>
            <div class="col-sm col-card-attendance"  >
            <div class="card card-content" >
                <h4 onClick="attend_detail_internal()" class="text-content-3">{{$attend}}</h4>
                <h4 class="text-title-1">Attend</h4>
            </div>
            </div>
            <div class="col-sm col-card-attendance" style="border-left: 1px solid #b5b5b5;">
            <div class="texthead"  >
            <h5 class="text-content-1">Not Present</h5>
            </div>
            <div class="card card-content">
                <h3 onClick="absen_detail_internal()" class="text-content-3">{{$absen}}</h3>
                <h3 class="text-title-1">Absent</h3>
            </div>
            </div>
            <div class="col-sm col-card-attendance">
            <div class="card card-content">
                <h3 onClick="noclockin_detail_internal()" class="text-content-3">{{$noclockin}}</h3>
                <h3 class="text-title-1">No Clock in</h3>
            </div>
            </div>
            <div class="col-sm col-card-attendance">
            <div class="card card-content">
                <h3 onClick="noclockout_detail_internal()" class="text-content-3">{{$noclockout}}</h3>
                <h3 class="text-title-1">No Clock Out</h3>
            </div>
            </div>
            <div class="col-sm col-card-attendance" style="border-left: 1px solid #b5b5b5;">
            <div class="texthead">
            <h5 class="text-content-1">Away</h5>
            </div>
            <div class="card card-content">
                <h2 onClick="dayoff_detail_internal()" class="text-content-3">{{$dayoff}}</h2>
                <h2 class="text-title-1">Day Off</h2>
            </div>
            </div>
            <div class="col-sm col-card-attendance">
            <div class="card card-content">
                <h2 onClick="timeoff_detail_internal()" class="text-content-3">{{$timeoff}}</h2>
                <h2 class="text-title-1">Time Off</h2>
            </div>
            </div>
        </div>
    </div>
</div>