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
            <div class="row ml-5 mr-5 mt-5">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <th>EAN</th>
                        <th>Descrição</th>
                        <th>
                            <button class="btn btn-link btn-secondary" type="button" title="Exibir tudo."
                                    data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false">
                                <i class="far fa-caret-square-down"></i>
                            </button>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->barcode }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <button class="btn btn-link" type="button" title="Mostrar todas as datas."
                                        data-toggle="collapse" data-target="#collapseDate{{ $product->id }}" aria-expanded="false">
                                    <i class="far fa-caret-square-down"></i>
                                </button>
                                <a href="#" title="Veja mais detalhes.">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="collapse multi-collapse" id="collapseDate{{ $product->id }}">
                                    <div class="card card-body">
                                        <table class="table text-center">
                                            <thead>
                                                <th>Data</th>
                                                <th>Quantidade</th>
                                                <th>
                                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalAddDate{{ $product->id }}">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                    @include('components.modalAddDate', ['product' => $product])
                                                </th>
                                            </thead>
                                            <tbody>
                                            @foreach($product->expiration_dates as $ep)
                                                <tr>
                                                    <td>{{ $ep['date'] }}</td>
                                                    <td>{{ $ep['amount'] }}</td>
                                                    <td>
                                                        <form action="{{ route('product.removeDate', $product) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="date" value="{{ $ep['date'] }}">
                                                            <input type="hidden" name="webmode" value="true">

                                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja remover?');">
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
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
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