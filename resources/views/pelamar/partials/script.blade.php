<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

    $(document).ready(function() {
        read();
    });

   
    function Close() {
      $("#modalAppr").modal('hide');  
    }

    function closeReject() {
    $("#modalReject").modal('hide');
    }
    
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        getPelamar(url);
        window.history.pushState("", "", url);
   

    function getPelamar(url) {
        $.ajax({
            url : url  
        }).done(function (data) {
            $('#pelamar').html(data);  
        });
      };
    });

    function closeDetail() {
    $("#modalDetail").modal('hide');
    }

    function showdetail(id) {
    $.get("{{ url('/pelamar/showdetail') }}/"+id,{}, 
    function(data,status){
        $("#detail").html(data);
        $("#modalDetail").modal('show');    
    });
    }


  $(document).on('click', '#storeapprove', function () {
    let back = window.location.href;
    event.preventDefault();
    let aprid = $("#cekid").val();
    let form = $('#myform')[0];
    let formData = new FormData(form);
    Close();
    $('#cover-spin').show(0);

    function getback(back) {
        $.ajax({
            url : back  
        }).done(function (data) {
            $('#pelamar').html(data);  
        });
    }
    
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url:"{{ url('/verif/storeapprove') }}",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data, textStatus, xhr) {
        $('#myform')[0].reset();
        $('#cover-spin').hide();
        getback(back);
          Swal.fire({
          icon: 'success',
            title: data.message,
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: 'Ok',
            timer: 1500
        });
      },
        error:function(data){
          
      }
      });
    });

    //store Reject
    $(document).on('click', '#storeReject', function () {
    event.preventDefault();
    let form = $('#myformReject')[0];
    let formData = new FormData(form);
    let back = window.location.href;  
    closeReject();
    $('#cover-spin').show(0);
    

    function getback(back) {
        $.ajax({
            url : back  
        }).done(function (data) {
            $('#pelamar').html(data);  
        }).fail(function () {
            alert('Applicant could not be loaded.');
        });
    }

  $.ajax({
    url:"{{ url('/verif/storereject') }}",
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function (data, textStatus, xhr) {
    $('#myformReject')[0].reset();
    $('#cover-spin').hide();
    getback(back);
        Swal.fire({
        icon: 'success',
          title: data.message,
          showDenyButton: false,
          showCancelButton: false,
          confirmButtonText: 'Ok',
          timer: 1500
      });
    },
      error:function(data){
        
    }
      });
      
    });


    function showreject(id) {
    $.get("{{ url('/pelamar/showrej') }}/"+id,{}, 
    function(data,status){
        $("#rej").html(data);
        $("#modalReject").modal('show');    
    });
    }
      
    function showapprove(id) {
    $.get("{{ url('/pelamar/showapp') }}/"+id,{}, 
    function(data,status){
        $("#appr").html(data);
        $("#modalAppr").modal('show');    
    });
    }
  

    $(document).ready(function(){
    //let progres=$(this).val();
     valueBut = "" 
     $('#button_1, #button_2, #button_3, #button_4, #button_5, #button_6, #button_7, #button_8').on('click', function (){
        valueBut = this.value;
     })
     
    $('#search').on('keyup', function(){
       let value=$(this).val();
      console.log('A...', valueBut)
    
    $.ajax({
      type : 'get',
      url : "{{URL::to('pelamar/show')}}",
      data:{
       progres:valueBut,
        search:value,
        
    },
      success:function(data){
        $('#pelamar').html(data);

      },
      error : function(){
       alert("Data tidak di temukan..! ");
        $('#search').val('');
        
      }


    });
    console.log(data)
  })
});

$(document).ready(function(){
   $('#button_1').on('click', function(e){
      e.stopPropagation();
     let value=$(this).val();
     let search=$('#search').val();


    $.ajax({
      type : 'get',
      url : '{{URL::to('pelamar/show')}}',
      data:{
        progres:value,
          search:search,
        },
      success:function(data){
        $('#pelamar').html(data);
      },
      error : function(){
       alert("Data tidak di temukan..! ");
        $('#search').val('');
        $('#button_1').val('');
         $('#button_1').trigger("click");
         $('#button_1').val('Administration');
      }
    });
    console.log(value)
  })
});

$(document).ready(function(){
    $('#button_2').on('click', function(e){
      e.stopPropagation();
     let value=$(this).val();
     let search=$('#search').val();


    $.ajax({
      type : 'get',
      url : '{{URL::to('pelamar/show')}}',
      data:{
        progres:value,
          search:search,
        },
      success:function(data){
        $('#pelamar').html(data);
      },
     error : function(){
       alert("Data tidak di temukan..! ");
        $('#search').val('');
        $('#button_2').val('');
         $('#button_2').trigger("click");
         $('#button_2').val('Interview');
      }
    });
    console.log(value)
  })
});

$(document).ready(function(){
    $('#button_3').on('click', function(e){
      e.stopPropagation();
     let value=$(this).val();
     let search=$('#search').val();
    console.log('but 3 ke click', valueBut)
    $.ajax({
      type : 'get',
      url : '{{URL::to('pelamar/show')}}',
      data:{
        progres:value,
          search:search,
        },
      success:function(data){
        $('#pelamar').html(data);
      },
      error : function(){
       alert("Data tidak di temukan..! ");
        $('#search').val('');
        $('#button_3').val('');
         $('#button_3').trigger("click");
         $('#button_3').val('Psychotest');
        
      }
    });
    console.log(value)
  })
});

$(document).ready(function(){
    $('#button_4').on('click', function(e){
      e.stopPropagation();
     let value=$(this).val();
     let search=$('#search').val();


    $.ajax({
      type : 'get',
      url : '{{URL::to('pelamar/show')}}',
      data:{
        progres:value,
          search:search,
        },
      success:function(data){
        $('#pelamar').html(data);
      },
      
        error : function(){
       alert("Data tidak di temukan..! ");
        $('#search').val('');
        $('#button_4').val('');
         $('#button_4').trigger("click");
         $('#button_4').val('Interview user');
      }

    });
    console.log(value)
  })
});

$(document).ready(function(){
    $('#button_5').on('click', function(e){
      e.stopPropagation();
     let value=$(this).val();
     let search=$('#search').val();


    $.ajax({
      type : 'get',
      url : '{{URL::to('pelamar/show')}}',
      data:{
        progres:value,
          search:search,
        },
      success:function(data){
        $('#pelamar').html(data);
      },
      error : function(){
       alert("Data tidak di temukan..! ");
        $('#search').val('');
        $('#button_5').val('');
         $('#button_5').trigger("click");
         $('#button_5').val('Offering Letter');
        
      }
    });
    console.log(value)
  })
});

$(document).ready(function(){
   $('#button_6').on('click', function(e){
      e.stopPropagation();
     let value=$(this).val();
     let search=$('#search').val();


    $.ajax({
      type : 'get',
      url : '{{URL::to('pelamar/show')}}',
      data:{
        progres:value,
        search:search,
        },
      success:function(data){
        $('#pelamar').html(data);
      },
      error : function(){
       alert("Data tidak di temukan..! ");
        $('#search').val('');
        $('#button_6').val('');
         $('#button_6').trigger("click");
         $('#button_6').val('Contract');
      }
    });
    console.log(value)
  })
});

$(document).ready(function(){
   $('#button_7').on('click', function(e){
      e.stopPropagation();
     let value=$(this).val();
     let search=$('#search').val();


    $.ajax({
      type : 'get',
      url : '{{URL::to('pelamar/show')}}',
      data:{
        progres:value,
          search:search,
        },
      success:function(data){
        $('#pelamar').html(data);
      },
     error : function(){
       alert("Data tidak di temukan..! ");
        $('#search').val('');
        $('#button_7').val('');
         $('#button_7').trigger("click");
         $('#button_7').val('Finish');
      }
    });
    console.log(value)
  })
});

$(document).ready(function(){
   $('#button_8').on('click', function(e){
      e.stopPropagation();
     let value=$(this).val();
     let search=$('#search').val();


    $.ajax({
      type : 'get',
      url : '{{URL::to('pelamar/show')}}',
      data:{
         progres:value,
          search:search,
        },
      success:function(data){
        $('#pelamar').html(data);
      },
     error : function(){
       alert("Data tidak di temukan..! ");
        $('#search').val('');
        $('#button_8').val('');
         $('#button_8').trigger("click");
         $('#button_8').val('Reject');
      }
    });
    console.log(value)
  })
});

// (document).ready(function(){
//     $('#inlineCheckbox1').on('change', function(){
//      let value=$(this).val();
    
//      //let arr:[]
//     $.ajax({
//       type : 'get',
//       url : '{{URL::to('pelamar/show')}}',
//       data:{
//         // 'progres':value,
//         //  'choiceValue':coba,
//         progres:value, 
       
//       },
//       success:function(data){
        
//         $('#pelamar').html(data);
//        // alert(data);
//       }
//     });
//     console.log(value)
//   })

// })

$('#vehicleChkBox').change(function(){
    if(this.checked)
        $('#inlineCheckbox1').val('TRUE');
   else
        $('#inlineCheckbox1').val('False');
});
console.log(val);


// $(document).ready(function() {
//   $("button").click(function(){
//     var days = [];
//     $.each($("input[name='directions']:checked"), function(){
//       days.push($(this).val());
//     });
//     alert("Selected say(s) are: " + days.join(", "));
//   });
// });


</script>
