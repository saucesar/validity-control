@if(isset($categories))
    @foreach($categories as $category)
        @include('components.categories.card_category', ['category' => $category])
    @endforeach
@else
    Nada aqui ...
@endif