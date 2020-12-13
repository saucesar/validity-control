@extends('layouts.app', ['title' => 'VC - Products', 'active' => 'products'])

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <div class="col mt-5">
                <h1>Produtos</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                @include('components.search_form', ['route' => route('products.search') ])
            </div>
        </div>
        <br>
        <br>
        <div class="row mt-4 d-flex justify-content-start">
            <div class="col-3">
                @if(isset($products))
                <div class="card card-body mb-4">
                    <div class="row">
                        <div class="col">
                            <small><b>Produtos encontrados: {{ $products->total() }}</b></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-6">
                @include('components.products_list')
            </div>
            <div class="col-3">
                <div class="card card-body mb-4" style="min-width: 18em;">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false"
                            title="Exibir datas.">
                        Mostrar todos
                    </button>
                </div>
                <div class="card card-body mb-4" style="min-width: 18em;">
                    <div class="row">
                        <div class="col">
                            <small><b>Produtos com vencimento em ...</b></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="btn-group" role="group">
                                <form class="mr-1" action="{{ route('products.byExpiration', 10) }}" method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary">10 dias</button>
                                </form>
                                <form class="mr-1" action="{{ route('products.byExpiration', 15) }}" method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary">15 dias</button>
                                </form>
                                <form class="mr-1" action="{{ route('products.byExpiration', 30) }}" method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary">30 dias</button>
                                </form>
                                <form class="mr-1" action="{{ route('products.byExpiration', 45) }}" method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary">45 dias</button>
                                </form>
                                <form class="mr-1" action="{{ route('products.byExpiration', 60) }}" method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary">60 dias</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <form action="{{ route('products.byExpiration') }}" method="post">
                                @csrf
                                <div class="btn-group" role="group">
                                    <input type="number" name="days" class="form-control" placeholder="Insira os dias">
                                    <button class="btn btn-sm btn-success">Ok</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection