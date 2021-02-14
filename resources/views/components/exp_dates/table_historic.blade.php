@foreach($dates as $key => $expdates)
<div class="card card-body shadow mb-2">
    <div class="row">
        <div class="col">
            <button class="btn btn-block btn-link mt-2 " type="button" data-toggle="collapse"
                data-target="#collapseDate{{ $key }}">
                {{ $key }}
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="collapse" id="collapseDate{{ $key }}">
                <div class="row text-center">
                    <div class="col"><i class="far fa-calendar-alt" title="Data de validade"></i></div>
                    <div class="col"><i class="fas fa-boxes" title="Quantidade"></i></div>
                    <div class="col"><i class="fas fa-pallet" title="Lote"></i></div>
                </div>
                <div class="dropdown-divider"></div>
                @foreach($expdates as $expdate)
                <div class="row text-center">
                    <div class="col">{{ $expdate->date }}</div>
                    <div class="col">{{ $expdate->amount }}</div>
                    <div class="col">{{ $expdate->lote }}</div>
                </div>
                <div class="dropdown-divider"></div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach