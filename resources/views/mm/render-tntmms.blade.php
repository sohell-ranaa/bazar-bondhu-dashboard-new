<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width: 20px">#</th>
        <th>Name</th>
        <th>Mobile No</th>
        <th>Field Officer</th>
        <th>District</th>
        <th>Upazila</th>
        <th>Total Order</th>
        <th>Total Sales(৳)</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $row_number = ($list->currentpage() - 1) * $list->perpage() + 1;
    ?>
    @forelse($list as $key => $value)

            <tr>
                <td>{{$row_number++}}</td>
                <td>{{$value->name_en}}</td>

                <!--Changed by Rana-->
                @php $j = ltrim($value->phone, '0'); @endphp
                <td><?php echo '0' . $j ?></td>
                <!--End-->

                <td>{{$value->name_bn}}</td>
                <td>{{$value->district}}</td>
                <td>{{$value->upazila}}</td>
                <td>@if($value->orders){{$value->orders->where('status', '!=', 5)->where('is_public_order','=',2)->count()}}@endif</td>
                <td>@if($value->orders){{number_format($value->orders->where('status', '!=', 5)->where('is_public_order','=',2)->sum('sub_total'),2)}}@endif</td>
            </tr>
    @empty
        <tr class="text-center">
            <td colspan="7">No Data Found</td>
        </tr>
    @endforelse
    </tbody>
</table>

<div class="mt-3 text-right">
    <div class="d-flex">
        <div class="mr-auto"></div>
        <div class="">
            <nav aria-label="">
                {!! @$list->render( "pagination::bootstrap-4") !!}
            </nav>
        </div>
    </div>
</div>
