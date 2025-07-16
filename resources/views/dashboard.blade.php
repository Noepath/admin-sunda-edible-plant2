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
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white shadow-lg relative overflow-hidden" style="background: linear-gradient(135deg, #28A745 0%, #20C997 100%);">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-2xl font-bold mb-1" id="tanamanCount">53</p>
                    <h3 class="text-lg font-medium opacity-90">Tanaman</h3>
                </div>
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-60">
                    <img src="{{ asset('icons/section1.svg') }}" alt="Plant Icon" class="w-16 h-16">
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
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white shadow-lg relative overflow-hidden" style="background: linear-gradient(135deg, #4C61CC 0%, #6C5CE7 100%);">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-2xl font-bold mb-1" id="hamaCount">65</p>
                    <h3 class="text-lg font-medium opacity-90">Hama & Penyakit</h3>
                </div>
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-60">
                    <img src="{{ asset('icons/section2.svg') }}" alt="Pest Icon" class="w-16 h-16">
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

        <!-- User Card -->
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-6 text-white shadow-lg relative overflow-hidden" style="background: linear-gradient(135deg, #FFC107 0%, #FFB300 100%);">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-2xl font-bold mb-1" id="userCount">44</p>
                    <h3 class="text-lg font-medium opacity-90">User</h3>
                </div>
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-60">
                    <img src="{{ asset('icons/section3.svg') }}" alt="User Icon" class="w-16 h-16">
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('users.index') }}" class="text-yellow-100 hover:text-white text-sm font-medium flex items-center">
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
                <select id="tanamanFilter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Tanaman umum</option>
                    <option value="Sayuran">Sayuran</option>
                    <option value="Herbal">Herbal</option>
                    <option value="Buah">Buah</option>
                </select>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full" id="tanamanTable">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 text-gray-600">No.</th>
                            <th class="text-left py-2 text-gray-600">Nama</th>
                            <th class="text-left py-2 text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{ route('plants.index') }}" class="text-green-600 hover:text-green-800 font-medium flex items-center">
                    See All
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Hama & Penyakit Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Hama & Penyakit</h2>
                <select id="hamaFilter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Semua</option>
                    <option value="Pest">Hama</option>
                    <option value="Disease">Penyakit</option>
                </select>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full" id="hamaTable">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 text-gray-600">No.</th>
                            <th class="text-left py-2 text-gray-600">Nama</th>
                            <th class="text-left py-2 text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{ route('diseases.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                    See All
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load data from API using JavaScript
        loadDashboardData();

        // Show session info
        showSessionInfo();

        // Add filter event listeners
        document.getElementById('tanamanFilter').addEventListener('change', function() {
            filterTanamanTable(this.value);
        });

        document.getElementById('hamaFilter').addEventListener('change', function() {
            filterHamaTable(this.value);
        });
    });

    // Dashboard data object
    let dashboardData = {
        tanaman: [],
        hama: [],
        users: []
    };

    // Filtered data
    let filteredTanaman = [];
    let filteredHama = [];

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
            const tanamanData = await fetchData('/plants/?limit=20');
            console.log('Plants data response:', tanamanData);

            if (tanamanData) {
                // API returns {plants: [...]} format
                if (tanamanData.plants && Array.isArray(tanamanData.plants)) {
                    // Map API data to include category if not present
                    dashboardData.tanaman = tanamanData.plants.map(plant => ({
                        ...plant,
                        category: plant.category || 'Sayuran' // Default category if not specified
                    }));
                } else if (tanamanData.data && Array.isArray(tanamanData.data)) {
                    dashboardData.tanaman = tanamanData.data.map(plant => ({
                        ...plant,
                        category: plant.category || 'Sayuran'
                    }));
                } else if (Array.isArray(tanamanData)) {
                    dashboardData.tanaman = tanamanData.map(plant => ({
                        ...plant,
                        category: plant.category || 'Sayuran'
                    }));
                } else {
                    dashboardData.tanaman = [];
                    console.warn('Unexpected plants data structure:', tanamanData);
                }
            } else {
                dashboardData.tanaman = [];
            }

            // Fetch hama data (diseases)
            console.log('Fetching diseases data...');
            const hamaData = await fetchData('/diseases/?limit=20');
            console.log('Diseases data response:', hamaData);

            if (hamaData) {
                // Handle different possible response formats
                if (hamaData.diseases && Array.isArray(hamaData.diseases)) {
                    // Map API data to include type if not present
                    dashboardData.hama = hamaData.diseases.map(disease => ({
                        ...disease,
                        type: disease.type || 'Disease' // Default type if not specified
                    }));
                } else if (hamaData.data && Array.isArray(hamaData.data)) {
                    dashboardData.hama = hamaData.data.map(disease => ({
                        ...disease,
                        type: disease.type || 'Disease'
                    }));
                } else if (Array.isArray(hamaData)) {
                    dashboardData.hama = hamaData.map(disease => ({
                        ...disease,
                        type: disease.type || 'Disease'
                    }));
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
        // Mock data sesuai gambar dengan lebih banyak variasi
        dashboardData.tanaman = [
            { id: 1, name: 'Tomat', scientific_name: 'Solanum lycopersicum', category: 'Sayuran', common_name: 'Tomat' },
            { id: 2, name: 'Sirih', scientific_name: 'Piper betle', category: 'Herbal', common_name: 'Sirih' },
            { id: 3, name: 'Cabai', scientific_name: 'Capsicum annuum', category: 'Sayuran', common_name: 'Cabai' },
            { id: 4, name: 'Jahe', scientific_name: 'Zingiber officinale', category: 'Herbal', common_name: 'Jahe' },
            { id: 5, name: 'Mangga', scientific_name: 'Mangifera indica', category: 'Buah', common_name: 'Mangga' },
            { id: 6, name: 'Bayam', scientific_name: 'Amaranthus', category: 'Sayuran', common_name: 'Bayam' },
            { id: 7, name: 'Kunyit', scientific_name: 'Curcuma longa', category: 'Herbal', common_name: 'Kunyit' },
            { id: 8, name: 'Pisang', scientific_name: 'Musa', category: 'Buah', common_name: 'Pisang' },
            { id: 9, name: 'Sawi', scientific_name: 'Brassica rapa', category: 'Sayuran', common_name: 'Sawi' },
            { id: 10, name: 'Temulawak', scientific_name: 'Curcuma xanthorrhiza', category: 'Herbal', common_name: 'Temulawak' }
        ];

        dashboardData.hama = [
            { id: 1, name: 'Wereng Coklat', scientific_name: 'Nilaparvata lugens', type: 'Pest', common_name: 'Brown Planthopper', display_name: 'Brown Planthopper' },
            { id: 2, name: 'Blast Padi', scientific_name: 'Pyricularia oryzae', type: 'Disease', common_name: 'Rice Blast', display_name: 'Rice Blast Disease' },
            { id: 3, name: 'Penggerek Batang', scientific_name: 'Scirpophaga incertulas', type: 'Pest', common_name: 'Yellow Stem Borer', display_name: 'Yellow Stem Borer' },
            { id: 4, name: 'Ulat Grayak', scientific_name: 'Spodoptera litura', type: 'Pest', common_name: 'Armyworm', display_name: 'Armyworm' },
            { id: 5, name: 'Layu Bakteri', scientific_name: 'Ralstonia solanacearum', type: 'Disease', common_name: 'Bacterial Wilt', display_name: 'Bacterial Wilt Disease' },
            { id: 6, name: 'Kutu Daun', scientific_name: 'Aphis gossypii', type: 'Pest', common_name: 'Aphid', display_name: 'Aphid' },
            { id: 7, name: 'Busuk Daun', scientific_name: 'Phytophthora infestans', type: 'Disease', common_name: 'Late Blight', display_name: 'Late Blight Disease' },
            { id: 8, name: 'Thrips', scientific_name: 'Thrips tabaci', type: 'Pest', common_name: 'Thrips', display_name: 'Thrips' },
            { id: 9, name: 'Antraknosa', scientific_name: 'Colletotrichum', type: 'Disease', common_name: 'Anthracnose', display_name: 'Anthracnose Disease' },
            { id: 10, name: 'Lalat Buah', scientific_name: 'Bactrocera dorsalis', type: 'Pest', common_name: 'Fruit Fly', display_name: 'Fruit Fly' }
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

        // Update counts with fallback values
        document.getElementById('tanamanCount').textContent = dashboardData.tanaman.length || 53;
        document.getElementById('hamaCount').textContent = dashboardData.hama.length || 65;
        document.getElementById('userCount').textContent = dashboardData.users.length || 44;

        // Update debug counts
        document.getElementById('plantsDebugCount').textContent = `${dashboardData.tanaman.length} plants loaded`;
        document.getElementById('diseasesDebugCount').textContent = `${dashboardData.hama.length} diseases loaded`;

        // Update debug data - show first 2 items for debugging
        const plantsDebugData = dashboardData.tanaman.slice(0, 2);
        const diseasesDebugData = dashboardData.hama.slice(0, 2);

        document.getElementById('plantsDebugData').textContent = JSON.stringify(plantsDebugData, null, 2);
        document.getElementById('diseasesDebugData').textContent = JSON.stringify(diseasesDebugData, null, 2);

        // Update tables with custom rendering
        renderTables();

        console.log('Dashboard UI updated successfully');
    }

    // Render tables without DataTables
    function renderTables() {
        // Reset filtered data
        filteredTanaman = [...dashboardData.tanaman];
        filteredHama = [...dashboardData.hama];

        // Render both tables
        renderTanamanTable();
        renderHamaTable();
    }

    // Render Tanaman table (limit to 5 items)
    function renderTanamanTable() {
        const tableBody = document.querySelector('#tanamanTable tbody');
        tableBody.innerHTML = '';

        if (filteredTanaman.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-gray-500">Tidak ada data tanaman</td></tr>';
            return;
        }

        // Limit to 5 items
        const limitedData = filteredTanaman.slice(0, 5);

        limitedData.forEach((item, index) => {
            const row = document.createElement('tr');
            row.className = 'border-b hover:bg-gray-50';
            row.innerHTML = `
                <td class="py-3 text-gray-600">${index + 1}</td>
                <td class="py-3 text-gray-800">${item.name || item.common_name || item.scientific_name || 'Unknown'}</td>
                <td class="py-3">
                    <div class="flex space-x-2">
                        <button class="p-2 text-gray-600 hover:text-blue-600 border rounded" onclick="editTanaman(${item.id})">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-red-600 border rounded" onclick="deleteTanaman(${item.id})">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Render Hama table (limit to 5 items)
    function renderHamaTable() {
        const tableBody = document.querySelector('#hamaTable tbody');
        tableBody.innerHTML = '';

        if (filteredHama.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-gray-500">Tidak ada data hama & penyakit</td></tr>';
            return;
        }

        // Limit to 5 items
        const limitedData = filteredHama.slice(0, 5);

        limitedData.forEach((item, index) => {
            const row = document.createElement('tr');
            row.className = 'border-b hover:bg-gray-50';
            row.innerHTML = `
                <td class="py-3 text-gray-600">${index + 1}</td>
                <td class="py-3 text-gray-800">${item.name || item.display_name || item.common_name || item.scientific_name || 'Unknown'}</td>
                <td class="py-3">
                    <div class="flex space-x-2">
                        <button class="p-2 text-gray-600 hover:text-blue-600 border rounded" onclick="editHama(${item.id})">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-red-600 border rounded" onclick="deleteHama(${item.id})">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Filter functions
    function filterTanamanTable(category) {
        console.log('Filtering tanaman by category:', category);
        console.log('Original data:', dashboardData.tanaman);

        if (!category) {
            filteredTanaman = [...dashboardData.tanaman];
        } else {
            filteredTanaman = dashboardData.tanaman.filter(item => {
                console.log('Checking item:', item, 'Category:', item.category);
                return item.category === category;
            });
        }

        console.log('Filtered data:', filteredTanaman);
        renderTanamanTable();
    }

    function filterHamaTable(type) {
        console.log('Filtering hama by type:', type);
        console.log('Original data:', dashboardData.hama);

        if (!type) {
            filteredHama = [...dashboardData.hama];
        } else {
            filteredHama = dashboardData.hama.filter(item => {
                console.log('Checking item:', item, 'Type:', item.type);
                return item.type === type;
            });
        }

        console.log('Filtered data:', filteredHama);
        renderHamaTable();
    }

    // Action functions
    function editTanaman(id) {
        alert(`Edit tanaman dengan ID: ${id}`);
    }

    function deleteTanaman(id) {
        if (confirm('Apakah Anda yakin ingin menghapus tanaman ini?')) {
            alert(`Hapus tanaman dengan ID: ${id}`);
        }
    }

    function editHama(id) {
        alert(`Edit hama dengan ID: ${id}`);
    }

    function deleteHama(id) {
        if (confirm('Apakah Anda yakin ingin menghapus hama ini?')) {
            alert(`Hapus hama dengan ID: ${id}`);
        }
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
