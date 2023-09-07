@extends('layouts.manager-master')

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
        <h1>Revenue Operasional</h1>
    </div>

    <div class="section-body">
        <div class="row mb-4 d-flex justify-content-between">
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Realisasi</h5>
                                <span class="h5 font-weight-bold mb-0">{{ number_format($TotalRealisasiRevenue), 2, ',', '.'}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fa-solid fa-rupiah-sign"></i>
                                    <i class="fa-solid fa-arrow-trend-up" style="height: 0.5em"></i>
                                    {{-- <i class="fas fa-chart-bar"></i> --}}

                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            @if($kenaikanRealisasi>0)
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ number_format($kenaikanRealisasi, 2, '.', '' )}}%</span>
                            @else
                            <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{ number_format($kenaikanRealisasi, 2, '.', '') }}%</span>
                            @endif
                            <span class="text-nowrap">Dari tahun lalu</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Target</h5>
                                <span class="h5 font-weight-bold mb-0">{{ number_format($TotalTarget1), 2, ',', '.'}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                    <i class="fas fa-chart-pie"></i>
                                    {{-- <i class="fa-regular fa-list-check fa-xl"></i> --}}
                                    {{-- <i class="fa-regular fa-bullseye fa-lg"></i> --}}
                                </div>
                            </div>
                        </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        @if($kenaikanTarget>0)
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ number_format($kenaikanTarget, 2, '.', '' )}}%</span>
                        @else
                        <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{ number_format($kenaikanTarget, 2, '.', '') }}%</span>
                        @endif
                        <span class="text-nowrap">Dari tahun lalu</span>
                    </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">GAP</h5>
                                <span class="h5 font-weight-bold mb-0">{{ number_format($gapSum1), 2, ',', '.'}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow" style="background-color: #6f42c1">
                                    <i class="fas fa-percent"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            @if($kenaikanGap>0)
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ number_format($kenaikanGap, 2, '.', '' )}}%</span>
                            @else
                            <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{ number_format($kenaikanGap, 2, '.', '') }}%</span>
                            @endif
                            <span class="text-nowrap">Dari tahun lalu</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Top Revenue </h5>
                                <span class="top-cogs h5 font-weight-bold mb-0">{{$TopRevenue}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-success mr-2">
                                @if($GapTop<0)
                                <span class="text-success mr-2">{{ number_format($GapTop), 2, ',', '.'}}</span>
                                @else
                                <span class="text-danger mr-2"></i>{{ number_format($GapTop), 2, ',', '.'}}</span>
                                @endif
                            </span>
                            <span class="text-nowrap">Total GAP</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 style="color:#525358; font-weight:bold">Revenue Operasional</h4>
                        <div class="filter d-flex ">
                            <label for="tahun" class="col-form-label mr-3">Filter </label>
                            <select class="form-control" name="tahun-filter" id="tahun-filter" style="border-radius: 8px">
                                @foreach ($tahunData as $tahun)
                                    <option value=<?= $tahun->tahun ?>>{{ $tahun->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id= chartRevenue>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 style="color:#525358; font-weight:bold">GAP</h4>
                        <div class="filter d-flex ">
                            <label for="tahun" class="col-form-label mr-3">Filter </label>
                            <select class="form-control" name="tahun-filter-gap" id="tahun-filter-gap" style="border-radius: 8px">
                                @foreach ($tahunData as $tahun)
                                    <option value=<?= $tahun->tahun ?>>{{ $tahun->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id= chartGAP>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 style="color:#525358; font-weight:bold">Perbandingan Tahun</h4>
                        <div class="filter d-flex">
                            <div class="mr-3">
                                <label for="revenue-tahun-filter-1" class="col-form-label">Filter 1:</label>
                                <select class="form-control" name="revenue-tahun-filter-1" id="revenue-tahun-filter-1" style="border-radius: 8px">
                                    @foreach ($tahunData as $tahun)
                                    <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="revenue-tahun-filter-2" class="col-form-label">Filter 2:</label>
                                <select class="form-control" name="revenue-tahun-filter-2" id="revenue-tahun-filter-2" style="border-radius: 8px">
                                    @foreach ($tahunData as $tahun)
                                    <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id= chartRevenue-Line>
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

    .top-revenue{
        display: block; 
        width: 150px; 
        overflow: hidden; 
        white-space: nowrap; 
        text-overflow: ellipsis;
    }

    @media only screen and (max-width: 1366px) {
        .top-revenue{
            display: block; 
            width: 105px; 
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

    // ==== CHART REVENUE OPERASIONAL ====
    const revenueData = {!! json_encode($revenueData) !!};
    const targetData = {!! json_encode($targetData) !!};
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

    // ==== CHART GAP ====
    const gapData = {!! json_encode($gapData) !!};
    console.log("INI GAP DATA BOS", gapData)

    // ==== CHART LINE Revenue ====
    const lineRevenueData = {!! json_encode($revenueData) !!};

document.addEventListener("DOMContentLoaded", function() {

    // ==== CHART REVENUE OPERASIONAL ====
    var dropdown = document.getElementById("tahun-filter");
    var selectedValue = dropdown.value;

    // ==== CHART GAP ====
    var dropdownGap = document.getElementById("tahun-filter-gap");
    var selectedValueGap = dropdownGap.value;

    // ==== CHART LINE REVENUE ====
    var dropdownTahunRevenue1 = document.getElementById("revenue-tahun-filter-1");
    var dropdownTahunRevenue2 = document.getElementById("revenue-tahun-filter-2");
    var selectedValueRevenueLine1 = dropdownTahunRevenue1.value;
    var selectedValueRevenueLine2 = dropdownTahunRevenue2.value;

    // ==== CHART Revenue OPERASIONAL ====
    function updateChart() {
        if (selectedValue !== "") {
            const filteredRevenueData = revenueData.filter(item => item.year.toString() === selectedValue);
            const filteredTargetData = targetData.filter(item => item.year.toString() === selectedValue);

            const seriesData = {};
            filteredRevenueData.forEach(item => {
                const year = item.year.toString();
                const month = item.month - 1;
                if (!seriesData[year]) {
                    seriesData[year] = new Array(12).fill(0);
                }
                seriesData[year][month] += parseInt(item.total_nilai);
            });

            const targetSeries = Object.keys(seriesData).map(year => {
                // ... kode untuk target series
                const targetValues = new Array(12).fill(null);
                targetData.forEach(item => {
                    if (item.year.toString() === year) {
                        const month = monthIndexMapping[item.month];
                        targetValues[month] = parseInt(item.total_nilai);
                    }
                });
                return {
                    name: 'Target ' + year,
                    data: targetValues
                };
            });

            const realizationSeries = Object.keys(seriesData).map(year => {
                // ... kode untuk realization series
                return {
                    name: 'Realisasi ' + year,
                    data: seriesData[year]
                };
            });

            const categories = monthNames;

            Highcharts.chart('chartRevenue', {
                // ... pengaturan chart
                chart: {
                    type: 'column'
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
                    min: 0,
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
                series: [...targetSeries, ...realizationSeries]
            });
        }
    }


    // ==== CHART GAP ====
    function updateChartGap() {
        if (selectedValueGap !== "") {
            const filteredGapData = gapData.filter(item => item.year.toString() === selectedValueGap)

            const seriesDataGap = {};
            filteredGapData.forEach(item => {
                const year = item.year.toString();
                const month = item.month - 1;
                if (!seriesDataGap[year]) {
                    seriesDataGap[year] = new Array(12).fill(0);
                }
                seriesDataGap[year][month] += parseInt(item.gap);
            });

            const realizationSeriesGap = Object.keys(seriesDataGap).map(year => {
                // ... kode untuk realization series
                return {
                    name: 'Gap ' + year,
                    data: seriesDataGap[year]
                };
            });

            console.log("realizationSeriesGap",realizationSeriesGap)

            const newRealizationSeriesGap = realizationSeriesGap.map(item => ({
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

            Highcharts.chart('chartGAP', {
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
                series: [...newRealizationSeriesGap]
            });
        }
    }


    function updateLineChart() {
        const filteredDataLineRevenue1 = lineRevenueData.filter(item => item.year.toString() === selectedValueRevenueLine1);
        const filteredDataLineRevenue2 = lineRevenueData.filter(item => item.year.toString() === selectedValueRevenueLine2);    
        const seriesDataRevenue1 = {}; 
        const seriesDataRevenue2 = {}; 

        filteredDataLineRevenue1.forEach(item => {
        const year = item.year.toString();
        const month = item.month - 1;
        if (!seriesDataRevenue1[year]) {
            seriesDataRevenue1[year] = new Array(12).fill(0);
        }
            seriesDataRevenue1[year][month] += parseInt(item.total_nilai);
        });

        filteredDataLineRevenue2.forEach(item => {
            const year = item.year.toString();
            const month = item.month - 1;
            if (!seriesDataRevenue2[year]) {
                seriesDataRevenue2[year] = new Array(12).fill(0);
            }
            seriesDataRevenue2[year][month] += parseInt(item.total_nilai);
        });

        const realizationSeriesRevenueLine1 = Object.keys(seriesDataRevenue1).map(year => {
            return {
                name: 'Realisasi ' + year,
                data: seriesDataRevenue1[year]
            };
        });

        const realizationSeriesRevenueLine2 = Object.keys(seriesDataRevenue2).map(year => {
            return {
                name: 'Realisasi ' + year,
                data: seriesDataRevenue2[year]
            };
        });

        Highcharts.chart('chartRevenue-Line', {
            chart: {
                type: 'line'
            },
            title: {
                text: '',
                align: 'left'
            },
            xAxis: {
                categories: monthNames,
                crosshair: true,
                accessibility: {
                    description: ''
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Nilai'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [...realizationSeriesRevenueLine1, ...realizationSeriesRevenueLine2]
        });
    }

    // ==== CHART Revenue OPERASIONAL ====
    updateChart();

    // ==== CHART GAP ====
    updateChartGap();

    // ==== CHART LINE Revenue ====
    updateLineChart();

    dropdown.addEventListener("change", function() {
        selectedValue = dropdown.value;
        console.log("Nilai input tahun: " + selectedValue);
        updateChart(); // Call the updateChart function to rebuild the chart
    });

    dropdownGap.addEventListener("change", function() {
        selectedValueGap = dropdownGap.value;
        console.log("Nilai input tahun: " + selectedValueGap);
        updateChartGap(); // Call the updateChartGap function to rebuild the chart
    });

    dropdownTahunRevenue1.addEventListener("change", function () {
        selectedValueRevenueLine1 = dropdownTahunRevenue1.value;
        updateLineChart();
    });

    dropdownTahunRevenue2.addEventListener("change", function () {
        selectedValueRevenueLine2 = dropdownTahunRevenue2.value;
        updateLineChart();
        });
    // ...
});



</script>
@endsection