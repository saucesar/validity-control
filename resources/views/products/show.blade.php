@extends('layouts.app', ['title' => 'VC - Products', 'active' => 'products'])

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <div class="col mt-5">
                <h1>Detalhes de Produto</h1>
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-6">
                @include('components.messages')
            </div>
        </div>
        <div class="row">
            <div class="col-3 text-center">
                <div class="card shadow card-body mb-4 action-card">
                    <div class="row">
                        <div class="col">
                            <img src="https://www.cognex.com/api/Sitecore/Barcode/Get?data={{ $product->barcode }}&code=S_EAN13&width=300&imageType=PNG&foreColor=%23000000&backColor=%23FFFFFF&rotation=RotateNoneFlipNone"
                                 alt="Barcode generated by Cognex Corporation" width="250"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                @include('components.products.card_product', ['product' => $product, 'collapse_class' => 'show'])
            </div>
            <div class="col-3">
                <div class="card shadow card-body action-card">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">O que deseja fazer <i class="far fa-question-circle"></i></h5>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <div class="col-2">
                            <button class="btn btn-primary" type="button" title="Editar produto" data-toggle="modal"
                                    data-target="#modalProduct{{ $product->id }}" {{ auth()->user()->isCompanyOwner() ? '' : 'disabled' }}>
                                <i class="fas fa-pen-square"></i>
                            </button>
                            @include('components.products.modal', ['product' => $product])
                        </div>
                        <div class="col-2">
                            <form action="{{ route('products.destroy', $product) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit" title="Deletar este produto"
                                        onclick="return confirm('Tem certeza?');" {{ auth()->user()->isCompanyOwner() ? '' : 'disabled' }}>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                @include('components.exp_dates.card_date_historic', ['dates' => $historic])
            </div>
            @foreach($dates as $dt)
                @include('components.exp_dates.modal_date_graphic', ['date' => $dt])

                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(setData);

                    function setData() {

                    var array = [['Data', 'Quantidade', { role: 'style' }, { role: 'annotation' }]];

                    var date = "<?= $dt?>";
                    var graphicData = <?= $graphicData; ?>;

                    for(j = 0; j < graphicData[date].length; j++){
                        array.push(graphicData[date][j])
                    }
                    
                    var data = new google.visualization.arrayToDataTable(array);

                    var options = {
                        'title':'Evolução da quantidade ({{$dt}})',
                        'width':700,
                        'height':400,
                    };

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div{{$dt}}'));
                    chart.draw(data, options);
                    }
                    </script>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('head_scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endpush