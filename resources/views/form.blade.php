@php
    // fetch all user categories
    use App\Http\Controllers\CategoryController;
    $user_categories = CategoryController::read();
@endphp

{{-- bring in main layout --}}
@extends('layouts.app')


{{-- pass title --}}
@section('title', "$title | ToDo-List")


{{-- pass main page content --}}
@section('content')
    <div class="max-w-6xl mx-auto my-5">
        <!-- Page Title -->
        <h1 class="text-4xl my-10 tracking-widest text-center capitalize">
            {{ $title === 'Add Task' ? 'Add Task' : 'Edit Task' }}
        </h1>
        
        <!-- Add/Edit Task Form -->
        @include('partials.task_form')
    </div>
@endsection