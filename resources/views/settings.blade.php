@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Loading Indicator -->
    <div id="loadingIndicator" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl">
            <div class="flex items-center space-x-4">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <span class="text-lg font-medium">Loading data...</span>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Tanaman Card -->
        <div class="bg-gradient-to-r from-green-400 to-green-600 rounded-lg p-6 text-white card-hover transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium mb-2">Tanaman</h3>
                    <p class="text-3xl font-bold" id="tanamanCount">-</p>
                </div>
                <div class="text-green-200">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('plants.index') }}" class="text-green-100 hover:text-white text-sm font-medium flex items-center">
                    More info
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Hama & Penyakit Card -->
        <div class="bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg p-6 text-white card-hover transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium mb-2">Hama & Penyakit</h3>
                    <p class="text-3xl font-bold" id="hamaCount">-</p>
                </div>
                <div class="text-blue-200">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V7a1 1 0 112 0v3.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('diseases.index') }}" class="text-blue-100 hover:text-white text-sm font-medium flex items-center">
                    More info
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Total User Card -->
        <div class="bg-gradient-to-r from-orange-400 to-orange-600 rounded-lg p-6 text-white card-hover transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium mb-2">Total User</h3>
                    <p class="text-3xl font-bold" id="userCount">-</p>
                </div>
                <div class="text-orange-200">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('users.index') }}" class="text-orange-100 hover:text-white text-sm font-medium flex items-center">
                    More info
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Tanaman Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Tanaman</h2>
                <select class="text-sm border rounded-lg px-3 py-1 bg-gray-50">
                    <option>Tanaman umum</option>
                </select>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 text-gray-600">NO.</th>
                            <th class="text-left py-2 text-gray-600">NAMA</th>
                            <th class="text-left py-2 text-gray-600">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="tanamanTable">
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">
                                <div class="flex justify-center">
                                    <svg class="animate-spin h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('plants.index') }}" class="text-green-600 hover:text-green-800 font-medium">
                    See All →
                </a>
            </div>
        </div>

        <!-- Hama & Penyakit Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Hama & Penyakit</h2>
                <select class="text-sm border rounded-lg px-3 py-1 bg-gray-50">
                    <option>Pest (Umum)</option>
                </select>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 text-gray-600">NO.</th>
                            <th class="text-left py-2 text-gray-600">NAMA</th>
                            <th class="text-left py-2 text-gray-600">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="hamaTable">
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">
                                <div class="flex justify-center">
                                    <svg class="animate-spin h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('diseases.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    See All →
                </a>
            </div>
        </div>
    </div>

    <!-- Session Information -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Session Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-gray-600 mb-2">Email:</p>
                <p class="font-medium">{{ $email ?? 'Not available' }}</p>
            </div>
            <div>
                <p class="text-gray-600 mb-2">Token Status:</p>
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Active</span>
            </div>
            <div>
                <p class="text-gray-600 mb-2">Admin Status:</p>
                @if($admin_registered ?? false)
                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">✅ Registered</span>
                @elseif(($api_status ?? '') == 'user_not_found_in_backend')
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">⚠️ Not in Backend</span>
                @else
                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Unknown</span>
                @endif
            </div>
        </div>

        @if($token ?? false)
        <div class="mt-4">
            <p class="text-gray-600 mb-2">Firebase Token (untuk API Plants):</p>
            <div class="relative">
                <textarea id="firebase-token" class="w-full p-3 border rounded-lg bg-gray-50 text-xs font-mono h-32 resize-none" readonly>{{ $token }}</textarea>
                <div class="absolute top-2 right-2 flex space-x-2">
                    <button onclick="copyToken()" class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600 transition-colors">
                        📋 Copy
                    </button>
                    <button onclick="selectAll()" class="px-3 py-1 bg-gray-500 text-white rounded text-sm hover:bg-gray-600 transition-colors">
                        🔍 Select All
                    </button>
                </div>
                <div id="copy-status" class="hidden absolute bottom-2 right-2 bg-green-500 text-white px-2 py-1 rounded text-sm">
                    Token copied!
                </div>
            </div>
            <div class="mt-2 text-xs text-gray-600">
                <p>🔗 API Endpoint: <code class="bg-gray-100 px-1 rounded">https://stapin.site/api/v1/plants/?limit=10</code></p>
                <p>📝 Header: <code class="bg-gray-100 px-1 rounded">Authorization: Bearer [token]</code></p>
            </div>
        </div>
        @endif
    </div>

    <!-- Debug Info Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Debug Information</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <p class="text-gray-600 mb-2">API Status:</p>
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">✅ JavaScript Loading</span>
            </div>
            <div>
                <p class="text-gray-600 mb-2">Plants Count:</p>
                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm" id="plantsDebugCount">Loading...</span>
            </div>
            <div>
                <p class="text-gray-600 mb-2">Diseases Count:</p>
                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-sm" id="diseasesDebugCount">Loading...</span>
            </div>
        </div>

        <div id="debugDataContainer">
            <div class="mb-4">
                <p class="text-gray-600 mb-2">Sample Plant Data:</p>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <pre class="text-sm overflow-x-auto" id="plantsDebugData">Loading...</pre>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 mb-2">Sample Disease Data:</p>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <pre class="text-sm overflow-x-auto" id="diseasesDebugData">Loading...</pre>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <p class="text-gray-600 mb-2">Session Data:</p>
            <div class="bg-gray-100 p-4 rounded-lg">
                <pre class="text-sm overflow-x-auto">{{ json_encode([
                    'email' => $email ?? 'Not set',
                    'admin_registered' => $admin_registered ?? false,
                    'api_status' => $api_status ?? 'Unknown',
                    'token_exists' => $token ? 'Yes' : 'No'
                ], JSON_PRETTY_PRINT) }}</pre>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load data from API using JavaScript
        loadDashboardData();

        // Show session info
        showSessionInfo();
    });

    // Dashboard data object
    let dashboardData = {
        tanaman: [],
        hama: [],
        users: []
    };

    // Fetch data from API
    async function fetchData(endpoint) {
        try {
            const token = '{{ $token }}';
            if (!token) {
                console.error('No token available for API request');
                return null;
            }

            console.log(`Making API request to: https://stapin.site/api/v1${endpoint}`);

            const response = await fetch(`https://stapin.site/api/v1${endpoint}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            console.log(`API response status: ${response.status}`);

            if (!response.ok) {
                const errorText = await response.text();
                console.error(`HTTP error! status: ${response.status}, message: ${errorText}`);
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log(`API response data for ${endpoint}:`, data);
            return data;
        } catch (error) {
            console.error(`Error fetching ${endpoint}:`, error);
            return null;
        }
    }

    // Show loading indicator
    function showLoading() {
        const loading = document.getElementById('loadingIndicator');
        if (loading) {
            loading.style.display = 'flex';
        }
    }

    // Hide loading indicator
    function hideLoading() {
        const loading = document.getElementById('loadingIndicator');
        if (loading) {
            loading.style.display = 'none';
        }
    }

    // Show error message
    function showErrorMessage(message) {
        alert(message);
    }

    // Load dashboard data
    async function loadDashboardData() {
        try {
            showLoading();

            // Fetch tanaman data
            console.log('Fetching plants data...');
            const tanamanData = await fetchData('/plants/?limit=10');
            console.log('Plants data response:', tanamanData);

            if (tanamanData) {
                // API returns {plants: [...]} format
                if (tanamanData.plants && Array.isArray(tanamanData.plants)) {
                    dashboardData.tanaman = tanamanData.plants;
                } else if (tanamanData.data && Array.isArray(tanamanData.data)) {
                    dashboardData.tanaman = tanamanData.data;
                } else if (Array.isArray(tanamanData)) {
                    dashboardData.tanaman = tanamanData;
                } else {
                    dashboardData.tanaman = [];
                    console.warn('Unexpected plants data structure:', tanamanData);
                }
            } else {
                dashboardData.tanaman = [];
            }

            // Fetch hama data (diseases)
            console.log('Fetching diseases data...');
            const hamaData = await fetchData('/diseases/?limit=10');
            console.log('Diseases data response:', hamaData);

            if (hamaData) {
                // Handle different possible response formats
                if (hamaData.diseases && Array.isArray(hamaData.diseases)) {
                    dashboardData.hama = hamaData.diseases;
                } else if (hamaData.data && Array.isArray(hamaData.data)) {
                    dashboardData.hama = hamaData.data;
                } else if (Array.isArray(hamaData)) {
                    dashboardData.hama = hamaData;
                } else {
                    dashboardData.hama = [];
                    console.warn('Unexpected diseases data structure:', hamaData);
                }
            } else {
                dashboardData.hama = [];
            }

            // Mock user data (replace with actual API call)
            dashboardData.users = [
                { id: 1, name: 'Admin User', email: 'admin@example.com', role: 'Administrator' },
                { id: 2, name: 'Plant Expert', email: 'expert@example.com', role: 'Expert' },
                { id: 3, name: 'Regular User', email: 'user@example.com', role: 'User' }
            ];

            console.log('Dashboard data loaded successfully');
            updateDashboardUI();
        } catch (error) {
            console.error('Error loading dashboard data:', error);
            showErrorMessage('Failed to load dashboard data: ' + error.message);
            loadMockData();
        } finally {
            hideLoading();
        }
    }

    // Load mock data as fallback
    function loadMockData() {
        dashboardData.tanaman = [
            { id: 1, name: 'Padi', scientific_name: 'Oryza sativa', category: 'Cereal', common_name: 'Rice' },
            { id: 2, name: 'Jagung', scientific_name: 'Zea mays', category: 'Cereal', common_name: 'Corn' },
            { id: 3, name: 'Kedelai', scientific_name: 'Glycine max', category: 'Legume', common_name: 'Soybean' },
            { id: 4, name: 'Singkong', scientific_name: 'Manihot esculenta', category: 'Tuber', common_name: 'Cassava' },
            { id: 5, name: 'Ubi Jalar', scientific_name: 'Ipomoea batatas', category: 'Tuber', common_name: 'Sweet Potato' }
        ];

        dashboardData.hama = [
            { id: 1, name: 'Wereng Coklat', scientific_name: 'Nilaparvata lugens', type: 'Pest', common_name: 'Brown Planthopper', display_name: 'Brown Planthopper' },
            { id: 2, name: 'Blast Padi', scientific_name: 'Pyricularia oryzae', type: 'Disease', common_name: 'Rice Blast', display_name: 'Rice Blast Disease' },
            { id: 3, name: 'Penggerek Batang', scientific_name: 'Scirpophaga incertulas', type: 'Pest', common_name: 'Yellow Stem Borer', display_name: 'Yellow Stem Borer' },
            { id: 4, name: 'Ulat Grayak', scientific_name: 'Spodoptera litura', type: 'Pest', common_name: 'Armyworm', display_name: 'Armyworm' },
            { id: 5, name: 'Layu Bakteri', scientific_name: 'Ralstonia solanacearum', type: 'Disease', common_name: 'Bacterial Wilt', display_name: 'Bacterial Wilt Disease' }
        ];

        dashboardData.users = [
            { id: 1, name: 'Admin User', email: 'admin@example.com', role: 'Administrator' },
            { id: 2, name: 'Plant Expert', email: 'expert@example.com', role: 'Expert' },
            { id: 3, name: 'Regular User', email: 'user@example.com', role: 'User' }
        ];

        console.log('Mock data loaded successfully');
        updateDashboardUI();
    }

    // Update dashboard UI with data
    function updateDashboardUI() {
        console.log('Updating dashboard UI with data:', dashboardData);

        // Update counts
        document.getElementById('tanamanCount').textContent = dashboardData.tanaman.length || 0;
        document.getElementById('hamaCount').textContent = dashboardData.hama.length || 0;
        document.getElementById('userCount').textContent = dashboardData.users.length || 0;

        // Update debug counts
        document.getElementById('plantsDebugCount').textContent = `${dashboardData.tanaman.length} plants loaded`;
        document.getElementById('diseasesDebugCount').textContent = `${dashboardData.hama.length} diseases loaded`;

        // Update debug data - show first 2 items for debugging
        const plantsDebugData = dashboardData.tanaman.slice(0, 2);
        const diseasesDebugData = dashboardData.hama.slice(0, 2);

        document.getElementById('plantsDebugData').textContent = JSON.stringify(plantsDebugData, null, 2);
        document.getElementById('diseasesDebugData').textContent = JSON.stringify(diseasesDebugData, null, 2);

        // Update tables
        updateTanamanTable();
        updateHamaTable();

        console.log('Dashboard UI updated successfully');
    }

    // Update tanaman table
    function updateTanamanTable() {
        const tbody = document.getElementById('tanamanTable');
        if (!tbody) return;

        if (dashboardData.tanaman.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-gray-500">No data available</td></tr>';
            return;
        }

        tbody.innerHTML = dashboardData.tanaman.slice(0, 5).map((item, index) => `
            <tr class="border-b">
                <td class="py-2">${index + 1}</td>
                <td class="py-2">${item.name || item.common_name || item.scientific_name || 'Unknown'}</td>
                <td class="py-2">
                    <button class="text-blue-600 hover:text-blue-800 text-sm">View</button>
                </td>
            </tr>
        `).join('');
    }

    // Update hama table
    function updateHamaTable() {
        const tbody = document.getElementById('hamaTable');
        if (!tbody) return;

        if (dashboardData.hama.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-gray-500">No data available</td></tr>';
            return;
        }

        tbody.innerHTML = dashboardData.hama.slice(0, 5).map((item, index) => `
            <tr class="border-b">
                <td class="py-2">${index + 1}</td>
                <td class="py-2">${item.name || item.display_name || item.common_name || item.scientific_name || 'Unknown'}</td>
                <td class="py-2">
                    <button class="text-blue-600 hover:text-blue-800 text-sm">View</button>
                </td>
            </tr>
        `).join('');
    }

    // Show session info
    function showSessionInfo() {
        const sessionInfo = document.getElementById('sessionInfo');
        if (sessionInfo) {
            sessionInfo.innerHTML = `
                <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                    <h4 class="font-semibold mb-2">Session Info:</h4>
                    <p class="text-sm">Email: {{ $email ?? 'Not set' }}</p>
                    <p class="text-sm">Admin Registered: {{ $admin_registered ? 'Yes' : 'No' }}</p>
                    <p class="text-sm">Token: {{ $token ? 'Available' : 'Not Available' }}</p>
                    <p class="text-sm">API Status: {{ $api_status ?? 'Unknown' }}</p>
                </div>
            `;
        }
    }

    // Copy token to clipboard
    function copyToken() {
        const tokenTextarea = document.getElementById('firebase-token');
        if (tokenTextarea) {
            tokenTextarea.select();
            document.execCommand('copy');

            const status = document.getElementById('copy-status');
            if (status) {
                status.classList.remove('hidden');
                setTimeout(() => {
                    status.classList.add('hidden');
                }, 2000);
            }
        }
    }

    // Select all token text
    function selectAll() {
        const tokenTextarea = document.getElementById('firebase-token');
        if (tokenTextarea) {
            tokenTextarea.select();
        }
    }
</script>
@endpush
