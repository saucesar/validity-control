<div class="card min-card-width-2x mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <i class="fas fa-cube"></i>
            {{ $category->name }}
        </h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col">
                <a  class="btn btn-sm btn-link" href="{{ route('products.byCategory', $category->id) }}">
                    <i class="fas fa-cubes"></i>
                    Total de Produtos: {{ count($category->products) }}
                </a>
            </div>
            <div class="col text-center">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#emails{{ $category->id }}">
                    Emails({{ count($category->emails) }})
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
        </div>
                
        <div class="collapse multicollapse" id="emails{{ $category->id }}">
            <div class="row">
                <div class="col">
                    Enviar para
                </div>
                <div class="col text-center">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#modalAddEmail{{ $category->id }}" title="Adicionar email.">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            @foreach($category->emails as $emailcategory)
            <div class="row">
                <div class="col">{{ $emailcategory->email }}</div>
                <div class="col text-center">
                    <form action="{{ route('categories.deleteEmail', $emailcategory->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem Certeza?');">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            @endforeach
        </div>
    </div>
    <div class="card-footer">
        Ultima atualização: {{ $category->updated_at->format('d-m-Y H:i:s') }}
    </div>
    @include('components.categories.modal_add_email', ['category' => $category])
</div>