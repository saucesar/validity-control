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
                    <input class="form-control form-control" type="search" name="search"
                        placeholder="{{__('Faça uma busca')}}" required>
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
            <div class="col">
                @if(isset($products))
                    @foreach($products as $product)
                    <div class="card mb-2">
                        <div class="card-body row d-flex justify-content-between">
                            <div class="col">
                                <h5 class="card-title">{{ $product->description }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $product->barcode }}</h6>
                            </div>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseproduct{{ $product->id }}" aria-expanded="false">
                                <i class="far fa-caret-square-down"></i>
                            </button>
                        </div>
                        <div class="collapse" id="collapseproduct{{ $product->id }}">
                            <table class="table table-responsive table-hover table-borderless">
                                <thead>
                                    <th>Data</th>
                                    <th>Quantidade</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach($product->expirationDates as $expdate)
                                    <tr>
                                        <td>{{ $expdate['date'] }}</td>
                                        <td>{{ $expdate['amount'] }}</td>
                                        <td>
                                            <form action="{{ route('product.removeDate', $expdate) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" style="zoom: 60%;" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja remover?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include('components.modalAddDate', ['product' => $product])
                @endforeach
                @else
                <div class="row text-center">
                    <div class="col">
                        <h4>Você ainda não tem acesso aos produtos da empresa <b>{{ $user->company->name  }}</b>.</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <br>
        @if(isset($products))
        <div class="row ml-5 mr-5">
            @if(isset($searchData))
            {{ $products->appends($searchData)->links() }}
            @else
            {{ $products->links() }}
            @endif
        </div>
        @endif
    </div>
</div>
@endsection