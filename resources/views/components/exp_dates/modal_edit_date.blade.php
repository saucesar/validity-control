<div class="modal" id="modalEditDate{{ $expdate->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditDateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditDateLabel">Modificar data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product.updateExpdate', $expdate) }}" method="post">
                @csrf
                @method('put')
                <div class="modal-body text-left">
                    <div class="row mb-2">
                        <div class="col">
                            <label for="amount">Data</label>
                            <input type="date" name="date" class="form-control" value="{{ $expdate->date }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="amount">Quantidade atual</label>
                            <input type="number" name="amount" class="form-control" value="{{ $expdate->amount }}" readonly>
                        </div>
                        <div class="col">
                            <label for="lote">Lote</label>
                            <input type="text" name="lote" class="form-control" value="{{ $expdate->lote }}" readonly>
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