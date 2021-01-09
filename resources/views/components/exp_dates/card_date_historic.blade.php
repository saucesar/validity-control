<div class="card shadow card-body min-card-width mb-4">
    <div class="row">
        <div class="col">
            <h5 class="card-title">
                <i class="far fa-file-alt"></i>
                Historico de datas
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col min-card-height-2x">
            @if(count($historic) > 0)
            @include('components.exp_dates.table_exp_dates', ['dates' => $dates, 'is_historic' => true])
            @else
            <p>Nada por aqui...</p>
            @endif
        </div>
    </div>
</div>