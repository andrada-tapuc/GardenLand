@extends('layouts.admin')

@section('content')

    <h1>Editare Categorie</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong>@lang('messages.some-errors')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('categories.update_service', $selectedCat->id)}}" method='POST' enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <br/>
                <div class="form-group name_cat">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{$selectedCat->name_category ? : old('name')}}" />
                </div><br/>

                <div class="select-boxes">
                    @csrf
                    <label for="parent_id">Categoria părinte:</label>
                    <select name="parent_id">
                        <option value="0" @if($selectedCat->parent_id === null) selected @endif>Supercategorie</option>
                        @foreach($allCat as $cat)
                            <option value={{$cat->id}} @if($cat->id === $selectedCat->parent_id) selected @endif>{{ $cat->name_category }}</option>
                            @foreach ($cat->childrenCategories as $child)
                                @if(!empty($child->first()))
                                    @include('categories.dropdown_service_selected', ['category' => $child])
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div><br/>

                <div class="form-group">
                    <img src="{{asset('storage/categories/'.$selectedCat->image->name)}}" id="{{$selectedCat->image->first()->id}}" title="imagine" class="form-row img_view1" alt="image" height="300" width="300"/>
                    <input type="file" name="image1" id="fileToUpload" hidden/>
                </div>

                <button onclick="alert('Categoria a fost editată! ')"  type="submit" class="btn btn-primary button-edit">Editează Categoria</button>
            </div>
        </div>
    </form>

@endsection

@section('styles')
    @parent
@endsection
@section('scripts')
    @parent
    <script>
    $(document).ready(function() {
        var $form = $('form');

        var $file1 =$('input[name=image1]');
        var $img1 = $form.find('img.img_view1');
        $img1.on('click', function () {
            $file1.click();
        });

        $file1.on('change', function (e) {
            var file1 = e.target.files[0];
            if (typeof (file1) === 'undefined' || !['image/jpg', 'image/jpeg', 'image/png', 'image/gif'].includes(file1.type))
                return false;
            var reader = new FileReader();
            reader.onload = function (e) {
                $img1.attr('src', e.target.result);
            };
            reader.readAsDataURL(file1);
        });
    });
    </script>
@endsection
