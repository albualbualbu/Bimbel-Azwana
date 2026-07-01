<?php 
include 'header.php'; 
include 'aksi.php'; 
date_default_timezone_set('Asia/Jakarta');
$saiki = Date("Y-m-d");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
        Dasboard</h1>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-body">
            
    <label for="startDate">Tanggal Mulai:</label>
    <input type="date" id="startDate">
    
    <label for="endDate">Tanggal Akhir:</label>
    <input type="date" id="endDate">

    <button onclick="calculateStatistics()">Filter</button>
    
    <!-- Canvas untuk Line Chart -->
    <canvas id="lineChart"></canvas>
    
        <div class="result" id="result"></div>
    
    <canvas id="lineChart" width="400" height="200"></canvas>



    <script>
    let chart; // Variabel untuk menyimpan chart agar dapat diupdate

    // Fungsi untuk mengambil data dari PHP (database)
    function fetchDataFromDatabase(callback) {
        fetch('getData.php') // Melakukan request ke file PHP
            .then(response => response.json()) // Mengubah response menjadi JSON
            .then(data => {
                callback(data); // Mengembalikan data ke callback
            })
            .catch(error => console.error('Error:', error));
    }

    // Fungsi untuk menampilkan statistik dan chart
    function displayStatisticsAndChart(data) {
        const resultDiv = document.getElementById('result');

        if (data.length === 0) {
            resultDiv.innerHTML = "<p>Tidak ada data tersedia untuk periode ini.</p>";
            return;
        }

        let total = 0;
        data.forEach(item => total += parseInt(item.value));

        const average = total / data.length;

        // Menampilkan hasil statistik
        resultDiv.innerHTML = `
            <p>&nbsp;</p>
            <h3>Hasil Statistik Pengunjung</h3>
            <p>Total: ${total}</p>
            <p>Rata-rata: ${average.toFixed(2)}</p>
            <p>Data yang digunakan:</p>
            <ul>
                ${data.map(item => `<li>${item.date}: ${item.value}</li>`).join('')}
            </ul>
        `;

        // Buat atau update Line Chart
        const labels = data.map(item => item.date);
        const values = data.map(item => item.value);

        if (chart) {
            chart.destroy(); // Hapus chart sebelumnya jika ada
        }

        const ctx = document.getElementById('lineChart').getContext('2d');
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai Statistik',
                    data: values,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.1  // Smooth curve
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nilai'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Fungsi untuk menampilkan data langsung saat halaman pertama kali dibuka
    window.onload = function() {
        // Mendapatkan tanggal hari ini dan tanggal 30 hari ke belakang
        const today = new Date();
        const thirtyDaysAgo = new Date();
        thirtyDaysAgo.setDate(today.getDate() - 30);

        // Format tanggal menjadi YYYY-MM-DD
        const todayFormatted = today.toISOString().split('T')[0];
        const thirtyDaysAgoFormatted = thirtyDaysAgo.toISOString().split('T')[0];

        // Menampilkan tanggal yang akan digunakan untuk filter
        console.log("Tanggal Hari Ini:", todayFormatted);
        console.log("Tanggal 30 Hari Sebelumnya:", thirtyDaysAgoFormatted);

        // Ambil data dari database dan filter berdasarkan rentang tanggal
        fetchDataFromDatabase((data) => {
            // Filter data berdasarkan tanggal
            const filteredData = data.filter(item => {
                return item.date >= thirtyDaysAgoFormatted && item.date <= todayFormatted;
            });

            // Menampilkan statistik dan chart dengan data yang sudah difilter
            displayStatisticsAndChart(filteredData);
        });
    };

    // Fungsi untuk menghitung statistik berdasarkan input tanggal
    function calculateStatistics() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const resultDiv = document.getElementById('result');

        if (!startDate || !endDate) {
            resultDiv.innerHTML = "<p style='color:red;'>Harap pilih kedua tanggal!</p>";
            return;
        }

        fetchDataFromDatabase((data) => {
            // Filter data berdasarkan tanggal yang dipilih oleh pengguna
            const filteredData = data.filter(item => {
                return item.date >= startDate && item.date <= endDate;
            });

            if (filteredData.length === 0) {
                resultDiv.innerHTML = "<p>Tidak ada data untuk rentang tanggal tersebut.</p>";
                return;
            }

            // Menampilkan statistik dan chart dengan data yang sudah difilter
            displayStatisticsAndChart(filteredData);
        });
    }
</script>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>
