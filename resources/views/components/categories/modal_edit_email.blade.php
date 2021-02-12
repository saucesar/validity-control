<div class="modal" id="modalEditEmail{{ $emailcategory->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditEmailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditEmailLabel">Editar Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categories.editEmail', $emailcategory->id) }}" method="post">
                @csrf
                @method('put')
                <div class="modal-body text-left">
                    <h4>Categoria: {{ $category->name }}</h4>

                    <div class="row">
                        <div class="col">
                            <label for="lote">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $emailcategory->email ?? '' }}" required>
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