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
        <h1>Revenue</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Revenue</h4>
                    </div>
                    <div class="card-body">
                        <div id= chartKKP>
                    </div>
                    <div class="card-body">
                        <div class="statistic-details mt-1">
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 7%</div>
                                <div class="detail-value">$243</div>
                                <div class="detail-name">Today</div>
                            </div>
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-danger"><i
                                            class="fas fa-caret-down"></i></span> 23%</div>
                                <div class="detail-value">$2,902</div>
                                <div class="detail-name">This Week</div>
                            </div>
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span>9%</div>
                                <div class="detail-value">$12,821</div>
                                <div class="detail-name">This Month</div>
                            </div>
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 19%</div>
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
                        <h4>GAP</h4>
                    </div>
                    <div class="card-body">
                        <div id= chartGAP>
                    </div>
                    <div class="card-body">
                        <div class="statistic-details mt-1">
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 7%</div>
                                <div class="detail-value">$243</div>
                                <div class="detail-name">Today</div>
                            </div>
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-danger"><i
                                            class="fas fa-caret-down"></i></span> 23%</div>
                                <div class="detail-value">$2,902</div>
                                <div class="detail-name">This Week</div>
                            </div>
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span>9%</div>
                                <div class="detail-value">$12,821</div>
                                <div class="detail-name">This Month</div>
                            </div>
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 19%</div>
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
                        <div id= percentage>
                    </div>
                    <div class="card-body">
                        <div class="statistic-details mt-1">
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 7%</div>
                                <div class="detail-value">$243</div>
                                <div class="detail-name">Today</div>
                            </div>
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-danger"><i
                                            class="fas fa-caret-down"></i></span> 23%</div>
                                <div class="detail-value">$2,902</div>
                                <div class="detail-name">This Week</div>
                            </div>
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span>9%</div>
                                <div class="detail-value">$12,821</div>
                                <div class="detail-name">This Month</div>
                            </div>
                            <div class="statistic-details-item">
                                <div class="text-small text-muted"><span class="text-primary"><i
                                            class="fas fa-caret-up"></i></span> 19%</div>
                                <div class="detail-value">$92,142</div>
                                <div class="detail-name">This Year</div>
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

    const seriesData = {};
    revenueData.forEach(item => {
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

    Highcharts.chart('chartGAP', {
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
</script>
@endsection