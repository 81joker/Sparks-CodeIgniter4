<div class="card bg-white shadow rounded-2  mb-2">
    <div class="card-body">
        <canvas id="orderStatusChart" style="height: 200px"></canvas>
    </div>
</div>
<script>
    // Chart.js configuration
    window.onload = function() {
        // Order Status Chart
        const statusCtx = document.getElementById('orderStatusChart');
        if (statusCtx) {
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: <?= $statusLabels ?>,
                    datasets: [{
                        data: <?= $statusData ?>,
                        backgroundColor: <?= $statusColors ?>,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        }
    };
</script>