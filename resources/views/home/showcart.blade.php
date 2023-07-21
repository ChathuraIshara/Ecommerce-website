<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="">
      <title>cart page</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <h1 class="text-center">My Cart</h1>
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
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php $totalprice = 0 ?>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->product_title}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>${{$product->price}}</td>
                    <td><img src="{{asset('images/' . $product->image)}}" class="rounded" width="20px" height="30px"></td>
                    <td><a href="/removecartproduct/{{$product->id}}" class="btn btn-danger">Remove</a></td>
                </tr>
                <?php $totalprice = $totalprice + $product->price ?>
                @endforeach
            </table>
            <h2 class="text-center">Total Price: ${{$totalprice}}</h2>
            <h5 class="text-center"><span style="color:dimgray">Proceed to Order</span></h5>
            <div class="text-center">
            <a href="/cash_order" class="btn btn-danger">Cash on Delivery</a>
            <a href="/stripe/{{$totalprice}}" class="btn btn-danger">Pay using Card</a>
            

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