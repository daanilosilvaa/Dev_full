@extends('adminlte::page')

@section('title', 'Cadastrar Telefone')

@section('content_header')
    <h1>Cadastrar Telefone para : {{$people->name}}</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">

            <form action="{{ route('phone.store',$people->id) }}" class="form" method="POST">
                @csrf
                @include('pages.phones._partials.form')
            </form>

        </div>


    </div>
@endsection