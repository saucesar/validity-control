@include('components.exp_dates.modal_add_date', ['product' => $product])

<div class="card shadow mb-4" >
    <div class="card-body row d-flex justify-content-between">
        <div class="col-9">
            <h5 class="card-title" title="Detalhes do produto"><a href="{{ route('products.show', $product) }}">{{ $product->description }}</a></h5>
            <div class="row">
                <div class="col-5">
                    <h6 class="card-subtitle mb-2 text-muted" title="Código de barras.">
                        <i class="fas fa-barcode"></i>
                        {{ $product->barcode }}
                    </h6>
                </div>
                <div class="col-7">
                    <h6 class="card-subtitle mb-2 text-muted" title="Categoria">
                        <i class="fas fa-cube"></i>
                        <a href="#">{{ $product->category->name }}</a>
                    </h6>
                </div>
            </div>
            <span class="btn {{ $product->expirationDates->first() ? $product->expirationDates->first()->statusClass() : '' }}"></span>
        </div>
        <div class="col-1">
        @if(!isset($collapse_class))
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseproduct{{ $product->id }}" aria-expanded="false"
                title="Exibir datas.">
            <i class="far fa-caret-square-down"></i>
        </button>
        @endif
        </div>
    </div>
    <div class="collapse multi-collapse {{ $collapse_class ?? '' }}" id="collapseproduct{{ $product->id }}">
        <div class="row">
            <div class="col">
                @include('components.exp_dates.table_exp_dates', ['dates' => $product->expirationDates ])    
            </div>
        </div>
        <div class="row ml-1 mb-2">
            <div class="col">
                <b>Quantidade Total: </b>{{ $product->totalAmount() }}
            </div>
        </div>
    </div>
    <div class="card-footer">
        Ultima atualização: {{ $product->updated_at->format('d-m-Y H:i:s') }}
    </div>
    <!--
    <div class="card-footer">
        <span class="btn btn-block {{ $product->expirationDates->first() ? $product->expirationDates->first()->statusClass() : '' }}"></span>
    </div>-->
</div>