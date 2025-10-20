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

    $sort_options = [
        'created_desc' => 'Created DESC',
        'created_asc' => 'Created ASC',
        'due_desc' => 'Due Date DESC',
        'due_asc' => 'Due Date ASC',
        'prio_desc' => 'Priority DESC',
        'prio_asc' => 'Priority ASC',
    ];
@endphp


{{-- bring in main layout --}}
@extends('layouts.app')


{{-- pass title --}}
@section('title', __('ui.page_tasks'))


{{-- pass main page content --}}
@section('content')
    <div class="max-w-6xl mx-auto my-5">
        
        <!-- Page Title -->
        <h1 class="text-4xl my-10 tracking-widest text-center capitalize">{{ __('ui.tasks_big_title') }} ({{ $count }})</h1>


        {{-- success msg (if any) --}}
        @if(session('success'))
            <div class="absolute top-[10px] left-[50%] -translate-x-1/2 bg-black border border-green-500 text-green-500 p-4 px-8 rounded-xl mb-4 success-msg opacity-0 -translate-y-[100px] transition">
                {{ session('success') }}
            </div>
            <script>
                // show success msg nicely and then hide
                const successMsg = document.querySelector('.success-msg');
                setTimeout(() => {
                    successMsg.classList.remove('opacity-0');
                    successMsg.classList.remove('-translate-y-[100px]');
                }, 300)
                setTimeout(() => {
                    successMsg.classList.add('opacity-0');
                    successMsg.classList.add('-translate-y-[100px]');
                }, 5000)
                setTimeout(() => { successMsg.remove(); }, 5500)
            </script>
        @endif


        {{-- search/filter forms --}}
        @include('partials.search_forms')

        
        <!-- all tasks (if any) or msg -->
        @if ($count > 0)
            <div class="tasks flex flex-col gap-8">
                @foreach ($entries as $entry)
                    @include('partials.task_block')
                @endforeach
            </div>
        @else
            <div class="text-center my-5 italic">{{ __('ui.tasks_no_tasks') }}</div>
        @endif


        {{-- pagination --}}
        <div class="my-pagination max-w-3xl mx-auto mt-8">
            {{ $entries->links() }}
        </div>

    </div>
@endsection