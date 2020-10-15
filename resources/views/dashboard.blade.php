@extends('layouts.master')
@section('content')

    {{-- Chart 1--}}
    <div class="block-card">
        <div class="block-header">
            <h4 class="block-title">Comparison between four districts</h4>
        </div>
        <div class="block-body">
            <div class="row">
                <div class="col-md-3">
                    <canvas
                        id="onBoardedMerchant"
                        data-onBoardedMerchant=""
                        style="height: 300px; width: 100%">
                    </canvas>
                </div>
                <div class="col-md-3">
                    <canvas
                        id="transactingMerchant"
                        data-transactingMerchant=""
                        style="height: 300px; width: 100%">
                    </canvas>
                </div>
                <div class="col-md-3">
                    <canvas
                        id="totalOrders"
                        data-totalOrders=""
                        style="height: 300px; width: 100%">
                    </canvas>
                </div>
                <div class="col-md-3">
                    <canvas
                        id="orderAmount"
                        data-orderAmount=""
                        style="height: 300px; width: 100%">
                    </canvas>
                </div>
            </div>
        </div>
    </div>


    <div class="block-card">
        <div class="block-header">
            <h4 class="block-title">District wise transacting merchant over time</h4>
        </div>
        <div class="block-body">
            <div class="card-body-top-part">
                <div class="d-flex">
                    <div class="info-card" style="margin-right: 30px">
                        <h4 class="info-title">Total Merchant</h4>
                        <span class="info-value">{{@$total_merchant}}</span>
                    </div>
                    <div class="info-card">
                        <h4 class="info-title">Transacting Merchant</h4>
                        <span class="info-value">{{@$transacting_merchant}}</span>
                    </div>
                </div>

                <div class="form-inline">
                    <span style="margin-right: 15px; display: inline-block">Filter By: </span>
                    <select style="min-width: 200px"
                            class="form-control form-control-sm c1_ajax"
                            name="c1_filterby">
                        <option value="">All</option>
                        <option value="Tangail">Tangail</option>
                        <option value="Sirajganj">Sirajganj</option>
                        <option value="Sherpur">Sherpur</option>
                        <option value="Jamalpur">Jamalpur</option>
                    </select>
                </div>
            </div>
            <div class="c1-overlay-wrap" style="display: none;">
                <div class="anim-overlay">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
            </div>
            <div id="c1_data">
                @include('dashboard.c1_view')
            </div>
        </div>
    </div>

    {{-- Chart 2 --}}
    <div class="block-card">
        <div class="block-header">
            <h4 class="block-title">Transacting merchants comparison between districts over time</h4>
        </div>
        <div class="block-body">
            <div class="card-body-top-part">
                <div class="form-inline">
                    <span style="margin-right: 15px; display: inline-block">Filter By: </span>
                    <select style="min-width: 200px" class="form-control form-control-sm c2_ajax">
                        <option value="">All</option>
                        <option value="1">Transacting</option>
                        <option value="2">Non Transacting</option>
                    </select>
                </div>
            </div>

            <div class="c1-overlay-wrap" style="display: none;">
                <div class="anim-overlay">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
            </div>
            <div id="c2_data">
                @include('dashboard.c2_view')
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="block-card">
                <div class="block-header">
                    <h4 class="block-title">Tangail</h4>
                </div>
                <div class="block-body">
                    <table
                        style="margin-bottom: 0"
                        class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <td>Total Merchant</td>
                            <td class="text-bold">
                                {{@$tangail_onboarded_count}}
                            </td>
                        </tr>
                        <tr>
                            <td>Transacting Merchant</td>
                            <td class="text-bold">
                                {{@$tangail_transacting_count}}
                            </td>
                        </tr>
                        <tr>
                            <td>Non Transacting Merchant</td>
                            <td class="text-bold">
                                {{@$tangail_onboarded_count - @$tangail_transacting_count}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="block-card">
                <div class="block-header">
                    <h4 class="block-title">Sirajganj</h4>
                </div>

                <div class="block-body">
                    <table
                        style="margin-bottom: 0"
                        class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <td>Total Merchant</td>
                            <td class="text-bold">
                                {{@$sirajganj_onboarded_count}}
                            </td>
                        </tr>
                        <tr>
                            <td>Transacting Merchant</td>
                            <td class="text-bold">
                                {{@$sirajganj_transacting_count}}
                            </td>
                        </tr>
                        <tr>
                            <td>Non Transacting Merchant</td>
                            <td class="text-bold">
                                {{@$sirajganj_onboarded_count -@$sirajganj_transacting_count}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="block-card">
                <div class="block-header">
                    <h4 class="block-title">Jamalpur</h4>
                </div>

                <div class="block-body">
                    <table
                        style="margin-bottom: 0"
                        class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <td>Total Merchant</td>
                            <td class="text-bold">
                                {{@$jamalpur_onboarded_count}}
                            </td>
                        </tr>
                        <tr>
                            <td>Transacting Merchant</td>
                            <td class="text-bold">
                                {{@$jamalpur_transacting_count}}
                            </td>
                        </tr>
                        <tr>
                            <td>Non Transacting Merchant</td>
                            <td class="text-bold">
                                {{@$jamalpur_onboarded_count - @$jamalpur_transacting_count}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="block-card">
                <div class="block-header">
                    <h4 class="block-title">Sherpur</h4>
                </div>

                <div class="block-body">
                    <table
                        style="margin-bottom: 0"
                        class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <td>Total Merchant</td>
                            <td class="text-bold">
                                {{@$sherpur_onboarded_count}}
                            </td>
                        </tr>
                        <tr>
                            <td>Transacting Merchant</td>
                            <td class="text-bold">
                                {{@$sherpur_transacting_count}}
                            </td>
                        </tr>
                        <tr>
                            <td>Non Transacting Merchant</td>
                            <td class="text-bold">
                                {{@$sherpur_onboarded_count - @$sherpur_transacting_count}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="block-card">
        <div class="block-header">
            <h4 class="block-title">Order, order amount, average order amount for districts</h4>
        </div>
        <div class="block-body">
            <div class="card-body-top-part">
                <div class="d-flex">
                    @php
                        $tor = clone $total_order_list;
                        $totalOrders = @$tangail_order_count + @$sirajganj_order_count + @$jamalpur_order_count + @$sherpur_order_count;
                        $totalAmount = @$tangail_sales_count +@$sirajganj_sales_count +@$jamalpur_sales_count +@$sherpur_sales_count;

                    @endphp
                    <div class="info-card" style="margin-right: 30px">
                        <h4 class="info-title">Total Order</h4>
                        <span class="info-value">{{$totalOrders}}</span>
                    </div>
                    <div class="info-card" style="margin-right: 30px">
                        <h4 class="info-title">Total Amount</h4>
                        <span class="info-value">{{number_format($totalAmount,2)}}</span>
                    </div>
                    <div class="info-card">
                        <h4 class="info-title">Average Order Amount</h4>
                        <span class="info-value">{{number_format($totalAmount/$totalOrders,2)}}</span>
                    </div>
                </div>

                <div class="form-inline">
                    <span style="margin-right: 15px; display: inline-block">Filter By: </span>
                    <select style="min-width: 200px" class="form-control form-control-sm c3_ajax"
                            name="c3_filterby">
                        <option value="">All</option>
                        <option value="Tangail">Tangail</option>
                        <option value="Sirajganj">Sirajganj</option>
                        <option value="Sherpur">Sherpur</option>
                        <option value="Jamalpur">Jamalpur</option>
                    </select>
                </div>
            </div>

            <div class="c1-overlay-wrap" style="display: none;">
                <div class="anim-overlay">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
            </div>
            <div id="c3_data">
                @include('dashboard.c3_view')
            </div>

        </div>
    </div>

    <div class="block-card">
        <div class="block-header">
            <h4 class="block-title">Order, order amount, average order amount comparison between districts over time</h4>
        </div>
        <div class="block-body">
            <div class="card-body-top-part">
                <div class="form-inline">
                    <span style="margin-right: 15px; display: inline-block">Filter By: </span>
                    <select style="min-width: 200px" class="form-control form-control-sm c4_ajax"
                            name="c4_filterby"
                    >
                        <option value="">All</option>
                        <option value="1">Total Order</option>
                        <option value="2">Total Amount</option>
                        <option value="3">Average Order Amount</option>
                    </select>
                </div>
            </div>
            <div id="c4_data">
                @include('dashboard.c4_view')
            </div>

            <hr>

        </div>
    </div>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="{{url('public/admin_ui_assets')}}/assets/js/dashboard.js"></script>

    <script>
        $(document).on('change', '.c1_ajax', function (e) {
            e.preventDefault();
            let c1_filterby = $('.c1_ajax').val();
            // $('#c1_data').html('');
            $('.c1-overlay-wrap').show();
            let data = {
                c1_filterby: c1_filterby,
                track: "c1",
            }
            $.ajax({
                url: '{{url('/')}}'/* + "?c1_filterby=" + c1_filterby*/,
                type: "get",
                dataType: 'json',
                data: data,
                success: function (html) {

                    $('.c1-overlay-wrap').hide();
                    $("#c1_data").html(html);
                }
            });
        });
        $(document).on('change', '.c2_ajax', function (e) {
            e.preventDefault();
            let c2_filterby = $('.c2_ajax').val();
            let data = {
                c2_filterby: c2_filterby,
                track: "c2",
            }
            $.ajax({
                url: '{{url('')}}',
                type: "get",
                dataType: 'json',
                data: data,
                success: function (html) {
                    $("#c2_data").html(html);
                }
            });
        });
        $(document).on('change', '.c3_ajax', function (e) {
            e.preventDefault();
            let c3_filterby = $('.c3_ajax').val();
            let data = {
                c3_filterby: c3_filterby,
                track: "c3",
            }
            $.ajax({
                url: '{{url('')}}',
                type: "get",
                dataType: 'json',
                data: data,
                success: function (html) {
                    $("#c3_data").html(html);
                }
            });
        });
        $(document).on('change', '.c4_ajax', function (e) {
            e.preventDefault();
            let c4_filterby = $('.c4_ajax').val();
            let data = {
                c4_filterby: c4_filterby,
                track: "c4",
            }
            $.ajax({
                url: '{{url('')}}',
                type: "get",
                dataType: 'json',
                data: data,
                success: function (html) {
                    $("#c4_data").html(html);
                }
            });
        });

        $(function () {
            // Total Onboarded Merchant
            let onBoardedMerchant = document.getElementById('onBoardedMerchant').getContext('2d');
            pieChartConfig(onBoardedMerchant, [{{$tangail_onboarded_count}}, {{$sirajganj_onboarded_count}}, {{$sherpur_onboarded_count}}, {{$jamalpur_onboarded_count}}], 'Total Onboarded Merchant');

            // Total Transacting Merchant
            let transactingMerchant = document.getElementById('transactingMerchant').getContext('2d');
            pieChartConfig(transactingMerchant, [{{$tangail_transacting_count}}, {{$sirajganj_transacting_count}}, {{$sherpur_transacting_count}}, {{$jamalpur_transacting_count}}], 'Total Transacting Merchant');

            // Total Order
            let totalOrders = document.getElementById('totalOrders').getContext('2d');
            pieChartConfig(totalOrders, [{{$tangail_order_count}}, {{$sirajganj_order_count}}, {{$sherpur_order_count}}, {{$jamalpur_order_count}}], 'Total Order');

            // Total Order amount/Sales
            let orderAmount = document.getElementById('orderAmount').getContext('2d');
            pieChartConfig(orderAmount, [{{$tangail_sales_count}}, {{$sirajganj_sales_count}}, {{$sherpur_sales_count}}, {{$jamalpur_sales_count}}], 'Total Order Amount/Sales');
        });

        function pieChartConfig(ctx, dataset, title) {
            let config = {
                type: 'pie',
                data: {
                    datasets: [{
                        data: dataset,
                        backgroundColor: ['#E9DA58', '#5EC7B5', '#ED715D', '#59bff5'],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        'Tangail',
                        'Sirajganj',
                        'Sherpur',
                        'Jamalpur',
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: title,
                        position: 'top'
                    },
                    legend: {
                        display: true
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                // return (value * 100 / sum).toFixed(2) + "%";
                                return value;
                            },
                            color: '#fff',
                        }
                    }
                }
            };
            new Chart(ctx, config);
        }
    </script>

@endsection
