@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
    <h1>Pessoas <a href=" {{ route('people.create') }} " class="btn btn-dark"><i class="fas fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
           <form action="{{ route('people.search')}}" method="POST" class="form form-inline">
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
                   <th>CPF/CNPJ</th>
                   <th width="150" class="text-center">Ação</th>
               </thead>
               <tbody>
                    @foreach ($people as $person)                 
                        <tr>
                            <td>
                                {{$person->name}}
                            </td>
                            @if ($person->type =="F")
                                <td>
                                    {{$person->document = ($person->document == 11) ? 'Não' : substr($person->document, 0, 3) . '.' . substr($person->document, 3, 3) . '.' . substr($person->document, 6, 3) . '-' . substr($person->document, 9)}}
                                </td>
                            @else
                            <td>
                                {{$person->document = ($person->document == 11) ? 'Não' : substr($person->document, 0, 2) . '.' . substr($person->document, 2, 3) . '.' . substr($person->document, 5, 3) . '/' . substr($person->document, 8, 4) . '-' . substr($person->document, 12, 2)}}
                            </td>
                            @endif
                            
                            <td>
                                <a href="{{ route('people.edit', $person->id) }}" class="btn btn-primary" title="Editar Cadastro"><i class="fas fa-user-edit"></i></a>
                                <a href="{{ route('people.show', $person->id) }}" class="btn btn-info" title="Exibir Informação"><i class="fas fa-eye"></i></a>
                                {{-- <a href="{{ route('phone.index', $person->id) }}" class="btn btn-success" title="Cadastrar Telefone"><i class="fas fa-phone-alt"></i></a> --}}
                                {{-- <a href="{{ route('address.index',$person->id) }}" class="btn btn-success" title="Cadastrar Endereço"><i class="fas fa-location-arrow"></i></a> --}}
                                </a>
                            </td>                    
                        </tr>
                    @endforeach
               </tbody>

           </table>
        </div>
        <div class="card-footer">

            @if (isset($filters))
                    {!! $people->appends($filters)->links() !!}
                @else 
                    {!! $people->links() !!}
                    
                @endif
            
        </div>
    </div>
@stop
