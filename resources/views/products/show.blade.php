@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <h3 class="title_table"></h3>
            <br/>
            <a href="/admin/products/create"><button class="btn btn-primary button-new">+ Produs Nou</button></a> <br/><br/>
            @if(count($productsShow) > 0)
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thread>
                            <th>Nume</th>
                            <th>Preț</th>
                            <th>Timp de execuție</th>
                            <th>Categoria</th>
                            <th>Editare</th>
                            <th>Ștergere</th>
                        </thread>

                        <tbody>
                        @foreach($productsShow as $prod)
                            <tr>
                                <td>{{$prod->name}}</td>
                                <td>{{$prod->price}}</td>
                                <td>{{$prod->time_exec}}</td>
                                <td>{{$prod->category->name_category}}</td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <a href="{{route('products.edit', $prod->id)}}">
                                            <button class="btn btn-primary btn-xs edit-product" data-title="Edit" data-toggle="modal" data-target="#edit" >
                                                <span class="glyphicon glyphicon-pencil "></span>
                                            </button>
                                        </a>
                                    </p>
                                </td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                                        <a href="{{route('products.destroy', $prod->id)}}" onclick="if(confirm('Ești sigur că vrei să ștergi acest produs?'))
                                                      alert('Produsul a fost șters!') ">
                                            <button class="btn btn-danger btn-xs delete-product" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                <span class="glyphicon glyphicon-trash "></span>
                                            </button>
                                        </a>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $productsShow->links() !!}
                </div>
            @else
                <p class="msg-empty"> Nu există produse! Poti începe să creezi un produs <a href="/admin/products/create">aici</a>.</p>
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
