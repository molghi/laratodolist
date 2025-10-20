@php
    if (!function_exists('get_time_between'))
    {    // must wrap in this IF cuz otherwise every time Blade view is rendered, PHP tries to redeclare func
        function get_time_between ($second_date) {
            $first_date = time();   // now in sec
            $second_date = strtotime($second_date);   // date-time in sec
            $diff_raw = $second_date - $first_date;
            $diff_days = floor($diff_raw / 60 / 60 / 24);
            if ((int) $diff_days === 0) {
                return __('ui.profile_today');
            } else {
                $word = $diff_days == 1 || $diff_days == -1 ? " " . __('ui.profile_day') : ' ' . __('ui.profile_days');
                return abs($diff_days) . $word;
            }
        }
    }

    // filter user tasks & categories data
    // $user_categories
    $tasks_done = 0;
    $tasks_undone = 0;
    $tasks_expired = 0;
    $tasks_names = [];
    $tasks_details = [];
    foreach ($user_tasks as $task) {
        $now = time();
        $task_expiration = strtotime($task['due_date']);
        if ($task['status'] === 'completed') { $tasks_done += 1; }
        elseif ($task['status'] !== 'completed') { $tasks_undone += 1; }
        array_push($tasks_names, $task['title']);
        array_push($tasks_details, $task['description']);
        if ($task_expiration) {
            if ($task_expiration - $now <= 0) $tasks_expired += 1;
        }
    }
    $categories_names = [];
    foreach ($user_categories as $cat) {
        array_push($categories_names, $cat['name']);
    }
@endphp


{{-- bring in main layout --}}
@extends('layouts.app')


{{-- pass title --}}
@section('title', __('ui.page_dashboard'))


{{-- pass main page content --}}
@section('content')
    <div class="max-w-6xl mx-auto my-5">
        <!-- Page Title -->
        <h1 class="text-3xl my-10 mb-12 tracking-widest text-center capitalize text-[violet]">{{ __('ui.profile_big_title') }}, {{$name}}</h1>
        
        @include('partials.dashboard_block')
    </div>
@endsection