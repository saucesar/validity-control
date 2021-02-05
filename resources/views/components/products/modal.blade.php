<div class="modal" id="modalProduct{{ $product->id ?? 'New' }}" tabindex="-1" role="dialog" aria-labelledby="modalProductLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProductLabel">{{ isset($product) ? 'Edição de produto' : 'Novo Produto' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="post">
                @csrf
                @if(isset($product))
                    @method('put')
                @endif
                <div class="modal-body text-left">
                    @include('products.form', ['product' => $product])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>