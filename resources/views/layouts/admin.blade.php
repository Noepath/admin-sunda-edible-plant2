<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Sunda Edible Plant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.css">

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwind.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .sidebar-active {
            @apply bg-green-600 text-white font-semibold shadow-lg;
            border-left: 4px solid #10b981;
        }
        .sidebar-active:hover {
            @apply bg-green-700;
        }
        .sidebar-active svg {
            @apply text-green-200;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        /* Ensure sidebar links are properly spaced */
        .sidebar-nav a {
            @apply block w-full text-left;
        }
        /* Statistics cards styling */
        .stats-card {
            transition: all 0.3s ease;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        .stats-card .icon-bg {
            filter: blur(0.5px);
        }
        /* Fix SVG icon display */
        .stats-card img {
            display: block;
            width: 1.5rem;
            height: 1.5rem;
        }
        /* Gradient card styling */
        .gradient-card {
            background: linear-gradient(135deg, var(--start-color), var(--end-color));
            transition: all 0.3s ease;
        }
        .gradient-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        /* Icon styling for gradient cards */
        .gradient-card img {
            width: 4rem;
            height: 4rem;
            opacity: 0.6;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content + Right Sidebar -->
        <div class="flex-1 flex flex-row h-screen min-h-screen">
            <!-- Gabungkan scroll utama dan sidebar kanan -->
            <div class="flex-1 flex flex-row">
                <main class="flex-1 p-6">
                    <!-- Page Title -->
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                    </div>

                    @yield('content')
                </main>
                <!-- Right Sidebar (optional) -->
                @hasSection('right-sidebar')
                    <aside class="w-full max-w-xs bg-white h-full shadow-lg border-l border-gray-200 flex flex-col p-6">
                        @yield('right-sidebar')
                    </aside>
                @endif
            </div>
        </div>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white p-6 rounded-lg shadow-xl text-center">
                <svg class="animate-spin h-8 w-8 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="mt-2 text-gray-500">Loading data...</p>
            </div>
        </div>
    </div>

    <!-- Global JavaScript -->
    @include('components.scripts')
    @stack('scripts')
</body>
</html>
