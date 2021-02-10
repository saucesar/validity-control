<div class="card min-card-width-2x mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <i class="fas fa-cube"></i>
            {{ $category->name }}
        </h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <p>
                    <a  class="btn btn-sm btn-outline-primary"  class="btn btn-sm btn-outline-primary" href="{{ route('products.byCategory', $category->id) }}">
                        <i class="fas fa-cubes"></i>
                        Total de Produtos: {{ count($category->products) }}
                    </a>
                </p>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <div>
                        <p title="Produtos desta categoria serão enviados para este(s) email(s).">
                            <i class="far fa-envelope"></i>
                            Enviar para:
                        </p>    
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddEmail{{ $category->id }}"
                                title="Adicionar email.">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <ul>
                            @foreach($category->emails as $emailcategory)
                            <li>{{ $emailcategory->email }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="card-footer">
        Ultima atualização: {{ $category->updated_at }}
    </div>
    @include('components.categories.modal_add_email', ['category' => $category])
</div>