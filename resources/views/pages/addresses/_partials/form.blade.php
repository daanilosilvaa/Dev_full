<div class="form-group">
    <label for="">Logradouro</label>
    <input type="text" name="street" class="form-control" placeholder="Logradouro:" value="{{$address->street ?? old('street')}}" required>
</div>

<div class="form-group">
    <label for="">Numero</label>
    <input type="text" name="number" class="form-control" placeholder="Numero:" value="{{$address->number ?? old('number')}}"required>
</div>

<div class="form-group">
    <label for="">Bairro</label>
    <input type="text" name="district" class="form-control" placeholder="Bairro:" value="{{$address->district ?? old('district')}}"required>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Salvar</button>
</div>