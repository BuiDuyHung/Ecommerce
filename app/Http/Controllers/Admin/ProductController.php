<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->title = $request->product_title;
        $product->desc = $request->product_desc;
        $product->content = $request->product_content;
        $product->price = $request->product_price;
        $product->status = $request->product_status;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        /*$get_image = $request->file('product_image');

        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $product->image = $new_image;
        }*/
        if($request->product_image){
            $image = $request->product_image;
            $ext = $image->getClientOriginalExtension();
            $name = time().'_'.$image->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($image));
            $product->image = $name;
        }

        $product->save();

        return redirect()->route('admin.indexProduct')->with('msg', 'Thêm sản phẩm thành công !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.edit', compact('categories', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        $product->title = $request->product_title;
        $product->desc = $request->product_desc;
        $product->content = $request->product_content;
        $product->price = $request->product_price;
        $product->status = $request->product_status;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        /*$get_image = $request->file('product_image');

        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $product->image = $new_image;
            $product->save();
        }*/
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $name = time() . '_' . $image->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($image));
            $product->image = $name;
        } else {
            $name = $product->image;
        }

        $product->save();
        return redirect()->route('admin.indexProduct')->with('msg', 'Cập nhật sản phẩm thành công !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product->image) {
            unlink('uploads/'.$product->image);
        }
        $product->delete();

        return redirect()->route('admin.indexProduct')->with('msg', 'Xóa sản phẩm thành công !');
    }

    /**
     * Unactive category product.
     */
    public function hidden(string $id){
        Product::where('id', $id)->update(['status' => '0']);

        return redirect()->route('admin.indexProduct')->with('msg', 'Ẩn sản phẩm thành công !');
    }

    /**
     * Active category product.
     */
    public function active(string $id){
        Product::where('id', $id)->update(['status' => '1']);

        return redirect()->route('admin.indexProduct')->with('msg', 'Kích hoạt sản phẩm thành công !');
    }
}
