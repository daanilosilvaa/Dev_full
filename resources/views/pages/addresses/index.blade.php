@extends('adminlte::page')

@section('title', 'Endereços')

@section('content_header')
    <h1>Endereços da Pessoa : <strong>{{$person->name}}</strong> <a href=" {{ route('people.address.create',$person->id) }} " class="btn btn-dark">Adicionar outros endereço</a></h1>

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
                   <th>Nome</th>
                   <th>Numero</th>
                   <th>Distrito</th>
                   <th width="250" class="text-center">Ação</th>
               </thead>
               <tbody>
                    @foreach ($person->contacts as $address)                 
                        <tr>
                            <td>
                                {{$address->street}}
                            </td>
                            <td>
                                {{$address->number}}
                            </td>
                            <td>
                                {{$address->district}}
                            </td>
                            <td>
                                <a href="{{ route('address.edit',[$person->id, $address->id]) }}" class="btn btn-primary" title="Editar Cadastro"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('address.show', [$person->id, $address->id]) }}" class="btn btn-info" title="Exibir Informação"><i class="fas fa-eye"></i></a>
                                </a>
                            </td>                    
                        </tr>
                    @endforeach
               </tbody>

           </table>
        </div>
    </div>
@stop
