<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Sunda Edible Plant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwind.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .sidebar-active { @apply bg-green-600 text-white font-semibold shadow-lg; border-left: 4px solid #10b981; }
        .sidebar-active:hover { @apply bg-green-700; }
        .sidebar-active svg { @apply text-green-200; }
    </style>
    @stack('styles')
</head>
<body class=" font-sans">
    <div class="flex h-screen overflow-hidden">
        @include('components.sidebar')

        <div class="flex-1 p-4 overflow-hidden">
            <div class="flex h-full rounded-2xl overflow-hidden">

                <main class="flex-1 p-6 overflow-y-auto">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                    </div>
                    @yield('content')
                </main>

                @hasSection('right-sidebar')
                    <aside class="w-full max-w-xs border-l border-gray-200 p-6 overflow-y-auto">
                        @yield('right-sidebar')
                    </aside>
                @endif
            </div>
        </div>
    </div>

    @include('components.scripts')
    @stack('scripts')
</body>
</html>
