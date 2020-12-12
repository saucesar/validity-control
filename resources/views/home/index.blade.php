@extends('layouts.app', ['title' => 'VC - Home'])

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <div class="col mt-5">
                <h1>Home</h1>
            </div>
        </div>
        <div class="row text-center">
            <div class="col"><h3 title="ID da sua empresa é {{ $user->company->id }}">{{ $user->company->name }}</h3></div>
        </div>
        <div class="row mt-5 mb-2">
            <div class="col d-flex justify-content-center">
                <form class="form-inline" action="{{ route('products.search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input class="form-control form-control" type="search" name="search" placeholder="{{__('Buscando algo?')}}">
 
                        <div class="input-group-append">
                            <button class="btn btn-success btn-sm my-2 my-sm-0" type="submit">{{__('Buscar')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-2"></div>
            <div class="col-8">
                @include('components.messages')
            </div>
            <div class="col-2"></div>
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
                @if(isset($access_requests))
                <div class="card card-body" style="min-width: 18em;">
                    <div class="row">
                        <div class="col">
                            <small><b>Solicitações de Acesso</b></small>
                        </div>
                    </div>
                    @foreach($access_requests as $request)
                        <div class="row">
                            <div class="col">
                                <small>{{ $request->name }}</small>
                            </div>
                            <div class="col">
                                <a class="btn btn-sm btn-success" href="{{ route('users.accessRequest', [$request, 'granted']) }}" style="zoom: 75%;" title="Aprovar acesso.">
                                    <i class="far fa-thumbs-up"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href="{{ route('users.accessRequest', [$request, 'denied']) }}" style="zoom: 75%;" title="Negar acesso.">
                                    <i class="far fa-thumbs-down"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection