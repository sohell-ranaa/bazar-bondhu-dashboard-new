<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width: 20px">#</th>
        <th>Name</th>
        <th>Mobile No</th>
        <th>Field Officer</th>
        <th>District</th>
        <th>Upazila</th>
        <th>Address</th>
    </tr>
    </thead>

    <tbody>
    @if($list)
    <?php $row_number = ($list->currentpage() - 1) * $list->perpage() + 1; ?>

    @forelse($list as $key => $value)

        <tr>
            <td>{{$row_number++}}</td>
            <td>{{$value->name_en}}</td>
            <!--Changed by Rana-->
            @php $j = ltrim($value->phone, '0'); @endphp
            <td>0{{$j}}</td>
            <!--End-->
            <td>{{$value->district=='Sirajganj'?'Md. Nurul Alam Ansery':($value->district=='Tangail'?"Alauddin Al Azad":($value->district=='Jamalpur'?"Abdullah Bin Abdur Rahman":($value->district=='Sherpur'?"Md. Mahabub Alam":'')))}}</td>
            <td>{{$value->district}}</td>
            <td>{{$value->upazila}}</td>
            <td>{{$value->address}}</td>
        </tr>
    @empty
        <tr class="text-center">
            <td colspan="7">No Data Found</td>
        </tr>
    @endforelse
    @endif
    </tbody>
</table>

<div class="mt-3 text-right">
    <div class="d-flex">
        <div class="mr-auto"></div>
        <div class="">
            <nav aria-label="">
                @if($list)
                {!! @$list->render( "pagination::bootstrap-4") !!}
                @endif
            </nav>
        </div>
    </div>
</div>
