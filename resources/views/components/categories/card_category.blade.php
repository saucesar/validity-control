<div class="card min-card-width-2x mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <i class="fas fa-cube"></i>
            {{ $category->name }}
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <a  class="btn btn-sm btn-outline-primary"  class="btn btn-outline-primary" href="{{ route('products.byCategory', $category->id) }}">
                    <i class="fas fa-cubes"></i>
                    Total de Produtos: {{ count($category->products) }}
                </a>
            </div>
            <div class="col">
                <button class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#emails{{ $category->id }}">
                    Emails
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
        </div>
                
        <div class="collapse" id="emails{{ $category->id }}">
            <div class="">
                <div class="row">
                    <div class="col">
                    <table class="table">
                        <thead>
                            <th>Enviar para</th>
                            <th>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modalAddEmail{{ $category->id }}" title="Adicionar email.">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </th>
                            </thead>
                            <tbody>
                                @foreach($category->emails as $emailcategory)
                                <tr>
                                    <td>{{ $emailcategory->email }}</td>
                                    <td></td>
                                </tr>
                                @endforeach    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        Ultima atualização: {{ $category->updated_at }}
    </div>
    @include('components.categories.modal_add_email', ['category' => $category])
</div>