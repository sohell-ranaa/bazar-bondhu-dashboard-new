@extends('layouts.master')
@section('content')

     <!--BEGIN PAGE HEADER-->

     <!--BEGIN PAGE TITLE-->
    <h1 class="page-title">
        Bazar Bondhu Overview
        <small></small>
    </h1>
     <!--END PAGE TITLE-->

    <div class="information-cards">
        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Total on Boarded</h3>
                <span class="value text-primary">{{$total_onboarded_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Tangail</h3>
                <span class="value sm text-info">{{$tangail_onboarded_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sirajganj</h3>
                <span class="value sm text-info">{{$sirajganj_onboarded_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Jamalpur</h3>
                <span class="value sm text-info">{{$jamalpur_onboarded_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sherpur</h3>
                <span class="value sm text-info">{{$sherpur_onboarded_count}}</span>
            </div>
        </div>
    </div>

    <div class="information-cards">

        <div class="information-item" data-toggle="tooltip" data-placement="top" title="Merchants who made transaction within 90 days">
            <div class="information-card">
                <h3 class="title">Total Transacting</h3>
                <span class="value text-success">{{$total_transacting_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Tangail</h3>
                <span class="value sm text-info">{{$tangail_transacting_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sirajganj</h3>
                <span class="value sm text-info">{{$sirajganj_transacting_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Jamalpur</h3>
                <span class="value sm text-info">{{$jamalpur_transacting_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sherpur</h3>
                <span class="value sm text-info">{{$sherpur_transacting_count}}</span>
            </div>
        </div>

    </div>

    <div class="information-cards">
        <div class="information-item" data-toggle="tooltip" data-placement="top" title="Total non transacting merchants ">
            <div class="information-card">
                <h3 class="title">Total Non-Transacting</h3>
                <span class="value text-danger">{{$total_nontransacting_count}}</span>
            </div>
        </div>


        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Tangail</h3>
                <span class="value sm text-info">{{$tangail_nontransacting_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sirajganj</h3>
                <span class="value sm text-info">{{$sirajganj_nontransacting_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Jamalpur</h3>
                <span class="value sm text-info">{{$jamalpur_nontransacting_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sherpur</h3>
                <span class="value sm text-info">{{$sherpur_nontransacting_count}}</span>
            </div>
        </div>
    </div>

     <div class="information-cards">
         <div class="information-item" data-toggle="tooltip" data-placement="top" title="Merchants who don’t have transaction within 90 days.">
             <div class="information-card">
                 <h3 class="title">Not transacting<br><small>90 days</small></h3>
                 <span class="value text-danger">{{$total_not_transacting_count}}</span>
             </div>
         </div>


         <div class="information-item">
             <div class="information-card">
                 <h3 class="title">Tangail</h3>
                 <span class="value sm text-info">{{$tangail_not_transacting_count}}</span>
             </div>
         </div>

         <div class="information-item">
             <div class="information-card">
                 <h3 class="title">Sirajganj</h3>
                 <span class="value sm text-info">{{$sirajganj_not_transacting_count}}</span>
             </div>
         </div>

         <div class="information-item">
             <div class="information-card">
                 <h3 class="title">Jamalpur</h3>
                 <span class="value sm text-info">{{$jamalpur_not_transacting_count}}</span>
             </div>
         </div>

         <div class="information-item">
             <div class="information-card">
                 <h3 class="title">Sherpur</h3>
                 <span class="value sm text-info">{{$sherpur_not_transacting_count}}</span>
             </div>
         </div>
     </div>

     <div class="information-cards">
         <div class="information-item" data-toggle="tooltip" data-placement="top" title="Merchants who don’t place any order yet.">
             <div class="information-card">
                 <h3 class="title">No order</h3>
                 <span class="value text-danger">{{$total_not_order_count}}</span>
             </div>
         </div>


         <div class="information-item">
             <div class="information-card">
                 <h3 class="title">Tangail</h3>
                 <span class="value sm text-info">{{$tangail_not_order_count}}</span>
             </div>
         </div>

         <div class="information-item">
             <div class="information-card">
                 <h3 class="title">Sirajganj</h3>
                 <span class="value sm text-info">{{$sirajganj_not_order_count}}</span>
             </div>
         </div>

         <div class="information-item">
             <div class="information-card">
                 <h3 class="title">Jamalpur</h3>
                 <span class="value sm text-info">{{$jamalpur_not_order_count}}</span>
             </div>
         </div>

         <div class="information-item">
             <div class="information-card">
                 <h3 class="title">Sherpur</h3>
                 <span class="value sm text-info">{{$sherpur_not_order_count}}</span>
             </div>
         </div>
     </div>

    <div class="information-cards">
        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Total Sales</h3>
                <span class="value text-default">{{number_format(round($total_sales_count))}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Tangail</h3>
                <span class="value sm text-info">{{number_format(round($tangail_sales_count))}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sirajganj</h3>
                <span class="value sm text-info">{{number_format(round($sirajganj_sales_count))}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Jamalpur</h3>
                <span class="value sm text-info">{{number_format(round($jamalpur_sales_count))}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sherpur</h3>
                <span class="value sm text-info">{{number_format(round($sherpur_sales_count))}}</span>
            </div>
        </div>
    </div>

    <div class="information-cards">

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Total Orders</h3>
                <span class="value text-warning">{{$total_order_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Tangail</h3>
                <span class="value sm text-info">{{$tangail_order_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sirajganj</h3>
                <span class="value sm text-info">{{$sirajganj_order_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Jamalpur</h3>
                <span class="value sm text-info">{{$jamalpur_order_count}}</span>
            </div>
        </div>

        <div class="information-item">
            <div class="information-card">
                <h3 class="title">Sherpur</h3>
                <span class="value sm text-info">{{$sherpur_order_count}}</span>
            </div>
        </div>
    </div>

    <div class="portlet light bordered">
        <div class="portlet-body">
            {{--<div class="info-card">
              <h3 class="title">Total on Boarded MM</h3>
              <span class="value">54213</span>
            </div>
            <hr/>--}}
            <form class="d-flex mb-2">
                <div class="form-inline">
                    <div class="form-group mr-1">

                        <label for="filterBy">Filter by: </label>

                        <select name="" id="district" class="form-control form-control-sm">
                            <option value="">--Select District--</option>
                            <option value="Tangail">Tangail</option>
                            <option value="Sirajganj">Sirajganj</option>
                            <option value="Jamalpur">Jamalpur</option>
                            <option value="Sherpur">Sherpur</option>
                        </select>

                    </div>

                    <div class="form-group mr-1">
                        <label for="filterByFo" class="sr-only">Filter by Upazila: </label>

                        <select id="upazila" name="upazila" id="filterByFo" class="form-control form-control-sm">
                            <option value="">--Select Upazila--</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="filterByStatus" class="sr-only">Filter by Status: </label>

                        <select name="" id="filterByStatus" class="form-control form-control-sm">
                            <option value="">--Select Status--</option>
                            <option value="1">Transacting</option>
                            <option value="2">Non-Transacting</option>
                        </select>

                    </div>
                </div>

                <div style="margin-left: auto;" class="form-inline">

                    <div class="form-group">
                        <label for="search" class="sr-only">Search</label>

                        <input id="inputSearch" type="search" class="form-control form-control-sm"
                               placeholder="Search...">
                    </div>
                    <button type="button" class="btn btn-default search-call"><i class="fa fa-search"></i></button>
                </div>

                <div class="col-sm-1 pull-right">
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

            </form>

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
                @include('mm.render-list')
            </div>

        </div>
    </div>

    <script>


      $(".search-call").on('click', function (e) {
        let district = $('#district').val();
        let upazila = $('#upazila').val();
        let fo = $('#filterByFo').val();
        let search = $('#inputSearch').val();
        let filterByStatus = $('#filterByStatus').val();
        e.preventDefault();
        $('#render_list').html('');
        $('.overlay-wrap').show();
        $.ajax({
          url: "{{URL::to('mm-list/')}}",
          method: "GET",
          data: {'search_string': search,'fo': fo,'district': district,'upazila': upazila, 'filterByStatus': filterByStatus},
          dataType: "json",
          success: function (data) {
            $('.overlay-wrap').hide();
            $('#render_list').html('');
            $('#render_list').html(data);
          }
        });
      });

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
        window.location = "{{URL::to('mm-list/')}}" + "?fo=" + fo + "&district=" + district+ "&upazila=" + upazila + "&search=" + search + "&filterByStatus=" + filterByStatus + "&export_type=" + export_type;
      });
    </script>

    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>

@endsection
