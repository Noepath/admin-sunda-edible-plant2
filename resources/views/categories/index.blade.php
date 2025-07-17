@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('page-title', 'Kategori')

@section('content')
    <div class="flex flex-wrap lg:flex-nowrap -mx-3">
        {{-- Kolom Kiri: Form Tambah Kategori --}}
        <div class="w-full lg:w-1/2 px-3">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>
                <form id="categoryForm">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                        <input type="text" id="nama_kategori" name="nama_kategori"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">Sampul</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50">
                            <div id="coverPreviewWrapper">
                                <svg id="coverPreviewIcon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                    fill="none" viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="relative flex justify-center">
                                    <img id="coverPreviewImg" src="#" alt="Preview Sampul"
                                        class="mx-auto h-48 w-auto rounded-md hidden object-contain border border-gray-300 bg-white" />
                                    <button type="button" id="removeCoverBtn"
                                        class="hidden absolute top-2 right-2 bg-white bg-opacity-80 rounded-full p-1 shadow hover:bg-red-500 hover:text-white transition-colors"
                                        title="Hapus gambar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <label for="cover_image_input"
                                class="mt-2 text-sm text-green-600 hover:text-green-500 font-medium cursor-pointer">
                                Choose File
                                <input id="cover_image_input" name="cover_image" type="file" class="sr-only"
                                    accept="image/*">
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi_kategori" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                            Kategori</label>
                        <textarea id="deskripsi_kategori" name="deskripsi_kategori" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-md transition-colors">
                        Tambah Kategori
                    </button>
                </form>
            </div>
        </div>

        {{-- Kolom Kanan: Daftar Kategori Tersimpan --}}
        <div class="w-full lg:w-1/2 px-3 mt-6 lg:mt-0">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Kategori Tersimpan</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="categoriesTableBody" class="bg-white divide-y divide-gray-200">
                            {{-- Data kategori akan dimuat di sini oleh JavaScript --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const coverInput = document.getElementById('cover_image_input');
            const coverImg = document.getElementById('coverPreviewImg');
            const coverIcon = document.getElementById('coverPreviewIcon');
            const removeCoverBtn = document.getElementById('removeCoverBtn');
            const categoriesTableBody = document.getElementById('categoriesTableBody');
            const categoryForm = document.getElementById('categoryForm');

            // Fungsi untuk memuat kategori
            function loadCategories() {
                window.api.getPlantCategories().then(function(categories) {
                    categoriesTableBody.innerHTML = ''; // Kosongkan tabel sebelum memuat data baru
                    if (Array.isArray(categories) && categories.length > 0) {
                        categories.forEach(cat => {
                            const row = `
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">${cat.name || cat.nama_kategori}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900 ml-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            `;
                            categoriesTableBody.innerHTML += row;
                        });
                    } else {
                        categoriesTableBody.innerHTML = '<tr><td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada kategori.</td></tr>';
                    }
                }).catch(error => {
                    console.error('Error loading categories:', error);
                    categoriesTableBody.innerHTML = '<tr><td colspan="2" class="px-6 py-4 text-center text-red-500">Gagal memuat kategori.</td></tr>';
                });
            }

            // Handle cover image preview
            coverInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        coverImg.src = ev.target.result;
                        coverImg.classList.remove('hidden');
                        coverIcon.classList.add('hidden');
                        removeCoverBtn.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle remove cover image
            removeCoverBtn.addEventListener('click', function() {
                coverInput.value = '';
                coverImg.src = '#';
                coverImg.classList.add('hidden');
                coverIcon.classList.remove('hidden');
                removeCoverBtn.classList.add('hidden');
            });

            // Handle form submission
            categoryForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('nama_kategori').value.trim();
                const description = document.getElementById('deskripsi_kategori').value.trim();
                // You can set plant_count to 0 or calculate it if needed
                const payload = {
                    name: name,
                    description: description,
                    plant_count: 0
                };
                const submitBtn = categoryForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Menyimpan...';
                submitBtn.disabled = true;

                window.api.post('/plant-categories', payload).then(function(response) {
                    if (response) {
                        alert('Kategori berhasil ditambahkan!');
                        categoryForm.reset();
                        removeCoverBtn.click(); // Reset preview
                        loadCategories(); // Reload categories
                    } else {
                        alert('Gagal menambahkan kategori. Respons tidak valid.');
                    }
                }).catch(function(error) {
                    console.error('Error creating category:', error);
                    alert('Gagal menambahkan kategori. Silakan coba lagi.');
                }).finally(function() {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                });
            });

            // Initial load
            loadCategories();
        });
    </script>
@endpush
