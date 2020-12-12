@extends('layouts.app', ['navoff' => true, 'bodyclass' => "bg-login"])

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-lg-10">
            <div class="container-fluid">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">VC</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Novo Usuário</h6>
                        <br>
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            @include('components/messages')
                            <input type="hidden" name="webmode" value="true">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="password">Seu Nome</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="col">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="company">Nome da sua Empresa</label>
                                <input type="text" class="form-control" name="company" value="{{ old('company') }}" required>
                                <small>Para ingressar em uma empresa existente, coloque aqui o id da empresa.</small>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="password">Senha</label>
                                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                                    </div>
                                    <div class="col">
                                        <label for="password_confirm">Confirme Senha</label>
                                        <input type="password" class="form-control" name="password_confirm" value="{{ old('password_confirm') }}" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection