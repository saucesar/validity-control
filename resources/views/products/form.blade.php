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
                @if(!isset($product))
                    <input type="hidden" name="company_id" class="form-control" value="{{ $user->company->id ?? old('company_id') }}">
                @endif
            </div>
        </div>
    </div>
</div>
