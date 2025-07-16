@extends('layouts.admin')

@section('title', 'Tanaman')
@section('page-title', 'Tanaman')

@push('scripts')
<script src="{{ asset('js/api-client.js') }}"></script>
@endpush

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
        <!-- Total Tanaman Card -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white shadow-lg relative overflow-hidden" style="background: linear-gradient(135deg, #28A745 0%, #20C997 100%);">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-2xl font-bold mb-1" id="totalPlantsCount">0</p>
                    <h3 class="text-lg font-medium opacity-90">Tanaman</h3>
                </div>
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-60">
                    <img src="{{ asset('icons/section1.svg') }}" alt="Plant Icon" class="w-16 h-16">
                </div>
            </div>
        </div>

        <!-- Kategori Card -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white shadow-lg relative overflow-hidden" style="background: linear-gradient(135deg, #6C5CE7 0%, #A855F7 100%);">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-2xl font-bold mb-1" id="categoriesCount">0</p>
                    <h3 class="text-lg font-medium opacity-90">Kategori</h3>
                </div>
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-60">
                    <img src="{{ asset('icons/section2.svg') }}" alt="Category Icon" class="w-16 h-16">
                </div>
            </div>
        </div>

        <!-- Tambah Tanaman Card -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white shadow-lg relative overflow-hidden cursor-pointer hover:shadow-xl transition-shadow" onclick="showAddPlantModal()">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h3 class="text-lg font-medium mb-2">Tambah Tanaman</h3>
                    <p class="text-sm opacity-75">Klik untuk menambah data tanaman baru</p>
                </div>
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-60">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Header with Search and Filter -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Tanaman</h2>
                <p class="text-sm text-gray-600">Kelola data tanaman yang dapat dimakan</p>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Add Plant Button -->
                <a href="{{ route('plants.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Tanaman
                </a>
                
                <!-- Category Filter -->
                <select id="categoryFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" onchange="filterPlantsByCategory(this.value)">
                    <option value="">Semua Kategori</option>
                    <option value="Sayuran">Sayuran</option>
                    <option value="Herbal">Herbal</option>
                    <option value="Buah">Buah</option>
                    <option value="Rempah">Rempah</option>
                </select>

                <!-- Refresh Button -->
                <button onclick="refreshData()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Plants Table -->
        <div>
            <table class="w-full" id="plantsTable">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 text-gray-600">No.</th>
                        <th class="text-left py-2 text-gray-600">Nama Tanaman</th>
                        <th class="text-left py-2 text-gray-600">Nama Ilmiah</th>
                        <th class="text-left py-2 text-gray-600">Kategori</th>
                        <th class="text-left py-2 text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded via DataTables -->
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let plantsData = [];
    let categoriesData = [];
    let plantsTable;

    // Initialize page
    $(document).ready(function() {
        console.log('Plants page loaded');
        loadData();
    });

    // Load data using API client
    async function loadData() {
        try {
            api.showLoading();

            console.log('Fetching plants data...');
            plantsData = await api.getPlants();
            console.log('Plants data loaded:', plantsData.length, 'items');

            console.log('Fetching plant categories data...');
            categoriesData = await api.getPlantCategories();
            console.log('Categories data loaded:', categoriesData.length, 'items');

            console.log('Plants data loaded successfully');
            updateUI();
        } catch (error) {
            console.error('Error loading plants data:', error);
            // Load mock data as fallback
            loadMockData();
        } finally {
            api.hideLoading();
        }
    }

    // Load mock data as fallback
    function loadMockData() {
        plantsData = [
            { id: 1, name: 'Tomat', latin_name: 'Solanum lycopersicum', category: 'Sayuran', common_name: 'Tomat' },
            { id: 2, name: 'Sirih', latin_name: 'Piper betle', category: 'Herbal', common_name: 'Sirih' },
            { id: 3, name: 'Cabai', latin_name: 'Capsicum annuum', category: 'Sayuran', common_name: 'Cabai' },
            { id: 4, name: 'Jahe', latin_name: 'Zingiber officinale', category: 'Herbal', common_name: 'Jahe' },
            { id: 5, name: 'Mangga', latin_name: 'Mangifera indica', category: 'Buah', common_name: 'Mangga' },
            { id: 6, name: 'Bayam', latin_name: 'Amaranthus', category: 'Sayuran', common_name: 'Bayam' },
            { id: 7, name: 'Kunyit', latin_name: 'Curcuma longa', category: 'Herbal', common_name: 'Kunyit' },
            { id: 8, name: 'Pisang', latin_name: 'Musa', category: 'Buah', common_name: 'Pisang' },
            { id: 9, name: 'Sawi', latin_name: 'Brassica rapa', category: 'Sayuran', common_name: 'Sawi' },
            { id: 10, name: 'Temulawak', latin_name: 'Curcuma xanthorrhiza', category: 'Herbal', common_name: 'Temulawak' },
            { id: 11, name: 'Wortel', latin_name: 'Daucus carota', category: 'Sayuran', common_name: 'Wortel' },
            { id: 12, name: 'Lengkuas', latin_name: 'Alpinia galanga', category: 'Rempah', common_name: 'Lengkuas' },
            { id: 13, name: 'Pepaya', latin_name: 'Carica papaya', category: 'Buah', common_name: 'Pepaya' },
            { id: 14, name: 'Kangkung', latin_name: 'Ipomoea aquatica', category: 'Sayuran', common_name: 'Kangkung' },
            { id: 15, name: 'Kencur', latin_name: 'Kaempferia galanga', category: 'Herbal', common_name: 'Kencur' }
        ];

        categoriesData = [
            { id: 1, name: 'Sayuran', description: 'Tanaman sayuran' },
            { id: 2, name: 'Herbal', description: 'Tanaman herbal' },
            { id: 3, name: 'Buah', description: 'Tanaman buah' },
            { id: 4, name: 'Rempah', description: 'Tanaman rempah' }
        ];

        console.log('Mock data loaded successfully');
        updateUI();
    }

    // Update UI with loaded data
    function updateUI() {
        // Update counts with fallback values
        document.getElementById('totalPlantsCount').textContent = plantsData.length || 0;
        document.getElementById('categoriesCount').textContent = categoriesData.length || 0;

        // Initialize DataTable
        initializeDataTable();
    }

    // Initialize DataTable
    function initializeDataTable() {
        if (plantsTable) {
            plantsTable.destroy();
        }

        // Prepare data for DataTables
        const tableData = plantsData.map((plant, index) => {
            const actions = `
                <div class="flex space-x-2">
                    <button class="p-2 text-gray-600 hover:text-blue-600 border rounded" onclick="editPlant(${plant.id})">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button class="p-2 text-gray-600 hover:text-red-600 border rounded" onclick="deletePlant(${plant.id})">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            `;

            const categoryBadge = `<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">${plant.category || 'N/A'}</span>`;

            return [
                index + 1,
                plant.name || plant.common_name || plant.latin_name || 'Unknown',
                plant.latin_name || 'N/A',
                categoryBadge,
                actions
            ];
        });

        plantsTable = $('#plantsTable').DataTable({
            data: tableData,
            columns: [
                { title: 'No.', width: '10%' },
                { title: 'Nama Tanaman', width: '25%' },
                { title: 'Nama Ilmiah', width: '25%' },
                { title: 'Kategori', width: '20%' },
                { title: 'Actions', width: '20%', orderable: false }
            ],
            order: [[1, 'asc']], // Default sort by plant name
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data per halaman',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                infoEmpty: 'Menampilkan 0 sampai 0 dari 0 data',
                infoFiltered: '(difilter dari _MAX_ total data)',
                paginate: {
                    first: 'Pertama',
                    last: 'Terakhir',
                    next: 'Selanjutnya',
                    previous: 'Sebelumnya'
                },
                emptyTable: 'Tidak ada data tanaman',
                zeroRecords: 'Tidak ditemukan data yang sesuai'
            },
            responsive: true,
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rt<"flex justify-start items-center mt-4"p>',
            initComplete: function() {
                // Style the search input
                $('.dataTables_filter input').addClass('px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500');
                $('.dataTables_length select').addClass('px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500');

                // Add row striping and borders
                $('#plantsTable tbody tr').addClass('border-b border-gray-200');
                $('#plantsTable tbody tr:nth-child(even)').addClass('bg-gray-50');
                $('#plantsTable tbody tr:hover').addClass('bg-green-50');

                // Style pagination buttons
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-2 mx-1 border border-gray-300 rounded-md hover:bg-gray-100 transition-colors');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-green-500 text-white border-green-500 hover:bg-green-600');
                $('.dataTables_paginate .paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
            },
            drawCallback: function() {
                // Reapply row styling after each draw
                $('#plantsTable tbody tr').addClass('border-b border-gray-200');
                $('#plantsTable tbody tr:nth-child(even)').addClass('bg-gray-50');

                // Style pagination buttons
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-2 mx-1 border border-gray-300 rounded-md hover:bg-gray-100 transition-colors');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-green-500 text-white border-green-500 hover:bg-green-600');
                $('.dataTables_paginate .paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
            }
        });
    }

    // Filter plants by category
    function filterPlantsByCategory(category) {
        if (!plantsTable) return;

        if (!category) {
            plantsTable.columns(3).search('').draw();
        } else {
            plantsTable.columns(3).search(category).draw();
        }
    }

    // Action functions
    function editPlant(id) {
        alert(`Edit tanaman dengan ID: ${id}`);
    }

    function deletePlant(id) {
        if (confirm('Apakah Anda yakin ingin menghapus tanaman ini?')) {
            // Remove from data array
            plantsData = plantsData.filter(plant => plant.id !== id);
            // Reinitialize table
            initializeDataTable();
            // Update counts
            document.getElementById('totalPlantsCount').textContent = plantsData.length;
            alert(`Tanaman dengan ID ${id} berhasil dihapus`);
        }
    }

    function showAddPlantModal() {
        alert('Fitur tambah tanaman akan segera tersedia');
    }

    function refreshData() {
        loadData();
    }
</script>
@endpush


