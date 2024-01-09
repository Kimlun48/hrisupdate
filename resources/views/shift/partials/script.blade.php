
<script>

  $(document).ready(function(){
      read_data();
  });

  function edit(id, nama_lengkap, shift) {
    try {
        $.get("{{ url('/shift/showedit/') }}/" + id, {}, function (data, status) {
            $("#modaleditlabel").html('Edit Shift  - ' + nama_lengkap);
            $("#editor-body").html(data);
            $("#editmodal").modal('show');
            $("#id").val(id);
            $("#nama").val(nama_lengkap);
            // $("#shift").val(shift);
            // console.log("Nama: ", nama_lengkap);
        });
    } catch (error) {
        console.error(error);
    }
  }

  function Close() {
    $("#editmodal").modal("hide");
  }

  
  // function read_data() {
  //     $.get("{{ url('/shift/read_data') }}",{},
  //   function(data,status){
  //     $("#sceduler").html(data);
  //   });
  // };


  function toggleMenu(menuId) {
      var menu = document.getElementById(menuId);
      if (menu.style.display === "none") {
      menu.style.display = "block";
      } else {
      menu.style.display = "none";
      }
  }

  function read_data() {
    var startDate = $("#dateRangeStart").val();
    var endDate = $("#dateRangeEnd").val();
    // console.log(startDate, endDate);

    // Tampilkan SweetAlert2 dengan progress bar
    Swal.fire({
      title: 'Loading...',
      html: '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%; background-color: red;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>',
      allowOutsideClick: false,
      didOpen: () => {
        // Mencegah penutupan modal selama request berlangsung
        Swal.showLoading();
      },
    });

    $.ajax({
      url: "{{ url('/shift/read_data') }}",
      type: 'GET',
      xhr: function () {
        var xhr = new window.XMLHttpRequest();
        xhr.addEventListener("progress", function (evt) {
          if (evt.lengthComputable) {
            var percentComplete = (evt.loaded / evt.total) * 100;

            console.log('Progress Event:', percentComplete); // Tambahkan log untuk melihat progress

            // Update progress bar dan warna berdasarkan rentang persentase
            if (percentComplete <= 30) {
              $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'red');
            } else if (percentComplete <= 60) {
              $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'orange');
            } else if (percentComplete <= 100) {
              $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'green');
            } else {
              console.log('Persentase di luar rentang yang diharapkan:', percentComplete); // Tambahkan log untuk persentase di luar rentang
            }
          } else {
            console.log('Tidak dapat menghitung panjang total.'); // Tambahkan log jika tidak dapat menghitung panjang total
          }
        }, false);
        return xhr;
      },
      data: {
        start: startDate,
        end: endDate,
      },
      success: function(response) {
        // Manipulasi atau tampilkan data di sini
        $('#sceduler').html(response);
      },
      error: function(xhr, status, error) {
        console.error('Terjadi kesalahan:', error);
      },
      complete: function() {
        // Tutup SweetAlert2 setelah request selesai
        Swal.close();
      }
    });
  }








  


  function onclik_read_data() {
  var search = $("#search").val();

  // Pemeriksaan panjang input minimal 3 karakter atau tidak kosong
  if (search.length >= 3 || search.length === 0) {
      var startDate = $("#dateRangeStart").val();
      var endDate = $("#dateRangeEnd").val();

      // Tampilkan SweetAlert2 dengan progress bar
      Swal.fire({
          title: 'Loading...',
          html: '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%; background-color: red;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>',
          allowOutsideClick: false,
          didOpen: () => {
              // Mencegah penutupan modal selama request berlangsung
              Swal.showLoading();
          },
      });

      $.ajax({
          url: "{{ url('/shift/read_data') }}",
          type: 'GET',
          xhr: function () {
              var xhr = new window.XMLHttpRequest();
              xhr.addEventListener("progress", function (evt) {
                  if (evt.lengthComputable) {
                      var percentComplete = (evt.loaded / evt.total) * 100;

                      console.log('Progress Event:', percentComplete);

                      if (percentComplete <= 30) {
                          $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'red');
                      } else if (percentComplete <= 60) {
                          $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'orange');
                      } else if (percentComplete <= 100) {
                          $('.progress-bar').css('width', percentComplete + '%').css('background-color', 'green');
                      } else {
                          console.log('Persentase di luar rentang yang diharapkan:', percentComplete);
                      }
                  } else {
                      console.log('Tidak dapat menghitung panjang total.');
                  }
              }, false);
              return xhr;
          },
          data: {
              start: startDate,
              end: endDate,
              search: search,
          },
          success: function(response) {
              $('#sceduler').html(response);
          },
          error: function(xhr, status, error) {
              console.error('Terjadi kesalahan:', error);
          },
          complete: function() {
              Swal.close();
          }
      });
  } else if (search.length === 0) {
      // Reset progress bar and hide loading modal when search input is empty
      $('.progress-bar').css('width', '0%').css('background-color', 'red');
      Swal.close();

      // Load the initial data or response when the search input is empty
      $.ajax({
          url: "{{ url('/shift/read_data') }}",
          type: 'GET',
          success: function(response) {
              $('#sceduler').html(response);
          },
          error: function(xhr, status, error) {
              console.error('Terjadi kesalahan:', error);
          }
      });

      console.log('Input kosong.');
  }
};


$(document).ready(function() {
$('#ExportForm').on('click', function(event) {
event.preventDefault(); // Mencegah form submit normal
var startDate = $("#dateRangeStart").val(); // Ganti dengan tanggal awal yang diinginkan
var endDate = $("#dateRangeEnd").val();
var formData = new FormData();
  formData.append('start', startDate);
  formData.append('end', endDate);
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$.ajax({
    url: "{{ url('shift/exportExcel') }}", // Menggunakan route yang sudah didefinisikan sebelumnya
    method: "get",
    data: {
          startDate:startDate,
          endDate:endDate
          },
    success: function(response) {
      window.location.href = "{{ url('shift/exportExcel') }}"+"?"+"startDate="+startDate+"&endDate="+endDate;           
    },
    error: function(error) {
        console.error(error);
    }
  });
});
});
</script>

<script defer src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script defer src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const datePicker = $('#datepicker');
    const weekTypeRadios = $('input[name="weekType"]');
    const calendarDiv = $('#calendar');
    const dateRangeStartInput = $('#dateRangeStart');
    const dateRangeEndInput = $('#dateRangeEnd');

    datePicker.datepicker();
    const today = new Date();
    let startOfMonth, endOfMonth;

    if (today.getDate() < 21) {
      // If today is before the 21st, show the range from the 21st of the previous month to the 20th of the current month
      startOfMonth = new Date(today.getFullYear(), today.getMonth() - 1, 21);
      endOfMonth = new Date(today.getFullYear(), today.getMonth(), 20);
    } else {
      // If today is on or after the 21st, show the range from the 21st of the current month to the 20th of the next month
      startOfMonth = new Date(today.getFullYear(), today.getMonth(), 21);
      endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 20);
    }

    dateRangeStartInput.val(formatDate(startOfMonth));
    dateRangeEndInput.val(formatDate(endOfMonth));
    datePicker.val(`${formatDate(startOfMonth)} - ${formatDate(endOfMonth)}`);

    function calculateWeekDays(selectedDate, weekType) {
        calendarDiv.empty();

        if (weekType === '30') {
          if (selectedDate.getDate() < 21)
          {
            const startDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() - 1, 21);
            const endDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth()  , 20);
            generateCalendar(startDate, endDate);
            setRangeInputs(startDate, endDate);
          }
          if (selectedDate.getDate() >= 21)
          {
            const startDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), 21);
            const endDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1 , 20);
            generateCalendar(startDate, endDate);
            setRangeInputs(startDate, endDate);

          }

        } else {
            const isMonday = selectedDate.getDay() === 1;
            const startDate = isMonday ? selectedDate : getStartOfPreviousMonday(selectedDate);
            let endDate;

            if (weekType === '1') {
                endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 6);
            } else if (weekType === '2') {
                endDate = isMonday ? getEndOfCurrentWeek(selectedDate) : getEndOfFollowingSunday(selectedDate);
                endDate.setDate(endDate.getDate() + 7); // Adding an additional week
            }

            generateCalendar(startDate, endDate);
            setRangeInputs(startDate, endDate);
        }
    }

    function setRangeInputs(startDate, endDate) {
        dateRangeStartInput.val(formatDate(startDate));
        dateRangeEndInput.val(formatDate(endDate));
        datePicker.val(`${formatDate(startDate)} - ${formatDate(endDate)}`);
    }

    datePicker.on('change', function() {
        const selectedDate = new Date(datePicker.val().split(' - ')[0]);
        const weekType = weekTypeRadios.filter(':checked').val();
        calculateWeekDays(selectedDate, weekType);
    });

    weekTypeRadios.on('change', function() {
        const selectedDate = new Date(datePicker.val().split(' - ')[0]);
        const weekType = weekTypeRadios.filter(':checked').val();
        calculateWeekDays(selectedDate, weekType);
    });


    function generateCalendar(startDate, endDate) {
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        let currentDate = new Date(startDate);

        while (currentDate <= endDate) {
            const dayInfo = `${days[currentDate.getDay()]}, ${currentDate.getDate()} ${currentDate.toLocaleString('default', { month: 'long' })} ${currentDate.getFullYear()}`;
            const dayCell = $('<div>').addClass('calendar-cell').text(dayInfo);
            calendarDiv.append(dayCell);

            currentDate.setDate(currentDate.getDate() + 1);
        }
    }

      function getStartOfPreviousMonday(date) {
          const dayOfWeek = date.getDay();
          const daysToSubtract = dayOfWeek === 0 ? 6 : dayOfWeek - 1;
          const startOfPreviousMonday = new Date(date);
          startOfPreviousMonday.setDate(date.getDate() - daysToSubtract);
          return startOfPreviousMonday;
      }

      function getEndOfCurrentWeek(date) {
          const dayOfWeek = date.getDay();
          const endOfCurrentWeek = new Date(date);
          endOfCurrentWeek.setDate(date.getDate() + (6 - dayOfWeek));
          return endOfCurrentWeek;
      }

      function getEndOfFollowingSunday(date) {
          const dayOfWeek = date.getDay();
          const daysToAdd = dayOfWeek === 0 ? 0 : 7 - dayOfWeek;
          const endOfFollowingSunday = new Date(date);
          endOfFollowingSunday.setDate(date.getDate() + daysToAdd);
          return endOfFollowingSunday;
      }

      function formatDate(date) {
          const day = date.getDate();
          const month = date.getMonth() + 1;
          const year = date.getFullYear();
          return `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
      }
  });
</script>



<style>
.calendar-cell {
  display: block;
  margin-bottom: 10px;
  font-size: 16px;
}


</style>
