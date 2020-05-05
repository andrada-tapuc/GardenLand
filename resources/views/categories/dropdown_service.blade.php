<label class="form-check-label">
    <option value={{$category->category_id }}>
        ~ {{ $category->name_category }} </option>
</label>
@if(!$category->childrenCategories->isEmpty())
    @foreach ($category->childrenCategories as $child)
        @if(!empty($child->lang->first()))
            @include('categories.dropdown_service', ['category' => $child])
        @endif
    @endforeach
@endif
