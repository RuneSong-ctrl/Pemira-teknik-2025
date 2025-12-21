@extends('/admin/layouts/master',['title'=>'Dashboard'])

@section('content')
<style>
    /* Global Dashboard Styling */
    .dashboard-wrapper {
        padding: 30px;
        padding-top: 50px; 
        background-color: #f4f6f9;
        min-height: 100vh;
        font-family: 'Nunito', sans-serif;
    }

    /* Page Header */
    .page-header { margin-bottom: 25px; }
    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #343a40;
        margin: 0;
    }
    .page-subtitle { color: #6c757d; font-size: 0.9rem; }

    /* Modern Stat Cards */
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border: none;
        height: 100%;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .stat-icon {
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 3rem;
        opacity: 0.1;
    }

    .stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
        display: block;
    }

    .stat-number { font-size: 2rem; font-weight: 800; color: #212529; }
    .card-blue .stat-label { color: #007bff; }
    .card-green .stat-label { color: #28a745; }
    .card-red .stat-label { color: #dc3545; }

    /* Content Cards */
    .content-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border: none;
        margin-bottom: 30px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-header-clean {
        padding: 20px 25px;
        border-bottom: 1px solid #f0f2f5;
        background: transparent;
    }

    .card-header-clean h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: #495057;
    }

    .card-body-clean { padding: 25px; flex: 1; }

    /* Ranking List Styling */
    .ranking-list { list-style: none; padding: 0; margin: 0; }
    .ranking-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #f0f2f5;
        transition: background-color 0.2s;
    }
    .ranking-item:last-child { border-bottom: none; }
    .ranking-item:hover { background-color: #fafafa; }

    .rank-badge {
        width: 35px;
        height: 35px;
        background: #343a40;
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin-right: 15px;
        font-size: 0.9rem;
    }
    .rank-badge.top-1 { background: #ffd700; color: #856404; }
    .rank-badge.top-2 { background: #c0c0c0; color: #3e3e3e; }
    .rank-badge.top-3 { background: #cd7f32; color: #5a3a22; }

    .candidate-info h5 { margin: 0; font-size: 0.95rem; font-weight: 600; color: #333; }
    .vote-pill {
        background: #e9ecef;
        color: #495057;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 4px;
        display: inline-block;
    }
    .section-title {
        font-size: 0.8rem;
        font-weight: 800;
        color: #adb5bd;
        text-transform: uppercase;
        margin: 20px 0 10px;
        letter-spacing: 1px;
    }
</style>

<div ui-view class="dashboard-wrapper" id="view">
    
    <div class="page-header">
        <h1 class="page-title">Dashboard Overview</h1>
        <p class="page-subtitle">Pantauan Real-time Pemilihan Raya</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="stat-card card-blue">
                <i class="fa fa-users stat-icon text-primary"></i>
                <span class="stat-label">Total DPT Terverifikasi</span>
                <span class="stat-number">{{ $data['jml_milih'] + $data['jml_golput'] }}</span>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="stat-card card-green">
                <i class="fa fa-check-circle stat-icon text-success"></i>
                <span class="stat-label">Sudah Memilih</span>
                <span class="stat-number">{{ $data['jml_milih'] }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card card-red">
                <i class="fa fa-times-circle stat-icon text-danger"></i>
                <span class="stat-label">Belum Memilih / Golput</span>
                <span class="stat-number">{{ $data['jml_golput'] }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content-card w-100">
                <div class="card-header-clean">
                    <h3><i class="fa fa-trophy mr-2 text-warning"></i> Posisi Sementara</h3>
                </div>
                <div class="card-body-clean" style="overflow-y: auto; max-height: 500px;">
                    
                    <div class="section-title mt-0">SMFT</div>
                    <ul class="ranking-list">
                        @foreach ($data['smft'] as $item)
                        <li class="ranking-item">
                            <div class="rank-badge {{ $loop->iteration <= 3 ? 'top-'.$loop->iteration : '' }}">
                                {{ $loop->iteration }}
                            </div>
                            <div class="candidate-info">
                                <h5>{{$item->nama_panggilan}}</h5>
                                <span class="vote-pill">{{$item->voted}} Suara</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <div class="section-title mt-4">BPMFT</div>
                    <ul class="ranking-list">
                        @foreach ($data['bpmft'] as $item)
                        <li class="ranking-item">
                            <div class="rank-badge {{ $loop->iteration <= 3 ? 'top-'.$loop->iteration : '' }}">
                                {{ $loop->iteration }}
                            </div>
                            <div class="candidate-info">
                                <h5>{{$item->nama_panggilan}}</h5>
                                <span class="vote-pill">{{$item->voted}} Suara</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>

        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="content-card w-100">
                <div class="card-header-clean">
                    <h3><i class="fa fa-chart-pie mr-2 text-info"></i> Persentase Partisipasi</h3>
                </div>
                <div class="card-body-clean d-flex justify-content-center align-items-center">
                    <div style="width: 100%; min-height: 350px;">
                        <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
                            [
                                {data: [{{ $data['jml_milih'] }}], label: 'Sudah Memilih'},
                                {data: [{{ $data['jml_golput'] }}], label: 'Belum Memilih'}
                            ],
                            {
                                series: {
                                    pie: { show: true, innerRadius: 0.5, stroke: { width: 0 }, label: { show: true, threshold: 0.05 } }
                                },
                                legend: { backgroundColor: 'transparent' },
                                colors: ['#28a745', '#dc3545'],
                                grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
                                tooltip: true,
                                tooltipOpts: { content: '%s: %p.0%' }
                            }
                        " style="height: 100%; min-height: 350px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="content-card">
                <div class="card-header-clean">
                    <h3><i class="fa fa-chart-bar mr-2 text-primary"></i> Rincian Suara Per Program Studi</h3>
                </div>
                <div class="card-body-clean">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <h6 class="text-center mb-3 font-weight-bold text-muted">VOTE SMFT</h6>
                            <div style="position: relative; height: 300px; width: 100%;">
                                <canvas id="smft"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <h6 class="text-center mb-3 font-weight-bold text-muted">VOTE BPMFT</h6>
                            <div style="position: relative; height: 300px; width: 100%;">
                                <canvas id="bpmft"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('footer')
<script>
    var cSmft = document.getElementById('smft');
    var cBpmft = document.getElementById('bpmft');
    
    // Variabel global untuk instance chart
    var chartSMFT = null;
    var chartBPMFT = null;

    loadDataChart();

    function loadDataChart(){
        $.ajax({
            url: '{{Route("chart")}}',
            type: 'get',
            success: function(data){
                // Parsing jika data dalam bentuk string JSON
                var chartData = (typeof data === 'string') ? JSON.parse(data) : data;
                updateChart(chartData);
            },
            error: function(err) {
                console.error("Gagal memuat data chart", err);
            }
        });
    }

    function updateChart(data) {
        // Validasi data
        if (!data.SMFT || !data.BPMFT) return;

        var smft_calons = Object.keys(data.SMFT);
        var bpmft_calons = Object.keys(data.BPMFT);

        if (smft_calons.length === 0 || bpmft_calons.length === 0) return;

        // Ambil label prodi (Asumsi struktur data konsisten)
        var prodis = data.SMFT[smft_calons[0]].prodis || [];

        // Setup Dataset SMFT
        var datasmft = {
            labels: prodis,
            datasets: smft_calons.map((calon, index) => ({
                label: calon,
                backgroundColor: index === 0 ? 'rgba(54, 162, 235, 0.6)' : 'rgba(255, 99, 132, 0.6)', // Biru vs Merah
                borderColor: index === 0 ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: data.SMFT[calon]?.prodi_value || []
            }))
        };

        // Setup Dataset BPMFT
        var databpmft = {
            labels: prodis,
            datasets: bpmft_calons.map((calon, index) => {
                // Generate warna dinamis agar beda tiap calon
                let r = (index * 60 + 50) % 255;
                let g = (index * 100 + 50) % 255;
                let b = (index * 140 + 50) % 255;
                return {
                    label: calon,
                    backgroundColor: `rgba(${r}, ${g}, ${b}, 0.6)`,
                    borderColor: `rgba(${r}, ${g}, ${b}, 1)`,
                    borderWidth: 1,
                    data: data.BPMFT[calon]?.prodi_value || []
                }
            })
        };

        // Hancurkan chart lama jika ada (mencegah memory leak / tumpuk)
        if (chartSMFT) chartSMFT.destroy();
        if (chartBPMFT) chartBPMFT.destroy();

        var commonOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                position: 'bottom',
                labels: { boxWidth: 12 }
            },
            scales: {
                yAxes: [{
                    ticks: { beginAtZero: true }
                }],
                xAxes: [{
                    gridLines: { display: false }
                }]
            }
        };

        // Render Chart Baru
        chartSMFT = new Chart(cSmft, {
            type: 'bar',
            data: datasmft,
            options: commonOptions
        });

        chartBPMFT = new Chart(cBpmft, {
            type: 'bar',
            data: databpmft,
            options: commonOptions
        });
    }
</script>
@endsection