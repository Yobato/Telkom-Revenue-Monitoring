@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/prismjs/themes/prism.min.css') }}">
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
                        <div id= Dashboard1>
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
    <script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.indonesia.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-statistic.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush
@section('footer')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        const DataCursor = Dashboards.DataCursor;
        const DataTable = Dashboards.DataTable;
        const cursor = new DataCursor();
        const vegeTable = buildVegeTable();

        // Create Dashboards.Board
        Dashboards.board('Dashboard1', {
            gui: {
                layouts: [{
                    id: 'dashboards-layout-1',
                    rows: [{
                        cells: [{
                            id: 'highcharts-dashboards-cell-a0'
                        }, {
                            id: 'highcharts-dashboards-cell-b0'
                        }]
                    }, {
                        cells: [{
                            id: 'highcharts-dashboards-cell-a1'
                        }]
                    }]
                }]
            },
            components: [
                {
                    cell: 'highcharts-dashboards-cell-a0',
                    type: 'Highcharts',
                    chartOptions: buildChartOptions('bar', vegeTable, cursor)
                }, {
                    cell: 'highcharts-dashboards-cell-b0',
                    type: 'Highcharts',
                    chartOptions: buildChartOptions('line', vegeTable, cursor)
                }, {
                    cell: 'highcharts-dashboards-cell-a1',
                    type: 'Highcharts',
                    chartOptions: buildChartOptions('pie', vegeTable, cursor)
                }
            ]
        });

        // Build chart options for each HighchartsComponent
        function buildChartOptions(type, table, cursor) {
            return {
                chart: {
                    events: {
                        load: function () {
                            const chart = this;
                            const series = chart.series[0];

                            // react to table cursor
                            cursor.addListener(table.id, 'point.mouseOver', function (e) {
                                const point = series.data[e.cursor.row];

                                if (chart.hoverPoint !== point) {
                                    chart.tooltip.refresh(point);
                                }
                            });
                            cursor.addListener(table.id, 'point.mouseOut', function () {
                                chart.tooltip.hide();
                            });
                        }
                    }
                },
                legend: {
                    enabled: false
                },
                series: [{
                    type,
                    name: table.id,
                    data: table.getRowObjects(0, void 0, ['name', 'y']),
                    point: {
                        events: {
                            // emit table cursor
                            mouseOver: function () {
                                cursor.emitCursor(table, {
                                    type: 'position',
                                    row: this.x,
                                    state: 'point.mouseOver'
                                });
                            },
                            mouseOut: function () {
                                cursor.emitCursor(table, {
                                    type: 'position',
                                    row: this.x,
                                    state: 'point.mouseOut'
                                });
                            }
                        }
                    }
                }],
                title: {
                    text: table.id
                },
                xAxis: {
                    categories: table.getColumn('name')
                },
                yAxis: {
                    title: {
                        enabled: false
                    }
                }
            };
        }

        // Build table with Highcharts.Series aliases
        function buildVegeTable() {
            const table = new DataTable({
                columns: {
                    vegetable: [
                        'Broccoli',
                        'Carrots',
                        'Corn',
                        'Cucumbers',
                        'Onions',
                        'Potatos',
                        'Spinach',
                        'Tomatos'

                    ],
                    amount: [
                        44,
                        51,
                        38,
                        45,
                        57,
                        62,
                        35,
                        61
                    ]
                },
                id: 'Vegetables'
            });

            table.setColumnAlias('name', 'vegetable');
            table.setColumnAlias('y', 'amount');

            return table;
        }
    </script>
@endsection
