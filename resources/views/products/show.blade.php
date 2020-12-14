@extends('layouts.app', ['title' => 'VC - Products', 'active' => 'products'])

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <div class="col mt-5">
                <h1>Detalhes de Produto</h1>
            </div>
        </div>
        <div class="row text-center">
            <div class="col">
                <h3>{{ $product->description }}</h3>
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-6">
                @include('components.messages')
            </div>
        </div>
        <div class="row">
            <div class="col-3 text-center">
                <div class="card card-body mb-4" style="min-width: 18em;">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">
                                <i class="far fa-file-alt"></i>
                                Historico de datas
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @if(count($historic) > 1)
                                <table class="table table-responsive" style="zoom: 80%;">
                                    <thead>
                                        <th><small>Data</small></th>
                                        <th><small>Quantidade</small></th>
                                        <th><small>Lote</small></th>
                                    </thead>
                                    <tbody>
                                    @foreach($historic as $hist)
                                    <tr>
                                        <td><small>{{ $hist->date }}</small></td>
                                        <td><small>{{ $hist->amount }}</small></td>
                                        <td><small>{{ $hist->lote }}</small></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Nada por aqui...</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                @include('components.card_product', ['product' => $product, 'collapse_class' => 'show'])
            </div>
            <div class="col-3">
                <div class="card card-body mb-4" style="min-width: 18em;">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">Algo aqui...</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection