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
            <div class="col"><h3 title="ID da sua empresa é {{ $user->company->id }}">{{ $user->company->name }}</h3></div>
        </div>
        <div class="row mt-5 mb-2">
            <div class="col d-flex justify-content-center">
                @include('components.search_form', ['route' => route('products.search') ])
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
            <div class="col-4">
                @if(isset($critical_date) && count($critical_date) > 0)
                <div class="card card-body min-card-width">
                    <div class="row">
                        <div class="col">
                            <small><b>Produtos em data critica ( 3 dias )</b></small>
                        </div>
                    </div>
                    <table class="table critical-date-table">
                        <thead>
                            <th>Data</th>
                            <th>Quantidade</th>
                            <th>Produto</th>
                        </thead>
                        <tbody>
                            @foreach($critical_date as $cdate)
                            <tr>
                                <td>{{ $cdate->date }}</td>
                                <td>{{ $cdate->amount }}</td>
                                <td><a href="{{ route('products.show', $cdate->product->id) }}">{{ $cdate->product->description }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                @if(isset($expired_products) && count($expired_products) > 0)
                @endif
            </div>
            <div class="col-4">
                @if(isset($users_granted))
                <div class="card card-body min-card-width">
                    <div class="row">
                        <div class="col">
                            <small><b>Usuários permitidos</b></small>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <th><small>Nome</small></th>
                            <th><small>Email</small></th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach($users_granted as $granted)
                        <tr>
                            <td><small>{{ $granted->name }}</small></td>
                            <td><small>{{ $granted->email }}</small></td>
                            <td>
                                <a class="btn btn-sm btn-danger" href="{{ route('users.accessRequest', [$granted, 'denied']) }}" style="zoom: 75%;" title="Revogar acesso.">
                                    <i class="fas fa-minus-circle"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="col-4">
                @if(isset($access_requests))
                <div class="card card-body min-card-width">
                    <div class="row">
                        <div class="col">
                            <small><b>Solicitações de Acesso</b></small>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <th><small>Nome</small></th>
                            <th><small>Ações</small></th>
                        </thead>
                        <tbody>
                        @foreach($access_requests as $request)
                            <tr>
                                <td><small>{{ $request->name }}</small></td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="{{ route('users.accessRequest', [$request, 'granted']) }}" style="zoom: 75%;" title="Aprovar acesso.">
                                        <i class="far fa-thumbs-up"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('users.accessRequest', [$request, 'denied']) }}" style="zoom: 75%;" title="Negar acesso.">
                                        <i class="far fa-thumbs-down"></i>
                                    </a>
                                </td>
                            </tr>        
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection