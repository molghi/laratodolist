@php
    $user_id = Auth::id(); // get user ID
@endphp

<header class="bg-[var(--bg)] text-[var(--accent)] border-b border-[var(--accent-2)] px-6 py-3 font-mono">
    <div class="max-w-6xl mx-auto flex items-center justify-between">

        {{-- LOGO --}}
        <h1 class="text-2xl tracking-widest">TODO-LIST</h1>

        {{-- ACTION BTNS or msg --}}
        @if ($user_id)
        <div class="flex gap-6">
            <a href="/form/add" 
                class="px-4 inline-block h-[36px] py-1.5 border rounded border-[var(--accent-2)] hover:bg-[var(--accent-3)] hover:text-black transition {{ !empty($title) && $title === 'Add Task' ? 'bg-[var(--accent-2)] text-black' : 'text-[var(--accent)]' }}">Add Task</a>
            <a href="/tasks" 
                class="px-4 inline-block h-[36px] py-1.5 border rounded border-[var(--accent-2)] hover:bg-[var(--accent-3)] hover:text-black transition {{ !empty($title) && $title === 'Tasks' ? 'bg-[var(--accent-2)] text-black' : 'text-[var(--accent)]' }}">Tasks</a>
            <a href="/categories" 
                class="px-4 inline-block h-[36px] py-1.5 border rounded border-[var(--accent-2)] hover:bg-[var(--accent-3)] hover:text-black transition {{ !empty($title) && $title === 'Categories' ? 'bg-[var(--accent-2)] text-black' : 'text-[var(--accent)]' }}">Categories</a>
            <a href="/user" 
                class="px-4 inline-block h-[36px] py-1.5 border rounded border-[var(--accent-2)] hover:bg-[var(--accent-3)] hover:text-black transition {{ !empty($title) && $title === 'Profile' ? 'bg-[var(--accent-2)] text-black' : 'text-[var(--accent)]' }}">Profile</a>
        </div>
        @else 
            <a href="/auth" 
                class="px-4 inline-block h-[36px] py-1.5 border rounded border-[var(--accent-2)] hover:bg-[var(--accent-3)] hover:text-black transition {{ !empty($title) && $title === 'Auth' ? 'bg-[var(--accent-2)] text-black' : 'text-[var(--accent)]' }}">Log In / Sign Up</a>
        @endif

    </div>
</header>