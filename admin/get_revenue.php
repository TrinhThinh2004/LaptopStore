<?php
$sql = "SELECT DATE_FORMAT(order_date, '%Y-%m') AS month, SUM(total_price) AS revenue
        FROM orders
        WHERE status = 3
        GROUP BY DATE_FORMAT(order_date, '%Y-%m')
        ORDER BY DATE_FORMAT(order_date, '%Y-%m') ASC";
$result = $conn->query($sql);

// Convert data to PHP array
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Extract years from data
$years = array_unique(array_map(function ($item) {
    return substr($item['month'], 0, 4);
}, $data));
$years = array_values($years); // Re-index the array
?>
<div id="revenue-section">
    <h2 class="title-revenue">Biểu đồ doanh thu theo tháng</h2>
    <div class="year-controls">
        <button id="prevYear">◀</button>
        <select id="yearSelector">
            <?php foreach ($years as $year): ?>
                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php endforeach; ?>
        </select>
        <button id="nextYear">▶</button>
    </div>
    <canvas id="revenueChart" width="1000" height="400"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data passed from PHP to JavaScript
        const dataFromPHP = <?php echo json_encode($data); ?>;
        const revenueDataByYear = {};

        // Organize data by year
        dataFromPHP.forEach(item => {
            const year = item.month.split('-')[0];
            if (!revenueDataByYear[year]) {
                revenueDataByYear[year] = [];
            }
            revenueDataByYear[year].push(item);
        });

        const ctx = document.getElementById('revenueChart').getContext('2d');
        let revenueChart;

        function updateChart(year) {
            const monthlyData = revenueDataByYear[year] || [];
            const labels = [];
            const revenues = [];

            // Prepare data for the selected year
            for (let month = 1; month <= 12; month++) {
                const monthString = year + '-' + String(month).padStart(2, '0');
                const found = monthlyData.find(item => item.month === monthString);
                labels.push(monthString);
                revenues.push(found ? parseFloat(found.revenue) : 0); // Default to 0 if no revenue
            }

            // Destroy previous chart instance if it exists
            if (revenueChart) {
                revenueChart.destroy();
            }

            // Create new chart with line connecting the tops of the bars
            revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Doanh thu theo tháng',
                            data: revenues,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            fill: true // Fill the area under the line
                        },
                        {
                            label: 'Doanh thu (line)',
                            data: revenues,
                            type: 'line', // Line chart type
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            fill: false, // Do not fill the area under the line
                            tension: 0.1 // Smooth the line
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        }

        // Initial chart load
        const initialYear = document.getElementById('yearSelector').value;
        updateChart(initialYear);

        // Event listener for year change
        document.getElementById('yearSelector').addEventListener('change', function() {
            updateChart(this.value);
        });

        // Event listeners for next and previous buttons
        document.getElementById('prevYear').addEventListener('click', function() {
            const currentYear = parseInt(document.getElementById('yearSelector').value);
            const newYear = currentYear - 1;
            if (revenueDataByYear[newYear]) {
                document.getElementById('yearSelector').value = newYear;
                updateChart(newYear);
            }
        });

        document.getElementById('nextYear').addEventListener('click', function() {
            const currentYear = parseInt(document.getElementById('yearSelector').value);
            const newYear = currentYear + 1;
            if (revenueDataByYear[newYear]) {
                document.getElementById('yearSelector').value = newYear;
                updateChart(newYear);
            }
        });
    </script>
</div>
<style>
    #revenue-section {
        margin: 20px 0 20px 30px;
        text-align: center;
        width: 100%;
    }

    .year-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    #yearSelector {
        margin: 0 10px;
        padding: 5px;
        font-size: 16px;
    }

    button {
        padding: 5px 10px;
        font-size: 16px;
        cursor: pointer;
        border: 1px solid #4CAF50;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    .title-revenue {
        margin-bottom: 20px;
    }
</style>