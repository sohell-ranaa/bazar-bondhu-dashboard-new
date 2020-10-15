<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th style="width: 20px">#</th>
        <th>Order</th>
        <th>Name</th>
        <th>Mobile No</th>
        <th>Field Officer</th>
        <th>District</th>
        <th>Upazila</th>
        <th>Payment Type</th>
        <th style="width: 5%; white-space: nowrap" class="text-center">Order Amount (৳)</th>
    </tr>
    </thead>

    <tbody>

    <?php $row_number = ($orders->currentpage() - 1) * $orders->perpage() + 1; ?>
    @forelse($orders as $key => $value)

        <tr>
            <td>{{$row_number++}}</td>
            <td class="order_id" data-id="{{$value->order_code}}">
                <span style="display:block;"><strong>Order ID: </strong> {{$value->order_code}}</span>
                <span style="display: block">{{date('d M, Y', strtotime($value->created_at))}}</span>
            </td>
            <td><span style="display: block">{{$value->user->name_en}}</span></td>

            <!--Changed by Rana-->
            @php $j = ltrim($value->user->phone, '0'); @endphp
            <td><?php echo '0'. $j ?></td>
            <!--End-->

            <td>{{$value->user->district=='Sirajganj'?'Md. Nurul Alam Ansery':($value->user->district=='Tangail'?"Alauddin Al Azad":($value->user->district=='Jamalpur'?"Abdullah Bin Abdur Rahman":($value->user->district=='Sherpur'?"Md. Mahabub Alam":'')))}}</td>
            <td>{{$value->user->district}}</td>
            <td>{{$value->user->upazila}}</td>
            <td>{{$value->payment_method == 1 ? "Cash On Delivery": "Online Payment"}}</td>
            <td>{{$value->sub_total}}</td>
            {{--            <td>{{$value->order->count()}}</td>--}}
            {{--            <td class="text-center nowrap"><span class="text-success">Transacting</span></td>--}}
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
                {!! @$orders->render( "pagination::bootstrap-4") !!}
            </nav>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="orderTrackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Tracking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="order-tracking-info" style="width: 100%;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(".order_id").on('click', function (e){
        e.preventDefault();
        let order_code = $(this).data("id");
        $.ajax({
            url: "{{URL::to('order-track/')}}",
            method: "GET",
            data: {'order_code': order_code},
            dataType: "json",
            success: function (data) {
                // $('.overlay-wrap').hide();
                // $('#render_list').html('');
                $('#order-tracking-info').html(data);
            }
        });
        $("#orderTrackModal").modal();

    })
</script>
