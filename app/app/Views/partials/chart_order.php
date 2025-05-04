<div class="card bg-white shadow rounded-2  mb-2">
    <div class="card-body">
        <canvas id="orderStatusChart" style="height: 200px"></canvas>
    </div>
    <!-- Spinner -->
    <div id="loadingSpinner8" class="spinner-border  position-absolute  start-50 top-50 d-none d-md-block" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <!--/ Spinner -->
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