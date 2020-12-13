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
                <div class="card card-body" style="min-width: 18em;">
                Algo aqui...
                </div>
            </div>
            <div class="col-4">
                @if(isset($users_granted))
                <div class="card card-body" style="min-width: 18em;">
                    <div class="row">
                        <div class="col">
                            <small><b>Usuários com permissão de acesso</b></small>
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
            <div class="col-4">
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