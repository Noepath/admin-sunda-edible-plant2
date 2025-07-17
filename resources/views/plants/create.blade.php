@extends('layouts.admin')

@section('title', 'Tambah Tanaman')
@section('page-title', 'Tambah Tanaman')

@section('content')
    <form id="plantForm" action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Menggunakan Flexbox untuk layout 2 kolom di layar besar --}}
        <div class="flex flex-wrap lg:flex-nowrap -mx-3 ">

            <div class="w-full lg:w-2/3 px-3">
                <div class="p-6">
                    {{-- Nama Tanaman, Ilmiah, Deskripsi, dll. --}}
                    <div class="mb-4">
                        <label for="nama_tanaman" class="block text-sm font-medium text-gray-700 mb-2">Nama Tanaman</label>
                        <input type="text" id="nama_tanaman" name="nama_tanaman"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="nama_ilmiah" class="block text-sm font-medium text-gray-700 mb-2">Nama Ilmiah</label>
                        <input type="text" id="nama_ilmiah" name="nama_ilmiah"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="mb-4">
                        <label for="nama_daerah" class="block text-sm font-medium text-gray-700 mb-2">Nama Daerah</label>
                        <input type="text" id="nama_daerah" name="nama_daerah"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi_singkat" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                            Singkat</label>
                        <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="manfaat_tanaman" class="block text-sm font-medium text-gray-700 mb-2">Manfaat
                            Tanaman</label>
                        <textarea id="manfaat_tanaman" name="manfaat_tanaman" rows="6"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>

                    {{-- FORM TAMBAHAN YANG BARU --}}
                    <hr class="my-6 border-gray-300">

                    {{-- Informasi Dasar --}}
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Informasi Dasar</h3>
                    <div class="mb-4">
                        <label for="toksisitas_manusia" class="block text-sm font-medium text-gray-700 mb-2">Toksisitas bagi
                            Manusia</label>
                        <textarea id="toksisitas_manusia" name="toksisitas_manusia" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="beracun_hewan" class="block text-sm font-medium text-gray-700 mb-2">Beracun untuk
                            Hewan</label>
                        <input type="text" id="beracun_hewan" name="beracun_hewan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="mb-4">
                        <label for="potensi_gulma" class="block text-sm font-medium text-gray-700 mb-2">Potensi
                            Gulma</label>
                        <input type="text" id="potensi_gulma" name="potensi_gulma"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="mb-4">
                        <label for="habitat" class="block text-sm font-medium text-gray-700 mb-2">Habitat</label>
                        <textarea id="habitat" name="habitat" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="jenis_tanaman" class="block text-sm font-medium text-gray-700 mb-2">Jenis
                            Tanaman</label>
                        <input type="text" id="jenis_tanaman" name="jenis_tanaman"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="mb-4">
                        <label for="harapan_hidup_dasar" class="block text-sm font-medium text-gray-700 mb-2">Harapan Hidup
                            (Dasar)</label>
                        <input type="text" id="harapan_hidup_dasar" name="harapan_hidup_dasar"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <hr class="my-6 border-gray-300">

                    {{-- Karakteristik Tanaman --}}
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Karakteristik Tanaman</h3>
                    <div class="mb-4">
                        <label for="tinggi_maksimal" class="block text-sm font-medium text-gray-700 mb-2">Tinggi
                            Maksimal</label>
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
                        <label for="jenis_batang" class="block text-sm font-medium text-gray-700 mb-2">Jenis
                            Batang</label>
                        <input type="text" id="jenis_batang" name="jenis_batang"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="mb-4">
                        <label for="jenis_akar" class="block text-sm font-medium text-gray-700 mb-2">Jenis Akar</label>
                        <input type="text" id="jenis_akar" name="jenis_akar"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <hr class="my-6 border-gray-300">

                    {{-- Pertumbuhan --}}
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Pertumbuhan</h3>
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
                        <label for="harapan_hidup_pertumbuhan"
                            class="block text-sm font-medium text-gray-700 mb-2">Harapan Hidup (Pertumbuhan)</label>
                        <input type="text" id="harapan_hidup_pertumbuhan" name="harapan_hidup_pertumbuhan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3 px-3 mt-6 lg:mt-0">
                <div class="p-6 mb-6 top-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Aksi</h3>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-md transition-colors">
                        Simpan Tanaman
                    </button>
                </div>

                <div class="p-6 mb-6 top-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Sampul</h3>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 mb-4">
                        <div id="coverPreviewWrapper">
                            <svg id="coverPreviewIcon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="relative flex justify-center">
                                <img id="coverPreviewImg" src="#" alt="Preview Sampul" class="mx-auto h-48 w-auto rounded-md hidden object-contain border border-gray-300 bg-white" />
                                <button type="button" id="removeCoverBtn" class="hidden absolute top-2 right-2 bg-white bg-opacity-80 rounded-full p-1 shadow hover:bg-red-500 hover:text-white transition-colors" title="Hapus gambar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                        </div>
                        <label for="cover_image"
                            class="mt-2 text-sm text-green-600 hover:text-green-500 font-medium cursor-pointer">
                            Choose File
                            <input id="cover_image" name="cover_image" type="file" class="sr-only" accept="image/*">
                        </label>
                    </div>
                    <button type="button" onclick="document.getElementById('cover_image').click()"
                        class="w-full bg-green-500 hover:bg-green-600 text-white text-sm py-2 px-4 rounded-md transition-colors">Choose
                        File</button>

                    <div class="mb-6 mt-12">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Gambar Slide</h3>
                        <div class="space-y-4">
                            <!-- Slide Images Upload -->
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50">
                            <div class="space-y-2">
                                <div id="slidePreviewWrapper" class="flex flex-wrap gap-4 justify-center"></div>
                                <svg class="mx-auto h-12 w-12 text-gray-400" id="slidePreviewIcon" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="text-sm text-gray-700">
                                    <label for="slide_images" class="cursor-pointer">
                                        <span class="text-green-600 hover:text-green-500">Choose Files</span>
                                        <input id="slide_images" name="slide_images[]" type="file"
                                            class="sr-only" accept="image/*" multiple>
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

                    <div class="p-6 top-[28rem]">
                        <a href="{{ route('categories.index') }}" class="block">
                            <h3 class="text-xl font-bold mb-4 text-gray-800 hover:text-green-600">Kategori Tanaman</h3>
                        </a>
                        <div id="kategoriContainer" class="space-y-2"></div>
                    </div>
                </div>
            </div>

    </form>
@endsection


@push('scripts')
    <script>
        // Handle cover image upload & preview & remove
        const coverInput = document.getElementById('cover_image');
        const coverImg = document.getElementById('coverPreviewImg');
        const coverIcon = document.getElementById('coverPreviewIcon');
        const removeCoverBtn = document.getElementById('removeCoverBtn');
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
            } else {
                coverImg.src = '#';
                coverImg.classList.add('hidden');
                coverIcon.classList.remove('hidden');
                removeCoverBtn.classList.add('hidden');
            }
        });
        removeCoverBtn.addEventListener('click', function() {
            coverInput.value = '';
            coverImg.src = '#';
            coverImg.classList.add('hidden');
            coverIcon.classList.remove('hidden');
            removeCoverBtn.classList.add('hidden');
        });

        // Handle slide images upload, preview, and remove
        const slideInput = document.getElementById('slide_images');
        const slidePreviewWrapper = document.getElementById('slidePreviewWrapper');
        const slidePreviewIcon = document.getElementById('slidePreviewIcon');
        slideInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            slidePreviewWrapper.innerHTML = '';
            if (files.length > 0) {
                slidePreviewIcon.classList.add('hidden');
                files.forEach((file, idx) => {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        const div = document.createElement('div');
                        div.className = 'relative inline-block';
                        div.innerHTML = `
                            <img src="${ev.target.result}" class="h-32 w-auto rounded-md object-contain border border-gray-300 bg-white" />
                            <button type="button" data-idx="${idx}" class="remove-slide-btn absolute top-1 right-1 bg-white bg-opacity-80 rounded-full p-1 shadow hover:bg-red-500 hover:text-white transition-colors" title="Hapus gambar">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4 w-4\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\" /></svg>
                            </button>
                        `;
                        slidePreviewWrapper.appendChild(div);
                        div.querySelector('.remove-slide-btn').addEventListener('click', function() {
                            removeSlideImage(idx);
                        });
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                slidePreviewIcon.classList.remove('hidden');
            }
        });

        // Remove slide image by index
        function removeSlideImage(idx) {
            const dt = new DataTransfer();
            const files = Array.from(slideInput.files);
            files.splice(idx, 1);
            files.forEach(f => dt.items.add(f));
            slideInput.files = dt.files;
            slideInput.dispatchEvent(new Event('change'));
        }

        // Render kategori dari API
        window.api.getPlantCategories().then(function(categories) {
            const container = document.getElementById('kategoriContainer');
            if (!Array.isArray(categories) || categories.length === 0) {
                container.innerHTML = '<div class="text-gray-500 text-sm">Tidak ada kategori tersedia</div>';
                return;
            }
            container.innerHTML = categories.map(cat => `
                <label class="flex items-center">
                    <input type="radio" name="kategori" value="${cat.id}" class="mr-2 text-green-600">
                    <span class="text-sm text-gray-800">${cat.name || cat.nama_kategori}</span>
                </label>
            `).join('');
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
