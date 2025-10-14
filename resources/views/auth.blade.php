{{-- bring in main layout --}}
@extends('layouts.app')


{{-- pass title --}}
@section('title', 'Auth | ToDo-List')


{{-- pass main page content --}}
@section('content')
    <div class="max-w-6xl mx-auto my-5">
        <!-- Page Title -->
        <h1 class="text-4xl my-10 tracking-widest text-center capitalize">Log In / Sign Up</h1>
        
        <!-- Auth Forms -->
        @include('partials.auth_forms')
    </div>
@endsection