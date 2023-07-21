<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>customer order Page</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <h1 class="text-center">My Orders</h1>
        @if(session()->has('message'))
        <div class="container mt-4">
            <div class="alert alert-success" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
                </button>
            </div>
            @endif
            <table class="table table-dark">
                <tr>
                    <th>Product-Title</th>
                    <th>Product-Quantity</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php $totalprice = 0 ?>
                @forelse($orders as $order)
                <tr>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td><img src="{{asset('images/' . $order->image)}}" class="rounded" width="20px" height="30px"></td>
                    @if($order->delivery_status=="processing")
                    <td><a href="/cancelorder/{{$order->id}}" class="btn btn-danger">Cancel</a></td>
                    @else
                    <td><a class="btn btn-secondary">Cancel</a></td>
                    @endif

                </tr>
                <?php $totalprice = $totalprice + $order->price ?>
                @empty
                <h3 class="text-center">No Orders found!</h3>
                    @endforelse
            </table>
           

            </div>
           
            @include('home.footer')


            <!-- footer end -->
            <div class="cpy_">
                <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

                    Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

                </p>
            </div>
            <!-- jQery -->
            <script src="home/js/jquery-3.4.1.min.js"></script>
            <!-- popper js -->
            <script src="home/js/popper.min.js"></script>
            <!-- bootstrap js -->
            <script src="home/js/bootstrap.js"></script>
            <!-- custom js -->
            <script src="home/js/custom.js"></script>
</body>

</html>