<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $brand = new Brand();
        $brand->title = $request->brand_product_title;
        $brand->slug = $request->brand_product_slug;
        $brand->desc = $request->brand_product_desc;
        $brand->status = $request->brand_product_status;
        $brand->keywords = $request->brand_product_keywords;
        $brand->save();

        return redirect()->route('admin.indexBrand')->with('msg', 'Thêm thương hiệu sản phẩm thành công !');
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
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        $brand = Brand::find($id);
        $brand->title = $request->brand_product_title;
        $brand->slug = $request->brand_product_slug;
        $brand->desc = $request->brand_product_desc;
        $brand->keywords = $request->brand_product_keywords;
        $brand->save();

        return redirect()->route('admin.indexBrand')->with('msg', 'Cập nhật thương hiệu sản phẩm thành công !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return redirect()->route('admin.indexBrand')->with('msg', 'Xóa thương hiệu sản phẩm thành công !');
    }

    /**
     * Unactive category product.
     */
    public function hidden(string $id){
        Brand::where('id', $id)->update(['status' => '0']);

        return redirect()->route('admin.indexBrand')->with('msg', 'Ẩn thương hiệu sản phẩm thành công !');
    }

    /**
     * Active category product.
     */
    public function active(string $id){
        Brand::where('id', $id)->update(['status' => '1']);

        return redirect()->route('admin.indexBrand')->with('msg', 'Kích hoạt thương hiệu sản phẩm thành công !');
    }
}
