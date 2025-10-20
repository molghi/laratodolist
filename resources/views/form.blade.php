@php 
    // fetch all user categories
    use App\Http\Controllers\CategoryController;
    $user_categories = CategoryController::read();

    $doc_title = "$title | ToDo-List";
    if ($doc_title === 'Add Task | ToDo-List') $doc_title = __('ui.page_form_add');
    else $doc_title = __('ui.page_form_edit');
@endphp

{{-- bring in main layout --}}
@extends('layouts.app')


{{-- pass title --}}
@section('title', $doc_title)


{{-- pass main page content --}}
@section('content')
    <div class="max-w-6xl mx-auto my-5">
        <!-- Page Title -->
        <h1 class="text-4xl my-10 tracking-widest text-center capitalize">
            {{ $title === 'Add Task' ? __('ui.formpage_big_title_add') : __('ui.formpage_big_title_edit') }}
        </h1>
        
        <!-- Add/Edit Task Form -->
        @include('partials.task_form')
    </div>
@endsection