<div class="modal" id="modalAddDate{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="modalAddDateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddDateLabel">Adicionar data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="post">
                <div class="modal-body text-left">
                    <h4>Produto: {{ $product->description }}</h4>
                    <label for="date">Data</label>
                    <input type="date" name="date" class="form-control" required>
                    <br>
                    <label for="amount">Quantidade</label>
                    <input type="number" name="amount" class="form-control" value="1" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>