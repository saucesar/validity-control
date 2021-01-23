<div class="modal" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="modalAmountInOutLabel"aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAmountInOutLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('amountInOut.store', $expdate->id) }}" method="post">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">
                <div class="modal-body">
                    <h4>Data selecionada: {{ $expdate->date() }}</h4>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            @include('components.inputs.input_text', ['name' => 'amount', 'label' => 'Quantidade', 'type' => 'number', 'value' => 1])
                        </div>
                        @if($type == 'out')
                        <div class="col-6">
                            <label for="reason">Motivo da Saída</label>
                            <select class="form-control" name="reason">
                                <option value="sale" selected>Venda</option>
                                <option value="expired">Vencido</option>
                            </select>
                        </div>
                        @endif
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