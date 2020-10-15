<style>
    .order-placed, .order-warehouse-left, .order-in-transit {
        width: 25%;
        float: left;
    }
    .order-delivered{
        width: 25%;
        float: right;
    }
    .fa{
        font-size: 25px;
    }
    .modal-content{
        text-align: center;
    }
    .modal-body{
        height: 150px;
    }
</style>
@if($order)

        <div class="order-placed">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <h3>ORDER PLACED</h3>
            <div class="created-date">{{date_format($order->created_at,"M j, Y, g:i a")}}</div>
        </div>
        @if($order->order_track)
            @php $tracking = $order->order_track();
                $tracking =  $tracking->orderBy('status', 'asc')->get();

             @endphp
            @foreach($tracking as $order_track)
                @if($order_track->status==2)
                <div class="order-warehouse-left">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <h3>WAREHOUSE LEFT</h3>
                    <div class="created-date">{{date_format($order_track->created_at,"M j, Y, g:i a")}}</div>
                    <div>{{$order_track->message_by}}</div>
                </div>
                @endif
                @if($order_track->status==3)
                <div class="order-in-transit">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <h3>IN TRANSIT</h3>
                    <div class="created-date">{{date_format($order_track->created_at,"M j, Y, g:i a")}}</div>
                    <div>{{$order_track->message_by}}</div>
                </div>
                @endif
                @if($order_track->status==4)
                <div class="order-delivered">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <h3>DELIVERED</h3>
                    <div class="created-date">{{date_format($order_track->created_at,"M j, Y, g:i a")}}</div>
                    <div>{{$order_track->message_by}}</div>
                </div>
                @endif
            @endforeach
        @endif
@endif
