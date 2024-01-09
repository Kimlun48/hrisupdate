<div class="border-body">
  <div class="table-responsive">

    <div class="col-md-12 d-flex">

      <div class="card ml-2 md-4" style="width:33%;">
        <div class="card-header text-center">
          Allowances
        </div>
        <div class="card-body">
          <div class="input-group mb-2">
            <form id="createForm" class="col-md-12 d-flex" >
              <input name="nama" type="text" class="form-control form-control-sm mr-1" placeholder="Component" id="nama" >
              <input name="jenis" type="hidden" class="form-control form-control-sm mr-1" value="Penambah" >
              <input name="komponen" type="hidden" class="form-control form-control-sm mr-1" value="Allowance" >
              <select name="status_tunjangan"class="form-control form-control-sm custom-select" id="inputGroupSelect01" required>
                <option selected disabled value="">Choose...</option>
                <option value="Monthly">Monthly</option>
                <option value="Daily">Daily</option>
                <option value="One Time">One Time</option>
              </select>
              <button class="btn btn-sm ml-2" onClick="createparam()">Add</button>   
            </form>
          </div>
          <hr/>
          <div class="table-wrapper-scroll-y my-custom-scrollbar scroll-wrapper">
            <table class="table data-table">
              @foreach ($param as $key => $par)
              @if($par->komponen =="Allowance")
              <form id="editallowance_{{ $par->id }}" class="col-md-12 d-flex" >
              @csrf
              <span>
                  <span class="badge badge-pill badge-success">{{$par->nama}}
                      <input type="hidden" class="form-control form-control-sm mr-1 " value="{{$par->id}}" name="idparam">
                      <button class="btn ml-2 badge badge-pill badge-danger" onClick="confirmEditAllowance({{ $par->id }})">X</button>
                  </span>
              </span>
              </form>
              @endif
              @endforeach
            </table>  
          </div>
        </div>
      </div>
      <div class="card ml-2 md-4" style="width:33%;">
        <div class="card-header text-center">
          Deductions
        </div>
        <div class="card-body">
          <div class="input-group mb-2">
            <form id="createFormDeductions" class="col-md-12 d-flex" >
              <input name="nama" type="text" class="form-control form-control-sm mr-1" placeholder="Component" id="nama_deductive" >
              <input name="komponen" type="hidden" class="form-control form-control-sm mr-1" value="Deductions" >
              <input name="jenis" type="hidden" class="form-control form-control-sm mr-1" value="Pengurang" >
              <select name="status_tunjangan"class="form-control form-control-sm custom-select" id="inputGroupSelect01">
                <option selected disabled value="">Choose...</option>
                <option value="Monthly">Monthly</option>
                <option value="Daily">Daily</option>
                <option value="One Time">One Time</option>
              </select>
              <button class="btn ml-2 btn-sm" onClick="createdeductions()">Add</button>   
            </form>
          </div>
          <hr/>
          <table class="table data-table">
            @foreach ($param as $key => $par)
            @if($par->komponen =="Deductions")
            <form id="editdeductive_{{ $par->id }}" class="col-md-12 d-flex" >
            <span>
              <span class="badge badge-pill badge-success">{{$par->nama}}
                <input type="hidden" class="form-control form-control-sm mr-1 " value="{{$par->id}}" name="idparam">
                <button class="btn ml-2 badge badge-pill badge-danger" onClick="confirmEditDeductive({{ $par->id }})">X</button>
              </span>
            </span>
            </form>
            @endif
            @endforeach
          </table>  
        </div>
      </div> 
      <div class="card ml-2 md-4" style="width:33%;">
        <div class="card-header text-center">
          Benefit
        </div>
        <div class="card-body">
          <div class="input-group mb-2">
            <form id="createFormBenefit" class="col-md-12 d-flex" >
              <input name="nama" type="text" class="form-control form-control-sm mr-1" placeholder="Component" id="nama_benefit">
              <input name="komponen" type="hidden" class="form-control form-control-sm mr-1" value="Benefit" >
              <input name="jenis" type="hidden" class="form-control form-control-sm mr-1" value="Pengurang" >
              <select name="status_tunjangan"class="form-control form-control-sm custom-select" id="inputGroupSelect01">
                <option selected disabled value="">Choose...</option>
                <option value="Monthly">Monthly</option>
                <option value="Daily">Daily</option>
                <option value="One Time">One Time</option>
              </select>
              <button class="btn ml-2 btn-sm" onClick="createbenefit()">Add</button>   
            </form>
          </div>
          <hr/>
          <table class="table data-table">
            @foreach ($param as $key => $par)
            @if($par->komponen =="Benefit")
            <form id="editbenefit_{{ $par->id }}" class="col-md-12 d-flex" >
            @csrf
            <span>
                <span class="badge badge-pill badge-success">{{$par->nama}}
                    <input type="hidden" class="form-control form-control-sm mr-1 " value="{{$par->id}}">
                    <button class="btn ml-2 badge badge-pill badge-danger" onClick="confirmEditBenefit({{ $par->id }})">X</button>
                </span>
            </span>
            </form>
            @endif
            @endforeach
          </table>  
        </div>
      </div> 

    </div>
  </div>
</div>

<script>
$(document).ready(function()
{
    $('#nama,#nama_deductive,#nama_benefit').keyup(function()
    {
        $(this).val($(this).val().toUpperCase());
    });
});
</script>

<style>
.my-custom-scrollbar {
position: relative;
height: 300px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
.scroll-wrapper{
  position: relative;
  overflow-x:scroll;
}

.badge.badge-success, .label.label-success {
  /* background: #00acac; */
  background: var(--blue-default, #4B61DD);
}

.badge.badge-danger, .label.label-danger {
  background: #fff;
  color: red;
  
}

.card-header{
  background: var(--primary-2, #F1F5F9);
}

button.btn.ml-2.btn-sm {
  border-radius: 8px;
  background: var(--blue-default, #4B61DD);
  color: #fff;
  padding: 0px 15px;
}
</style>