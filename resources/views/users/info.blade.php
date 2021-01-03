@extends('layouts.app', ['title' => 'VC - Products', 'active' => 'info'])

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <div class="col mt-5">
                <h1>Informações de Conta</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-9">
                @include('components.alerts.success')
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-9">
                <h5>Sobre você</h5>
            </div>
        </div>
        <form action="{{ route('users.update', $user) }}" method="post">
            @csrf
            @method('put')
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-4">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-5">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-9">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-9">
                <h5>Configuração de senha</h5>
            </div>
        </div>
        <form action="{{ route('users.changePassword', $user) }}" method="post">
            @csrf
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-3 {{ $errors->has('oldpass') ? 'is-invalid' : '' }}">
                    <label for="oldpass">Senha antiga</label>
                    <input type="password" class="form-control @error('oldpass') is-invalid @enderror" name="oldpass" value="{{ old('oldpass') }}" required>
                    @error('oldpass')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="newpass">Nova senha</label>
                    <input type="password" class="form-control @error('newpass') is-invalid @enderror" name="newpass" value="{{ old('newpass') }}" required>
                    @error('newpass')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="newpass_confirmation">Confirme a nova senha</label>
                    <input type="password" class="form-control @error('newpass') is-invalid @enderror" name="newpass_confirmation" value="{{ old('newpass_confirmation') }}" required>
                    @error('newpass')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-3">
                    <button class="btn btn-primary" type="submit" title="Mudar senha.">
                        Mudar senha
                    </button>
                </div>
                <div class="col-3"></div>
                <div class="col-3"></div>
            </div>
        </form>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-9">
                <h5>Sobre a empresa</h5>
            </div>
        </div>
        <div class="row mt-2 mb-5 d-flex justify-content-center">
            <div class="col-9">
                <h6>
                    Chama-se <b>{{ $user->company->name }}</b>, Você é <b>{{ $user->isCompanyOwner() ? 'Proprietário' : 'Funcionário' }}</b>, 
                    o ID da empresa é <b>{{ $user->company->id }}</b>.
                </h6>
            </div>
        </div>
    </div>
</div>
@endsection