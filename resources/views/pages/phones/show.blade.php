@extends('adminlte::page')

@section('title', 'Detalhes da Pessoa')

@section('content_header')

    <h1>Detalhes da Pessoa </b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">                
                <ul>
                    <li>
                        <strong>Logradouro</strong> {{$address->street}}
                    </li>
                    <li>
                        <strong>Numero</strong> {{$address->number}}
                    </li>
                    <li>
                        <strong>Bairro</strong> {{$address->district}}
                    </li>
                    <form action="{{ route('address.destroy',[$people->id, $address->id]) }}"  method="POST">
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