@extends('adminlte::page')

@section('title', 'Endereços')

@section('content_header')
    <h1>Endereços da Pessoa : <strong>{{$people->name}}</strong> <a href=" {{ route('people.phone.create',$people->id) }} " class="btn btn-dark">Adicionar outros telefone</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
           <form action="" method="POST" class="form form-inline">
               @csrf
                <input type="text" name="filter" placeholder="Filtar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
           </form>
        </div>
        <div class="card-body">
            {{-- @include('admin.includes.alerts') --}}
           <table class="table table-condensed">
               <thead>
                   <th>Numero</th>
                   <th>Descrição</th>
                   <th width="250" class="text-center">Ação</th>
               </thead>
               <tbody>
                    @foreach ($people->phones as $phone)                 
                        <tr>
                            <td>
                                {{$phone->number}}
                            </td>
                            <td>
                                {{$phone->description}}
                            </td>
                            
                            <td>
                                <a href="{{ route('phone.edit',[$people->id, $phone->id]) }}" class="btn btn-primary" title="Editar Cadastro"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('phone.show', [$people->id, $phone->id]) }}" class="btn btn-info" title="Exibir Informação"><i class="fas fa-eye"></i></a>
                                </a>
                            </td>                    
                        </tr>
                    @endforeach
               </tbody>

           </table>
        </div>
    </div>
@stop
