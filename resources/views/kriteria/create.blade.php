<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kriteria Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">

                    @if ($errors->any())
                    <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-3 rounded-lg">
                        <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('kriteria.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="kode_kriteria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Kriteria</label>
                                <input type="text" name="kode_kriteria" id="kode_kriteria" value="{{ old('kode_kriteria') }}"
                                    class="mt-1 block w-full rounded-md" required>
                            </div>

                            <div class="mb-4">
                                <label for="nama_kriteria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kriteria</label>
                                <input type="text" name="nama_kriteria" id="nama_kriteria" value="{{ old('nama_kriteria') }}"
                                    class="mt-1 block w-full rounded-md" required>
                            </div>

                            <div class="mb-4">
                                <label for="bobot" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bobot</label>
                                <input type="text" name="bobot" id="bobot" value="{{ old('bobot') }}"
                                    placeholder="Contoh: 0.25" class="mt-1 block w-full rounded-md" required>
                            </div>

                            <div class="mb-4">
                                <label for="tipe" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe Kriteria</label>
                                <select name="tipe" id="tipe" class="mt-1 block w-full rounded-md" required>
                                    <option value="" disabled {{ old('tipe') ? '' : 'selected' }}>-- Pilih Tipe --</option>
                                    <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                    <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>Cost</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('kriteria.index') }}" class="text-gray-600 mr-4">Batal</a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan Kriteria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk konversi koma ke titik -->
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const input = document.querySelector('input[name="bobot"]');
            if (input) {
                input.value = input.value.replace(',', '.');
            }
        });
    </script>
</x-app-layout>