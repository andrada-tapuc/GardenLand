@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <h3 class="title_table">Categoriile Serviciilor</h3>
            <br/>
            <a href="/admin/categories/services/create"><button class="btn btn-primary button-new">+ Crează Categorie</button></a> <br/><br/>
            @if(count($allCategories) > 0)
                <h6>*Ștergerea unei categorii, va șterge și serviciile sale.</h6>
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thread>
                            <th>Nume Categorie</th>
                            <th>Categoria Părinte</th>
                            <th>Editează</th>
                            <th>Șterge</th>
                        </thread>

                        <tbody>
                        @foreach($allCategories as $category)
                            @if(!empty($category))
                                <tr>
                                    <td>{{$category->name_category}}</td>
                                    <td>
                                        @if($category->parent instanceof \App\Services_category)
                                            {{ $category->parent->name_category }}
                                        @else
                                            {{ 'Supercategorie' }}
                                        @endif
                                    </td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <a href="{{route('categories.edit_service', $category->id)}}">
                                                <button class="btn btn-primary btn-xs edit-cateogory" data-title="Edit" data-toggle="modal" data-target="#edit" >
                                                    <span class="glyphicon glyphicon-pencil "></span>
                                                </button>
                                            </a>
                                        </p>
                                    </td>
                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                                            <a href="{{route('categories.destroy_service', $category->id)}}" onclick="alert('Categoria a fost ștearsă!')">
                                                <button class="btn btn-danger btn-xs delete-category" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                    <span class="glyphicon glyphicon-trash "></span>
                                                </button>
                                            </a>
                                        </p>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    {!! $allCategories->links() !!}
                </div>
            @else
                <p class="msg-empty"> Nu există categorii pentru produse! Poti începe să creezi o categorie <a href="/admin/categories/services/create">aici</a>.</p>
            @endif
        </div>
    </div>

@endsection

@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
@endsection

