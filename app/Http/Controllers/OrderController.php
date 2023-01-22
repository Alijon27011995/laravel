<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class OrderController extends Controller
{
    public function index(){
        // dd('came');
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.phone', 'users.name')
            ->get();
       return view('admin.tables.basic_table_history', compact('orders'));

    }
    public function orderShow($id){
        // dd('came');


        $order=Order::where('id',$id)->first();
        $user=User::where('id',$order->user_id)->first();
        $order_datails=OrderDetail::where('order_id',$order->id)->get();
        $address=Address::where('user_id',$user->id)->first();
        // $product=Product::get();
        // dd($product);
        $list=[];
        foreach ($order_datails as $order_datail) {
            $product=Product::where('id',$order_datail->product_id)->first();
            $data=[
                'code'=>$order->code,
                'date'=>$order->created_at,
                'user_name'=>$user->name,
                'user_phone'=>$user->phone,
                'product_quantity'=>$order_datail->quantity,
                'product_name'=>$product->name,
                'product_foto'=>$product->slug,
                'adrress'=>$address->address
            ];
            array_push($list,$data);
        }


        //    dd($list);
        //    return 'came';
        // return view('admin.forms.basic_elements_update',compact('user'));


       return view('admin.tables.basic_table', compact('list'));

    }

}
