<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Dashboard' }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- TAILWIND TANPA NPM -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- TAILWIND CUSTOM CONFIG -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#7c3aed',
                        darkbg: '#0f0f15',
                        darkcard: '#1a1a22',
                    },
                }
            }
        }
    </script>

</head>

<body class="bg-darkbg text-dark-200 font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 min-h-screen bg-gray-900 text-gray-200 flex flex-col shadow-xl">

        <div class="p-6 text-2xl font-bold flex items-center gap-2 border-b border-gray-800">
            <img src="/logo.png" class="w-8" alt="">
            <span class="tracking-wide text-white">SmartTask</span>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1">

{{-- DASHBOARD --}}
<a href="{{ route('dashboard') }}"
   class="flex items-center gap-3 p-3 rounded-md transition-all
   {{ request()->is('dashboard') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800/60' }}">
    <span>🏠</span> <span>Dashboard</span>
</a>

{{-- TASKS --}}
<a href="{{ route('tasks.index') }}"
   class="flex items-center gap-3 p-3 rounded-md transition-all
   {{ request()->is('tasks*') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800/60' }}">
    <span>📝</span> <span>Tasks</span>
</a>

{{-- CATEGORIES --}}
<a href="{{ route('categories.index') }}"
   class="flex items-center gap-3 p-3 rounded-md transition-all
   {{ request()->is('categories*') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800/60' }}">
    <span>📂</span> <span>Categories</span>
</a>

{{-- INVENTORY --}}
<a href="{{ route('inventories.index') }}"
   class="flex items-center gap-3 p-3 rounded-md transition-all
   {{ request()->is('inventories*') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800/60' }}">
    <span>📦</span> <span>Inventory</span>
</a>

{{-- EXPENSE TRACKER (FITUR BARU) --}}
<a href="{{ route('expenses.index') }}"
   class="flex items-center gap-3 p-3 rounded-md transition-all
   {{ request()->is('expenses*') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800/60' }}">
    <span>💰</span> <span>Expense Tracker</span>
</a>

{{-- PROFILE --}}
<a href="{{ route('profile.edit') }}"
   class="flex items-center gap-3 p-3 rounded-md transition-all
   {{ request()->is('profile') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800/60' }}">
    <span>👤</span> <span>Profile</span>
</a>

</nav>


        <!-- FOOTER SIDEBAR -->
        <div class="p-4 border-t border-gray-800 text-sm">
            <p class="text-gray-400">Logged in as:</p>
            <p class="font-bold text-white mb-3">{{ Auth::user()->name }}</p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full py-2 bg-red-600 rounded-lg font-semibold hover:bg-red-700 shadow">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-white">{{ $title ?? 'Dashboard' }}</h1>
            <p class="text-gray-400 mt-1">{{ $subtitle ?? '' }}</p>
        </div>

        <div class="bg-darkcard border border-gray-800 rounded-xl shadow-xl p-6">
            {{ $slot }}
        </div>

    </main>

</div>

</body>
</html>
