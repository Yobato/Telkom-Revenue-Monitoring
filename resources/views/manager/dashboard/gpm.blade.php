@extends('layouts.manager-master')

@section('title', 'Statistic')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('assets/library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Gross Profit Margin</h1>
    </div>

    <div class="section-body">
        <div class="row mb-4 d-flex justify-content-between">
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Gross Profit</h5>
                                <span class="h2 font-weight-bold mb-0">{{ number_format($cumulativeGPM), 2, ',',
                                    '.'}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow"
                                    style="background-color: #23337A">
                                    <i class="fa-solid fa-rupiah-sign"></i>
                                    <i class="fa-solid fa-arrow-trend-up" style="height: 0.5em"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            @if($kenaikanGPM>=0)
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{
                                number_format($kenaikanGPM, 2, '.', '' )}}%</span>
                            @else
                            <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{
                                number_format($kenaikanGPM, 2, '.', '') }}%</span>
                            @endif
                            <span class="text-nowrap">From last year</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Gross Margin</h5>
                                <span class="h2 font-weight-bold mb-0">{{ number_format($cumulativeGM), 2, ',',
                                    '.'}}%</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow" style="background-color: #3D55C1">
                                    <i class="fas fa-chart-bar"></i>
                                    {{-- <i class="fas fa-chart-pie"></i> --}}
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            @if($kenaikanGM>=0)
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{ number_format($kenaikanGM,
                                2, '.', '' )}}%</span>
                            @else
                            <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{
                                number_format($kenaikanGM, 2, '.', '') }}%</span>
                            @endif
                            <span class="text-nowrap">From last year</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="top-cogs card-title text-uppercase text-muted mb-0">Top Gross Profit</h5>
                                <span class="top-cogs h2 font-weight-bold mb-0">{{ $TopGP }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow" style="background-color: #6D7BF2">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            @if($kenaikanGM>=0)
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
                            <label for="portofolio" class="col-form-label mr-3">Portofolio </label>
                            <select class="form-control" name="portofolio-filter-gp" id="portofolio-filter-gp"
                                style="border-radius: 8px">
                                @foreach ($filterPortofolio as $porto)
                                <option value=<?=$porto->id ?>>{{ $porto->nama_portofolio }}</option>
                                @endforeach
                            </select>
                            <label for="filter-tahun-gp" class="col-form-label ml-3 mr-3">Filter </label>
                            <select class="form-control" name="filter-tahun-gp" id="filter-tahun-gp"
                                style="border-radius: 8px">
                                @foreach ($tahunData as $tahun)
                                <option value=<?=$tahun->year ?>>{{ $tahun->year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id=chartGP>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 style="color:#525358; font-weight:bold">Gross Profit Margin</h4>
                            <div class="filter d-flex ">
                                <label for="portofolio" class="col-form-label mr-3">Portofolio </label>
                                <select class="form-control" name="portofolio-filter-gm" id="portofolio-filter-gm"
                                    style="border-radius: 8px">
                                    @foreach ($filterPortofolio as $porto)
                                    <option value=<?=$porto->id ?>>{{ $porto->nama_portofolio }}</option>
                                    @endforeach
                                </select>
                                <label for="filter-tahun-gm" class="col-form-label ml-3 mr-3">Filter </label>
                                <select class="form-control" name="filter-tahun-gm" id="filter-tahun-gm"
                                    style="border-radius: 8px">
                                    @foreach ($tahunData as $tahun)
                                    <option value=<?=$tahun->year ?>>{{ $tahun->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id=chartGM>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 style="color:#525358; font-weight:bold">GPM Portofolio Comparison</h4>
                            <div class="filter d-flex ">
                                <label for="portofolio-1" class="col-form-label mr-3">Portofolio </label>
                                <select class="form-control" name="portofolio-filter-gpm-1" id="portofolio-filter-gpm-1"
                                    style="border-radius: 8px">
                                    @foreach ($filterPortofolio as $porto)
                                    <option value=<?=$porto->id ?>>{{ $porto->nama_portofolio }}</option>
                                    @endforeach
                                </select>
                                <label for="portofolio-2" class="col-form-label ml-3 mr-3">Portofolio </label>
                                <select class="form-control" name="portofolio-filter-gpm-2" id="portofolio-filter-gpm-2"
                                    style="border-radius: 8px">
                                    @foreach ($filterPortofolio as $porto)
                                    <option value=<?=$porto->id ?>>{{ $porto->nama_portofolio }}</option>
                                    @endforeach
                                </select>
                                <label for="portofolio-3" class="col-form-label ml-3 mr-3">Portofolio </label>
                                <select class="form-control" name="portofolio-filter-gpm-3" id="portofolio-filter-gpm-3"
                                    style="border-radius: 8px">
                                    @foreach ($filterPortofolio as $porto)
                                    <option value=<?=$porto->id ?>>{{ $porto->nama_portofolio }}</option>
                                    @endforeach
                                </select>
                                <label for="tahunPerbandingan" class="col-form-label ml-3 mr-3">Filter </label>
                                <select class="form-control" name="tahun-filter-perbandingan-porto" id="tahun-filter-perbandingan-porto"
                                    style="border-radius: 8px">
                                    @foreach ($tahunData as $tahun)
                                    <option value=<?=$tahun->year ?>>{{ $tahun->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id=chartGPMPorto>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 style="color:#525358; font-weight:bold">Total Gross Profit Margin</h4>
                            <div class="filter d-flex ">
                                <label for="tahunTotal" class="col-form-label ml-3 mr-3">Filter </label>
                                <select class="form-control" name="tahun-total" id="tahun-total" style="border-radius: 8px">
                                    @foreach ($tahunData as $tahun)
                                    <option value=<?=$tahun->year ?>>{{ $tahun->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id=chartGPMTotal>
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

    .top-cogs {
        display: block;
        width: 200px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    @media only screen and (max-width: 1366px) {
        .top-cogs {
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
    const gpmTotal = {!! json_encode($gpmTotal) !!};
    const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const monthIndexMapping = {
        'Januari': 0,
        'Februari': 1,
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

    console.log("Ini GP DATA", gpmTotal);
    // console.log("Ini GM DATA", gpmData2);


document.addEventListener("DOMContentLoaded", function() {
    // ==== CHART GP ====
    let dropdownGP = document.getElementById("filter-tahun-gp");
    let dropdownPortoGP = document.getElementById("portofolio-filter-gp");
    let selectedValueGP = dropdownGP.value;
    let selectedValuePortoGP = dropdownPortoGP.value;

    // ==== CHART GM ====
    let dropdownGM = document.getElementById("filter-tahun-gm");
    let dropdownPortoGM = document.getElementById("portofolio-filter-gm");
    let selectedValueGM = dropdownGM.value;
    let selectedValuePortoGM = dropdownPortoGM.value;

    // ==== CHART PERBANDINGAN PORTOFOLIO ====
    let dropdownPortofolio1 = document.getElementById("portofolio-filter-gpm-1");
    let selectedValuePorto1 = dropdownPortofolio1.value;
    let dropdownPortofolio2 = document.getElementById("portofolio-filter-gpm-2");
    let selectedValuePorto2 = dropdownPortofolio2.value;
    let dropdownPortofolio3 = document.getElementById("portofolio-filter-gpm-3");
    let selectedValuePorto3 = dropdownPortofolio3.value;
    let dropdownTahunPerbandingan = document.getElementById("tahun-filter-perbandingan-porto");
    let selectedValueTahunPerbandingan = dropdownTahunPerbandingan.value;

    // ==== CHART TOTAL PORTOFOLIO ====
    let dropdownTahunTotal = document.getElementById("tahun-total");
    let selectedValueTahunTotal = dropdownTahunTotal.value;

    // ==== CHART GP ====
    function updateChartGP(valuePortoGP, valueYearGP) {
        if (valuePortoGP !== "" || valueYearGP !== "") {
            const filteredGPData = gpmData1.filter(item => item.year.toString() === valueYearGP)
            const filteredGPDataByPorto = filteredGPData.filter(item => item.id_portofolio === Number(valuePortoGP));

            const seriesDataGP = {};
            filteredGPDataByPorto.forEach(item => {
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
                        text: 'Total Value'
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
    function updateChartGM(valuePortoGM, valueYearGM) {
        if (valuePortoGM !== "" || valueYearGM !== "") {
            const filteredGMData = gpmData2.filter(item => item.year.toString() === valueYearGM)
            const filteredGMDataByPorto = filteredGMData.filter(item => item.id_portofolio === Number(valuePortoGM));

            const seriesDataGM = {};
            filteredGMDataByPorto.forEach(item => {
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
                    name: 'GPM ' + year,
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
                        text: 'Persentase Gross Profit Margin'
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

    // ==== CHART COGS OPERASIONAL ====
    function updateChartPorto(valuePorto1,   valuePorto2, valuePorto3, valueYear) {
        if (valuePorto1 !== "" || valuePorto2 !== "" || valuePorto3 !== "") {
            const filteredGPMData = gpmData2.filter(item => item.year.toString() === valueYear);
            const filteredGPMDataByPorto1 = filteredGPMData.filter(item => item.id_portofolio === Number(valuePorto1));
            const filteredGPMDataByPorto2 = filteredGPMData.filter(item => item.id_portofolio === Number(valuePorto2));
            const filteredGPMDataByPorto3 = filteredGPMData.filter(item => item.id_portofolio === Number(valuePorto3));
            const seriesDataPerbandingan1 = {};
            const seriesDataPerbandingan2 = {};
            const seriesDataPerbandingan3 = {};
            const filteredDataByPorto1 = filteredGPMDataByPorto1.filter(item => item.id_portofolio === Number(valuePorto1));
            const filteredDataByPorto2 = filteredGPMDataByPorto2.filter(item => item.id_portofolio === Number(valuePorto2));
            const filteredDataByPorto3 = filteredGPMDataByPorto3.filter(item => item.id_portofolio === Number(valuePorto3));
            
            let dropdownPortofolioText1 = dropdownPortofolio1.options[dropdownPortofolio1.selectedIndex].text;
            let dropdownPortofolioText2 = dropdownPortofolio2.options[dropdownPortofolio2.selectedIndex].text;
            let dropdownPortofolioText3 = dropdownPortofolio3.options[dropdownPortofolio3.selectedIndex].text;
            
            filteredDataByPorto1.forEach(item => {
                const year = item.year.toString();
                const month = item.month - 1;
                if (!seriesDataPerbandingan1[year]) {
                    seriesDataPerbandingan1[year] = new Array(12).fill(0);
                }
                seriesDataPerbandingan1[year][month] += parseInt(item.gpm);
                }
            );
        
            filteredDataByPorto2.forEach(item => {
                    const year = item.year.toString();
                    const month = item.month - 1;
                    if (!seriesDataPerbandingan2[year]) {
                        seriesDataPerbandingan2[year] = new Array(12).fill(0);
                    }
                        seriesDataPerbandingan2[year][month] += parseInt(item.gpm);
                }
            );

            filteredDataByPorto3.forEach(item => {
                    const year = item.year.toString();
                    const month = item.month - 1;
                    if (!seriesDataPerbandingan3[year]) {
                    seriesDataPerbandingan3[year] = new Array(12).fill(0);
                    }
                    seriesDataPerbandingan3[year][month] += parseInt(item.gpm);
                }
            );
            
            const realizationSeriesPorto1 = Object.keys(seriesDataPerbandingan1).map(year => {
                // ... kode untuk realization series
                return {
                    name: dropdownPortofolioText1 + " " + year,
                    data: seriesDataPerbandingan1[year]
                    };
                }
            );

            const realizationSeriesPorto2 = Object.keys(seriesDataPerbandingan2).map(year => {
                // ... kode untuk realization series
                return {
                    name: dropdownPortofolioText2 + " " + year,
                    data: seriesDataPerbandingan2[year]
                    };
                }
            );

            const realizationSeriesPorto3 = Object.keys(seriesDataPerbandingan3).map(year => {
                // ... kode untuk realization series
                return {
                    name: dropdownPortofolioText3 + " " + year,
                    data: seriesDataPerbandingan3[year]
                    };
                }
            );
            
            const categories = monthNames;
            
            Highcharts.chart('chartGPMPorto', {
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
                        text: 'Total Value'
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
                series: [...realizationSeriesPorto1, ...realizationSeriesPorto2, ...realizationSeriesPorto3]
            });
        }
    }

    function updateChartTotal(valueYear) {
        const filteredGPMData = gpmTotal.filter(item => item.year.toString() === valueYear);
        const seriesDataTotal = {};
        
        filteredGPMData.forEach(item => {
                const year = item.year.toString();
                const month = item.month - 1;
                if (!seriesDataTotal[year]) {
                    seriesDataTotal[year] = new Array(12).fill(0);
                }
                    seriesDataTotal[year][month] += parseInt(item.gpm);
            }
        );
        
        const realizationSeriesTotal = Object.keys(seriesDataTotal).map(year => {
            // ... kode untuk realization series
            return {
                name: 'Total ' + year,
                data: seriesDataTotal[year]
                };
            }
        );
        
        const categories = monthNames;
        
        Highcharts.chart('chartGPMTotal', {
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
                    text: 'Total Value'
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
            series: [...realizationSeriesTotal]
        });
    }

    // ==== CHART GP ====
    updateChartGP(selectedValuePortoGP, selectedValueGP);

    // ==== CHART GM ====
    updateChartGM(selectedValuePortoGM, selectedValueGM);

    // ==== CHART GPM PERBANDINGAN PORTO ====
    updateChartPorto(selectedValuePorto1, selectedValuePorto2, selectedValuePorto3, selectedValueTahunPerbandingan);

    // ==== CHART GPM TOTAL ====
    updateChartTotal(selectedValueTahunTotal);

    dropdownPortofolio1.addEventListener("change", function () {
        selectedValuePorto1 = dropdownPortofolio1.value;
        updateChartPorto(selectedValuePorto1, selectedValuePorto2, selectedValuePorto3, selectedValueTahunPerbandingan)
    });

    dropdownPortofolio2.addEventListener("change", function () {
        selectedValuePorto2 = dropdownPortofolio2.value;
        updateChartPorto(selectedValuePorto1, selectedValuePorto2, selectedValuePorto3, selectedValueTahunPerbandingan)
    });

    dropdownPortofolio3.addEventListener("change", function () {
        selectedValuePorto3 = dropdownPortofolio3.value;
        updateChartPorto(selectedValuePorto1, selectedValuePorto2, selectedValuePorto3, selectedValueTahunPerbandingan)
    });

    dropdownTahunPerbandingan.addEventListener("change", function () {
        selectedValueTahunPerbandingan = dropdownTahunPerbandingan.value;
        updateChartPorto(selectedValuePorto1, selectedValuePorto2, selectedValuePorto3, selectedValueTahunPerbandingan)
    });

    dropdownTahunTotal.addEventListener("change", function () {
        selectedValueTahunPerbandingan = dropdownTahunTotal.value;
        updateChartTotal(selectedValueTahunTotal)
    });

    dropdownPortoGP.addEventListener("change", function() {
        selectedValuePortoGP = dropdownPortoGP.value;
        updateChartGP(selectedValuePortoGP, selectedValueGP); // Call the updateChartGap function to rebuild the chart
    });
    
    dropdownGP.addEventListener("change", function() {
        selectedValueGP = dropdownGP.value;
        updateChartGP(selectedValuePortoGP, selectedValueGP); // Call the updateChartGap function to rebuild the chart
    });

    dropdownPortoGM.addEventListener("change", function() {
        selectedValuePortoGM = dropdownPortoGM.value;
        updateChartGM(selectedValuePortoGM, selectedValueGM); // Call the updateChartGap function to rebuild the chart
    });

    dropdownGM.addEventListener("change", function() {
        selectedValueGM = dropdownGM.value;
        updateChartGM(selectedValuePortoGM, selectedValueGM); // Call the updateChartGap function to rebuild the chart
    });
    
}
);
</script>
@endsection