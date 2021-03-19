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
        <div class="row mt-5 mb-5 d-flex justify-content-center">
            <div class="col-9">
                @include('components.companies.about')
            </div>
        </div>
    </div>
</div>
@endsection