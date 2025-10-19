@php
    $status_options = [
        'todo' => '📝 To Do — Pending; Created, Not Started',
        'in_progress' => '⚙️ In Progress — Actively Being Worked On',
        'on_hold' => '⏸️ On Hold — Temporarily Paused',
        'review' => '🔍 Review — Awaiting Approval Or Verification',
        'cancelled' => '❌ Cancelled — Abandoned Or No Longer Needed',
        'completed' => '✅ Completed — Finished And Verified',
        'archived' => '📦 Archived — Kept For Records, Not Active',
    ];

    $priority_options = [
        "none" => '➖ Unspecified',
        "low" => '🔹 Low',
        "medium" => '🔸 Medium',
        "high" => '🔴 High',
    ];

    $mode = $title === 'Add Task' ? 'add' : 'edit';
@endphp



<form action="{{ $mode === 'add' ? route('task.add') : route('task.edit', $data['id']) }}" 
    method="POST" 
    class="w-full max-w-3xl mx-auto bg-gray-900 p-6 pb-8 rounded-lg shadow-sm">

    @csrf

    @if ($mode === 'edit')
        @method('PUT')
    @endif

    {{-- TITLE --}}
  <div class="mb-4">
    <label for="title" class="block text-sm font-medium text-[var(--accent-4)] mb-1">Title</label>
    <input id="title" name="title" type="text" autofocus="true"
           class="bg-black w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[var(--accent)]"
           value="{{ $mode === 'edit' ? $data['title'] : '' }}"
    />
    @error('title')
        <div class="text-[red] text-sm rounded p-2">{{$message}}</div>
    @enderror
  </div>

  {{-- DESCRIPTION --}}
  <div class="mb-4">
    <label for="description" class="block text-sm font-medium text-[var(--accent-4)] mb-1">Description / Details</label>
    <textarea id="description" name="description" 
              class="bg-black min-h-[42px] max-h-[350px] h-[130px] text-[14px] w-full px-3 py-2 border border-gray-300 rounded resize-vertical focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">{{ $mode === 'edit' ? $data['description'] : '' }}</textarea>
        @error('description')
            <div class="text-[red] text-sm rounded p-2">{{$message}}</div>
        @enderror
  </div>

  <div class="flex gap-8 mb-4">
    {{-- STATUS --}}
    <div class="flex-1">
        <label for="status" class="block text-sm font-medium text-[var(--accent-4)] mb-1">Status</label>
        <select id="status" name="status" class="bg-black w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[var(--accent)] overflow-ellipsis">
            @foreach ($status_options as $k => $v)
                <option value="{{ $k }}" {{ $mode === 'edit' && $data['status'] === $k ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        </select>
        @error('status')
            <div class="text-[red] text-sm rounded p-2">{{$message}}</div>
        @enderror
    </div>

    {{-- CATEGORY --}}
    <div class="flex-1">
        <label for="category" class="block text-sm font-medium text-[var(--accent-4)] mb-1">Category</label>
        <select id="category" name="category" class="bg-black w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[var(--accent)] overflow-ellipsis">
            @if (!empty($user_categories) && count($user_categories) > 0)
                <option value="0" selected>Unspecified</option>
                @foreach ($user_categories as $item)
                    <option value="{{ preg_replace("/[^A-Za-z0-9]/", "", str_replace(' ', '_', strtolower($item->name))) }}"
                        {{ $mode === 'edit' && $data['category'] === strtolower($item->name) ? 'selected' : '' }}
                    >
                        {{ $item->name }}
                    </option>
                @endforeach
            @else 
                <option value="0" selected disabled>No categories added</option>
            @endif
        </select>
        @error('category')
            <div class="text-[red] text-sm rounded p-2">{{$message}}</div>
        @enderror
    </div>
  </div>

  <div class="flex gap-8 mb-6">
    {{-- PRIORITY --}}
    <div class="flex-1">
        <label for="priority" class="block text-sm font-medium text-[var(--accent-4)] mb-1">Priority</label>
        <select id="priority" name="priority" class="bg-black h-[44px] w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
            @foreach ($priority_options as $k => $v)
                <option value="{{$k}}" {{ $mode === 'edit' && $k === $data['priority'] ? 'selected' : '' }}>{{$v}}</option>
            @endforeach
        </select>
        @error('priority')
                <div class="text-[red] text-sm rounded p-2">{{$message}}</div>
            @enderror
    </div>

    {{-- DUE DATE --}}
    <div class="flex-1">
        <label for="due_date" class="block text-sm font-medium text-[var(--accent-4)] mb-1">Due Date</label>
        <input id="due_date" name="due_date" type="datetime-local" 
            class="bg-black w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[var(--accent)]"
            value="{{ $mode === 'edit' ? $data['due_date'] : '' }}"
        />
        @error('due_date')
            <div class="text-[red] text-sm rounded p-2">{{$message}}</div>
        @enderror
    </div>
  </div>

  {{-- ACTION BTN --}}
  <div class="text-right">
    <button type="submit" class="px-4 py-2 bg-[var(--accent-2)] text-black rounded hover:bg-[var(--accent-4)] transition">
        {{ $mode === 'edit' ? 'Update' : 'Create' }}
    </button>
  </div>

</form>