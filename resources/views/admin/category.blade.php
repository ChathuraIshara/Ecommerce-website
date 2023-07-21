<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .form_category {
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <div class="main-panel">
            <div class="content-wrapper">
            @if($errors->any())
        <div class="col-12">
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                {{$error}}
            </div>
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
                <div class="div_center">
                    <h2 class="h2_font">Add Category</h2>
                    <form action="/addcategory" method="post">
                        @csrf
                        <input type="text" class="form_category" name="categoryname" placeholder="Enter the category">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                    </form>
                    <br><br>
                    <table class="table table-dark">
                        <tr>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach($categories as $category)
                        <tr>
                        <td>{{$category->category_name}}</td>
                        <td><a href="/categorydelete/{{$category->id}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- partial -->

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>