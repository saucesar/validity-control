<div class="card">
    <div class="card-body">
        <form action="{{ route('company.update', auth()->user()->company) }}" method="post">
            <div class="row">
                <div class="col d-flex justify-content-start">
                    <h5>Sobre a empresa</h5>
                </div>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit" title="Mudar senha." {{ auth()->user()->isCompanyOwner() ? '' : 'disabled' }}>
                        Salvar
                    </button>
                </div>
            </div>
            @csrf
            <div class="row mt-2">
                <div class="col-4">
                    @if(auth()->user()->isCompanyOwner())
                    @include('components.inputs.input_text', ['name' => 'company_name', 'prepend' => 'far fa-building', 'label' => 'Nome', 'value' => auth()->user()->company->name])
                    @else
                    @include('components.inputs.input_text', ['name' => 'company_name', 'prepend' => 'far fa-building', 'label' => 'Nome', 'value' => auth()->user()->company->name, 'readonly' => true])
                    @endif
                </div>
                <div class="col-4">
                    <label for="company_id" title="Este id pode ser usado para que funcionaŕios  solicitem acesso ao dados da empresa.">
                        ID da empresa
                    </label>
                    <input type="number" class="form-control" name="company_id" value="{{ auth()->user()->company->id }}" readonly>
                </div>
                <div class="col-4">
                    <label for="role">Seu papel na empresa</label>
                    <input type="text" class="form-control" name="role" value="{{ auth()->user()->isCompanyOwner() ? 'Proprietário' : 'Funcionário' }}" readonly>
                </div>
            </div>
        </form>
    </div>
</div>