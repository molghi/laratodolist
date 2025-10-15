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

    
    {{-- output success msg (if any) --}}
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
@endsection
