<div>
    {{-- TOP PART: USER PROFILE THINGS --}}
    <div class="flex items-start gap-10 justify-between max-w-6xl mx-auto relative">

        <div class="flex items-center gap-3 flex-wrap max-w-[400px]">
            <span class="font-bold opacity-50">Name:</span> {{$name}} 
            <span class="ml-4">
                <button data-user-id="{{$user_id}}" class="edit-name px-3 py-1 border border-sky-500 text-sky-400 rounded hover:bg-sky-500/20 transition text-sm opacity-40 hover:opacity-100">
                    Edit
                </button>
            </span>
            @error('username')
                <div class="text-[red] text-sm py-2 flex-1 basis-full">{{$message}}</div>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <span class="font-bold opacity-50">Email:</span> {{$email}}
        </div>

        <div class="flex items-center gap-3">
            <span class="font-bold opacity-50">Member since:</span> {{ substr($created_at, 0, 10) . ' (' . get_time_between($created_at) . ')' }}
        </div>

        <div class="absolute top-[-80px] right-0 flex flex-col gap-2 text-right text-sm">
            <a href="/user/logout" class="opacity-30 hover:opacity-100 hover:underline">Log Out</a>
            <form action="{{ route('user.delete', $user_id) }}" method="POST">
                @csrf 
                @method('DELETE')
                <button type="submit" onclick="return confirm('CAREFUL!\nAre you sure you want to delete your profile?\nThis action cannot be undone. You will lose all your tasks.')" class="opacity-30 hover:opacity-100 hover:underline hover:text-[red]">Delete Profile</button>
            </form>
        </div>

    </div>

    {{-- BOTTOM PART: TASKS & CATEGORIES THINGS --}}
    <div>
        <div class="flex flex-col items-start md:flex-row gap-10 max-w-4xl mx-auto mt-10">

            <!-- Column 1: Tasks Stats -->
            <div class="flex-1 bg-gray-900 text-gray-100 p-6 rounded-lg border border-gray-700 overflow-hidden">
                <h2 class="text-xl font-semibold mb-4">Tasks</h2>
                <ul class="space-y-3">
                <li>
                    <span class="opacity-50 font-bold">Tasks Created: </span> {{ count($user_tasks) }}
                </li>
                <li>
                    <span class="opacity-50 font-bold">Tasks Done: </span> {{ $tasks_done }}
                </li>
                <li>
                    <span class="opacity-50 font-bold">Tasks Undone: </span> {{ $tasks_undone }}
                </li>
                <li>
                    <span class="opacity-50 font-bold">Tasks Expired: </span> {{ $tasks_expired }}
                </li>
                <li>
                    <span class="opacity-50 font-bold">Task List: </span> <button class="tasklist-toggle underline hover:no-underline active:opacity-50">Show</button>
                    @if (count($user_tasks) > 0)
                    <div class="tasklist hidden">
                        <ol class="ml-6 list-decimal list-inside">
                        @foreach ($tasks_names as $k => $v)
                            <li 
                                title="{{ $v . ' — ' . substr($tasks_details[$k], 0, 50) . (strlen($tasks_details[$k]) > 50 ? '...' : '') }}" 
                                class="whitespace-nowrap overflow-ellipsis overflow-hidden">{{$v}}</li>
                        @endforeach
                        </ol>
                        <a href="/tasks" class="ml-6 opacity-40 underline hover:opacity-100 hover:no-underline">Manage Your Tasks</a>
                    </div>
                    @else 
                        0
                    @endif
                </li>
                </ul>
            </div>

            <!-- Column 2: Categories Stats -->
            <div class="flex-1 bg-gray-900 text-gray-100 p-6 rounded-lg border border-gray-700 overflow-hidden">
                <h2 class="text-xl font-semibold mb-4">Categories</h2>
                <ul class="space-y-3">
                <li>
                    <span class="opacity-50 font-bold">Categories Created: </span> {{ count($user_categories) }}
                </li>
                <li>
                    <span class="opacity-50 font-bold">Categories List: </span> <button class="catlist-toggle underline hover:no-underline active:opacity-50">Show</button>
                    @if (count($user_categories) > 0)
                    <div class="catlist hidden">
                        <ol class="ml-6 list-decimal list-inside">
                        @foreach ($categories_names as $name)
                            <li title="{{$name}}" class="whitespace-nowrap overflow-ellipsis overflow-hidden">{{$name}}</li>
                        @endforeach
                        </ol>
                        <a href="/categories" class="ml-6 opacity-40 underline hover:opacity-100 hover:no-underline">Manage Your Categories</a>
                    </div>
                    @else 
                        0
                    @endif
                </li>
                </ul>
            </div>

        </div>
    </div>
</div>


{{-- Change username functionality --}}
<script>
    (() => {
        const editBtn = document.querySelector('.edit-name');
        if (!editBtn) return;
        editBtn.addEventListener('click', function(e) {
            const newUsername = prompt('Enter new username').trim();
            const userId = editBtn.dataset.userId;
            location.href = `/user/${userId}/change?username=${newUsername}`; // same as submitting GET form
        })
    })();

    document.querySelector('.tasklist-toggle').addEventListener('click', function(e) {
        document.querySelector('.tasklist').classList.toggle('hidden');
        if (e.target.textContent === 'Show') e.target.textContent = 'Hide';
        else e.target.textContent = 'Show';
    })

    document.querySelector('.catlist-toggle').addEventListener('click', function(e) {
        document.querySelector('.catlist').classList.toggle('hidden');
        if (e.target.textContent === 'Show') e.target.textContent = 'Hide';
        else e.target.textContent = 'Show';
    })
</script>