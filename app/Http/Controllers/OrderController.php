<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 📋 danh sách đơn
    public function index()
    {
        $orders = Order::with('items.product')->get();
        return view('orders.index', compact('orders'));
    }

    // ➕ form tạo đơn
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    // 💾 lưu đơn
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'=>'required',
            'products'=>'required'
        ]);

        // ❗ tạo order
        $order = Order::create([
            'customer_name'=>$request->customer_name
        ]);

        // ❗ không cho đơn rỗng
        if(count($request->products) == 0){
            return back()->with('error','Đơn hàng rỗng');
        }

        // ❗ lưu từng sản phẩm
        foreach($request->products as $productId => $quantity){

            if($quantity > 0){
                $product = Product::find($productId);

                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$productId,
                    'quantity'=>$quantity,
                    'price'=>$product->price
                ]);
            }
        }

        return redirect()->route('orders.index');
    }

    // 🔍 xem chi tiết
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // 🔄 cập nhật trạng thái
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status'=>$request->status
        ]);

        return back();
    }
}