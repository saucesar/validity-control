@if(isset($products))
    @foreach($products as $product)
        @include('components.card_product', ['product' => $product])
        @include('components.modalAddDate', ['product' => $product])
    @endforeach
    @if(isset($searchData))
        {{ $products->appends($searchData)->links() }}
    @else
        {{ $products->links() }}
    @endif
@else
<div class="row text-center">
    <div class="col">
        @if($user->access_denied)
        <h4>Seu acesso aos dados da empresa <b>{{ $user->company->name }}</b> foi negado pelo proprietário.</h4>
        @else
        <h4>Aguardando aprovação de acesso aos dados da empresa <b>{{ $user->company->name }}</b>.</h4>
        @endif
    </div>
</div>
@endif