<div class="flex w-full max-w-4xl gap-10 mx-auto">

    <!-- Log In Column -->
    <div class="flex-1 bg-gray-800 p-8 rounded-lg border border-sky-700">
        <h2 class="text-2xl mb-6 text-center">Log In</h2>
        <form class="flex flex-col gap-4">
            <input autofocus="true" type="text" name="emailUsername" placeholder="Email or Username" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <input type="password" name="password" placeholder="Password" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <button type="submit" class="mt-4 bg-sky-500 text-black py-2 rounded hover:bg-sky-700 transition">Log In</button>
        </form>
    </div>

    <!-- Sign Up Column -->
    <div class="flex-1 bg-gray-800 p-8 rounded-lg border border-sky-700">
        <h2 class="text-2xl mb-6 text-center">Sign Up</h2>
        <form class="flex flex-col gap-4">
            <input type="email" name="email" placeholder="Email" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <input type="password" name="password" placeholder="Password" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <input type="password" name="password-repeat" placeholder="Repeat Password" class="p-3 rounded bg-gray-900 border border-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <button type="submit" class="mt-4 bg-sky-500 text-black py-2 rounded hover:bg-sky-700 transition">Sign Up</button>
        </form>
    </div>

</div>