@extends('layouts.admin')

@section('content')
    <h1><strong>Cum se folosește dashboardul:</strong></h1>
    <div class="card">
        <div class="card-body">
            <strong>Funcționalitate pentru produse:</strong>
        </div>
        <div class="card-footer">
            Crearea unui produs nou:
            <a href="/admin/products/create" class="btn btn-default btn-flat">+</a>
        </div>
        <div class="card-footer">
           Editatea unui produs:
            <a href="/admin/products/show" class="btn btn-primary btn-flat">-</a>

        </div>
        <div class="card-footer">
            Ștergerea unui produs:
            <a href="/admin/products/show" class="btn btn-danger btn-flat">X</a>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <strong> Funcționalitate pentru categoriile produselor:</strong>
        </div>
        <div class="card-footer">
            Crearea unei categorii:
            <a href="/admin/categories/products/create" class="btn btn-default btn-flat">+</a>
        </div>
        <div class="card-footer">
            Editarea unei categorii:
            <a href="/admin/categories/products/show" class="btn btn-primary btn-flat">-</a>

        </div>
        <div class="card-footer">
            Ștergerea unei categorii:
            <a href="/admin/categories/products/show" class="btn btn-danger btn-flat">X</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <strong>Funcționalitate pentru servicii:</strong>
        </div>
        <div class="card-footer">
            Crearea unui serviciu nou:
            <a href="/admin/services/create" class="btn btn-default btn-flat">+</a>
        </div>
        <div class="card-footer">
            Editarea unui serviciu:
            <a href="/admin/services/show" class="btn btn-primary btn-flat">-</a>

        </div>
        <div class="card-footer">
            Ștergerea unui serviciu:
            <a href="/admin/services/show" class="btn btn-danger btn-flat">X</a>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <strong> Funcționalitate pentru categoriile serviciilor:</strong>
        </div>
        <div class="card-footer">
           Crearea unei categorii:
            <a href="/admin/categories/services/create" class="btn btn-default btn-flat">+</a>
        </div>
        <div class="card-footer">
            Editarea unei categorii:
            <a href="/admin/categories/services/show" class="btn btn-primary btn-flat">-</a>

        </div>
        <div class="card-footer">
            Ștergerea unei categorii:
            <a href="/admin/categories/services/show" class="btn btn-danger btn-flat">X</a>
        </div>
    </div>
@endsection

@section('styles')
    @parent
@endsection

@section('scripts')
    @parent
@endsection
