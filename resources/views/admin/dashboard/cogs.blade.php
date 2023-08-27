@extends('layouts.admin-master')

@section('title', 'Statistic')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('assets/library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Cost of Good Sold (COGS)</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Target & Realisasi</h4>
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
                        <div id=chartCOGS-Bar>
                        </div>
                        <div class="card-body">
                            <div class="statistic-details mt-1">
                                <div class="statistic-details-item">
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</div>
                                    <div class="detail-value">$243</div>
                                    <div class="detail-name">Today</div>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</div>
                                    <div class="detail-value">$2,902</div>
                                    <div class="detail-name">This Week</div>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</div>
                                    <div class="detail-value">$12,821</div>
                                    <div class="detail-name">This Month</div>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</div>
                                    <div class="detail-value">$92,142</div>
                                    <div class="detail-name">This Year</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Perbandingan Tahun</h4>
                            <div class="filter d-flex">
                                <div class="mr-3">
                                    <label for="tahun-filter-1" class="col-form-label">Filter 1:</label>
                                    <select class="form-control" name="tahun-filter-1" id="tahun-filter-1" style="border-radius: 8px">
                                        @foreach ($tahunData as $tahun)
                                        <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="tahun-filter-2" class="col-form-label">Filter 2:</label>
                                    <select class="form-control" name="tahun-filter-2" id="tahun-filter-2" style="border-radius: 8px">
                                        @foreach ($tahunData as $tahun)
                                        <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id=chartCOGS-Line>
                            </div>
                            <div class="card-body">
                                <div class="statistic-details mt-1">
                                    <div class="statistic-details-item">
                                        <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</div>
                                        <div class="detail-value">$243</div>
                                        <div class="detail-name">Today</div>
                                    </div>
                                    <div class="statistic-details-item">
                                        <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</div>
                                        <div class="detail-value">$2,902</div>
                                        <div class="detail-name">This Week</div>
                                    </div>
                                    <div class="statistic-details-item">
                                        <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</div>
                                        <div class="detail-value">$12,821</div>
                                        <div class="detail-name">This Month</div>
                                    </div>
                                    <div class="statistic-details-item">
                                        <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</div>
                                        <div class="detail-value">$92,142</div>
                                        <div class="detail-name">This Year</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Percentage</h4>
                            </div>
                            <div class="card-body">
                                <div id=percentage>
                                </div>
                                <div class="card-body">
                                    <div class="statistic-details mt-1">
                                        <div class="statistic-details-item">
                                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</div>
                                            <div class="detail-value">$243</div>
                                            <div class="detail-name">Today</div>
                                        </div>
                                        <div class="statistic-details-item">
                                            <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</div>
                                            <div class="detail-value">$2,902</div>
                                            <div class="detail-name">This Week</div>
                                        </div>
                                        <div class="statistic-details-item">
                                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</div>
                                            <div class="detail-value">$12,821</div>
                                            <div class="detail-name">This Month</div>
                                        </div>
                                        <div class="statistic-details-item">
                                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</div>
                                            <div class="detail-value">$92,142</div>
                                            <div class="detail-name">This Year</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
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
    const kkpData = {!!json_encode($commerceData) !!};
    const targetData = {!!json_encode($targetData) !!};
    const lineData = {!!json_encode($commerceData) !!};
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

    document.addEventListener("DOMContentLoaded", function () {
    const kkpData = {!! json_encode($commerceData) !!};
    const targetData = {!! json_encode($targetData) !!};
    const lineData = {!! json_encode($commerceData) !!};
    const monthNames = [
        'Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];
    const monthIndexMapping = {
        'Januari': 0, 'Febuari': 1, 'Maret': 2, 'April': 3, 'Mei': 4, 'Juni': 5,
        'Juli': 6, 'Agustus': 7, 'September': 8, 'Oktober': 9, 'November': 10,
        'Desember': 11
    };

    var dropdown = document.getElementById("tahun-filter");
    var selectedValue = dropdown.value;
    var dropdown1 = document.getElementById("tahun-filter-1");
    var dropdown2 = document.getElementById("tahun-filter-2");
    var selectedValue1 = dropdown1.value;
    var selectedValue2 = dropdown2.value;

    function updateChart() {
        if (selectedValue !== "") {
            const filteredKkpData = kkpData.filter(item => item.year.toString() === selectedValue);
            const filteredTargetData = targetData.filter(item => item.year.toString() === selectedValue);

            const seriesData = {};
            filteredKkpData.forEach(item => {
                const year = item.year.toString();
                const month = item.month - 1;
                if (!seriesData[year]) {
                    seriesData[year] = new Array(12).fill(0);
                }
                seriesData[year][month] += parseInt(item.total_nilai);
            });

            const targetSeries = Object.keys(seriesData).map(year => {
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
                return {
                    name: 'Realisasi ' + year,
                    data: seriesData[year]
                };
            });

            const categories = monthNames;

            Highcharts.chart('chartCOGS-Bar', {
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

        function updateLineChart() {
        const filteredLineData1 = lineData.filter(item => item.year.toString() === selectedValue1);
        const filteredLineData2 = lineData.filter(item => item.year.toString() === selectedValue2);    
        const seriesData1 = {}; 
        const seriesData2 = {}; 

        filteredLineData1.forEach(item => {
        const year = item.year.toString();
        const month = item.month - 1;
        if (!seriesData1[year]) {
            seriesData1[year] = new Array(12).fill(0);
        }
            seriesData1[year][month] += parseInt(item.total_nilai);
        });

        filteredLineData2.forEach(item => {
            const year = item.year.toString();
            const month = item.month - 1;
            if (!seriesData2[year]) {
                seriesData2[year] = new Array(12).fill(0);
            }
            seriesData2[year][month] += parseInt(item.total_nilai);
        });

        const realizationSeries1 = Object.keys(seriesData1).map(year => {
            return {
                name: 'Realisasi ' + year,
                data: seriesData1[year]
            };
        });

        const realizationSeries2 = Object.keys(seriesData2).map(year => {
            return {
                name: 'Realisasi ' + year,
                data: seriesData2[year]
            };
        });

        Highcharts.chart('chartCOGS-Line', {
            chart: {
                type: 'line'
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
            series: [...realizationSeries1, ...realizationSeries2]
        });
    }

    updateLineChart();
    updateChart();

    dropdown.addEventListener("change", function () {
        selectedValue = dropdown.value;
        updateChart();
    });

    dropdown1.addEventListener("change", function () {
        selectedValue1 = dropdown1.value;
        updateLineChart();
    });

    dropdown2.addEventListener("change", function () {
        selectedValue2 = dropdown2.value;
        updateLineChart();
        });
});
</script>
@endsection