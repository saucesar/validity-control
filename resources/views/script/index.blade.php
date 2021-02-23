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
                <div class="card shadow mt-2 mb-2">
                    <div class="card-body">
                        <p>{{ $expdate->date() }}</p>
                        <p>{{ $expdate->amount }}</p>
                        <p>{{ $expdate->product->description }}</p>
                    </div>
                </div>
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