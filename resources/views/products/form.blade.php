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
            <div class="col">
                <label for="barcode">Categoria</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Selecione</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($product) && $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
</div>
