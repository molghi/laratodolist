<!DOCTYPE html>
<html>
<head>
    <!-- INCLUDE TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- RECEIVE SECTION: TITLE -->
    <title>@yield('title')</title>

    {{-- INCLUDE SOME CUSTOM STYLES --}}
    @include('partials.styles')
</head>
<body style="background-color: var(--bg);" class="flex flex-col h-[100vh] text-[var(--accent)] font-mono">
    
    <main class="flex-1 pb-[100px]">
        <!-- INCLUDE HEADER -->
        @include('partials.header')

        <!-- RECEIVE SECTION: CONTENT -->
        @yield('content')
    </main>

    <!-- INCLUDE FOOTER -->
    @include('partials.footer')
</body>
</html>
