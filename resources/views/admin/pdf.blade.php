<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 class="text-center">Order Details</h1>
    <h4>Owner Name:{{$order->name}}</h4>
    <h4>Owner Email:{{$order->email}}</h4>
    <h4>Owner Address:{{$order->address}}</h4>
    <h4>Owner phone:{{$order->phone}}</h4>
    <h4>Owner Id:{{$order->id}}</h4>
    <hr>
    <h4>Product Name:{{$order->product_title}}</h4>
    <h4>Product Quantity:{{$order->quantity}}</h4>
    <h4>price:${{$order->price}}</h4>
    <h4>Payment Status:{{$order->payment_status}}</h4>
    <h4>Product Id:{{$order->product_id}}</h4>
    <img height="400" width="450" src="images/{{$order->image}}"> 

</body>
</html>