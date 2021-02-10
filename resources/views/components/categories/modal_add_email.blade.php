<div class="modal" id="modalAddEmail{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modalAddEmailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddEmailLabel">Adicionar Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categories.addEmail', $category->id) }}" method="post">
                @csrf
                <div class="modal-body text-left">
                    <h4>Categoria: {{ $category->name }}</h4>

                    <div class="row">
                        <div class="col">
                            <label for="lote">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>