@extends('adminlte::page')

@section('subTitle',"Editar Pessoa :{$person->name}")
@section('content')

<form action="{{ route('address.update', [$person->id,$address->id]) }}" class="form" method="POST">
   @csrf
   @method('PUT')
  @include('pages.addresses._partials.form')
</form>
    
@endsection