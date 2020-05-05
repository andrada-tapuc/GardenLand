<?php

namespace App\Http\Controllers;

use App\Products_category;
use App\Product;
use App\Image_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
//    public function index()
//    {
//        return view('home',[
//            'productsList' => Product::index(),
//            'newProducts' => Product::newProducts()
//        ]);
//    }

    public function create()
    {
        return view('products.create')->with([
            'allCat' => Products_category::all()]);
    }

    public function show()
    {
        $productsShow = Product::paginate(10);
        return view('products.show', compact('productsShow'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id'=>'required',
            'name' => 'required|max:999',
            'price' => 'required',
            'time_exec' => 'required',
            'image1' =>'required|image|max:1999',
            'image2' =>'nullable|image|max:1999',
            'image3' =>'nullable|image|max:1999',
            'title1' => 'required|max:300',
            'title2' => 'max:300',
            'title3' => 'max:300',
            'description1' => 'required|max:9999',
            'description2' => 'max:9999',
            'description3' => 'max:9999',
        ]);

        $product = new Product;
        $product->category_id = $request->get('category_id');
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->time_exec = $request->get('time_exec');
        $product->save();


        $image1 = new Image_Product;
        $image1->product_id = $product->id;
        if($request->hasFile('image1')) {
            $file = $request->file('image1');
            $image1->name = $product->name . '_' . $file->getClientOriginalName();
            if (!empty($file))
                Storage::put('public/products/' . $image1->name, file_get_contents($request->file('image1')->getRealPath()));
            $image1->title = $request->get('title1');
            $image1->description = $request->get('description1');
            $image1->save();
        }

        if($request->hasFile('image2')){
            $image2 = new Image_Product;
            $image2->product_id = $product->id;
            $file = $request->file('image2');
            $image2->name = $product->name . '_' . $file->getClientOriginalName();
            if (!empty($file))
                Storage::put('public/products/' . $image2->name, file_get_contents($request->file('image2')->getRealPath()));
            $image2->title = $request->get('title2');
            $image2->description = $request->get('description2');
            $image2->save();
        }

        if($request->hasFile('image3')){
            $image3 = new Image_Product;
            $image3->product_id = $product->id;
            $file = $request->file('image3');
            $image3->name = $product->name . '_' . $file->getClientOriginalName();
            if (!empty($file))
                Storage::put('public/products/' . $image3->name, file_get_contents($request->file('image3')->getRealPath()));
            $image3->title = $request->get('title3');
            $image3->description = $request->get('description3');
            $image3->save();
        }

        return redirect('/admin/products/show')->with('success', 'Produsul a fost creat!');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit')->with([
            'product'=> $product,
            'allCat' => Products_category::all(),
            compact('product')
        ]);
    }

    public function update(Request $request, $id)
    {
        $request -> validate ([
            'name' => 'required',
            'time_exec' =>'required',
            'price' => 'required',
            'category_id' =>'required',
            'image1' => 'image|nullable|max:1999',
            'image2' => 'image|nullable|max:1999',
            'image3' => 'image|nullable|max:1999',
            'title1' => 'required|max:300',
            'title2' => 'nullable|max:300',
            'title3' => 'nullable|max:300',
            'description1' => 'required|max:9999',
            'description2' => 'nullable|max:9999',
            'description3' => 'nullable|max:9999',
            'image_add1' => 'image|nullable|max:1999',
            'image_add2' => 'image|nullable|max:1999',
            'title_new1' => 'nullable|max:300',
            'title_new2' => 'nullable|max:300',
            'description_new1' => 'nullable|max:9999',
            'description_new2' => 'nullable|max:9999',
        ]);

        $product = Product::find($id);
        if (empty($product))
            return abort(404);
        $product->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'time_exec' => $request->input('time_exec'),
            'price' => $request->input('price'),
        ]);
        $product->save();

        $file =  $request->file('image1');
        $image1 = Image_Product::where('product_id', $product->id)->first();
        $image1->update([
            'name' => empty($file) ? $image1->name : ($product->name . '_' . $file->getClientOriginalName()),
            'title'=>$request->input('title1'),
            'description' =>$request->input('description1'),
        ]);
        $image1->save();
        if (!empty($file))
            Storage::put('public/products/' . $image1->name, file_get_contents($file->getRealPath()));

        $file2 =  $request->file('image2');
        if($file2 && !empty($file2)) {
            $image2 = Image_Product::where('product_id', $product->id)->get()[1];
            $image2->update([
                'name' => empty($file2) ? $image2->name : ($product->name . '_' . $file2->getClientOriginalName()),
                'title'=>$request->input('title2'),
                'description' =>$request->input('description2'),
            ]);
            $image2->save();
            }
        if (!empty($file2))
            Storage::put('public/products/' . $image2->name, file_get_contents($file2->getRealPath()));

        $file3 =  $request->file('image3');
        if($file3 && !empty($file3)) {
            $image3 = Image_Product::where('product_id', $product->id)->get()[2];
            $image3->update([
                'name' => empty($file3) ? $image3->name : ($product->name . '_' . $file3->getClientOriginalName()),
                'title'=>$request->input('title3'),
                'description' =>$request->input('description3'),
            ]);
            $image3->save();
        }
        if (!empty($file3))
            Storage::put('public/products/' . $image3->name, file_get_contents($file3->getRealPath()));

        $file_add1 =  $request->file('image_add1');
        if($file_add1  && !empty($file_add1)) {
            $image_add1 = new Image_Product;
            $image_add1->product_id = $id;
            $image_add1->name = $product->name . '_' . $file_add1->getClientOriginalName();
            $image_add1->title = $request->get('title_new1');
            $image_add1->description = $request->get('description_new1');
            $image_add1->save();
            Storage::put('public/products/' . $image_add1->name, file_get_contents($file_add1->getRealPath()));

        }

        $file_add2 =  $request->file('image_add2');
        if($file_add2  && !empty($file_add2)) {
            $image_add2 = new Image_Product;
            $image_add2->product_id = $id;
            $image_add2->image_name = $product->name . '_' . $file_add2->getClientOriginalName();
            $image_add2->title = $request->get('title_new2');
            $image_add2->description = $request->get('description_new2');
            $image_add2->save();
            Storage::put('public/products/' . $image_add2->name, file_get_contents($file_add2->getRealPath()));
        }
        return redirect('/admin/products/show')->with('success', 'Produsul a fost editat!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        $images = Image_Product::where('product_id', $id)->get();
        foreach ($images as $img) {
            $img->delete();
        }
        return redirect('/admin/products/show')->with('success', 'Produsul a fost șters!');
    }

//    public function toProduct($slug)
//    {
//        $slug = explode('-', $slug);
//        $id = end($slug );
//        $product = Product::find($id);
//
//        if ($product->lang->first()->language_name !== app()->getLocale())
//            return redirect()->route('welcome');
//        return view('product_page')->with([
//            'product'=> $product,
//            'slug' => $slug
//        ]);
//    }

    public function destroyImage(Request $request)
    {
        $imageId = $request->get('imageId');
        $image = Image_Product::find($imageId);
        $image->delete();
        return redirect('/admin/products/show')->with('success', 'Imaginea a fost ștearsă!');
    }
}
