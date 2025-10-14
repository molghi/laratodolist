<div class="flex items-start gap-10 max-w-4xl mx-auto mt-10">

  <!-- Left Column: Your Categories -->
  <div class="flex-1 bg-gray-800 text-gray-100 p-6 rounded-lg border border-gray-700">
    <h2 class="text-2xl font-semibold mb-4">Your Categories</h2>

    {{-- List categories --}}
    <div class="categories flex flex-col gap-4">
        @if (count($data) > 0)
            @foreach($data as $entry)
                <!-- Category Item -->
                <div class="category flex items-center justify-between bg-gray-700 p-3 rounded mb-3" data-category-id="{{ $entry->id }}">
                    <span>{{ $entry->name }}</span>
                    <div class="flex gap-2">
                        <a href='/categories/edit/{{$entry->id}}' class="px-3 py-1 border border-[var(--accent-2)] text-[var(--accent-3)] rounded hover:bg-[var(--accent-2)]/20 transition text-sm opacity-50 hover:opacity-100">Edit</a>

                        <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm opacity-50 hover:opacity-100">Delete</button>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-[gray]">Nothing here yet.</div>
        @endif
    </div>
  </div>


  <!-- Right Column: Add New / Edit One -->
  <div class="flex-1 bg-gray-800 text-gray-100 p-6 rounded-lg border border-gray-700">
    <h2 class="text-2xl font-semibold mb-4">
        {{ $flag === 'edit' ? 'Edit One' : 'Add New' }}
    </h2>
    <form action="{{ $flag === 'edit' ? "#" : route('category.add') }}" method="POST" class="flex flex-col gap-3">
        @csrf
        @if ($flag === 'edit')
            @method('PUT')
        @endif
      <input name="name" type="text" placeholder="Category Name" autofocus="true"
             class="px-3 py-2 rounded bg-gray-900 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[var(--accent-2)]"
             value="{{ $flag === 'edit' ? $entry['name'] : '' }}"
        />

      <button type="submit" class="mt-2 bg-[var(--accent-2)] text-black py-2 rounded hover:bg-[var(--accent-4)] transition">
        {{ $flag === 'edit' ? 'Edit' : 'Add' }}
      </button>
    </form>
    @error('category')
        <div class="text-[red] p-2 text-sm">{{$message}}</div>
    @enderror
  </div>

</div>
