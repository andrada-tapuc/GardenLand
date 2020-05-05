<label class="form-check-label">
    <option value={{ $category->id }} @if($category->id === $service->category_id) selected @endif >
        ~{{ $category->name_category }}
    </option>
</label>
@if(!$category->childrenCategories->isEmpty())
    @foreach ($category->childrenCategories as $child)
        @if(!empty($child->lang->first()))
            @include('services.dropdown_selected', ['category' => $child])
        @endif
    @endforeach
@endif

