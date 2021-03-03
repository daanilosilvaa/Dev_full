@extends('adminlte::page')

@section('subTitle',"Editar Pessoa :{$people->name}")
@section('content')

<form action="{{ route('people.update', $people->id) }}" class="form" method="POST">
   @csrf
   @method('PUT')
  @include('pages.people._partials.form')
</form>
    
@endsection