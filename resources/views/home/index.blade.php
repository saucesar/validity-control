@extends('layouts.app', ['title' => 'VC - Home'])

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <div class="col mt-5">
                <h1>Home</h1>
            </div>
        </div>
        <div class="row text-center">
            <div class="col">
                <h3 title="ID da sua empresa é {{ $user->company->id }}">{{ $user->company->name }}</h3>
            </div>
        </div>
        <div class="row mt-5 mb-2">
            <div class="col d-flex justify-content-center">
                @include('components.search_form', ['route' => route('products.search') ])
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col text-center">
                @include('components.messages')
            </div>
        </div>
        <div class="card-deck">
            @if(isset($critical_dates) && count($critical_dates) > 0)
                @include('components.exp_dates.card_exp_dates', ['dates' => $critical_dates, 'title' => 'Produtos em data critica ( 3 dias )'])
            @endif
            @if(isset($expired_products) && count($expired_products) > 0)
                @include('components.exp_dates.card_exp_dates', ['dates' => $expired_products, 'title' => 'Produtos vencidos', 'danger' => true])
            @endif
            @if(isset($users_granted))
                @include('components.users.card_users_granted', ['users' => $users_granted])
            @endif
            @if(isset($access_requests))
                @include('components.users.card_access_requests', ['requests' => $access_requests])
            @endif
        </div>
        @if(isset($graphic_data))
        <div class="d-flex justify-content-between mt-5 mb-2">
            <div id="piechart" class="card shadow chart-categories"></div>
        </div>
        @endif
        @if(!auth()->user()->access_granted)
        <div class="row text-center">
            <div class="col">
                @if(auth()->user()->access_denied)
                <h4>Seu acesso aos dados da empresa <b>{{ auth()->user()->company->name }}</b> foi negado pelo proprietário.</h4>
                @else
                <h4>Aguardando aprovação de acesso aos dados da empresa <b>{{ auth()->user()->company->name }}(Proprietario: {{auth()->user()->company->owner->email}})</b>.</h4>
                @endif
            </div>
        </div>
        @endif
    </div>
    @endsection

    @push('head_scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @endpush

    @push('scripts')
    @if(isset($graphic_data))
    <script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    var graphicData = <?= $graphic_data; ?>;

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(graphicData);

        var options = {
            title: 'Produtos com até 30 dias ( Por categoria )',
            is3D: true,
            //pieHole: 0.4,
            sliceVisibilityThreshold: 0.05,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
    </script>
    @endif
    @endpush