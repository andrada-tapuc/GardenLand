@extends('layouts.admin')

@section('content')

    <h1>Crează Categorie Produse</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store_product') }}" method='POST' enctype="multipart/form-data">
        <div class="form-group">
            <br/>
            @csrf
            <div class="form-group name_cat">
                <label for="name_en">Nume Categorie</label>
                <input type="text" class="form-control" name="name" />
            </div><br/>
        </div>

        <div class="form-group  image-group">
            <label for="parent_id">Categoria Părinte</label>
            <select name="parent_id">
                <option value="0">Supercategorie</option>
                @foreach ($allCat as $category)
                    <option value={{$category->id}}>{{ $category->name_category}} </option>
                    @foreach ($category->childrenCategories as $child)
                        @if(!empty($child->first()))
                            @include('categories.dropdown_product', ['category' => $child])
                        @endif
                    @endforeach
                @endforeach
            </select>
        </div>
        <button onclick="alert('Categoria a fost creată cu succes!')" type="submit" class="btn btn-primary button-create">Crează Categoria</button>
    </form>

@endsection

@section('styles')
    @parent
@endsection
