@extends('layouts.commerce-master')

@section('title', 'Statistic')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('assets/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Gross Profit Margin</h1>
    </div>

    <div class="section-body">
        <div class="row mb-4 d-flex justify-content-between">
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Gross Profit</h5>
                                <span class="h2 font-weight-bold mb-0">{{ number_format($cumulativeGPM), 2, ',', '.'}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fa-solid fa-rupiah-sign"></i>
                                    <i class="fa-solid fa-arrow-trend-up" style="height: 0.5em"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            @if($kenaikanGPM>0)
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ number_format($kenaikanGPM, 2, '.', '' )}}%</span>
                            @else
                            <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{ number_format($kenaikanGPM, 2, '.', '') }}%</span>
                            @endif
                            <span class="text-nowrap">Dari tahun lalu</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Gross Margin</h5>
                                <span class="h2 font-weight-bold mb-0">{{ number_format($cumulativeGM), 2, ',', '.'}}%</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                    {{-- <i class="fas fa-chart-pie"></i> --}}
                                </div>
                            </div>
                        </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        @if($kenaikanGM>0)
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ number_format($kenaikanGM, 2, '.', '' )}}%</span>
                        @else
                        <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{ number_format($kenaikanGM, 2, '.', '') }}%</span>
                        @endif
                        <span class="text-nowrap">Dari tahun lalu</span>
                    </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="top-cogs card-title text-uppercase text-muted mb-0">Top Gross Profit</h5>
                                <span class="top-cogs h2 font-weight-bold mb-0">{{ $TopGP }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            @if($kenaikanGM>0)
                            <span class="text-success mr-2"></i> {{ number_format($biggestGPUser), 2, ',', '.'}}</span>
                            @else
                            <span class="text-danger mr-2"></i> {{ number_format($biggestGPUser), 2, ',', '.'}}</span>
                            @endif
                            <span class="text-nowrap">Total Gross Profit</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 style="color:#525358; font-weight:bold">Gross Profit</h4>
                        <div class="filter d-flex ">
                            <label for="filter-tahun-gp" class="col-form-label mr-3">Filter </label>
                            <select class="form-control" name="filter-tahun-gp" id="filter-tahun-gp" style="border-radius: 8px">
                                @foreach ($tahunData as $tahun)
                                    <option value=<?= $tahun->year ?>>{{ $tahun->year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id= chartGP>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 style="color:#525358; font-weight:bold">Gross Margin</h4>
                        <div class="filter d-flex ">
                            <label for="filter-tahun-gm" class="col-form-label mr-3">Filter </label>
                            <select class="form-control" name="filter-tahun-gm" id="filter-tahun-gm" style="border-radius: 8px">
                                @foreach ($tahunData as $tahun)
                                    <option value=<?= $tahun->year ?>>{{ $tahun->year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id= chartGM>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .icon-shape {
        display: inline-flex;
        padding: 12px;
        text-align: center;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
    }
    .icon {
        width: 3rem;
        height: 3rem;
    }

    .top-cogs{
        display: block; 
        width: 200px; 
        overflow: hidden; 
        white-space: nowrap; 
        text-overflow: ellipsis;
    }

    @media only screen and (max-width: 1366px) {
        .top-cogs{
            display: block; 
            width: 155px; 
            overflow: hidden; 
            white-space: nowrap; 
            text-overflow: ellipsis;
        }
    }
</style>

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/library/jqvmap/dist/maps/jquery.vmap.indonesia.js') }}"></script>
    

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/components-statistic.js') }}"></script>
@endpush
@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>

    // ==== CHART Gross Profit ====
    const gpmData1 = {!! json_encode($gpmData1) !!};
    const gpmData2 = {!! json_encode($gpmData2) !!};
    const monthNames = ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const monthIndexMapping = {
        'Januari': 0,
        'Febuari': 1,
        'Maret': 2,
        'April': 3,
        'Mei': 4,
        'Juni': 5,
        'Juli': 6,
        'Agustus': 7,
        'September': 8,
        'Oktober': 9,
        'November': 10,
        'Desember': 11
    };

    console.log("Ini GP DATA", gpmData1);
    console.log("Ini GM DATA", gpmData2);


document.addEventListener("DOMContentLoaded", function() {
    // ==== CHART GP ====
    var dropdownGP = document.getElementById("filter-tahun-gp");
    var selectedValueGP = dropdownGP.value;

    // ==== CHART GM ====
    var dropdownGM = document.getElementById("filter-tahun-gm");
    var selectedValueGM = dropdownGM.value;

    // ==== CHART GP ====
    function updateChartGP() {
        if (selectedValueGP !== "") {
            const filteredGPData = gpmData1.filter(item => item.year.toString() === selectedValueGP)

            const seriesDataGP = {};
            filteredGPData.forEach(item => {
                const year = item.year.toString();
                const month = item.month - 1;
                if (!seriesDataGP[year]) {
                    seriesDataGP[year] = new Array(12).fill(0);
                }
                seriesDataGP[year][month] += parseInt(item.gpm);
            });

            const realizationSeriesGP = Object.keys(seriesDataGP).map(year => {
                // ... kode untuk realization series
                return {
                    name: 'GP ' + year,
                    data: seriesDataGP[year]
                };
            });

            const newRealizationSeriesGP = realizationSeriesGP.map(item => ({
                name: item.name,
                data: item.data,
                zones: [
                    {
                        value: 0,
                        color: 'red'
                    },
                    {
                        color: 'green'
                    },
                ]
            }))

            const categories = monthNames;

            Highcharts.chart('chartGP', {
                // ... pengaturan chart
                chart: {
                    type: 'line'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xAxis: {
                    categories: categories,
                    crosshair: true,
                    accessibility: {
                        description: ''
                    }
                },
                yAxis: {
                    // min: 0,
                    title: {
                        text: 'Total Nilai'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [ ...newRealizationSeriesGP]
            });
        }
    }

    // ==== CHART GM ====
    function updateChartGM() {
        if (selectedValueGM !== "") {
            const filteredGMData = gpmData2.filter(item => item.year.toString() === selectedValueGM)

            const seriesDataGM = {};
            filteredGMData.forEach(item => {
                const year = item.year.toString();
                const month = item.month - 1;
                if (!seriesDataGM[year]) {
                    seriesDataGM[year] = new Array(12).fill(0);
                }
                seriesDataGM[year][month] += parseInt(item.gpm);
            });

            const realizationSeriesGM = Object.keys(seriesDataGM).map(year => {
                // ... kode untuk realization series
                return {
                    name: 'GM ' + year,
                    data: seriesDataGM[year]
                };
            });

            const newRealizationSeriesGM = realizationSeriesGM.map(item => ({
                name: item.name,
                data: item.data,
                zones: [
                    {
                        value: 0,
                        color: 'red'
                    },
                    {
                        color: 'green'
                    },
                ]
            }))

            const categories = monthNames;

            Highcharts.chart('chartGM', {
                // ... pengaturan chart
                chart: {
                    type: 'line'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xAxis: {
                    categories: categories,
                    crosshair: true,
                    accessibility: {
                        description: ''
                    }
                },
                yAxis: {
                    // min: 0,
                    title: {
                        text: 'Persentase Gross Margin'
                    },
                    labels: {
                        format: '{value}%'
                    }
                },
                tooltip: {
                    pointFormat: '<span">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                    valueSuffix: ''
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [ ...newRealizationSeriesGM]
            });
        }
    }

    // ==== CHART GP ====
    updateChartGP();

    // ==== CHART GM ====
    updateChartGM();

    dropdownGP.addEventListener("change", function() {
        selectedValueGP = dropdownGP.value;
        console.log("Nilai input tahun: " + selectedValueGP);
        updateChartGP(); // Call the updateChartGap function to rebuild the chart
    });

    dropdownGM.addEventListener("change", function() {
        selectedValueGM = dropdownGM.value;
        console.log("Nilai input tahun: " + selectedValueGM);
        updateChartGM(); // Call the updateChartGap function to rebuild the chart
    });
    }
);
</script>
@endsection