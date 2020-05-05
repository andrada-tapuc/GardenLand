<label class="form-check-label">
    <option value={{$category->id}}  >
        ~{{ $category->name_category }}
    </option>
</label>
@foreach ($category->childrenCategories as $child)
    @include('products.dropdown', ['category' => $child])
@endforeach
