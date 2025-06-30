<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Kotak Sambutan Awal -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Anda telah masuk ke dalam Sistem Pendukung Keputusan Penentuan Karyawan Teladan.
                    </p>
                </div>
            </div>

            <!-- Kartu Pintasan (Shortcut Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Kartu 1: Data Kriteria -->
                <a href="{{ route('kriteria.index') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700/50 transition ease-in-out duration-150">
                    <div class="flex items-center">
                        <!-- Ikon -->
                        <div class="flex-shrink-0 bg-blue-500/10 text-blue-500 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">Data Kriteria</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Kelola kriteria penilaian.</p>
                        </div>
                    </div>
                </a>

                <!-- Kartu 2: Data Karyawan -->
                <a href="{{ route('alternatif.index') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700/50 transition ease-in-out duration-150">
                    <div class="flex items-center">
                        <!-- Ikon -->
                        <div class="flex-shrink-0 bg-green-500/10 text-green-500 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">Data Karyawan</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Kelola data Karyawan & nilai.</p>
                        </div>
                    </div>
                </a>

                <!-- Kartu 3: Hasil Perhitungan -->
                <a href="{{ route('perhitungan.index') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700/50 transition ease-in-out duration-150">
                    <div class="flex items-center">
                        <!-- Ikon -->
                        <div class="flex-shrink-0 bg-yellow-500/10 text-yellow-500 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">Perhitungan SAW</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Lihat hasil ranking Karyawan.</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>