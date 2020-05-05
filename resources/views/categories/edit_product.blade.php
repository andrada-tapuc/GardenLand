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

    <form action="{{route('categories.update_product', $selectedCat->id)}}" method='POST' enctype="multipart/form-data">
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
                                    @include('categories.dropdown_product_selected', ['category' => $child])
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div><br/>
                <button onclick="alert('Categoria a fost editată! ')"  type="submit" class="btn btn-primary button-edit">Editează Categoria</button>
            </div>
        </div>
    </form>

@endsection

@section('styles')
    @parent
@endsection
