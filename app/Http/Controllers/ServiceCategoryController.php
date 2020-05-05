<?php

namespace App\Http\Controllers;

use App\Image_Service;
use App\Product;
use App\Products_category;
use App\Service;
use Illuminate\Http\Request;
use App\Services_category;
use App\Image_Category;
use Illuminate\Support\Facades\Storage;

class ServiceCategoryController extends Controller
{
    public function all_products_categories(){
        return view('all-products')->with([
            'allCatServ' => Services_category::all(),
            'allServices' =>Service::all(),
            'allProdCat' => Products_category::index(),
            'allProducts' => Product::all(),
        ]);
    }

    public function all_services_categories(){
        return view('all-services')->with([
            'allCat' => Services_category::all(),
            'allServices' =>Service::all(),
            'allProdCat' => Products_category::index(),
        ]);
    }

    public function welcome_categories(){
        return view('welcome')->with([
            'allCat' => Services_category::all(),
            'allServices' =>Service::all(),
            'allProdCat' => Products_category::index(),
            'allProducts' =>Product::all(),
            'firstProd' => Product::all()->take(4),
            'nextProd' => Product::all()->slice(4)->take(4),
            'images' =>Image_Category::all(),
            ]);
    }

    public function create()
    {
        return view('categories.create_service')->with([
            'allCat' => Services_category::all()]);
    }

    public function show()
    {
        $allCategories = Services_category::paginate(10);
        return view('categories.show_service', compact('allCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'parent_id' => 'required',
            'image' => 'required|image|max:1999',
        ]);
        $category = new Services_category();
        if($request->parent_id === "0"){
            $category->parent_id = null;
        }
        else {
            $category->parent_id = $request->parent_id;
        }
        $category->name_category = $request->name;
        $category->save();

        $image = new Image_Category;
        $image->category_id = $category->id;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $image->name = $category->name_category . '_' . $file->getClientOriginalName();
            if (!empty($file))
                Storage::put('public/categories/' . $image->name, file_get_contents($request->file('image')->getRealPath()));
            $image->save();
        }
        return redirect('/admin/categories/services/show')->with('success',  'Categoria de servicii a fost creată!');
    }

    public function edit($id)
    {
        $category = Services_category::find($id);
        return view('categories.edit_service')->with([
            'selectedCat' => $category,
            'allCat' => Services_category::all(),
            compact('category')
        ]);
    }

    public function update(Request $request, $id)
    {
        $parent = $request->input('parent_id');
        if($parent === "0"){
            $request->validate([
                'name' => 'required|max:255',
                'image1' => 'image|nullable|max:1999',
            ]);
            $category = Services_category::find($id);
            if (empty($category))
                return abort(404);
            $category->update([
                'name_category' => $request->input('name'),
                'parent_id' => null,
            ]);
            $category->save();

            $file =  $request->file('image1');
            $image1 = Image_Category::where('category_id', $category->id)->first();
            $image1->update([
                'name' => empty($file) ? $image1->name : ($category->name_category . '_' . $file->getClientOriginalName()),
            ]);
            $image1->save();
            if (!empty($file))
                Storage::put('public/categories/' . $image1->name, file_get_contents($file->getRealPath()));
            return redirect('/admin/categories/services/show')->with('success',  'Categoria serviciilor a fost edită!');
        }

        $request->validate([
            'parent_id' => 'required|exists:services_categories,id',
            'name' => 'required|max:255',
            'image1' => 'image|nullable|max:1999',
        ]);

        $category = Services_category::find($id);
        if (empty($category))
            return abort(404);
        $category->update([
            'parent_id' => $request->input('parent_id'),
            'name_category' =>$request->input('name'),
        ]);
        $category->save();

        $file =  $request->file('image1');
        $image1 = Image_Category::where('category_id', $category->id)->first();
        $image1->update([
            'name' => empty($file) ? $image1->name : ($category->name_category . '_' . $file->getClientOriginalName()),
        ]);
        $image1->save();
        if (!empty($file))
            Storage::put('public/categories/' . $image1->name, file_get_contents($file->getRealPath()));

        return redirect('/admin/categories/services/show')->with('success',  'Categoria serviciilor a fost edită!');
    }

    public function destroy($id)
    {
        $category = Services_category::find($id);
        $category->delete();
        return redirect('/admin/categories/services/show')->with('success', 'Categoria a fost ștearsă!');
    }
}
