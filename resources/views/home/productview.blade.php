
<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
               
                  <form action="/searchproductpage" method="post">
                     @csrf
                     <input type="text" name="search" placeholder="Search your product">
                     <input type="submit" value="search">
                  </form><br>
               </h2>
            </div>
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
            <div class="row">
               
               @forelse($products as $product)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="/productdetails/{{$product->id}}" class="option1">
                           More Details
                           </a>
                           <form action="/addtocart" method="post">
                              @csrf
                              <div class="row">
                                 <div class="col-md-4">
                                    <input type="number" name="quantity" min="1" value="1">

                                 </div>
                                 <div class="col-md-4">
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="submit" value="Add to Cart">
                                 </div>
                                 
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="{{asset('images/' . $product->image)}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                          {{$product->title}}
                        </h5>
                        <h6>
                           ${{$product->price}}
                        </h6>
                       
                     </div>
                  </div>
               </div>
               @empty
               <h3 class="text-center">No seacrh item found!</h3>
               @endforelse
               <span style="padding-top:20px">
                  
                 {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
           
               </span>   
         </div>
      </section>