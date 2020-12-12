@extends('layouts.app', ['title' => 'VC - Products', 'active' => 'products'])

@section('content')
<div class="container">
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
                    <div class="row">
                        <div class="col">
                            <small><b>Produtos com vencimento em ...</b></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="btn-group" role="group">
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('products.byExpiration', 10) }}">10 dias</a>
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('products.byExpiration', 15) }}">15 dias</a>
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('products.byExpiration', 30) }}">30 dias</a>
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('products.byExpiration', 45) }}">45 dias</a>
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('products.byExpiration', 60) }}">60 dias</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection