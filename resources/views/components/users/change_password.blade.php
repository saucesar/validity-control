<div class="card">
    <div class="card-body">
        <form action="{{ route('users.changePassword', auth()->user()) }}" method="post">
            <div class="row">
                <div class="col d-flex justify-content-start">
                    <h5>Configuração de senha</h5>
                </div>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit" title="Mudar senha.">
                        Salvar
                    </button>
                </div>
            </div>
            @csrf
            <div class="row mt-3">
                <div class="col-4">
                    @include('components.inputs.input_password', ['name' => 'oldpass', 'prepend' => 'fas fa-lock',
                    'label' => 'Senha antiga'])
                </div>
                <div class="col-4">
                    @include('components.inputs.input_password', ['name' => 'newpass', 'prepend' => 'fas fa-lock',
                    'label' => 'Nova senha'])
                </div>
                <div class="col-4">
                    @include('components.inputs.input_password', ['name' => 'newpass_confirmation', 'prepend' => 'fas
                    fa-lock', 'label' => 'Confirme a nova senha'])
                </div>
            </div>
        </form>
    </div>
</div>
