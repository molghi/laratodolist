{{-- bring in main layout --}}
@extends('layouts.app')


{{-- pass title --}}
@section('title', "Category Manager | ToDo-List")


{{-- pass main page content --}}
@section('content')
    <div class="max-w-6xl mx-auto my-5">
        <!-- Page Title -->
        <h1 class="text-4xl my-10 tracking-widest text-center capitalize">Categorize tasks for better management</h1>
        
        <!-- Main Content -->
        @include('partials.categories_block')
    </div>
@endsection
