@extends('layouts.app', ['navoff' => true, 'bodyclass' => "bg-login", 'title' => 'VC - Novo Usuário'])

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
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        @include('components.inputs.input_text', ['name' => 'name', 'label' => 'Seu Nome'])
                                    </div>
                                    <div class="col">
                                        @include('components.inputs.input_text', ['name' => 'email', 'label' => 'Seu Email', 'type' => 'email'])
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                @include('components.inputs.input_text', ['name' => 'company', 'label' => 'Nome da sua Empresa'])
                                <small>Para ingressar em uma empresa existente, coloque aqui o id da empresa.</small>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        @include('components.inputs.input_password', ['name' => 'password', 'label' => 'Senha'])
                                    </div>
                                    <div class="col">
                                        @include('components.inputs.input_password', ['name' => 'password_confirmation', 'label' => 'Confirme a Senha'])
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