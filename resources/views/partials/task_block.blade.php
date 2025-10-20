@php
    $statuses = [
        'todo' => '📝 To Do',
        'in_progress' => '⚙️ In Progress',
        'on_hold' => '⏸️ On Hold',
        'review' => '🔍 Review',
        'cancelled' => '❌ Cancelled',
        'completed' => '✅ Completed',
        'archived' => '📦 Archived',
    ];

    $priority_colors = [
        'none' => '#777',
        'low' => '#2563eb',
        'medium' => '#fb923c',
        'high' => '#ef4444',
    ];

    if (!function_exists('get_time_between'))
    {    // must wrap in this IF cuz otherwise every time Blade view is rendered, PHP tries to redeclare func
        function get_time_between ($second_date) {
            $first_date = time();   // now in sec
            $second_date = strtotime($second_date);   // date-time in sec
            
            $diff_raw = $second_date - $first_date;
            $diff_days = floor($diff_raw / 60 / 60 / 24);

            if ($diff_days > 0) {
                $word = $diff_days == 1 ? ' day' : ' days';
                return $diff_days . $word;
            }
            
            else {
                $diff_hours = floor($diff_raw / 60 / 60);
                $word = $diff_hours == 1 ? ' hr' : ' hrs';
                return $diff_hours . $word;
            }
        }
    }
@endphp

<article data-task-id="{{ $entry->id }}" class="task max-w-3xl w-full mx-auto bg-gray-900 hover:bg-[#0b0b0b] transition text-gray-100 border border-gray-700 rounded-lg p-6 font-sans relative">
  <header class="flex items-start justify-between mb-4">
    {{-- TITLE --}}
    <h3 class="text-xl font-semibold font-mono tracking-wide" title="Title">{{ $entry->title }}</h3>
    <div class="absolute top-[10px] right-[10px] flex flex-col gap-2">
        {{-- STATUS --}}
        <span class="text-sm px-2 py-0.5 bg-sky-700/20 font-mono text-[var(--accent)] rounded-md" title="Status">{{ $statuses[$entry->status] }}</span>
        {{-- PRIORITY --}}
        <span class="text-sm px-2 py-0.5 bg-sky-700/20 font-mono text-[var(--accent)] rounded-md" title="Priority">
            <span class="opacity-50">Prio: </span>
            <span class="text-[{{$priority_colors[$entry->priority]}}]">{{ $entry->priority }}</span>
        </span>
        {{-- CATEGORY --}}
        @if ($entry->category)
        <span class="text-sm px-2 py-0.5 bg-sky-700/20 font-mono text-[var(--accent)] rounded-md" title="Category">{{ $entry->category }}</span>
        @endif
    </div>
  </header>

  {{-- DESCRIPTION --}}
  <p class="text-sm leading-relaxed text-gray-300 mb-6 font-mono" title="Description / Details">{{ $entry->description }}</p>

  <dl class="flex justify-between gap-x-6 gap-y-2 text-xs text-gray-500">
    {{-- CREATED --}}
    <div title="Created at">
      <dt class="uppercase tracking-wider font-mono">{{__('ui.tasks_created_text')}}</dt>
      <dd class="mt-1 font-mono">{{ substr($entry->created_at, 0, -3) }}</dd>
    </div>
    {{-- UPDATED --}}
    <div title="Updated at">
      <dt class="uppercase tracking-wider font-mono">{{__('ui.tasks_updated_text')}}</dt>
      <dd class="mt-1 font-mono">{{ substr($entry->updated_at, 0, -3) }}</dd>
    </div>
    {{-- DUE DATE --}}
    <div title="Due date">
      <dt class="uppercase tracking-wider font-mono">{{__('ui.tasks_duedate_text')}}</dt>
      <dd class="mt-1 font-mono">{{ !$entry->due_date ? 'Unspecified' : substr($entry->due_date, 0, -3) . ' (' . get_time_between($entry->due_date) . ')' }}</dd>
    </div>

    <div class="flex justify-end gap-3">
      {{-- EDIT BTN --}}
      <a href='/form/edit/{{$entry->id}}' class="px-3 py-1.5 border border-[var(--accent-4)] text-[var(--accent)] rounded hover:bg-[var(--accent-4)]/10 transition text-sm font-mono opacity-40 hover:opacity-100">{{__('ui.edit_btn')}}</a>
  
      {{-- DELETE BTN --}}
      <form action="{{ route('task.delete', $entry->id) }}" method="POST">
        @csrf 
        @method('DELETE')
        <button type='submit'   
            onclick="return confirm('Are you sure you want to delete this task?\nThis action cannot be undone.')" 
            class="px-3 py-1.5 h-[36px] bg-red-600 text-white rounded hover:bg-red-700 transition text-sm font-mono opacity-40 hover:opacity-100">
            {{__('ui.delete_btn')}}
        </button>
      </form>
    </div>
  </dl>

</article>{{-- priority, category --}}