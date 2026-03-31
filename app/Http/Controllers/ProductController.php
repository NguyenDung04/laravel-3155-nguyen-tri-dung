<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import model Product

class ProductController extends Controller
{
    // 📋 Danh sách
    public function index(Request $request)
    {
        $query = Product::query();

        // 🔍 tìm kiếm
        if ($request->search) {
            $query->where('name','like','%'.$request->search.'%');
        }

        $products = $query->paginate(5);

        return view('products.index', compact('products'));
    }

    // ➕ form thêm
    public function create()
    {
        return view('products.create');
    }

    // 💾 lưu
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required|numeric|min:0',
            'quantity'=>'required|integer|min:0',
            'category'=>'required'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                         ->with('success','Thêm thành công');
    }

    // ❌ xóa
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back();
    }

    // 🔄 cập nhật tồn kho
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'quantity' => $request->quantity
        ]);

        return back();
    }
}