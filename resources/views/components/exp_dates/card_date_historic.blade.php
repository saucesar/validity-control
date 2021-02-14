<div class="card shadow min-card-width mb-4">
    <div class="card-header">
        <h6 class="card-title">
            <i class="far fa-file-alt"></i>
            Historico de datas
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col min-card-height-2x">
                @if(count($historic) > 0)
                @include('components.exp_dates.table_historic', ['dates' => $dates])
                @else
                <p>Nada por aqui...</p>
                @endif
            </div>
        </div>
    </div>
</div>