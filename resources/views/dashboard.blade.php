<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Dashboard
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Selamat datang di sistem manajemen klinik AnoCare.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">
                                Total Pasien
                            </p>
                            <h3 class="text-3xl font-bold text-slate-800 mt-2">
                                128
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
                            👨‍⚕️
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">
                                Dokter Aktif
                            </p>
                            <h3 class="text-3xl font-bold text-slate-800 mt-2">
                                12
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl">
                            🩺
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">
                                Jadwal Hari Ini
                            </p>
                            <h3 class="text-3xl font-bold text-slate-800 mt-2">
                                24
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center text-2xl">
                            📅
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">
                                Obat Tersedia
                            </p>
                            <h3 class="text-3xl font-bold text-slate-800 mt-2">
                                342
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center text-2xl">
                            💊
                        </div>
                    </div>
                </div>

            </div>

            {{-- Main Section --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                {{-- Activity --}}
                <div class="xl:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800">
                                Aktivitas Terbaru
                            </h3>
                            <p class="text-sm text-slate-500">
                                Aktivitas sistem terbaru hari ini.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">

                        <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50">
                            <div>
                                <h4 class="font-medium text-slate-800">
                                    Pasien baru ditambahkan
                                </h4>
                                <p class="text-sm text-slate-500">
                                    5 menit yang lalu
                                </p>
                            </div>

                            <span class="text-blue-600 font-medium">
                                Baru
                            </span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50">
                            <div>
                                <h4 class="font-medium text-slate-800">
                                    Pemeriksaan selesai
                                </h4>
                                <p class="text-sm text-slate-500">
                                    15 menit yang lalu
                                </p>
                            </div>

                            <span class="text-emerald-600 font-medium">
                                Selesai
                            </span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50">
                            <div>
                                <h4 class="font-medium text-slate-800">
                                    Stok obat diperbarui
                                </h4>
                                <p class="text-sm text-slate-500">
                                    30 menit yang lalu
                                </p>
                            </div>

                            <span class="text-amber-600 font-medium">
                                Update
                            </span>
                        </div>

                    </div>

                </div>

                {{-- Side Card --}}
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

                    <h3 class="text-lg font-semibold text-slate-800 mb-5">
                        Ringkasan Klinik
                    </h3>

                    <div class="space-y-5">

                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm text-slate-600">
                                    Kapasitas Pasien
                                </span>
                                <span class="text-sm font-semibold text-slate-800">
                                    78%
                                </span>
                            </div>

                            <div class="w-full bg-slate-100 rounded-full h-3">
                                <div class="bg-blue-600 h-3 rounded-full w-[78%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm text-slate-600">
                                    Stok Obat
                                </span>
                                <span class="text-sm font-semibold text-slate-800">
                                    92%
                                </span>
                            </div>

                            <div class="w-full bg-slate-100 rounded-full h-3">
                                <div class="bg-emerald-500 h-3 rounded-full w-[92%]"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm text-slate-600">
                                    Jadwal Dokter
                                </span>
                                <span class="text-sm font-semibold text-slate-800">
                                    64%
                                </span>
                            </div>

                            <div class="w-full bg-slate-100 rounded-full h-3">
                                <div class="bg-amber-500 h-3 rounded-full w-[64%]"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>