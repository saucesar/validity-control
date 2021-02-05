<div class="modal" id="modalCategory{{ $category->id ?? 'New' }}" tabindex="-1" role="dialog"
    aria-labelledby="modalCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCategoryLabel">{{ isset($category) ? 'Edição de categoria' : 'Nova categoria' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="post">
                @csrf
                @if(isset($category))
                    @method('put')
                @endif
                <div class="modal-body text-left">
                @include('components.categories.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>