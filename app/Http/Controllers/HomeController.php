<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\cart;
use App\Models\User;
use App\Models\order;


use App\Models\reply;
use App\Models\comment;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            $ordercount = order::all()->count();
            $productcount = product::all()->count();
            $custcount = User::all()->count();

            $orders = order::all();
            $revenue = 0;
            $dorders = 0;
            $porders = 0;
            foreach ($orders as $order) {
                $revenue = $revenue + $order->price;
                if ($order->delivery_status == "delivered") {
                    $dorders = $dorders + 1;
                } else {
                    $porders = $porders + 1;
                }
            }

            return view('admin.home', ['ordercount' => $ordercount, 'productcount' => $productcount, 'custcount' => $custcount, 'revenue' => $revenue, 'dorders' => $dorders, 'porders' => $porders]);
        } else {
            $product = product::paginate(6);
            $comment = comment::orderby('id','desc')->get();
            $reply = reply::all();
            return view('home.userpage', ['products' => $product, 'comments' => $comment, 'replys' => $reply]);
        }
    }
    public function index()
    {
        $product = product::paginate(6);
        $comment = comment::orderby('id','desc')->get();
        $reply = reply::all();
        return view('home.userpage', ['products' => $product, 'comments' => $comment, 'replys' => $reply]);
    }
    public function logOut()
    {
        Session()->flush();
        Auth::logout();
        $product = product::paginate(6);
        $comment = comment::orderby('id','desc')->get();
        $reply = reply::all();
        return view('home.userpage', ['products' => $product, 'comments' => $comment, 'replys' => $reply]);
    }
    public function moreDetails($id)
    {
        $product = product::find($id);
        return view('home.productdetails')->with('product', $product);
    }
    public function addToCart(Request $request)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $userid=$user->id;
            $product = product::find($request->id);
            $productid=$product->id;

            $targetid=cart::where('user_id','=',"$userid")->where('product_id','=',"$productid")->get('id')->first();
            if($targetid)
            {
                $cart=cart::find($targetid)->first();
                $count=$cart->quantity;
                $cart->quantity=$count+($request->quantity);
                $oldprice=$cart->price;

                if ($product->discount_price != null) {
                    $cart->price = ((($product->price) - ($product->discount_price)) * $request->quantity)+$oldprice;
                } else {
                    $cart->price = (($product->price) * $request->quantity)+$oldprice;
                }

                $cart->save();
            }
            else{
                $cart = new cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
    
                $cart->product_title = $product->title;
                if ($product->discount_price != null) {
                    $cart->price = (($product->price) - ($product->discount_price)) * $request->quantity;
                } else {
                    $cart->price = ($product->price) * $request->quantity;
                }
    
                $cart->quantity = $request->quantity;
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->user_id = $user->id;
    
                $cart->save();
    
                
            }

           



            return redirect()->back()->with('message','Your product hass beend added to the cart succesfully!');
        } else {
            return redirect(route('login'));
        }
    }
    public function showCart()
    {
        if (Auth::user()) {
            $userid = Auth::user()->id;
            $products = cart::where('user_id', '=', $userid)->get();
            return view('Home.showcart')->with('products', $products);
        } else {
            return redirect(route('login'));
        }
    }
    public function removeCartProduct($id)
    {
        $product = cart::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Your product has been removed succesfully!');
    }
    public function cashOrder()
    {
        $user = Auth::user();
        $cartproducts = cart::where('user_id', '=', $user->id)->get();
        foreach ($cartproducts as $cartproduct) {
            $order = new order;

            $order->name = $cartproduct->name;
            $order->email = $cartproduct->email;
            $order->phone = $cartproduct->phone;
            $order->address = $cartproduct->address;
            $order->userid = $cartproduct->user_id;

            $order->product_title = $cartproduct->product_title;
            $order->quantity = $cartproduct->quantity;
            $order->price = $cartproduct->price;
            $order->image = $cartproduct->image;
            $order->product_id = $cartproduct->product_id;

            $order->payment_status = "cash on delivery";
            $order->delivery_status = "processing";

            $order->save();
            $cartproduct->delete();
        }

        return redirect()->back()->with('message', 'We received your order.we will connect with you soon!');
    }
    public function stripe($totalprice)
    {
        return view('home.stripe')->with('totalprice', $totalprice);
    }
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $request->amount * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for Payment!."
        ]);

        Session::flash('success', 'Payment successful!');

        $user = Auth::user();
        $cartproducts = cart::where('user_id', '=', $user->id)->get();
        foreach ($cartproducts as $cartproduct) {
            $order = new order;

            $order->name = $cartproduct->name;
            $order->email = $cartproduct->email;
            $order->phone = $cartproduct->phone;
            $order->address = $cartproduct->address;
            $order->userid = $cartproduct->user_id;

            $order->product_title = $cartproduct->product_title;
            $order->quantity = $cartproduct->quantity;
            $order->price = $cartproduct->price;
            $order->image = $cartproduct->image;
            $order->product_id = $cartproduct->product_id;

            $order->payment_status = "paid";
            $order->delivery_status = "processing";

            $order->save();
            $cartproduct->delete();
        }


        return redirect()->back();
    }
    public function order_page()
    {
        if (Auth::user()) {
            $userid = Auth::user()->id;
            $orders = order::where('userid', '=', $userid)->get();

            return view('home.customerorder')->with('orders', $orders);
        } else {

            return redirect(route('login'));
        }
    }
    public function cancelOrder($id)
    {
        $order = order::find($id);
        $order->delete();
        return redirect()->back()->with('message', "Your order has been canceled succesfully!");
    }
    public function addComment(Request $request)
    {
        if (Auth::user()) {
            $comment = new comment;
            $this->validate($request, [
                'comment' => 'required'
            ]);
            $comment->name = Auth::user()->name;
            $comment->comment = $request->comment;
            $comment->userid = Auth::user()->id;

            $comment->save();
            return redirect()->back();
        } else {
            return redirect(route('login'));
        }
    }
    public function addReply(Request $request)
    {
        if (Auth::user()) {
            $reply = new reply;
            $this->validate($request, [
                'reply' => 'required'
            ]);

            $reply->name = Auth::user()->name;
            $reply->reply = $request->reply;
            $reply->commentid = $request->commentid;
            $reply->userid = Auth::user()->id;

            $reply->save();

            return redirect()->back();
        } else {
            return redirect(route('login'));
        }
    }
    public function searchProduct(Request $request)
    {
        $this->validate($request,[
            'search'=>'required'
        ]);
        $searchtext=$request->search;
        $product=product::where('title','LIKE',"%$searchtext%")->orWhere('category','LIKE',"%$searchtext%")->paginate(10);
        $comment = comment::orderby('id','desc')->get();
        $reply = reply::all();
         return view('home.userpage', ['products' => $product, 'comments' => $comment, 'replys' => $reply]);
    }
    public function productPage()
    {
            $product = product::paginate(6);
            $comment = comment::orderby('id','desc')->get();
            $reply = reply::all();
            return view('home.productpage', ['products' => $product, 'comments' => $comment, 'replys' => $reply]);

    }
    public function searchProductPage(Request $request)
    {
        $this->validate($request,[
            'search'=>'required'
        ]);
        $searchtext=$request->search;
        $product=product::where('title','LIKE',"%$searchtext%")->orWhere('category','LIKE',"%$searchtext%")->paginate(10);
        $comment = comment::orderby('id','desc')->get();
        $reply = reply::all();
         return view('home.productpage', ['products' => $product, 'comments' => $comment, 'replys' => $reply]);
    }
    
}
