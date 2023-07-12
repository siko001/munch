<h1>Order Received by Restaurant Please Await Confirmation</h1>
<h3>Order details:</h3>
<ul>
    <li>Order ID: {{ $order->order_number }}</li>
    <li>Customer ID: {{ $order->user_id }}</li>
    <li>Total: {{ $order->total_excluding_vat }}</li>
    <li>Payment:{{ $order->payment }}</li>
    <li>Status:{{ $order->status }}</li>
    <li>Delivery Method:{{ $order->delivery_method }}</li>
    <li>Time In:{{ $order->time }}</li>
    <li>Time For Delivery:{{ $order->time_to_deliver }}</li>
    <br>
    @if ($order->order_notes != null)
        <li>Requests:{{ $order->order_notes }}</li>
        <hr style="width:75%;float:center;">
    @else
        <hr style="width:75%;float:center;">
    @endif
</ul>
<h3>Food Details</h3>
<ul>
    @foreach ($orderDetails as $orderDetail)
        <li>Item: {{ $orderDetail->product_name }}</li>
        <li>Quantity: {{ $orderDetail->quantity }}</li>
        <li>Price: {{ $orderDetail->price }}</li>
        <hr style="width:50%">
    @endforeach

</ul>
