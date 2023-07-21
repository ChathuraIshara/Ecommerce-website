<!DOCTYPE html>
<html lang="en">

<head>
     <base href="/public">
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
                display: inline-block;
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
                <h1 class="text-center">Send email to {{$order->email}}</h1><br><br>
                <div class="container">
                <form class="form-group" action="/senduseremail" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$order->id}}">
                    Email greeting: <input type="text" name="greeting" class="input_product"><br><br>
                    Email firstline: <input type="text" name="fline" class="input_product"><br><br>
                    Email body: <input type="text" name="body" class="input_product"><br><br>
                    Email button name: <input type="text" name="bname" class="input_product"><br><br>
                    Email url: <input type="text" name="url" class="input_product"><br><br>
                    Email lastline: <input type="text" name="lline" class="input_product"><br><br>
                    <input type="submit" class="btn btn-success" value="Send email" class="input_product">
                    
                </form>

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