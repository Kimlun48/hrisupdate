<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type='text/javascript'>

var months = ['January', 'February', 'March', 'April', 'Mey', 'June', 'July', 'August', 'September', 'October', 'November', 'Desember'];

var myDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friyday', 'Saturday'];

var date = new Date();

var day = date.getDate();

var month = date.getMonth();

var thisDay = date.getDay(),

    thisDay = myDays[thisDay];

var yy = date.getYear();

var year = (yy < 1000) ? yy + 1900 : yy;

tanggallengkap = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
document.getElementById("time").innerHTML = tanggallengkap;
document.getElementById("tanggal").innerHTML = tanggallengkap;

const time = new Date().getHours();
let greeting;

if (time < 10) {
greeting = "Good Morning";
} else if (time < 15) {
greeting = "Good Afternoon";
} else if (time < 19) {
greeting = "Good Afternoon";
} else {
greeting = "Good Evening";
}

document.getElementById('greetings').innerHTML = greeting ;

// grafik total pelamar


var word = [
'Semangat untuk hari ini', 
'Target Target Targer', 
'Ingat cicilan masih banyak',
'Dia nungguin dihalalin',
'Kerja masih miskin'];
var words = word[Math.floor(Math.random()*word.length)]; 
document.getElementById('word').innerHTML = words ;

</script>


<!-- chart -->
<script type="text/javascript">
    var chartData = JSON.parse(`<?php echo $hasil ?>`);
	var chartlineData = JSON.parse(`<?php echo $ref ?>`);
	const ctx = document.getElementById('grafikpelamar').getContext('2d');
	const ctx2 = document.getElementById('chartline').getContext('2d');

    const myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: chartData.label,
        datasets: [{
            label: 'Total Pelamar',
            data: chartData.data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(11, 58, 177, 1)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 119, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 119, 64, 1)'
            ],
            borderWidth: 1,
            borderRadius: 10 // Sesuaikan nilai ini sesuai keinginan Anda
        }]
    },
    options: {
        cutoutPercentage: 50,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


    const chartline = new Chart(ctx2, {
        type: 'line',
            data: {
                labels: chartlineData.label,
                datasets: [{
                    minBarLength: 2,
                        label: 'Reference Vacancy',
                        data: chartlineData.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(11, 58, 177, 1)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 119, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
        });



</script>


<script>
    function closeDetail() {
    $("#modalDetail").modal('hide');
    }

    function showdetailaplicant(id) {
    $.get("{{ url('/pelamar/showdetail') }}/"+id,{}, 
    function(data,status){
        $("#labeldetail").html('Detail Applicant');
        $("#detail").html(data);
        $("#modalDetail").modal('show');    
    });
    }

</script>
