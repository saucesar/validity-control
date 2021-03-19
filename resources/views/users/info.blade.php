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
                @include('components.alerts.error')
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-9">
                @include('components.users.about')
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-9">
                @include('components.users.change_password')
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-9">
                <h5>Sobre a empresa</h5>
            </div>
        </div>
        <form action="{{ route('company.update', auth()->user()->company) }}" method="post">
            @csrf
            <div class="row mt-2 d-flex justify-content-center">
                <div class="col-3">
                    @if(auth()->user()->isCompanyOwner())
                    @include('components.inputs.input_text', ['name' => 'company_name', 'prepend' => 'far fa-building', 'label' => 'Nome', 'value' => auth()->user()->company->name])
                    @else
                    @include('components.inputs.input_text', ['name' => 'company_name', 'prepend' => 'far fa-building', 'label' => 'Nome', 'value' => auth()->user()->company->name, 'readonly' => true])
                    @endif
                </div>
                <div class="col-3">
                    <label for="company_id" title="Este id pode ser usado para que funcionaŕios  solicitem acesso ao dados da empresa.">
                        ID da empresa
                    </label>
                    <input type="number" class="form-control" name="company_id" value="{{ auth()->user()->company->id }}" readonly>
                </div>
                <div class="col-3">
                    <label for="role">Seu papel na empresa</label>
                    <input type="text" class="form-control" name="role" value="{{ auth()->user()->isCompanyOwner() ? 'Proprietário' : 'Funcionário' }}" readonly>
                </div>
            </div>
            <div class="row mt-2 mb-5 d-flex justify-content-center">
                <div class="col-3">
                    <button class="btn btn-primary" type="submit" title="Mudar senha." {{ auth()->user()->isCompanyOwner() ? '' : 'disabled' }}>
                        Salvar
                    </button>
                </div>
                <div class="col-3"></div>
                <div class="col-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection