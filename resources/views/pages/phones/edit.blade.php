@extends('adminlte::page')

@section('subTitle',"Editar Telefone:{$people->name}")
@section('content')

@section('content_header')
    <h1>Editar Telefone:{{$people->name}}</h1>
@stop

<form action="{{ route('phone.update', [$people->id,$phone->id]) }}" class="form" method="POST">
   @csrf
   @method('PUT')
  @include('pages.phones._partials.form')
</form>
    
@endsection