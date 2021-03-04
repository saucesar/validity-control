@extends('layouts.app', ['title' => 'VC - Script', 'active' => 'roadmap'])

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <div class="col mt-5">
                <h1>Roteiro de Conferência</h1>
            </div>
        </div>
        <br>
        <div class="row d-flex justify-content-center">
            <div class="col-3"></div>
            <div class="col-6">
                @include('components.search_form', ['route' => '#'])
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-3"></div>
            <div class="col-6">
                @include('components.messages')
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row d-flex justify-content-start">
            <div class="col-3"></div>
            <div class="col-6">
                @foreach($expdates as $expdate)
                <form action="{{ route('product.updateExpdate', $expdate->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card shadow mt-2 mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p><strong><a href="{{ route('products.show', $expdate->product->id) }}">{{ $expdate->product->description }}</a></strong></p>
                                <button class="btn btn-success" type="submit">Salvar</button>
                            </div>
                            <p><strong>Validade({{ $expdate->id }}): </strong>{{ $expdate->date() }}</p>
                            <p><strong>Lote: </strong>{{ $expdate->lote }}</p>
                            <div class="row">
                                <div class="col">
                                    <label for=""><strong>Quant. Atual: </strong></label>
                                    <input class="form-control" type="number" name="amount" value="{{ $expdate->amount }}" readonly>
                                </div>
                                <div class="col">
                                    <label for="newAmount"><strong>Quant. Contagem : </strong></label>
                                    <input class="form-control" type="number" name="newAmount" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            Ultima Atualização: {{ $expdate->updated_at }}
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                {{ $expdates->links() }}
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</div>
@endsection