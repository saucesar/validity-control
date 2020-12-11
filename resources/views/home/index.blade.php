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
        <div class="row mt-5 mb-2">
            <div class="col d-flex justify-content-center">
                <form class="form-inline" action="{{ route('products.search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input class="form-control form-control" type="search" name="search" placeholder="{{__('Faça uma busca')}}">
                        <select name="days" class="form-control">
                            <option value="3">3 dias</option>
                            <option value="15">15 dias</option>
                            <option value="30" selected>30 dias</option>
                            <option value="45">45 dias</option>
                            <option value="60">60 dias</option>
                            <option value="90">90 dias</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-success btn-sm my-2 my-sm-0" type="submit">{{__('Buscar')}}</button>
                        </div>
                    </div>
                </form>
            </div>
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
                        @include('components.card_product', ['product' => $product])
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