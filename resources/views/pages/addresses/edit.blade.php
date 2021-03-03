@extends('adminlte::page')

@section('subTitle',"Editar Endereço :{$people->name}")
@section('content')

@section('content_header')
    <h1>Editar Endereço:{{$people->name}}</h1>
@stop

<form action="{{ route('address.update', [$people->id,$address->id]) }}" class="form" method="POST">
   @csrf
   @method('PUT')
  @include('pages.addresses._partials.form')
</form>
    
@endsection