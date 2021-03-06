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
                @if ($people->type == "J")
                    <li>
                        <strong>Nome Fantasia: </strong>{{$people->fantasy_name ?? ''}}
                    </li>
                @endif

                <li>
                    @if (strlen($people->document) == 11)
                        <strong>CPF: </strong>{{$people->document = ($people->document == 11) ? 'Não' : substr($people->document, 0, 3) . '.' . substr($people->document, 3, 3) . '.' . substr($people->document, 6, 3) . '-' . substr($people->document, 9)}}
                    @else
                        <strong>CNPJ: </strong>{{$people->document = ($people->document == 14) ? 'Não' : substr($people->document, 0, 2) . '.' . substr($people->document, 2, 3) . '.' . substr($people->document, 5, 3) . '/' . substr($people->document, 8, 4) . '-' . substr($people->document, 12, 2)}}
                    @endif
                </li>
                <li>
                    <strong>RG/Inscrição Estadual: </strong>{{$people->rg_ie}}
                </li>
                @if ($people->type == "F")
                    <li>
                        <strong>Sexo: </strong>{{$people->sex == 1 ? "Masculino" : "Feminino"}}
                    </li>
                @endif
                <li>
                    <strong>Data Nascimento/Fundação :</strong>{{date('d/m/Y', strtotime($people->brith))}}
                </li>
                <form action="{{ route('people.destroy',[$people->id]) }}"  method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form>
               
            </ul>
            <hr>
            <h3>Entereços <a href=" {{ route('people.address.create', $people->id ) }} " class="btn btn-dark"><i class="fas fa-plus-square"></i></a></h3>
                <ul>
                    <div class="row">
                        @foreach ($people->contacts as $address)
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-secondary">
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
            <h3>Telefones  <a href=" {{ route('people.phone.create', $people->id) }} " class="btn btn-dark"><i class="fas fa-plus-square"></i></a></h3>
            <ul>
                <div class="row">
                    @foreach ($people->phones as $phone)
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                
                                    <li>
                                        <strong>Numero: </strong> {{$phone->number}}
                                    </li>
                                    <li>
                                        <strong>Descrição: </strong> {{$phone->description}}
                                    </li>
                                    <li>
                                        <strong>Atualizado: </strong> {{date('d/m/Y', strtotime($phone->updated_at))}}
                                    </li>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="container">
                                    <div class="row" style="margin-left: 20%" >
                                        <a href="{{ route('phone.edit',[$people->id, $phone->id]) }}" class="btn btn-primary" title="Editar Cadastro"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('phone.show', [$people->id, $phone->id]) }}" class="btn btn-warning" title="Exibir Informação"><i class="fas fa-eye"></i></a>
                                        <form action="{{ route('phone.destroy',[$people->id, $phone->id]) }}"  method="POST">
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
        </div>
    </div>
@endsection