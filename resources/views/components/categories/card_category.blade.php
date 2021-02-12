<div class="card min-card-width-2x mb-4">
    <div class="card-header d-flex justify-content-between">
        <h5 class="card-title">
            <i class="fas fa-cube"></i>
            {{ $category->name }}
        </h5>
        @if(auth()->user()->isCompanyOwner())
        <div class="btn-group">
            <button class="btn btn-primary" type="button" title="Editar categoria" data-toggle="modal"
                    data-target="#modalCategory{{ $category->id }}">
                <i class="fas fa-pen-square"></i>
            </button>
            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?');">X</button>
            </form>
        </div>
        @endif
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
                            data-target="#modalEmail{{ $category->id }}" title="Adicionar email.">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            @foreach($category->emails as $emailcategory)
            <div class="row">
                <div class="col">{{ $emailcategory->email }}</div>
                <div class="col text-center">
                    <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-warning" type="button" title="Editar produto" data-toggle="modal"
                                data-target="#modalEditEmail{{ $emailcategory->id }}">
                            <i class="fas fa-pen-square"></i>
                        </button>
                        <form action="{{ route('categories.deleteEmail', $emailcategory->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem Certeza?');">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            @include('components.categories.modal_edit_email', ['emailcategory' => $emailcategory])
            @endforeach
        </div>
    </div>
    <div class="card-footer">
        Ultima atualização: {{ $category->updated_at->format('d-m-Y H:i:s') }}
    </div>
    @include('components.categories.modal_add', ['category' => $category])
    @include('components.categories.modal_add_email', ['category' => $category])
</div>