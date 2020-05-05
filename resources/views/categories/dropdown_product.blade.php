<label class="form-check-label">
    <option value={{$category->id}}>
        ~ {{ $category->name_category }}
    </option>
</label>
@if(!$category->childrenCategories->isEmpty())
    @foreach ($category->childrenCategories as $child)
        @if(!empty($child->first()))
            @include('categories.dropdown_product', ['category' => $child])
        @endif
    @endforeach
@endif
