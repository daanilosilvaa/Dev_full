@extends('adminlte::page')

@section('title', 'Cadastrar Pessoa')

@section('content_header')
    <h1>Cadastrar Endereço para : {{$person->name}}</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">

            <form action="{{ route('address.store',$person->id) }}" class="form" method="POST">
                @csrf
                @include('pages.addresses._partials.form')
            </form>

        </div>


    </div>
@endsection