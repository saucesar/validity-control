@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row mt-5 text-center">
                <div class="col">
                    <br>
                    <h1>Home</h1>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">{{ $user->company->name }}</div>
            </div>
            <div class="row d-flex justify-content-center mt-5 mb-5">
                <form class="form-inline my-2 my-lg-0 mr-2" action="{{ route('products.search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input class="form-control form-control" type="search" name="search" placeholder="{{__('Faça uma busca')}}" required>
                        <input type="hidden" name='user_id' value="{{ $user->id }}">
                        <input type="hidden" name='webmode' value="true">
                        <div class="input-group-append">
                            <button class="btn btn-success btn-sm my-2 my-sm-0" type="submit">{{__('Buscar')}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col">
                    @include('components.messages')
                </div>
            </div>
            <div class="row ml-4 mr-4 mt-4 d-flex justify-content-start">
                @foreach($products as $product)
                <div class="row mb-2 ml-2">
                    <div class="col-6">
                        <div class="card" style="min-width: 20em;min-height: 15em;">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $product->description }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $product->barcode }}</h6>
                                </div>
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalAddDate{{ $product->id }}">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <small>
                                            <div class="row">
                                                <div class="col">Data</div>
                                                <div class="col">Quantidade</div>
                                                <div class="col"></div>
                                            </div>
                                        </small>
                                        @foreach($product->expiration_dates as $expdate)
                                            <small>
                                                <div class="row mb-1">
                                                    <div class="col">{{ $expdate['date'] }}</div>
                                                    <div class="col">{{ $expdate['amount'] }}</div>
                                                    <div class="col">
                                                        <form action="{{ route('product.removeDate', $product) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="date" value="{{ $expdate['date'] }}">
                                                            <input type="hidden" name="webmode" value="true">

                                                            <button type="submit" style="zoom: 60%;" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja remover?');">
                                                                    <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </small>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('components.modalAddDate', ['product' => $product])
                @endforeach
            </div>
            <br>
            <div class="row ml-5 mr-5">
                @if(isset($searchData))
                    {{ $products->appends($searchData)->links() }}
                @else
                    {{ $products->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection