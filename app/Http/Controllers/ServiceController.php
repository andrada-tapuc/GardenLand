<?php

namespace App\Http\Controllers;

use App\Services_category;
use App\Service;
use App\Image_Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Marcohern\Slugifier\Lib\Slugifier;

class ServiceController extends Controller
{
    public function create()
    {
        return view('services.create')->with([
            'allCat' => Services_category::all()]);
    }

    public function show()
    {
        $servicesShow = Service::paginate(10);
        return view('services.show', compact('servicesShow'));
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


        $service = new Service;
        $service->category_id = $request->get('category_id');
        $service->name = $request->get('name');
        $service->price = $request->get('price');
        $service->time_exec = $request->get('time_exec');
        $service->save();


        $image1 = new Image_Service;
        $image1->service_id = $service->id;
        if($request->hasFile('image1')) {
            $file = $request->file('image1');
            $image1->title = $request->get('title1');
            $image1->name = $service->name . str_replace(" ", "-",$image1->title) . '_' .  str_replace(" ", "-", $file->getClientOriginalName());
            $image1->description = $request->get('description1');
            if (!empty($file))
                Storage::put('public/services/' . $image1->name, file_get_contents($request->file('image1')->getRealPath()));
            $image1->save();
        }

        if($request->hasFile('image2')){
            $image2 = new Image_Service;
            $image2->service_id = $service->id;
            $file = $request->file('image2');
            $image2->description = $request->get('description2');
            $image2->title = $request->get('title2');
            $image2->name = $service->name . str_replace(" ", "-",$image2->title) . '_' .  str_replace(" ", "-", $file->getClientOriginalName());
            if (!empty($file))
                Storage::put('public/services/' . $image2->name, file_get_contents($request->file('image2')->getRealPath()));
            $image2->save();
        }

        if($request->hasFile('image3')){
            $image3 = new Image_Service;
            $image3->service_id = $service->id;
            $file = $request->file('image3');
            $image3->description = $request->get('description3');
            $image3->title = $request->get('title3');
            $image3->name = $service->name . str_replace(" ", "-",$image3->title) . '_' .  str_replace(" ", "-", $file->getClientOriginalName());
            if (!empty($file))
                Storage::put('public/services/' . $image3->name, file_get_contents($request->file('image3')->getRealPath()));
            $image3->save();
        }

        return redirect('/admin/services/show')->with('success', 'Seviciul a fost creat!');
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('services.edit')->with([
            'service'=> $service,
            'allCat' => Services_category::all(),
            compact('service')
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

        $service = Service::find($id);
        if (empty($service))
            return abort(404);
        $service->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'time_exec' => $request->input('time_exec'),
            'price' => $request->input('price'),
        ]);
        $service->save();

        $file =  $request->file('image1');
        $image1 = Image_Service::where('service_id', $service->id)->first();
        $image1->update([
            'title'=>$request->input('title1'),
            'name' => empty($file) ? $image1->name : ($service->name . str_replace(" ", "-",$image1->title) . '_' .  str_replace(" ", "-", $file->getClientOriginalName())),
            'description' =>$request->input('description1'),
        ]);
        $image1->save();
        if (!empty($file))
            Storage::put('public/services/' . $image1->name, file_get_contents($file->getRealPath()));

        $file2 =  $request->file('image2');
        if($file2 && !empty($file2)) {
            $image2 = Image_Service::where('service_id', $service->id)->get()[1];
            $image2->update([
                'title'=>$request->input('title2'),
                'name' => empty($file2) ? $image2->name : ($service->name . str_replace(" ", "-",$image2->title) . '_' .  str_replace(" ", "-", $file2->getClientOriginalName())),
                'description' =>$request->input('description2'),
            ]);
            $image2->save();
        }
        if (!empty($file2))
            Storage::put('public/services/' . $image2->name, file_get_contents($file2->getRealPath()));

        $file3 =  $request->file('image3');
        if($file3 && !empty($file3)) {
            $image3 = Image_Service::where('service_id', $service->id)->get()[2];
            $image3->update([
                'title'=>$request->input('title3'),
                'name' => empty($file3) ? $image3->name : ($service->name . str_replace(" ", "-",$image3->title) . '_' .  str_replace(" ", "-", $file3->getClientOriginalName())),
                'description' =>$request->input('description3'),
            ]);
            $image3->save();
        }
        if (!empty($file3))
            Storage::put('public/services/' . $image3->name, file_get_contents($file3->getRealPath()));

        $file_add1 =  $request->file('image_add1');
        if($file_add1  && !empty($file_add1)) {
            $image_add1 = new Image_Service;
            $image_add1->service_id = $id;
            $image_add1->title = $request->get('title_new1');
            $image_add1->name = $service->name . str_replace(" ", "-",$image_add1->title) . '_' .  str_replace(" ", "-", $file_add1->getClientOriginalName());
            $image_add1->description = $request->get('description_new1');
            $image_add1->save();
            Storage::put('public/services/' . $image_add1->name, file_get_contents($file_add1->getRealPath()));

        }

        $file_add2 =  $request->file('image_add2');
        if($file_add2  && !empty($file_add2)) {
            $image_add2 = new Image_Service;
            $image_add2->service_id = $id;
            $image_add2->title = $request->get('title_new2');
            $image_add2->name = $service->name . str_replace(" ", "-",$image_add2->title) . '_' .  str_replace(" ", "-", $file_add2->getClientOriginalName());
            $image_add2->description = $request->get('description_new2');
            $image_add2->save();
            Storage::put('public/services/' . $image_add2->name, file_get_contents($file_add2->getRealPath()));
        }
        return redirect('/admin/services/show')->with('success', 'Serviciul a fost editat!');
    }

    public function destroy($id)
    {
        $product = Service::find($id);
        $product->delete();

        $images = Image_Service::where('service_id', $id)->get();
        foreach ($images as $img) {
            $img->delete();
        }
        return redirect('/admin/services/show')->with('success', 'Serviciul a fost șters!');
    }

    public function destroyImage(Request $request)
    {
        $imageId = $request->get('imageId');
        $image = Image_Service::find($imageId);
        $image->delete();
        return redirect('/admin/services/show')->with('success', 'Imaginea a fost ștearsă!');
    }

}
