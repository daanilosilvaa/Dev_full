@extends('adminlte::page')

@section('title', 'Detalhes da Pessoa')

@section('content_header')

    <h1>Detalhes da Pessoa </b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">    
            <ul>
                @if (isset($people->type))
                    <li>
                        <strong>Pessoa: </strong>{{$people->type == "F" ? "Fisica" : "Juridica"}}
                    </li>
                @endif
                <li>
                    <strong>Nome: </strong>{{$people->name}}
                </li>
                <li>
                    <strong>CPF/CNPJ: </strong>{{$people->document}}
                </li>
                <li>
                    <strong>RG/Inscrição Estadual: </strong>{{$people->rg_ie}}
                </li>
                @if (isset($people->sex))
                    <li>
                        <strong>Sexo: </strong>{{$people->sex == 1 ? "Masculino" : "Feminino"}}
                    </li>
                @endif
                <li>
                    <strong>CPF/CNPJ:</strong>{{$people->document}}
                </li>
               
            </ul>
              <hr>
                <h3>Entereços <a href=" {{ route('address.index', $people->id ) }} " class="btn btn-dark"><i class="fas fa-plus-square"></i></a></h3>
                <ul>
                    <div class="row">
                        @foreach ($people->contacts as $address)
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-dark">
                                <div class="inner">
                
                                    <li>
                                        <strong>Logradouro</strong> {{$address->street}}
                                    </li>
                                    <li>
                                        <strong>Numero</strong> {{$address->number}}
                                    </li>
                                    <li>
                                        <strong>Bairro</strong> {{$address->district}}
                                    </li>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-location-arrow"></i>
                                </div>
                               <div class="container">
                                    <div class="row" style="margin-left: 20%" >
                                        <a href="{{ route('address.edit',[$people->id, $address->id]) }}" class="btn btn-primary" title="Editar Cadastro"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('address.show', [$people->id, $address->id]) }}" class="btn btn-info" title="Exibir Informação"><i class="fas fa-eye"></i></a>
                                        <form action="{{ route('address.destroy',[$people->id, $address->id]) }}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                               </div>
                                
                                </div>
                            </div>
                        @endforeach
                    </div>
                </ul>
                <hr>
                
            
           
            <h3>Telefones  <a href=" {{ route('phone.create', $people->id) }} " class="btn btn-dark"><i class="fas fa-plus-square"></i></a></h3>
            <ul>
                @foreach ($people->phones as $phone)
                    <li>
                        <strong>Tipo</strong> {{$phone->type}}
                    </li>
                    <li>
                        <strong>Numero</strong> {{$phone->number}}
                    </li>
                    <li>
                        <strong>Descrição</strong> {{$phone->description}}
                    </li>
                @endforeach
            </ul>
            <hr>

            <form action="{{ route('people.destroy', $people->id) }}"  method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar  {{$people->name}} </button>
            </form>

        </div>
    </div>
@endsection