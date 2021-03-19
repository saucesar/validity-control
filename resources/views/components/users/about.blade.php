<div class="card">
    <div class="card-body">
        <form action="{{ route('users.update', auth()->user()) }}" method="post">
            <div class="row">
                <div class="col d-flex justify-content-start">
                    <h5>Sobre você</h5>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
            <div class="row">
                <div class="col">        
                        @csrf
                        @method('put')
                        <div class="row mt-2">
                            <div class="col">
                                @include('components.inputs.input_text', ['name' => 'name', 'prepend' => 'fas fa-user', 'label' => 'Nome', 'value' => auth()->user()->name])
                            </div>
                            <div class="col">
                                @include('components.inputs.input_text', ['name' => 'email', 'prepend' => 'fas fa-at', 'label' => 'Email', 'type' => 'email', 'value' => auth()->user()->email])
                            </div>
                        </div>
                        <div class="row mt-2">
                            
                        </div>
                </div>
            </div>
        </form>
    </div>
</div>