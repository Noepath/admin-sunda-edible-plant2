<div class="bg-gray-800 text-white w-64 min-h-screen flex flex-col">
    <div class="p-4">
        <!-- Logo/Title -->
        <div class="mb-8">
            <h1 class="text-xl font-bold text-center">Admin</h1>
        </div>

        <!-- Profile Section -->
        <div class="flex items-center mb-6 p-3 bg-gray-700 rounded-lg">
            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                <span class="text-white font-bold">
                    @if(session('firebase_email'))
                        {{ strtoupper(substr(session('firebase_email'), 0, 1)) }}
                    @else
                        AP
                    @endif
                </span>
            </div>
            <div>
                <p class="text-sm font-medium">
                    @if(session('firebase_email'))
                        {{ explode('@', session('firebase_email'))[0] }}
                    @else
                        Admin Plant
                    @endif
                </p>
                <p class="text-xs text-gray-400">Administrator</p>
            </div>
        </div>        <!-- Navigation Menu -->
        <nav class="space-y-2 flex-1 sidebar-nav">
            <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('plants.index') }}" class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('plants.*') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                Tanaman
            </a>

            <a href="{{ route('diseases.index') }}" class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('diseases.*') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V7a1 1 0 112 0v3.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                Hama & Penyakit
            </a>

            <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('users.*') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
                User List
            </a>
        </nav>
    </div>

    <!-- Bottom Section - Fixed at bottom -->
    <div class="p-4 border-t border-gray-600">
        <div class="space-y-2">
            <a href="{{ route('settings') }}" class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('settings') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm">Pengaturan</span>
            </a>

            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-red-600 transition-colors duration-200 text-red-400 hover:text-white" onclick="confirmLogout()">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm">Logout</span>
            </a>
        </div>
    </div>
</div>
