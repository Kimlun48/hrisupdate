<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>
    var chartVacancyData = JSON.parse(`<?php echo json_encode($data) ?>`);
    var chartReferenceData = JSON.parse(`<?php echo json_encode($result) ?>`);

    const ctxVacancy = document.getElementById('grafikpelamar').getContext('2d');
    const myVacancyChart = new Chart(ctxVacancy, {
        type: 'doughnut',
        data: {
            labels: chartVacancyData.labels,
            datasets: [{
                label: 'Total Pelamar',
                data: chartVacancyData.data,
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
                borderRadius: 10
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

    const ctxReference = document.getElementById('grafikreferensi').getContext('2d');
    const myReferenceChart = new Chart(ctxReference, {
        type: 'bar',
        data: {
            labels: chartReferenceData.labels,
            datasets: [{
                label: 'Jumlah Pelamar',
                data: chartReferenceData.data,
                backgroundColor: 'rgba(11, 58, 177, 0.8)',
                borderColor: 'rgba(11, 58, 177, 1)',
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
