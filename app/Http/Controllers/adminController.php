<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\order;
use App\Models\product;


use App\Models\category;
use App\Notifications\MyFirstNotification;
use Illuminate\Http\Request;
use App\Notifications\sendEmailNotification;



use Illuminate\Support\Facades\Notification;


class adminController extends Controller
{
    public function adminCategory()
    {
        $data=category::all();
        return view('admin.category')->with('categories',$data);
    }
    public function addCategory(Request $request)
    {
        $category=new category;
        $this->validate($request,[
            'categoryname'=>'required'

        ]);
        $category->category_name=$request->categoryname;
        $category->save();
        return redirect()->route('category')->with('message','Category Added Succesfully');
    }
    public function categoryDelete($id)
    {
        $category=category::find($id);
        $category->delete();
        return redirect()->route('category')->with('message','Category Deleted Succesfully');

    }
    public function addProduct()
    {
        $data=category::all();
        return view('admin.addproduct')->with('categories',$data);
    }
    public function saveProduct(Request $request)
    {
        $product=new product;
        $this->validate($request,[
            'title'=>'required',
            'desc'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'cate'=>'required',
            'img'=>'required|mimes:jpg,png,jpeg|max:5048'

        ]);
        $imagenewname=uniqid().'-'.$request->title .'.'.$request->img->extension();
        $request->img->move(public_path('images'),$imagenewname);

        $product->title=$request->title;
        $product->description=$request->desc;   
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->category=$request->cate;
        $product->discount_price=$request->dprice;
        $product->image=$imagenewname;
        $product->save();
        return redirect(route('addproduct'))->with('message','Product has been added!');
    }
    public function showProduct()
    {
        $data=product::all();
        return view('admin.showproduct')->with('products',$data);
    }
    public function deleteProduct($id)
    {
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('message','Product hass beed deleted Successfully!');
    }
    public function editProductPage($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.editproduct', ['product' => $product, 'categories' => $categories]);
    }
    public function cancelEdit()
    {
        return redirect(route('showproduct'));
    }
    public function editStore(Request $request)
    {
        $product=product::find($request->id);
        $this->validate($request,[
            'title'=>'required',
            'desc'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'cate'=>'required',
           

        ]);
        $image=$request->img;
        if($image)
        {
            $imagenewname=uniqid().'-'.$request->title .'.'.$request->img->extension();
            $request->img->move(public_path('images'),$imagenewname);
            $product->image=$imagenewname;

        }
      

        $product->title=$request->title;
        $product->description=$request->desc;   
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->category=$request->cate;
        $product->discount_price=$request->dprice;
        $product->save();
        return redirect(route('showproduct'))->with('message','Product has been Edited succusfully!');

    }
    public function orderPage()
    {
        $order=order::all();
        return view('admin.order')->with('orders',$order);
    }
    public function deliveredStatus($id)
    {
        $order=order::find($id);
        $order->delivery_status="delivered";
        $order->payment_status="paid";
        $order->save();
        return redirect()->back()->with('message','');
    }
    public function printPdf($id){
        
        $order=order::find($id);
        
        $pdf=PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('orderdetails.pdf');

    }
    public function sendMail($id)
    {
        $order=order::find($id);
        return view('admin.mail')->with('order',$order);
    }
    public function sendUserEmail(Request $request)
    {
        $order=order::find($request->id);

        $details=[
            'greeting'=>$request->greeting,
            'firstline'=>$request->fline,
            'body'=>$request->body,
            'button'=>$request->bname,
            'url'=>$request->url,
            'lastline'=>$request->lline
        ];
        Notification::send($order, new MyFirstNotification($details));
        return redirect()->back();

    }
    public function searchOrder(Request $request)
    {
        $searchtext=$request->sitem;
        $orders=order::where('name','LIKE',"%$searchtext%")->orWhere('phone','LIKE',"%$searchtext%")->orWhere('product_title','LIKE',"%$searchtext%")->get();
        return view('admin.order')->with('orders',$orders);
    }
    
}
