<div class="row">
    <div class="col">
        <div class="row">
            <div class="col">
                <label for="description">Descrição</label>
                <input type="text" name="description" class="form-control" value="{{ $product->description ?? old('description') }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="barcode">EAN</label>
                <input type="text" name="barcode" class="form-control" value="{{ $product->barcode ?? old('barcode') }}">
            </div>
        </div>
    </div>
</div>
