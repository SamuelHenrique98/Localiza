
<div class="row mt-3">
        <div class="col col-12">
            <ul class="list-group"> 
            @if($itens == null)        
                @foreach($categorias as $categoria)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$categoria->categoria}}
                    <input type="checkbox"
                        name="categorias[]"
                        value="{{ $categoria->id }}">
                    </input>
                </li>
                @endforeach
            @else
            <?php $i=0; ?>
                @foreach($categorias as $categoria)
                        @if($i < count($itens) && $categoria->id == $itens[$i])
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$categoria->categoria}}
                                <input type="checkbox"
                                    name="categorias[]"
                                    value="{{ $categoria->id }}" checked>
                                </input>
                            </li>
                            <?php $i++; ?>
                        @else
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$categoria->categoria}}
                                <input type="checkbox"
                                    name="categorias[]"
                                    value="{{ $categoria->id }}">
                                </input>
                            </li>
                        @endif
                @endforeach 
            @endif
            </ul>
        </div>
    </div>
