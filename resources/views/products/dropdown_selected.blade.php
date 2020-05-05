<label class="form-check-label">
    <option value={{ $category->id }} @if($category->id === $product->category_id) selected @endif >
        ~{{ $category->name_category }}
    </option>
</label>
@if(!$category->childrenCategories->isEmpty())
    @foreach ($category->childrenCategories as $child)
        @if(!empty($child->first()))
            @include('products.dropdown_selected', ['category' => $child])
        @endif
    @endforeach
@endif

