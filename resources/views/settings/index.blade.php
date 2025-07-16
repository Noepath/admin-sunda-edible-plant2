@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan')

@section('content')
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-medium text-gray-900">Pengaturan Sistem</h2>
                <p class="text-sm text-gray-600">Kelola pengaturan aplikasi dan sistem</p>
            </div>
            <div class="flex space-x-2">
                <button onclick="resetSettings()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                    Reset ke Default
                </button>
                <button onclick="saveSettings()" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-md transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Simpan Pengaturan
                </button>
            </div>
        </div>
    </div>

    <!-- Settings Tabs -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="border-b border-gray-200">
            <nav class="flex space-x-8 px-6" aria-label="Tabs">
                <button onclick="switchTab('general')" class="tab-button border-b-2 border-purple-500 text-purple-600 py-4 px-1 text-sm font-medium">
                    Umum
                </button>
                <button onclick="switchTab('api')" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium">
                    API
                </button>
                <button onclick="switchTab('notification')" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium">
                    Notifikasi
                </button>
                <button onclick="switchTab('security')" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium">
                    Keamanan
                </button>
                <button onclick="switchTab('backup')" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium">
                    Backup
                </button>
            </nav>
        </div>

        <!-- General Settings -->
        <div id="general-tab" class="tab-content p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6">Pengaturan Umum</h3>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi</label>
                    <input type="text" id="appName" value="Sunda Edible Plant Admin"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Aplikasi</label>
                    <textarea id="appDescription" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">Admin dashboard untuk mengelola data tanaman yang dapat dimakan di Sunda</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Zona Waktu</label>
                    <select id="timezone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="Asia/Jakarta">Asia/Jakarta (WIB)</option>
                        <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                        <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bahasa</label>
                    <select id="language" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="id">Bahasa Indonesia</option>
                        <option value="en">English</option>
                        <option value="su">Basa Sunda</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Items per Halaman</label>
                    <select id="itemsPerPage" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="maintenanceMode" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="maintenanceMode" class="ml-2 block text-sm text-gray-700">
                        Mode Maintenance
                    </label>
                </div>
            </div>
        </div>

        <!-- API Settings -->
        <div id="api-tab" class="tab-content p-6 hidden">
            <h3 class="text-lg font-medium text-gray-900 mb-6">Pengaturan API</h3>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Base URL API</label>
                    <input type="url" id="apiBaseUrl" value="https://stapin.site/api/v1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">API Timeout (detik)</label>
                    <input type="number" id="apiTimeout" value="30" min="5" max="300"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rate Limit (request per menit)</label>
                    <input type="number" id="rateLimit" value="100" min="10" max="1000"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="apiLogging" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="apiLogging" class="ml-2 block text-sm text-gray-700">
                        Log API Requests
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="apiCache" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="apiCache" class="ml-2 block text-sm text-gray-700">
                        Cache API Responses
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cache Duration (menit)</label>
                    <input type="number" id="cacheDuration" value="15" min="1" max="1440"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-md">
                    <h4 class="text-sm font-medium text-blue-900 mb-2">API Status</h4>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-blue-700">API Connection: Online</span>
                    </div>
                    <div class="flex items-center space-x-2 mt-1">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <span class="text-sm text-blue-700">Last Response: 250ms</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Settings -->
        <div id="notification-tab" class="tab-content p-6 hidden">
            <h3 class="text-lg font-medium text-gray-900 mb-6">Pengaturan Notifikasi</h3>

            <div class="space-y-6">
                <div class="flex items-center">
                    <input type="checkbox" id="emailNotifications" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="emailNotifications" class="ml-2 block text-sm text-gray-700">
                        Notifikasi Email
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="pushNotifications" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="pushNotifications" class="ml-2 block text-sm text-gray-700">
                        Push Notifications
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="smsNotifications" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="smsNotifications" class="ml-2 block text-sm text-gray-700">
                        SMS Notifications
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Admin</label>
                    <input type="email" id="adminEmail" value="admin@plantapp.com"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notifikasi untuk:</label>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" id="notifyNewUser" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <label for="notifyNewUser" class="ml-2 block text-sm text-gray-700">
                                Pengguna baru mendaftar
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="notifyNewPlant" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <label for="notifyNewPlant" class="ml-2 block text-sm text-gray-700">
                                Tanaman baru ditambahkan
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="notifyNewDisease" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <label for="notifyNewDisease" class="ml-2 block text-sm text-gray-700">
                                Hama/penyakit baru ditambahkan
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="notifySystemError" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <label for="notifySystemError" class="ml-2 block text-sm text-gray-700">
                                Error sistem
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div id="security-tab" class="tab-content p-6 hidden">
            <h3 class="text-lg font-medium text-gray-900 mb-6">Pengaturan Keamanan</h3>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (menit)</label>
                    <input type="number" id="sessionTimeout" value="60" min="5" max="480"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Login Attempts</label>
                    <input type="number" id="maxLoginAttempts" value="5" min="3" max="10"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lockout Duration (menit)</label>
                    <input type="number" id="lockoutDuration" value="15" min="5" max="60"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="twoFactorAuth" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="twoFactorAuth" class="ml-2 block text-sm text-gray-700">
                        Two Factor Authentication
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="auditLog" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="auditLog" class="ml-2 block text-sm text-gray-700">
                        Audit Log
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="ipWhitelist" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="ipWhitelist" class="ml-2 block text-sm text-gray-700">
                        IP Whitelist
                    </label>
                </div>

                <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-md">
                    <h4 class="text-sm font-medium text-red-900 mb-2">Security Status</h4>
                    <div class="space-y-1">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-red-700">SSL Certificate: Valid</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-red-700">Firebase Auth: Connected</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <span class="text-sm text-red-700">Last Security Scan: 2 days ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backup Settings -->
        <div id="backup-tab" class="tab-content p-6 hidden">
            <h3 class="text-lg font-medium text-gray-900 mb-6">Pengaturan Backup</h3>

            <div class="space-y-6">
                <div class="flex items-center">
                    <input type="checkbox" id="autoBackup" checked class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <label for="autoBackup" class="ml-2 block text-sm text-gray-700">
                        Auto Backup
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Backup Schedule</label>
                    <select id="backupSchedule" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="daily">Harian</option>
                        <option value="weekly">Mingguan</option>
                        <option value="monthly">Bulanan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Backup Retention (hari)</label>
                    <input type="number" id="backupRetention" value="30" min="7" max="365"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Backup Storage</label>
                    <select id="backupStorage" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="local">Local Storage</option>
                        <option value="cloud">Cloud Storage</option>
                        <option value="both">Both</option>
                    </select>
                </div>

                <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-md">
                    <h4 class="text-sm font-medium text-green-900 mb-2">Backup Status</h4>
                    <div class="space-y-1">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-green-700">Last Backup: 2024-01-15 02:00:00</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-green-700">Backup Size: 25.6 MB</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-green-700">Next Backup: 2024-01-16 02:00:00</span>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button onclick="createBackup()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition-colors">
                        Buat Backup Sekarang
                    </button>
                    <button onclick="restoreBackup()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                        Restore Backup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Tab switching functionality
    function switchTab(tabName) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active class from all tab buttons
        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => {
            button.classList.remove('border-purple-500', 'text-purple-600');
            button.classList.add('border-transparent', 'text-gray-500');
        });

        // Show selected tab content
        document.getElementById(tabName + '-tab').classList.remove('hidden');

        // Add active class to selected tab button
        event.target.classList.remove('border-transparent', 'text-gray-500');
        event.target.classList.add('border-purple-500', 'text-purple-600');
    }

    // Settings management
    function saveSettings() {
        const settings = {
            general: {
                appName: document.getElementById('appName').value,
                appDescription: document.getElementById('appDescription').value,
                timezone: document.getElementById('timezone').value,
                language: document.getElementById('language').value,
                itemsPerPage: document.getElementById('itemsPerPage').value,
                maintenanceMode: document.getElementById('maintenanceMode').checked
            },
            api: {
                baseUrl: document.getElementById('apiBaseUrl').value,
                timeout: document.getElementById('apiTimeout').value,
                rateLimit: document.getElementById('rateLimit').value,
                logging: document.getElementById('apiLogging').checked,
                cache: document.getElementById('apiCache').checked,
                cacheDuration: document.getElementById('cacheDuration').value
            },
            notification: {
                email: document.getElementById('emailNotifications').checked,
                push: document.getElementById('pushNotifications').checked,
                sms: document.getElementById('smsNotifications').checked,
                adminEmail: document.getElementById('adminEmail').value,
                newUser: document.getElementById('notifyNewUser').checked,
                newPlant: document.getElementById('notifyNewPlant').checked,
                newDisease: document.getElementById('notifyNewDisease').checked,
                systemError: document.getElementById('notifySystemError').checked
            },
            security: {
                sessionTimeout: document.getElementById('sessionTimeout').value,
                maxLoginAttempts: document.getElementById('maxLoginAttempts').value,
                lockoutDuration: document.getElementById('lockoutDuration').value,
                twoFactorAuth: document.getElementById('twoFactorAuth').checked,
                auditLog: document.getElementById('auditLog').checked,
                ipWhitelist: document.getElementById('ipWhitelist').checked
            },
            backup: {
                autoBackup: document.getElementById('autoBackup').checked,
                schedule: document.getElementById('backupSchedule').value,
                retention: document.getElementById('backupRetention').value,
                storage: document.getElementById('backupStorage').value
            }
        };

        // Save to localStorage for demo purposes
        localStorage.setItem('adminSettings', JSON.stringify(settings));

        showSuccessMessage('Pengaturan berhasil disimpan');
        console.log('Settings saved:', settings);
    }

    function resetSettings() {
        if (confirm('Apakah Anda yakin ingin mengembalikan semua pengaturan ke default?')) {
            // Reset all form fields to default values
            document.getElementById('appName').value = 'Sunda Edible Plant Admin';
            document.getElementById('appDescription').value = 'Admin dashboard untuk mengelola data tanaman yang dapat dimakan di Sunda';
            document.getElementById('timezone').value = 'Asia/Jakarta';
            document.getElementById('language').value = 'id';
            document.getElementById('itemsPerPage').value = '10';
            document.getElementById('maintenanceMode').checked = false;

            document.getElementById('apiBaseUrl').value = 'https://stapin.site/api/v1';
            document.getElementById('apiTimeout').value = '30';
            document.getElementById('rateLimit').value = '100';
            document.getElementById('apiLogging').checked = true;
            document.getElementById('apiCache').checked = true;
            document.getElementById('cacheDuration').value = '15';

            document.getElementById('emailNotifications').checked = true;
            document.getElementById('pushNotifications').checked = true;
            document.getElementById('smsNotifications').checked = false;
            document.getElementById('adminEmail').value = 'admin@plantapp.com';
            document.getElementById('notifyNewUser').checked = true;
            document.getElementById('notifyNewPlant').checked = true;
            document.getElementById('notifyNewDisease').checked = true;
            document.getElementById('notifySystemError').checked = true;

            document.getElementById('sessionTimeout').value = '60';
            document.getElementById('maxLoginAttempts').value = '5';
            document.getElementById('lockoutDuration').value = '15';
            document.getElementById('twoFactorAuth').checked = false;
            document.getElementById('auditLog').checked = true;
            document.getElementById('ipWhitelist').checked = false;

            document.getElementById('autoBackup').checked = true;
            document.getElementById('backupSchedule').value = 'daily';
            document.getElementById('backupRetention').value = '30';
            document.getElementById('backupStorage').value = 'local';

            // Remove from localStorage
            localStorage.removeItem('adminSettings');

            showSuccessMessage('Pengaturan berhasil direset ke default');
        }
    }

    function loadSettings() {
        const saved = localStorage.getItem('adminSettings');
        if (saved) {
            const settings = JSON.parse(saved);

            // Load general settings
            if (settings.general) {
                document.getElementById('appName').value = settings.general.appName || 'Sunda Edible Plant Admin';
                document.getElementById('appDescription').value = settings.general.appDescription || '';
                document.getElementById('timezone').value = settings.general.timezone || 'Asia/Jakarta';
                document.getElementById('language').value = settings.general.language || 'id';
                document.getElementById('itemsPerPage').value = settings.general.itemsPerPage || '10';
                document.getElementById('maintenanceMode').checked = settings.general.maintenanceMode || false;
            }

            // Load other settings similarly...
        }
    }

    // Backup functions
    function createBackup() {
        showLoading();

        // Simulate backup creation
        setTimeout(() => {
            hideLoading();
            showSuccessMessage('Backup berhasil dibuat');
        }, 2000);
    }

    function restoreBackup() {
        if (confirm('Apakah Anda yakin ingin restore backup? Semua data saat ini akan digantikan.')) {
            showLoading();

            // Simulate backup restoration
            setTimeout(() => {
                hideLoading();
                showSuccessMessage('Backup berhasil direstore');
            }, 3000);
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        loadSettings();
    });
</script>
@endpush
