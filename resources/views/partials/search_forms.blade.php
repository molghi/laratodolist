<div class="max-w-3xl mx-auto mb-8 flex justify-between gap-4 text-[12px]">

    {{-- search form --}}
    <form action="{{ route('task.search') }}" method="GET" class="flex items-center gap-4">
        <input name="term" type="text" placeholder="{{__('ui.tasks_search_form_placeholder')}}" autocomplete="off" 
            value="{{ !empty($term) ? $term : '' }}"
            class="bg-black flex-1 border border-gray-700 rounded-lg px-4 py-2">
            @if (!empty($term))
                <a href="/tasks" class="border border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800">{{__('ui.tasks_search_form_btn_clear')}}</a>
            @else
                <button type="submit" class="border border-gray-700 rounded-lg px-4 py-2 hover:bg-gray-800">{{__('ui.tasks_search_form_btn')}}</button>
            @endif
    </form>

    {{-- Status select --}}
    <div class="flex items-center gap-4">
        <select name="status" class="bg-black border border-gray-700 rounded-lg px-4 py-2">
        <option value="0" selected disabled>{{__('ui.tasks_search_form_status_default')}}</option>
        <option value="all">{{__('ui.tasks_search_form_status_all')}}</option>
        @foreach ($status_options as $k => $v)
            <option value="{{$k}}" 
                {{ !empty($term_clean) && $term_clean === $k ? 'selected' : '' }}
            >{{ trim(explode(' — ', $v)[0]) }}</option>
        @endforeach
    </select>

    {{-- Priority select --}}
    <select name="priority" class="bg-black border border-gray-700 rounded-lg px-4 py-2">
        <option value="0" selected disabled>{{__('ui.tasks_search_form_priority_default')}}</option>
        @foreach ($priority_options as $k => $v)
            <option value="{{$k}}"
                {{ !empty($term_clean) && $term_clean === $k ? 'selected' : '' }}
            >{{ explode(' ', $v)[1] }}</option>
        @endforeach
    </select>

    {{-- Sort select --}}
    <select name="sort" class="bg-black border border-gray-700 rounded-lg px-4 py-2">
        <option value="0" selected disabled>{{__('ui.tasks_search_form_sort_default')}}</option>
        @foreach ($sort_options as $k => $v)
            <option value="{{$k}}"
                {{ !empty($term_clean) && $term_clean === $k ? 'selected' : '' }}
            >{{ $v }}</option>
        @endforeach
    </select>

    </div>
</div>



<script>
    const statusSelect = document.querySelector('select[name="status"]');
    const prioSelect = document.querySelector('select[name="priority"]');
    const sortSelect = document.querySelector('select[name="sort"]');
    
    statusSelect.addEventListener('change', function(e) {
        const selectedStatOptValue = e.target.value.trim();
        location.href = `/tasks/search?filterstatus=${encodeURIComponent(selectedStatOptValue)}`;
    })

    prioSelect.addEventListener('change', function(e) {
        const selectedPrioOptValue = e.target.value.trim();
        location.href = `/tasks/search?filterprio=${encodeURIComponent(selectedPrioOptValue)}`;
    })

    sortSelect.addEventListener('change', function(e) {
        const selectedSortOptValue = e.target.value.trim();
        location.href = `/tasks/search?sort=${encodeURIComponent(selectedSortOptValue)}`;
    })
</script>