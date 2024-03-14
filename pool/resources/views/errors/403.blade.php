@extends('errors::minimal')

@section('title', 'Error: no tiene permiso')
@section('code', '403')
@section('message', $exception->getMessage() ?: 'No tiene permisos para este módulo')
@section('error-desc')
    <hr class="border-t dark:border-gray-700">
    <br>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <div class="text-center mt-4">
        <button class="btn">Inicie sesión nuevamente</button>
    </div>
    </form>
@endsection