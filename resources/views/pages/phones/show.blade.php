@extends('adminlte::page')

@section('title', 'Detalhes da Pessoa')

@section('content_header')

    <h1>Detalhes do Telefone : <strong>{{$people->name}}</strong> </h1> 
@stop

@section('content')
    <div class="card">

        <div class="card-body">                
                <ul>
                    <li>
                        <strong>Numero</strong> {{$phone->number}}
                    </li>
                    <li>
                        <strong>Descrição</strong> {{$phone->description}}
                    </li>
                    <form action="{{ route('phone.destroy',[$people->id, $phone->id]) }}"  method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    <hr>
                </ul>
                <hr>
        </div>
    </div>
@endsection