@extends('layouts.admin')

@section('title', 'Tambah Tanaman')
@section('page-title', 'Tambah Tanaman')


@section('content')
    <div class="flex h-screen overflow-y-auto">
        <div class="flex-1 p-4">
            <form id="plantForm" action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Tanaman -->
            <div class="mb-4">
                <label for="nama_tanaman" class="block text-sm font-medium text-gray-700 mb-2">Nama Tanaman</label>
                <input type="text" id="nama_tanaman" name="nama_tanaman"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>

            <!-- Nama Ilmiah -->
            <div class="mb-4">
                <label for="nama_ilmiah" class="block text-sm font-medium text-gray-700 mb-2">Nama Ilmiah</label>
                <input type="text" id="nama_ilmiah" name="nama_ilmiah"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>

            <!-- Nama Daerah -->
            <div class="mb-4">
                <label for="nama_daerah" class="block text-sm font-medium text-gray-700 mb-2">Nama Daerah</label>
                <input type="text" id="nama_daerah" name="nama_daerah"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Deskripsi Singkat -->
            <div class="mb-4">
                <label for="deskripsi_singkat" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                    Singkat</label>
                <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    placeholder="Masukkan deskripsi singkat tentang tanaman..."></textarea>
            </div>

            <!-- Manfaat Tanaman -->
            <div class="mb-4">
                <label for="manfaat_tanaman" class="block text-sm font-medium text-gray-700 mb-2">Manfaat Tanaman</label>
                <textarea id="manfaat_tanaman" name="manfaat_tanaman" rows="6"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    placeholder="Jelaskan manfaat dan kegunaan tanaman..."></textarea>
            </div>

            <h2 class="text-2xl font-bold mb-4 mt-6 text-gray-800">Informasi Dasar</h2>
            <div class="mb-4">
                <label for="toksisitas_manusia" class="block text-sm font-medium text-gray-700 mb-2">Toksisitas bagi
                    Manusia</label>
                <input id="toksisitas_manusia" name="toksisitas_manusia" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="beracun_hewan" class="block text-sm font-medium text-gray-700 mb-2">Beracun untuk Hewan</label>
                <input type="text" id="beracun_hewan" name="beracun_hewan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="potensi_gulma" class="block text-sm font-medium text-gray-700 mb-2">Potensi Gulma</label>
                <input type="text" id="potensi_gulma" name="potensi_gulma"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="habitat" class="block text-sm font-medium text-gray-700 mb-2">Habitat</label>
                <input id="habitat" name="habitat" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="jenis_tanaman" class="block text-sm font-medium text-gray-700 mb-2">Jenis Tanaman</label>
                <input type="text" id="jenis_tanaman" name="jenis_tanaman"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="harapan_hidup_dasar" class="block text-sm font-medium text-gray-700 mb-2">Harapan Hidup</label>
                <input type="text" id="harapan_hidup_dasar" name="harapan_hidup_dasar"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <h2 class="text-2xl font-bold mb-4 mt-6 text-gray-800">Karakteristik Tanaman</h2>

            <div class="mb-4">
                <label for="tinggi_maksimal" class="block text-sm font-medium text-gray-700 mb-2">Tinggi Maksimal</label>
                <input type="text" id="tinggi_maksimal" name="tinggi_maksimal"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="warna_daun" class="block text-sm font-medium text-gray-700 mb-2">Warna Daun</label>
                <input type="text" id="warna_daun" name="warna_daun"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="bentuk_daun" class="block text-sm font-medium text-gray-700 mb-2">Bentuk Daun</label>
                <input type="text" id="bentuk_daun" name="bentuk_daun"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="jenis_batang" class="block text-sm font-medium text-gray-700 mb-2">Jenis Batang</label>
                <input type="text" id="jenis_batang" name="jenis_batang"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="jenis_akar" class="block text-sm font-medium text-gray-700 mb-2">Jenis Akar</label>
                <input type="text" id="jenis_akar" name="jenis_akar"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <h2 class="text-2xl font-bold mb-4 mt-6 text-gray-800">Pertumbuhan</h2>

            <div class="mb-4">
                <label for="lama_tumbuh" class="block text-sm font-medium text-gray-700 mb-2">Lama Tumbuh</label>
                <input type="text" id="lama_tumbuh" name="lama_tumbuh"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="musim_panen" class="block text-sm font-medium text-gray-700 mb-2">Musim Panen</label>
                <input type="text" id="musim_panen" name="musim_panen"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="waktu_panen" class="block text-sm font-medium text-gray-700 mb-2">Waktu Panen</label>
                <input type="text" id="waktu_panen" name="waktu_panen"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="harapan_hidup_pertumbuhan" class="block text-sm font-medium text-gray-700 mb-2">Harapan
                    Hidup</label>
                <input type="text" id="harapan_hidup_pertumbuhan" name="harapan_hidup_pertumbuhan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            </form>
        </div>
@endsection

@section('right-sidebar')
    <div class="flex flex-col min-h-full h-full">
        <!-- Simpan Tanaman Button -->
        <div class="mb-6">
            <button type="submit" form="plantForm"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
                Simpan Tanaman
            </button>
        </div>

        <!-- Sampul Section -->
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Sampul</h3>
            <div class="space-y-4">
                <!-- Cover Image Upload -->
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50">
                    <div class="space-y-2">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="text-sm text-gray-700">
                            <label for="cover_image" class="cursor-pointer">
                                <span class="text-green-600 hover:text-green-500">Choose File</span>
                                <input id="cover_image" name="cover_image" type="file" class="sr-only"
                                    accept="image/*">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" onclick="document.getElementById('cover_image').click()"
                        class="w-full bg-green-500 hover:bg-green-600 text-white text-sm py-2 px-4 rounded-md transition-colors">
                        Choose File
                    </button>
                </div>
            </div>
        </div>

        <!-- Gambar Slide Section -->
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Gambar Slide</h3>
            <div class="space-y-4">
                <!-- Slide Images Upload -->
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50">
                    <div class="space-y-2">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="text-sm text-gray-700">
                            <label for="slide_images" class="cursor-pointer">
                                <span class="text-green-600 hover:text-green-500">Choose Files</span>
                                <input id="slide_images" name="slide_images[]" type="file" class="sr-only"
                                    accept="image/*" multiple>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" onclick="document.getElementById('slide_images').click()"
                        class="w-full bg-green-500 hover:bg-green-600 text-white text-sm py-2 px-4 rounded-md transition-colors">
                        Choose File
                    </button>
                </div>
                <!-- Selected files preview -->
                <div id="slideImagesPreview" class="space-y-2 hidden">
                    <div class="text-sm text-gray-700">Selected files:</div>
                    <div id="slideFilesList" class="text-sm text-gray-800"></div>
                </div>
            </div>
        </div>

        <!-- Kategori Tanaman Section -->
        <div>
            <h3 class="text-lg font-medium text-gray-800 mb-4">Kategori Tanaman</h3>
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="radio" name="kategori" value="umum" class="mr-2 text-green-600">
                    <span class="text-sm text-gray-800">Tanaman Umum (Default sistem)</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="kategori" value="pangan" class="mr-2 text-green-600">
                    <span class="text-sm text-gray-800">Tanaman Pangan</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="kategori" value="buah" class="mr-2 text-green-600">
                    <span class="text-sm text-gray-800">Tanaman Buah</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="kategori" value="obat_keluarga" class="mr-2 text-green-600">
                    <span class="text-sm text-gray-800">Tanaman Obat Keluarga</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="kategori" value="hias" class="mr-2 text-green-600">
                    <span class="text-sm text-gray-800">Tanaman Hias</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="kategori" value="tempat_bumbu_keluarga" class="mr-2 text-green-600">
                    <span class="text-sm text-gray-800">Tanaman Tempat & Bumbu Keluarga</span>
                </label>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Handle cover image upload
        document.getElementById('cover_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                console.log('Cover image selected:', file.name);
                // You can add preview functionality here
            }
        });

        // Handle slide images upload
        document.getElementById('slide_images').addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            const preview = document.getElementById('slideImagesPreview');
            const filesList = document.getElementById('slideFilesList');

            if (files.length > 0) {
                preview.classList.remove('hidden');
                filesList.innerHTML = files.map(file => `<div>• ${file.name}</div>`).join('');
            } else {
                preview.classList.add('hidden');
            }
        });

        // Handle form submission
        document.getElementById('plantForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic validation
            const namaTanaman = document.getElementById('nama_tanaman').value.trim();
            const namaIlmiah = document.getElementById('nama_ilmiah').value.trim();
            const kategori = document.querySelector('input[name="kategori"]:checked');

            if (!namaTanaman) {
                alert('Nama tanaman harus diisi');
                return;
            }

            if (!namaIlmiah) {
                alert('Nama ilmiah harus diisi');
                return;
            }

            if (!kategori) {
                alert('Kategori tanaman harus dipilih');
                return;
            }

            // Show loading state
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Menyimpan...';
            submitBtn.disabled = true;

            // For now, just show success message
            setTimeout(() => {
                alert('Tanaman berhasil disimpan!');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                // You can redirect or reset form here
            }, 1000);
        });
    </script>
@endpush
