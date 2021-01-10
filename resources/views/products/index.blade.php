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

        <div class="row d-flex justify-content-center">
            <div class="col-3"></div>
            <div class="col-6">
                @include('components.messages')
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row mt-4 d-flex justify-content-start">
            <div class="col-3">
                @if(isset($products))
                <div class="card shadow card-body mb-4">
                    <div class="row">
                        <div class="col">
                            <small><b>Resultados encontrados: {{ $products->total() }}</b></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                    </div>
                </div>
                @endif
                <div class="card shadow card-body mb-4">
                    <div class="col">
                        <div class="row">
                            <div class="col-2"><span class="btn bg-red"></span></div>
                            <div class="col-10"><small>menos de 10 dias</small></div>
                        </div>
                        <div class="row">
                            <div class="col-2"><span class="btn bg-orange"></span></div>
                            <div class="col-10"><small>menos de 20 dias</small></div>
                        </div>
                        <div class="row">
                            <div class="col-2"><span class="btn bg-light-green"></span></div>
                            <div class="col-10"><small>menos de 30 dias</small></div>
                        </div>
                        <div class="row">
                            <div class="col-2"><span class="btn bg-green"></span></div>
                            <div class="col-10"><small>mais que 30 dias</small></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                @include('components.products.products_list')
                @include('components.products.modal', ['product' => null])
            </div>
            <div class="col-3">
                <div class="card shadow card-body min-card-width mb-4">
                    <div class="row d-flex justify-content-between">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalProductNew" title="Adicionar produto.">
                                <i class="fas fa-plus-circle"></i>
                                Add
                            </button>    
                        </div>
                        <div class="col">
                            <form action="{{ route('products.toPDF') }}" method="post" target="_blank">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-block" title="Gera um pdf com a lista de itens.">
                                    <i class="fas fa-file-pdf"></i>
                                    PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card shadow card-body min-card-width mb-4">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false"
                            title="Exibir datas.">
                        <i class="fas fa-angle-double-down"></i>
                        Expandir todos
                    </button>
                </div>
                <div class="card shadow card-body min-card-width mb-4">
                    <div class="row">
                        <div class="col">
                            <small><b>Produtos para os próximos ...</b></small>
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
                                    <button class="btn btn-success">Ok</button>
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