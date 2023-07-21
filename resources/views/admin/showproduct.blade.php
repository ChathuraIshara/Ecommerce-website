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
                <h1 class="text-center">All Products</h1>
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
                            <th>Product Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Product Image</th>
                            <th class="text-center" colspan="2">Actions</th>
                        </tr>
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->discount_price}}</td>
                            <td><img src="{{asset('images/' . $product->image)}}"></td>
                            <td><a href="/editproduct/{{$product->id}}" class="btn btn-primary">Edit</a></td>
                            <td><a href="/deleteproduct/{{$product->id}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- container-scroller -->
            <!-- plugins:js -->
            @include('admin.script')
            <!-- End custom js for this page -->
</body>

</html>