<label class="form-check-label">
    <option value={{$category->id }} @if($selectedCat->parent_id === $category->id) selected @endif>
        ~ {{ $category->name_category }}
    </option>
</label>
@if(!$category->childrenCategories->isEmpty())
    @foreach ($category->childrenCategories as $child)
        @if(!empty($child->first()))
            @include('categories.dropdown_service_selected', ['category' => $child])
        @endif
    @endforeach
@endif
