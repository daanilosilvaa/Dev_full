@extends('adminlte::page')

@section('title', 'Cadastrar Pessoa')

@section('content_header')
    <h1>Cadastrar Pessoa</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">

            <form action="{{ route('people.store') }}" class="form" method="POST">
                @csrf
                @include('pages.people._partials.form')
            </form>

        </div>


    </div>
@endsection