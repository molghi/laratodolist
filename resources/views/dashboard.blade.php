@php
    if (!function_exists('get_time_between'))
    {    // must wrap in this IF cuz otherwise every time Blade view is rendered, PHP tries to redeclare func
        function get_time_between ($second_date) {
            $first_date = time();   // now in sec
            $second_date = strtotime($second_date);   // date-time in sec
            $diff_raw = $second_date - $first_date;
            $diff_days = floor($diff_raw / 60 / 60 / 24);
            if ((int) $diff_days === 0) {
                return 'Today';
            } else {
                $word = $diff_days == 1 || $diff_days == -1 ? ' day' : ' days';
                return $diff_days . $word;
            }
        }
    }
@endphp


{{-- bring in main layout --}}
@extends('layouts.app')


{{-- pass title --}}
@section('title', 'Your Dashboard | ToDo-List')


{{-- pass main page content --}}
@section('content')
    <div class="max-w-6xl mx-auto my-5">
        <!-- Page Title -->
        <h1 class="text-4xl my-10 mb-12 tracking-widest text-center capitalize">Your Dashboard, {{$name}}</h1>
        
        <!--  -->
        {{-- @include('partials.auth_forms') --}}
        <div>
            {{-- TOP PART --}}
            <div class="flex items-center gap-10 justify-between max-w-6xl mx-auto relative">
                <div class="flex items-center gap-3">
                    <span class="font-bold opacity-60">Name:</span> {{$name}} 
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-bold opacity-60">Email:</span> {{$email}}
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-bold opacity-60">Member since:</span> {{ substr($created_at, 0, 10) . ' (' . get_time_between($created_at) . ')' }}
                </div>
                <div class="absolute top-[-80px] right-0 flex flex-col gap-2 text-right text-sm">
                    <a href="/user/logout" class="opacity-30 hover:opacity-100 hover:underline">Log Out</a>
                    <button class="opacity-30 hover:opacity-100 hover:underline">Delete Profile</button>
                </div>
            </div>
        </div>

    </div>
@endsection