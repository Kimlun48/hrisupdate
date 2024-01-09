
<meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="modal fade detail-pelamar" id="amdldtl12" tabindex="-1" role="dialog" aria-labelledby="ModalTransferLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-pelamar" role="document">
      <div class="modal-content modal-content-pelamar">
        <div class="modal-header">
          <h5 class="modal-title" id="albldtl12"></h5>
          <button type="button" class="close" onClick="acls12()"  id="close-button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modal-body-pelamar">
          <div id="adetl12" class="p-2"></div>
        </div>
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">  
$(document).ready(function(){
  // readalmostexpired();
  // readexpired();
});

// Baca Data Ketika Even Click almost
// function cekdataemploy(){
//   reademploy();
// }


function cls12() {
    $("#albldtl12").modal("hide");
    $("#adetl12").modal("hide");
    $("#amdldtl12").modal("hide");
}
function showakuuaa(id) {
    console.log('wkwkwk ini akuu',id); 
    $.get("{{ url('/employ/detail/') }}/"+id,{}, 
    function(data,status){
        $("#albldtl12").html('Detail karyawan');
        $("#adetl12").html(data);
        $("#amdldtl12").modal('show');
    });
}
</script>




<script>
document.getElementById("external").style.display="block";
document.getElementById("defaultexternal").click();

function tabGeneral(evt, tab) {
  var i, tabcontent, tablinks, hide_nav, nav_atas;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tab).style.display = "block";
  evt.currentTarget.className += " active";
  
}

</script>
