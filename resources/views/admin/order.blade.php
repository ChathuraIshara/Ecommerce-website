<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <style>
            .form_product {
                margin-right: 200px;
                margin-top: 50px;
                margin-bottom: 200px;
                margin-left: 200px;
            }

            .input_product {
                margin-left: 20px;
                display: inline block;
            }

            .form_header {
                margin-top: 75px;
            }

            .img_div {
                margin-left: 165px;
            }
        </style>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="text-center">All Orders</h1><br>
                <div class="text-center">
                    <form action="/search" method="post">
                        @csrf
                    <input type="text" name="sitem" placeholder="Search your order">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                    </form><br><br>
                    
                    
                </div>
                <div>    
                <table class="table table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product-title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment</th>
                        <th>Delivery</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th colspan="2" class="text-center"">Actions</th>
                        
                    </tr>

                  
                    @forelse($orders as $order)
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td><img src="{{asset('images/' . $order->image)}}"></td>
                        @if($order->delivery_status=="processing")
                        <td><a href="/deliverdstatus/{{$order->id}}" class="btn btn-success">Deliverd</a></td>
                        @else
                        <td><a class="btn btn-secondary">Deliverd</a></td>
                        @endif
                        <td><a href="/printpdf/{{$order->id}}" class="btn btn-danger">print</a></td>
                        <td style="width:20px"><a href="/sendmail/{{$order->id}}" class="btn btn-primary">mail</a></td>
                    </tr>
                    @empty
                <h3 class="text-center">No data found!</h3>
                    @endforelse
                   
                </table>
                </div>
            </div>
        </div>

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>