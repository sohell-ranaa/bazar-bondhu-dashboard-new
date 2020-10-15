<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width: 20px">#</th>
        <th>Store Name</th>
        <th>District</th>
        <th>Merchant Name</th>
        <th>Contact Number</th>
    </tr>
    </thead>
    <tbody>
    <?php $row_number = ($list->currentpage() - 1) * $list->perpage() + 1; ?>
    @forelse($list as $key => $value)
        <tr>
            <td>{{$row_number++}}</td>
            <td>{{$value->store_name}}</td>
            <td>{{$value->district}}</td>
            <td>{{$value->merchant_name}}</td>
            <td>{{$value->contact_number}}</td>
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