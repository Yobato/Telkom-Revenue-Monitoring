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
        <h1>GPM</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>GPM</h4>
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
                    <div class="card-body">
                        <div id= chartGPM>
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
    const chart = Highcharts.chart('chartGPM', {

        chart: {
            type: 'column'
        },

        title: {
            text: 'Gross Profit Margin'
        },

        subtitle: {
            text: ''
        },

        legend: {
            align: 'right',
            verticalAlign: 'middle',
            layout: 'vertical'
        },

        xAxis: {
            categories: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 
            'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            labels: {
                x: -10
            }
        },

        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Amount'
            }
        },

        series: [{
            name: 'Ava',
            data: [38, 51, 34, 31, 32, 34, 35, 33, 49, 50, 46, 43]
        },  {
            name: 'Malin',
            data: [38, 42, 41, 42, 41, 44, 43, 34, 51, 51, 44, 41]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal'
                    },
                    yAxis: {
                        labels: {
                            align: 'left',
                            x: 0,
                            y: -5
                        },
                        title: {
                            text: null
                        }
                    },
                    subtitle: {
                        text: null
                    },
                    credits: {
                        enabled: false
                    }
                }
            }]
        }
    });

    document.getElementById('small').addEventListener('click', function () {
        chart.setSize(400);
    });

    document.getElementById('large').addEventListener('click', function () {
        chart.setSize(600);
    });

    document.getElementById('auto').addEventListener('click', function () {
        chart.setSize(null);
    });
</script>
@endsection