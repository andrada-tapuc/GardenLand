<?php

namespace App\Http\Controllers;

use App\Image_Product;
use App\Product;
use Illuminate\Http\Request;
use App\Products_category;

class ProductCategoryController extends Controller
{

    public function create()
    {
        return view('categories.create_product')->with([
            'allCat' => Products_category::all()]);
    }

    public function show()
    {
        $allCategories = Products_category::paginate(10);
        return view('categories.show_product', compact('allCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'parent_id' => 'required',
        ]);

        $category = new Products_category();
        if($request->parent_id === "0"){
            $category->parent_id = null;
        }
        else {
            $category->parent_id = $request->parent_id;
        }
        $category->name_category = $request->name;
        $category->save();

        return redirect('/admin/categories/products/show')->with('success',  'Categoria de produse a fost creată!');
    }

    public function edit($id)
    {
        $category = Products_category::find($id);
        return view('categories.edit_product')->with([
            'selectedCat' => $category,
            'allCat' => Products_category::all(),
            compact('category')
        ]);
    }

    public function update(Request $request, $id)
    {
        $parent = $request->input('parent_id');
        if($parent === "0"){
            $request->validate([
                'name' => 'required|max:255',
            ]);

            $category = Products_category::find($id);
            if (empty($category))
                return abort(404);
            $category->update([
                'name_category' => $request->input('name'),
                'parent_id' => null,
            ]);
            $category->save();
            return redirect('/admin/categories/products/show')->with('success',  'Categoria produselor a fost edită!');
        }

        $request->validate([
            'parent_id' => 'required|exists:products_categories,id',
            'name' => 'required|max:255'
        ]);

        $category = Products_category::find($id);
        if (empty($category))
            return abort(404);
        $category->update([
            'parent_id' => $request->input('parent_id'),
            'name_category' =>$request->input('name'),
        ]);
        $category->save();

        return redirect('/admin/categories/products/show')->with('success',  'Categoria produselor a fost edită!');
    }

    public function destroy($id)
    {
        $category = Products_category::find($id);

        $products = Product::where('category_id', $id)->get();
        foreach ($products as $prod){
            $images = Image_Product::where('product_id', $prod->id)->get();
            foreach ($images as $img) {
                $img->delete();
            }
            $prod->delete();
        }
        $category->delete();
        return redirect('/admin/categories/products/show')->with('success', 'Categoria a fost ștearsă!');
    }
}
