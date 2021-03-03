
<div class="form-group">
    <label for=""></label>
    <select name="type" class="form-control" required>
        <option value="">Tipo de Pessoa</option>
        @if (!isset($people))
            <option value="F" >Pessoa Fisica</option>
            <option value="J">Pessoa Juridica</option> 
        @else
            @if (isset($people->type) && $people->type == 'F')      
                <option value="F" selected>Pessoa Fisica</option>                                  
            @endif 
            @if (isset($people->type) && $people->type == 'J')      
                    <option value="J"selected >Pessoa Juridica</option>                                 
            @endif  
        @endif            
               
    </select>
</div>

<div class="form-group">
    <label for="">CPF/CNPJ</label>
    <input type="text" name="document" class="form-control" placeholder="CPF/CNPJ:" value="{{$people->document ?? old('dosument')}}" autofocus>
</div>

<div class="form-group">
    <label for="">Nome/Razão Social</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{$people->name ?? old('name')}}">
</div>

<div class="form-group">
    <label for="">Nome Fantasia</label>
    <input type="text" name="fatasy_name" class="form-control" placeholder="Nome Fantasia:" value="{{$people->fantasy_name ?? old('fantasy_name')}}">
</div>

<fieldset class="form-group col-md-6">
    <div class="row">
        <legend class="col-form-label col-sm-12 pt-0">Sexo</legend>
        <div class="row col-md-12" >
            <div class="form-check col-md-3" >
                <input class="form-check-input" type="radio" name="sex"  checked  value="1" @if(@isset($people) &&  $people->sex == '1' ) checked @endif>
                <label class="form-check-label" for="">Masculino</label>
            </div>
            <div class="form-check check-inativo">
                <input class="form-check-input" type="radio" name="sex"  value="0" @if(@isset($people) &&  $people->sex == '0' ) checked @endif>
                <label class="form-check-label" for="">Femino</label>
            </div>
        </div>
    </div>
</fieldset>

<div class="form-group">
    <label for="">RG/Inscrição Estadual</label>
    <input type="text" name="rg_ie" class="form-control" placeholder="RG/Inscrição Estadual:" value="{{$people->rg_ie ?? old('rg_ie')}}">
</div>


<div class="form-group">
    <label for="">Data nascimento/Fundação</label>
    <input type="date" name="brith" class="form-control" placeholder="Data nascimento/Fundação:" value="{{$people->brith ?? old('brith')}}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>