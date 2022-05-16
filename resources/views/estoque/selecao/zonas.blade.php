<div class="row mt-3">
    <div class="col col-12">
        <ul class="list-group"> 
        @if($itens == null)        
            @foreach($zonas as $zona)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{$zona->zona}}
                <input type="checkbox"
                    name="zonas[]"
                    value="{{ $zona->id }}">
                </input>
            </li>
            @endforeach
        @else
        <?php $i=0; ?>
            @foreach($zonas as $zona)
                @if($i < count($itens) && $zona->id == $itens[$i])
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$zona->zona}}
                    <input type="checkbox"
                        name="zona[]"
                        value="{{ $zona->id }}" checked>
                    </input>
                </li>
                <?php $i++; ?>
                @else
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$zona->zona}}
                    <input type="checkbox"
                        name="zona[]"
                        value="{{ $zona->id }}">
                    </input>
                </li>
                @endif
            @endforeach
        @endif
        </ul>
    </div>
</div>