@extends('layouts.admin')

@section('title', 'User List')
@section('page-title', 'User List')

@section('content')
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-yellow-400 rounded-lg shadow-sm p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Total User</p>
                    <p class="text-3xl font-bold" id="totalUsers">14</p>
                </div>
                <div class="text-right">
                    <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-green-400 rounded-lg shadow-sm p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-90">Tambah User</p>
                    <p class="text-3xl font-bold">+</p>
                </div>
                <div class="text-right">
                    <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <table id="usersTable" class="w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">No.</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Nama Lengkap</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">No.Hp</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">E-Mail</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody" class="bg-white">
                    <!-- Data akan diload dari DataTables -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bulk Actions -->
    <div id="bulkActions" class="hidden fixed bottom-4 right-4 bg-white rounded-lg shadow-lg border border-gray-200 p-4">
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-600"><span id="selectedCount">0</span> item dipilih</span>
            <button onclick="bulkAction('activate')" class="px-3 py-1 bg-green-600 text-white text-sm rounded-md hover:bg-green-700">
                Aktifkan
            </button>
            <button onclick="bulkAction('deactivate')" class="px-3 py-1 bg-gray-600 text-white text-sm rounded-md hover:bg-gray-700">
                Nonaktifkan
            </button>
            <button onclick="bulkAction('delete')" class="px-3 py-1 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                Hapus
            </button>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let usersTable;
    let usersData = [];

    // Load users data
    async function loadUsers() {
        showLoading();
        try {
            // For now, load dummy data since we don't have a users API endpoint
            loadDummyUsers();
            initializeDataTable();
            updateStatistics();

        } catch (error) {
            console.error('Error loading users:', error);
            showErrorMessage('Failed to load users data: ' + error.message);
            loadDummyUsers();
            initializeDataTable();
            updateStatistics();
        } finally {
            hideLoading();
        }
    }

    // Load dummy users for demo
    function loadDummyUsers() {
        usersData = [
            {
                id: 1,
                name: 'Ayita Haley',
                email: 'a.haley@gmail.com',
                phone: '0853 1234 2234',
                role: 'admin',
                status: 'active',
                photo: null,
                last_login: '2024-01-15 10:30:00',
                created_at: '2024-01-01',
                firebase_uid: 'uid123'
            },
            {
                id: 2,
                name: 'Jaden Bison',
                email: 'jaden.n@gmail.com',
                phone: '0853 1234 2234',
                role: 'user',
                status: 'active',
                photo: null,
                last_login: '2024-01-14 15:45:00',
                created_at: '2024-01-10',
                firebase_uid: 'uid456'
            },
            {
                id: 3,
                name: 'Ace Foley',
                email: 'ace.foley@uco.com',
                phone: '0853 1234 2234',
                role: 'user',
                status: 'inactive',
                photo: null,
                last_login: '2024-01-12 09:15:00',
                created_at: '2024-01-08',
                firebase_uid: 'uid789'
            },
            {
                id: 4,
                name: 'Nikolai Schmidt',
                email: 'nikolai.schmidt1984@outlook.com',
                phone: '0853 1234 2234',
                role: 'user',
                status: 'active',
                photo: null,
                last_login: '2024-01-15 08:20:00',
                created_at: '2024-01-05',
                firebase_uid: 'uid101'
            },
            {
                id: 5,
                name: 'Clayton Charles',
                email: 'me@clayton.com',
                phone: '0853 1234 2234',
                role: 'user',
                status: 'active',
                photo: null,
                last_login: '2024-01-13 16:30:00',
                created_at: '2024-01-03',
                firebase_uid: 'uid102'
            },
            {
                id: 6,
                name: 'Prince Chiri',
                email: 'prince.chiri197@gmail.com',
                phone: '0853 1234 2234',
                role: 'user',
                status: 'active',
                photo: null,
                last_login: '2024-01-13 16:30:00',
                created_at: '2024-01-03',
                firebase_uid: 'uid103'
            },
            {
                id: 7,
                name: 'Reece Duran',
                email: 'reece@yahoo.com',
                phone: '0853 1234 2234',
                role: 'user',
                status: 'active',
                photo: null,
                last_login: '2024-01-13 16:30:00',
                created_at: '2024-01-03',
                firebase_uid: 'uid104'
            },
            {
                id: 8,
                name: 'Anastasia Mccann',
                email: 'anastasia.spring@roundhilljs.com',
                phone: '0853 1234 2234',
                role: 'user',
                status: 'active',
                photo: null,
                last_login: '2024-01-13 16:30:00',
                created_at: '2024-01-03',
                firebase_uid: 'uid105'
            }
        ];
    }

    // Initialize DataTable
    function initializeDataTable() {
        if (usersTable) {
            usersTable.destroy();
        }

        // Prepare data for DataTables
        const tableData = usersData.map((user, index) => {
            const actions = `
                <div class="flex space-x-2">
                    <button onclick="editUser(${user.id})" class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md transition-colors" title="Edit">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                    </button>
                    <button onclick="deleteUser(${user.id})" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors" title="Delete">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            `;

            return [
                index + 1,
                user.name || 'Unknown',
                user.phone || '-',
                user.email || '-',
                actions
            ];
        });

        usersTable = $('#usersTable').DataTable({
            data: tableData,
            columns: [
                { title: 'No.', width: '10%' },
                { title: 'Nama Lengkap', width: '25%' },
                { title: 'No.Hp', width: '20%' },
                { title: 'E-Mail', width: '25%' },
                { title: 'Aksi', width: '20%', orderable: false }
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
                emptyTable: 'Tidak ada data yang tersedia',
                zeroRecords: 'Tidak ditemukan data yang sesuai'
            },
            responsive: true,
            dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rt<"flex justify-start items-center mt-4"p>',
            initComplete: function() {
                // Style the search input
                $('.dataTables_filter input').addClass('px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500');
                $('.dataTables_length select').addClass('px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500');

                // Add row styling
                $('#usersTable tbody tr').addClass('border-b border-gray-100');
                $('#usersTable tbody tr:nth-child(even)').addClass('bg-gray-50');
                $('#usersTable tbody tr:hover').addClass('bg-blue-50');

                // Style table cells
                $('#usersTable tbody td').addClass('px-4 py-3 text-sm text-gray-900');
                $('#usersTable tbody td:first-child').addClass('font-medium text-gray-500');

                // Style pagination buttons
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-2 mx-1 border border-gray-300 rounded-md hover:bg-gray-100 transition-colors text-sm');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-blue-500 text-white border-blue-500 hover:bg-blue-600');
                $('.dataTables_paginate .paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
            },
            drawCallback: function() {
                // Reapply row styling after each draw
                $('#usersTable tbody tr').addClass('border-b border-gray-100');
                $('#usersTable tbody tr:nth-child(even)').addClass('bg-gray-50');

                // Style table cells
                $('#usersTable tbody td').addClass('px-4 py-3 text-sm text-gray-900');
                $('#usersTable tbody td:first-child').addClass('font-medium text-gray-500');

                // Style pagination buttons
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-2 mx-1 border border-gray-300 rounded-md hover:bg-gray-100 transition-colors text-sm');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-blue-500 text-white border-blue-500 hover:bg-blue-600');
                $('.dataTables_paginate .paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
            }
        });
    }

    // Update statistics
    function updateStatistics() {
        const total = usersData.length;
        document.getElementById('totalUsers').textContent = total;
    }

    // Action functions
    function addUser() {
        showSuccessMessage('Fitur tambah pengguna akan segera tersedia');
    }

    function editUser(id) {
        showSuccessMessage(`Edit pengguna ID: ${id}`);
    }

    function deleteUser(id) {
        if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
            usersData = usersData.filter(user => user.id !== id);
            initializeDataTable();
            updateStatistics();
            showSuccessMessage('Pengguna berhasil dihapus');
        }
    }

    // Helper functions
    function showLoading() {
        if (document.getElementById('loadingState')) {
            document.getElementById('loadingState').classList.remove('hidden');
        }
    }

    function hideLoading() {
        if (document.getElementById('loadingState')) {
            document.getElementById('loadingState').classList.add('hidden');
        }
    }

    function showSuccessMessage(message) {
        alert(message);
    }

    function showErrorMessage(message) {
        alert(message);
    }

    // Event listeners
    $(document).ready(function() {
        loadUsers();
    });
</script>
@endpush
