<script>

   document.getElementById("info").style.display="block"
   document.getElementById("defaultOpen").click(); 

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

      hide_nav =  document.getElementsByClassName("hide_nav");
      nav_atas =  document.getElementsByClassName("nav_atas");

      
      

      if($(hide_nav).attr('id') === "") {
         nav_atas.style.display = "none"
      }else {
         nav_atas.style.display = "block"
         
      }
   }




</script>

<!-- ini buat according myinfo -->
<script>
  $(document).ready(function() {
  $('.accordion-header').click(function() {
    $(this).parent().toggleClass('active');
  });
});

</script>

<style>
   .accordion-header {
  cursor: pointer;
}

.accordion-content {
  display: none;
}

.accordion-item.active .accordion-content {
  display: block;
}

.accordion-item.border-0 {
   background-color: #f9f9f9;
}

.icon-kanan{
   float: right;
}

.accordion-content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out;
}

.accordion-item.active .accordion-content {
  max-height: 500px; /* Sesuaikan tinggi maksimal sesuai kebutuhan */
  transition: max-height 0.3s ease-in;
}


</style>


<script>
   function showTab(tabId) {
      $('.tab-pane').removeClass('show active');
      $('#' + tabId).addClass('show active');
   }

   var table = document.getElementById("familyTable");
   var rows = table.getElementsByTagName("tr");

   for (var i = 0; i < rows.length; i++) {
      var currentRow = rows[i];
      var createClickHandler = function (row) {
         return function () {
            var cell = row.getElementsByTagName("td")[0];
            var id = cell.innerHTML;
            alert("Clicked ID: " + id);
            // Tambahan tindakan apa pun yang ingin Anda lakukan saat mengklik baris
            // Misalnya, pengisian formulir dengan data baris yang diklik, dll.
         };
      };
      currentRow.onclick = createClickHandler(currentRow);
   }

   function highlightRow(row) {
      row.classList.toggle("highlight");
   }
</script>


<style>
   .accordion-header {
  cursor: pointer;
}

.accordion-content {
  display: none;
}

.accordion-item.active .accordion-content {
  display: block;
}

.accordion-item.border-0 {
   background-color: #f9f9f9;
}

.icon-kanan{
   float: right;
}

.accordion-content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out;
}

.accordion-item.active .accordion-content {
  max-height: 500px; /* Sesuaikan tinggi maksimal sesuai kebutuhan */
  transition: max-height 0.3s ease-in;
}


</style>
