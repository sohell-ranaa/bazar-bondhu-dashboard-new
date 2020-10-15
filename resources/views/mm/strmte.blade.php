@extends('layouts.master')
@section('content')
    <!-- BEGIN PAGE HEADER-->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Inventory Management Users
        <small></small>
    </h1>
    <!-- END PAGE TITLE-->

    <div class="portlet light bordered">

            <div class="col-sm-1 pull-right" style="margin-bottom: 10px;">
                <div class="dropdown" style="display: inline-block; width: 100px;">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-download"></i>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="javascript:;" class="export" data-filetype="xlsx">
                                <i class="fa fa-file-excel-o"></i> Excel
                            </a>
                        </li>
                        <li>
                    </ul>
                </div>
            </div>


        <div class="overlay-wrap">
            <div class="anim-overlay">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        </div>

        <div id="render_list">
            @include('mm.render-strmte')
        </div>
    </div>
    <script>

        $(document).on('click', '.pagination a', function (e) {

            e.preventDefault();
            let district = $('#district').val();
            let upazila = $('#upazila').val();
            let fo = $('#filterByFo').val();
            let search = $('#inputSearch').val();
            let filterByStatus = $('#filterByStatus').val();
            page = $(this).attr('href').split('page=')[1];
            $('#render_list').html('');
            $('.overlay-wrap').show();
            $.ajax({
                url: $(this).attr('href'),
                type: "get",
                dataType: 'json',
                data: {'search_string': search,'fo': fo,'district': district,'upazila': upazila,'filterByStatus': filterByStatus},
                success: function (data) {
                    $('.overlay-wrap').hide();
                    $('#render_list').html('');
                    $('#render_list').html(data);
                }
            });
        });

        $(document).on('click', '.export', function (e) {
            let district = $('#district').val();
            let upazila = $('#upazila').val();
            let fo = $('#filterByFo').val();
            let search = $('#inputSearch').val();
            let filterByStatus = $('#filterByStatus').val();
            var export_type = $(this).data('filetype');
            window.location = "{{URL::to('strmte-mngmnt/')}}" + "?fo=" + fo + "&district=" + district +"&upazila=" + upazila + "&search=" + search + "&filterByStatus=" + filterByStatus + "&export_type=" + export_type;
        });
    </script>
@endsection
