@extends('layouts.admin')

@section('content')
    <h1> Crează un nou serviciu</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong>  @lang('messages.some-errors')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method='POST' enctype="multipart/form-data">

        <br/>
        @csrf
        <div class="form-group">
            <label for="name">Numele Serviciului:</label>
            <input type="text" class ="form-control" name="name"/>
        </div>

        <div class="form-group">
            <label for="price">Prețul:</label>
            <input type="text" class ="form-control" name="price"/>
        </div>

        <div class="form-group">
            <label for="time_exec">Timp de execuție:</label>
            <input type="text" class ="form-control" name="time_exec"/>
        </div>

        <div class="form-group  image-group">
            <label for="category_id">Categoria Serviciului</label>
            <select name="category_id">
                <option value="">Selectează categoria</option>
                @foreach ($allCat as $category)
                    <option value={{$category->id}}>{{ $category->name_category}} </option>
                    @foreach ($category->childrenCategories as $child)
                        @if(!empty($child->first()))
                            @include('services.dropdown', ['category' => $child])
                        @endif
                    @endforeach
                @endforeach
            </select>
        </div>

        <label for="image1">Imagini:</label>
        <div class="row form-group image-group">

            <div class="column" id="box_image1">
                <input type="file" class="input" name="image1" id="input_box_image1" data-items="5">
                <input type="text" class ="form-control" name="title1" placeholder="Titlul imaginii"/>
                <textarea type="text" class="form-control" name = "description1"  rows="5"  placeholder="Descrierea imaginii"></textarea>
            </div>

            <div class="column add_image1">
                <button class=" btn btn-add_image1" type="button">+ Adaugă altă imagine</button>
            </div>

            <div class="column" id="box_image2" style="display:none">
                <input type="file" class="input" name="image2" id="input_box_image2" data-items="5">
                <input type="text" class ="form-control" name="title2" placeholder="Titlul imaginii"/>
                <textarea type="text" class="form-control" name = "description2"  rows="5"  placeholder="Descrierea imaginii"></textarea>
            </div>

            <div class="column add_image2" style="display:none">
                <button class="btn btn-add_image2" type="button">+ Adaugă altă imagine</button>
            </div>

            <div class="column" id="box_image3" style="display:none">
                <input type="file" class="input" name="image3" id="input_box_image3" data-items="5">
                <input type="text" class ="form-control" name="title3" placeholder="Titlul imaginii"/>
                <textarea type="text" class="form-control" name = "description3"  rows="5"  placeholder="Descrierea imaginii"></textarea>
            </div>

        </div>
        <button onclick="alert('Serviciul a fost creat!')" type="submit" class="btn btn-primary button-create">Crează Serviciul</button>
    </form>

@endsection

@section('styles')
    @parent
@endsection

@section('scripts')
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.btn-add_image1').click(function(){
                $('.add_image1').hide();
                $('.add_image2').show();
                $('#box_image2').show();
            });
            $('.btn-add_image2').click(function() {
                $('.add_image2').hide();
                $('#box_image3').show();
            });
        });
    </script>
@endsection
