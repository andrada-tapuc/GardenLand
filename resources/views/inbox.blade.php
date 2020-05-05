@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <h3 class="title_table">Inbox</h3>
            @if(count($inbox) > 0)
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thread>
                            <th>Nume complet</th>
                            <th>Mesaj</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            <th>Ștergere</th>
                        </thread>

                        <tbody>
                        @foreach($inbox as $msg)
                            <tr>
                                <td>{{$msg->username}}</td>
                                <td>{{$msg->message}}</td>
                                <td>{{$msg->email}}</td>
                                <td>{{$msg->phone_number}}</td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                                        <a href="{{route('inbox.destroy', $msg->message_id)}}" onclick="if(confirm('Are you sure you want to delete this message?'))
                                                      alert('The message was deleted.') ">
                                            <button class="btn btn-danger btn-xs delete-message" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                <span class="glyphicon glyphicon-trash "></span>
                                            </button>
                                        </a>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $inbox->links() !!}
                </div>
            @else
                <p class="msg-empty">Nu exista mesaje noi !</p>
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
