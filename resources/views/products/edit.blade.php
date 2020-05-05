
@extends('layouts.admin')

@section('content')
    <h1>Editare Produs</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong>Există probleme cu datele introduse!<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('products.update', $product->id)}}" method='POST' enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <br/>

        <div class="form-group">
            <label for="name">Numele Produsului:</label>
            <input type="text" class ="form-control" name="name" value="{{$product->name ? : old('name') }}"/>
        </div>

        <div class="form-group">
            <label for="price">Prețul:</label>
            <input type="text" class ="form-control" name="price" value="{{$product->price ? : old('price')}}">
        </div>

        <div class="form-group">
            <label for="time_exec">Timp de execuție:</label>
            <input type="text" class ="form-control" name="time_exec" value="{{$product->time_exec ? : old('time_exec')}}">
        </div>

        <div class="form-group  image-group">
            <label for="category_id">Categoria Produsului:</label>
            <select name="category_id">
                @foreach ($allCat as $category)
                    <option value={{ $category->id }} @if($category->id === $product->category_id) selected @endif>
                        {{ $category->name_category}}
                    </option>
                    @foreach ($category->childrenCategories as $child)
                        @if(!empty($child->first()))
                            @include('products.dropdown_selected', ['category' => $child])
                        @endif
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="label-image" for="image">Imagini: </label>
        </div>
        <div class="row form-group">
            @php $count = 0 ; @endphp
            @foreach( $product->image as $img)
                @php $count = $count + 1 ;
                    $name_image = "image" . $count;
                    $view_image = "img_view" . $count;
                    $title_image = "title" .$count;
                    $description_image = "description" .$count;
                @endphp
                <div class="column" data-id={{ $img->id }}>
                    <img src="{{asset('storage/products/'.$img->name)}}" id="{{$img->id}}" title="imagine" class="form-row {{$view_image}}" alt="image" height="300" width="300"/>
                    <input type="text" name="{{$title_image}}" class="form-control" value="{{$img->title ? : old('title')}}">
                    <textarea type="textarea" rows="7" name="{{$description_image}}" class ="form-control" value="{{$img->description ? : old('description')}}">{{$img->description ? : old('description')}}</textarea>

                    <input type="file" name="{{$name_image}}" id="fileToUpload" hidden/>
                    <a class="link-delete-{{$count}}">
                        <button class="btn btn-danger btn-xs delete-image" data-title="Delete" data-toggle="modal" data-target="#delete" >
                            <span class="glyphicon glyphicon-trash "></span>Șterge imaginea
                        </button>
                    </a>
                </div>
                <br/>
            @endforeach

            <div class="column add_image1" id="box_image1">
                <button id="b1" class="btn btn-add_image1" type="button">+ Adaugă altă imagine</button>
            </div>

            <div class="column" id="newimage1" style="display: none">
                <input type="file" class="input" name="image_add1" id="input_box_image1" data-items="5">
                <input type="text" class ="form-control" name="title_new1" placeholder="Titlul imaginii"/>
                <textarea type="text" class="form-control" name = "description_new1"  rows="5"  placeholder="Descrierea imaginii"></textarea>
            </div>

            <div class="column add_image2" id="box_image2"  style="display: none">
                <button id="b1" class="btn btn-add_image2" type="button">+ Adaugă altă imagine</button>
            </div>
            <div class="column" id="newimage2" style="display: none">
                <input type="file" class="input" name="image_add2" id="input_box_image2" data-items="5">
                <input type="text" class ="form-control" name="title_new2" placeholder="Titlul imaginii"/>
                <textarea type="text" class="form-control" name = "description_new2"  rows="5"  placeholder="Descrierea imaginii"></textarea>
            </div>
        </div>

        <br/>
        <button onclick="alert('Produsul a fost editat!')" type="submit" class="btn btn-primary button-edit">Editează Produsul</button>
    </form>
@endsection

@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>

                $(document).on('click', '.delete-image', function (e) {
                    e.preventDefault();
                    console.log('gewgewgw');
                    var imageId = $(this).parents('div').attr('data-id');
                    $.ajax({
                        type: "post",
                        data: {'imageId': imageId},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '/admin/products/destroy/image',
                        success: function (data) {
                            console.log('success');
                        }
                    });
                });

                $(document).ready(function() {
                    $('.link-delete-1').addClass('hidden');
                    var $form = $('form');

                    var $file1 = $form.find('input[name=image1]');
                    var $img1 = $form.find('img.img_view1');
                    $img1.on('click', function() {
                        $file1.click();
                    });
                    $file1.on('change', function (e) {
                        var file1 = e.target.files[0];
                        if (typeof(file1) === 'undefined' || !['image/jpg', 'image/jpeg', 'image/png', 'image/gif'].includes(file1.type))
                            return false;
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $img1.attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file1);
                    });

                    var $file2 = $form.find('input[name=image2]');
                    var $img2 = $form.find('img.img_view2');
                    $img2.on('click', function() {
                        $file2.click();
                    });
                    $file2.on('change', function (e) {
                        var file2 = e.target.files[0];
                        if (typeof(file2) === 'undefined' || !['image/jpg', 'image/jpeg', 'image/png', 'image/gif'].includes(file2.type))
                            return false;
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $img2.attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file2);
                    });

                    var $file3 = $form.find('input[name=image3]');
                    var $img3 = $form.find('img.img_view3');
                    $img3.on('click', function() {
                        $file3.click();
                    });
                    $file3.on('change', function (e) {
                        var file3 = e.target.files[0];
                        if (typeof(file3) === 'undefined' || !['image/jpg', 'image/jpeg', 'image/png', 'image/gif'].includes(file3.type))
                            return false;
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $img3.attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file3);
                    });
                });

                $(document).ready(function(){
                    var $newimage1 =$('div[id=box_image1]');
                    var $newimage2 =$('div[id=box_image2]');
                    var allimages =  document.getElementsByName('image3');
                    var secondimage = document.getElementsByName('image2');
                    if (allimages.length > 0)
                    {
                        $newimage1.hide();
                        $newimage2.hide();
                    }
                    else
                    if (secondimage.length > 0){
                        $newimage2.hide();
                    }
                });

                $(document).ready(function() {
                    $('.btn-add_image1').click(function(){
                        $('.add_image1').hide();
                        $('#newimage1').show();
                        var element =  document.getElementsByClassName('img_view2');
                        if (typeof(element) === 'undefined' && element === null)
                        {
                            $('.add_image2').show();
                        }
                        $('.add_image2').show();
                    });
                    $('.btn-add_image2').click(function(){
                        $('.add_image2').hide();
                        $('#newimage2').show();
                    });
                });

    </script>
@endsection
