@extends('layouts.app', ['navoff' => true, 'bodyclass' => "bg-login", 'title' => 'VC - Novo Usuário'])

@push('head_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
@endpush

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
                        @include('components.alerts.success')
                        @include('components.alerts.error')

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
                            <div class="form-check row">
                                <input type="radio" id="owner" name="role" value="owner" {{ old('role') == 'owner' ? 'checked' : '' }} required>
                                <label for="owner">Sou Proprietário</label>
                            </div>
                            <div class="form-check row">
                                <input type="radio" id="employee" name="role" value="employee" {{ old('role') == 'employee' ? 'checked' : '' }} required>
                                <label for="employee">Sou Funcionário</label>
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