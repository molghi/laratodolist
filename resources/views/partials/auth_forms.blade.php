<div class="flex w-full max-w-4xl gap-10 mx-auto">

    <!-- Log In Column -->
    <div class="flex-1 bg-gray-800 p-8 rounded-lg border border-sky-700">
        <h2 class="text-2xl mb-6 text-center">{{ __('ui.auth_log_in') }}</h2>
        <form action="{{ route('user.login') }}" method="POST" class="flex flex-col gap-4">
            @csrf 
            <input autofocus="true" type="text" name="email" placeholder="{{ __('ui.auth_email') }}" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <input type="password" name="password" placeholder="{{ __('ui.auth_password') }}" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <button type="submit" class="mt-4 bg-sky-500 text-black py-2 rounded hover:bg-sky-700 transition">{{ __('ui.auth_log_in') }}</button>
        </form>
        @error('email-login')
            <div class="text-[red] p-2 text-sm">{{$message}}</div>
        @enderror
    </div>

    <!-- Sign Up Column -->
    <div class="flex-1 bg-gray-800 p-8 rounded-lg border border-sky-700">
        <h2 class="text-2xl mb-6 text-center">{{ __('ui.auth_sign_up') }}</h2>
        <form action="{{ route('user.create') }}" method="POST" class="flex flex-col gap-4">
            @csrf 
            <input type="email" name="email" placeholder="{{ __('ui.auth_email') }}" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <input type="password" name="password" placeholder="{{ __('ui.auth_password') }}" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <input type="password" name="password_confirmation" placeholder="{{ __('ui.auth_password_repeat') }}" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <button type="submit" class="mt-4 bg-sky-500 text-black py-2 rounded hover:bg-sky-700 transition">{{ __('ui.auth_sign_up') }}</button>
        </form>
        @error('email')
            <div class="text-[red] p-2 text-sm">{{$message}}</div>
        @enderror
        @error('password')
            <div class="text-[red] p-2 text-sm">{{$message}}</div>
        @enderror
    </div>

</div>