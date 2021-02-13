@extends('layouts.app', ['title' => 'VC - Empresa'])

@push('head_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
@endpush

@section('content')
<div class="container">
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-10 col-lg-10">
            <div class="container-fluid">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">VC</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Dados da empresa</h6>
                        <br>
                        @include('components.alerts.success')
                        @include('components.alerts.error')

                        <form action="{{ route('companies.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    @if(auth()->user()->role == 'owner')
                                    <div class="col-6">
                                        @include('components.inputs.input_text', ['name' => 'name', 'label' => 'Seu Nome'])
                                    </div>
                                    @endif
                                    <div class="col-6">
                                        @include('components.inputs.input_text', ['name' => 'cnpj', 'label' => 'CNPJ'])
                                        <script type="text/javascript">
                                            $('#cnpj').mask('00.000.000/0000-00');
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">{{auth()->user()->role == 'employee' ? 'Solicitar acesso' : 'Salvar' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection