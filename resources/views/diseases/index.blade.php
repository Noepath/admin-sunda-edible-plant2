@extends('layouts.admin')

@section('page-title', 'Hama & Penyakit')

@push('scripts')
<script src="{{ asset('js/api-client.js') }}"></script>
@endpush

@section('content')
    <!-- Loading Indicator -->
    <div id="loadingIndicator" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="bg-white p-6 rounded-lg shadow-xl">
            <div class="flex items-center space-x-4">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <span class="text-lg font-medium">Loading data...</span>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Total Hama & Penyakit Card -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white shadow-lg relative overflow-hidden" style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-2xl font-bold mb-1" id="totalDiseasesCount">65</p>
                    <h3 class="text-lg font-medium opacity-90">Hama & Penyakit</h3>
                </div>
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 opacity-60">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Tambah Hama & Penyakit Card -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white shadow-lg relative overflow-hidden cursor-pointer hover:shadow-xl transition-shadow" onclick="showAddDiseaseModal()">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h3 class="text-lg font-medium mb-2">Tambah Data</h3>
                    <p class="text-sm opacity-75">Klik untuk menambah data hama & penyakit baru</p>
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
                <h2 class="text-xl font-bold text-gray-800">Hama & Penyakit</h2>
                <p class="text-sm text-gray-600">Kelola data hama dan penyakit tanaman</p>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Search -->
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari Hama & Penyakit..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onkeyup="filterDiseases()">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Type Filter -->
                <select id="typeFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onchange="filterDiseasesByType(this.value)">
                    <option value="">Semua Jenis</option>
                    <option value="Pest">Hama</option>
                    <option value="Disease">Penyakit</option>
                </select>

                <!-- Refresh Button -->
                <button onclick="refreshData()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Diseases Table -->
        <div>
            <table class="w-full" id="diseasesTable">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-3 px-2 text-gray-600 font-medium">No.</th>
                        <th class="text-left py-3 px-2 text-gray-600 font-medium">Nama</th>
                        <th class="text-left py-3 px-2 text-gray-600 font-medium">Tanaman</th>
                        <th class="text-left py-3 px-2 text-gray-600 font-medium">Fase</th>
                        <th class="text-left py-3 px-2 text-gray-600 font-medium">Actions</th>
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
    let diseasesData = [];
    let diseasesTable;

    // Initialize page
    $(document).ready(function() {
        console.log('Diseases page loaded');
        loadData();
    });

    // Load data using API client
    async function loadData() {
        try {
            api.showLoading();

            console.log('Fetching diseases data...');
            diseasesData = await api.getDiseases();
            console.log('Diseases data loaded:', diseasesData.length, 'items');

            console.log('Diseases data loaded successfully');
            updateUI();
        } catch (error) {
            console.error('Error loading diseases data:', error);
            // Load mock data as fallback
            diseasesData = api.getMockDiseases();
            updateUI();
        } finally {
            api.hideLoading();
        }
    }

    // Update UI with loaded data
    function updateUI() {
        // Update counts
        document.getElementById('totalDiseasesCount').textContent = diseasesData.length || 0;

        // Initialize DataTable
        initializeDataTable();
    }

    // Initialize DataTable
    function initializeDataTable() {
        if (diseasesTable) {
            diseasesTable.destroy();
        }

        // Prepare data for DataTables
        const tableData = diseasesData.map((disease, index) => {
            const actions = `
                <div class="flex space-x-2">
                    <button class="p-2 text-gray-600 hover:text-blue-600 border border-gray-300 rounded hover:border-blue-300 transition-colors" onclick="editDisease(${disease.id})" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button class="p-2 text-gray-600 hover:text-red-600 border border-gray-300 rounded hover:border-red-300 transition-colors" onclick="deleteDisease(${disease.id})" title="Delete">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            `;

            // Handle plants display
            let plantsDisplay = 'N/A';
            if (disease.plants_listed) {
                if (Array.isArray(disease.plants_listed)) {
                    plantsDisplay = disease.plants_listed.map(plant =>
                        typeof plant === 'string' ? plant : (plant.name || plant.common_name || 'Unknown')
                    ).join(', ');
                } else if (typeof disease.plants_listed === 'string') {
                    plantsDisplay = disease.plants_listed;
                }
            }

            // Type badge
            const typeColor = disease.type === 'Pest' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800';
            const typeBadge = `<span class="px-2 py-1 ${typeColor} rounded-full text-xs font-medium">${disease.type || 'Unknown'}</span>`;

            return [
                index + 1,
                disease.name || disease.common_name || disease.latin_name || 'Unknown',
                plantsDisplay,
                typeBadge,
                actions
            ];
        });

        diseasesTable = $('#diseasesTable').DataTable({
            data: tableData,
            columns: [
                { title: 'No.', width: '10%' },
                { title: 'Nama', width: '25%' },
                { title: 'Tanaman', width: '30%' },
                { title: 'Fase', width: '15%' },
                { title: 'Actions', width: '20%', orderable: false }
            ],
            order: [[1, 'asc']], // Default sort by name
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
                emptyTable: 'Tidak ada data hama & penyakit',
                zeroRecords: 'Tidak ditemukan data yang sesuai'
            },
            responsive: true,
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rt<"flex justify-start items-center mt-4"p>',
            initComplete: function() {
                // Style the search input
                $('.dataTables_filter input').addClass('px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500');
                $('.dataTables_length select').addClass('px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500');

                // Add row striping and borders
                $('#diseasesTable tbody tr').addClass('border-b border-gray-200');
                $('#diseasesTable tbody tr:nth-child(even)').addClass('bg-gray-50');
                $('#diseasesTable tbody tr:hover').addClass('bg-blue-50');

                // Style pagination buttons
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-2 mx-1 border border-gray-300 rounded-md hover:bg-gray-100 transition-colors');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-blue-500 text-white border-blue-500 hover:bg-blue-600');
                $('.dataTables_paginate .paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
            },
            drawCallback: function() {
                // Reapply row styling after each draw
                $('#diseasesTable tbody tr').addClass('border-b border-gray-200');
                $('#diseasesTable tbody tr:nth-child(even)').addClass('bg-gray-50');

                // Style pagination buttons
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-2 mx-1 border border-gray-300 rounded-md hover:bg-gray-100 transition-colors');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-blue-500 text-white border-blue-500 hover:bg-blue-600');
                $('.dataTables_paginate .paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
            }
        });
    }

    // Filter diseases by type
    function filterDiseasesByType(type) {
        if (!diseasesTable) return;

        if (!type) {
            diseasesTable.columns(3).search('').draw();
        } else {
            diseasesTable.columns(3).search(type).draw();
        }
    }

    // Filter diseases by search
    function filterDiseases() {
        const searchTerm = document.getElementById('searchInput').value;
        if (diseasesTable) {
            diseasesTable.search(searchTerm).draw();
        }
    }

    // Action functions
    function editDisease(id) {
        alert(`Edit hama/penyakit dengan ID: ${id}`);
    }

    function deleteDisease(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data hama/penyakit ini?')) {
            // Remove from data array
            diseasesData = diseasesData.filter(disease => disease.id !== id);
            // Reinitialize table
            initializeDataTable();
            // Update counts
            document.getElementById('totalDiseasesCount').textContent = diseasesData.length;
            alert(`Hama/penyakit dengan ID ${id} berhasil dihapus`);
        }
    }

    function showAddDiseaseModal() {
        alert('Fitur tambah hama & penyakit akan segera tersedia');
    }

    function refreshData() {
        loadData();
    }
</script>
@endpush
