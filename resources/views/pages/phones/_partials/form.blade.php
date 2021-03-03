<div class="form-group">
    <label for="">Numero</label>
    <input type="text" name="number" class="form-control" placeholder="Numero:" value="{{$phone->number ?? old('number')}}"required>
</div>

<div class="form-group">
    <label for="">Descrição</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{$phone->description ?? old('description')}}"required>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Salvar</button>
</div>