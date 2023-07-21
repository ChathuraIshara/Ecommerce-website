<!DOCTYPE html>
<html lang="en">

<head>
  <base href="/public">
    @include('admin.css')
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
            .button_gap
            {
              padding-right:20px;
              display: inline;
            }
        </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
      
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="text-center">
                    <h1>Edit Product</h1>
                    @if($errors->any())
                    <div class="col-12">
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    </div>
                    @endif
                    @if(session()->has('message'))
                    <div class="container mt-4">
                        <div class="alert alert-success" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                            {{session()->get('message')}}
                            </button>
                        </div>
                        @endif
                        <div class="form_header">
                            <form class="text-center" action="/editstore" method="post" enctype="multipart/form-data">
                                @csrf
                                Product Title:<input type="text" name="title" placeholder="Enter product title" class="input_product" required="" value="{{$product->title}}"><br><br>
                                Description:<input type="text" name="desc" placeholder="Enter product Description" class="input_product" required="" value="{{$product->description}}"><br><br>
                                Product quantity:<input type="number" min="0" name="quantity" placeholder="Enter product quantity" class="input_product" required="" value="{{$product->quantity}}"><br><br>
                                Product Price:<input type="number" name="price" placeholder="Enter product price" class="input_product" required="" value="{{$product->price}}"><br><br>
                                Discount Price:<input type="number" name="dprice" placeholder="Enter discount price" class="input_product" value="{{$product->discount_price}}"><br><br>
                                Product Category:<select class="input_product" required="" name="cate" value="{{$product->category}}">
                                    <option value="{{$product->category}}">{{$product->category}}</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                    @endforeach
                                    
                                </select><br><br>
                                <div class="img_div">
                                    Product Image:<input type="file" name="img" class="input_product" >
                                </div><br><br>
                                <div class="button_gap">
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="submit" value="Edit Product" class="btn btn-primary">
                            
                                <a href="/canceledit" class="btn btn-danger" >Cancel</a>
                                </div>
                               
                            
                                

                            </form>

                        </div>

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