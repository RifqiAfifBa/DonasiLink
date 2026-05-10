@extends('layout.navbarShelter')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-purple-200 shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-gray-700 font-semibold">$ DonasiLink</span>
            </div>
            <div class="flex gap-6">
                <a href="#" class="text-gray-600 hover:text-gray-800 font-medium">Dashboard</a>
                <a href="#" class="text-gray-600 hover:text-gray-800 font-medium">Withdrawal Tracking</a>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <form action="{{ route('shelter.updateKampanye', $kampanye->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
            @method('PUT')
            @csrf

            <!-- Image Upload Section -->
            <div class="mb-8">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-12 text-center bg-gray-100 hover:bg-gray-200 transition cursor-pointer relative group">
                    <input type="file" name="image" id="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400 mb-2 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-gray-500 font-medium">Upload Image</span>
                    </div>
                </div>
            </div>

            <!-- Form Fields -->
            <div class="space-y-4 mb-8">
                <!-- Nama Hewan -->
                <div>
                    <input type="text" name="nama_hewan" placeholder="Nama Hewan"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                        required>
                </div>

                <!-- Usia Hewan -->
                <div>
                    <input type="text" name="usia_hewan" placeholder="Usia Hewan"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                        required>
                </div>

                <!-- Sedang Sakit -->
                <div>
                    <select name="sedang_sakit"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                        required>
                        <option value="">Sedang Sakit (Ya / Tidak)</option>
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                    </select>
                </div>

                <!-- Kebutuhan Hewan -->
                <div>
                    <input type="text" name="kebutuhan_hewan" placeholder="Kebutuhan Hewan"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                        required>
                </div>

                <!-- Deskripsi Hewan -->
                <div>
                    <textarea name="deskripsi_hewan" placeholder="Deskripsi Hewan" rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                        required></textarea>
                </div>
            </div>

            <!-- Saldo Section -->
            <div class="grid grid-cols-2 gap-4 mb-8">
                <button type="button" class="px-6 py-3 bg-gray-300 text-gray-600 rounded-lg hover:bg-gray-400 transition font-medium">
                    Saldo Minimal
                </button>
                <button type="button" class="px-6 py-3 bg-gray-300 text-gray-600 rounded-lg hover:bg-gray-400 transition font-medium">
                    Saldo Maksimal
                </button>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button type="submit" class="w-full px-6 py-3 bg-purple-300 text-white rounded-lg hover:bg-purple-400 transition font-semibold text-lg">
                    UPLOAD
                </button>
                <a href="{{ route('shelter.landingpage') }}" class="block w-full px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-semibold text-lg text-center">
                    KEMBALI
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    /* Styling tambahan jika diperlukan */
    input[type="file"] {
        display: none;
    }
</style>
@endsection