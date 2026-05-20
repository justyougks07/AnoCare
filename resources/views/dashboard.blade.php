<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="fade-in">
                <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-slate-800 via-blue-700 to-slate-800 bg-clip-text text-transparent">
                    Dashboard
                </h2>
                <p class="text-base text-slate-600 mt-2">
                    Selamat datang di sistem manajemen klinik AnoCare.
                </p>
            </div>
            <div class="text-right">
                <p class="text-sm text-slate-500">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ auth()->user()->role }}</p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen pb-12">
        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="group bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-soft-lg text-white hover:shadow-glow-blue transition-all duration-300 hover:-translate-y-1 cursor-default">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center text-xl">
                        👥
                    </div>
                    <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Total</span>
                </div>
                <p class="text-blue-100 text-sm font-medium">
                    Total Pasien
                </p>
                <h3 class="text-4xl font-bold mt-2">
                    128
                </h3>
                <p class="text-blue-200 text-xs mt-3">+12% dari bulan lalu</p>
            </div>

            <div class="group bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 shadow-soft-lg text-white hover:shadow-glow-emerald transition-all duration-300 hover:-translate-y-1 cursor-default">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center text-xl">
                        🩺
                    </div>
                    <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Aktif</span>
                </div>
                <p class="text-emerald-100 text-sm font-medium">
                    Dokter Aktif
                </p>
                <h3 class="text-4xl font-bold mt-2">
                    12
                </h3>
                <p class="text-emerald-200 text-xs mt-3">Tersedia hari ini</p>
            </div>

            <div class="group bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-6 shadow-soft-lg text-white hover:shadow-glow-blue transition-all duration-300 hover:-translate-y-1 cursor-default">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center text-xl">
                        📅
                    </div>
                    <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Hari Ini</span>
                </div>
                <p class="text-amber-100 text-sm font-medium">
                    Jadwal Terjadwal
                </p>
                <h3 class="text-4xl font-bold mt-2">
                    24
                </h3>
                <p class="text-amber-200 text-xs mt-3">Dalam antrian</p>
            </div>

            <div class="group bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 shadow-soft-lg text-white hover:shadow-glow-purple transition-all duration-300 hover:-translate-y-1 cursor-default">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center text-xl">
                        💊
                    </div>
                    <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Stok</span>
                </div>
                <p class="text-purple-100 text-sm font-medium">
                    Obat Tersedia
                </p>
                <h3 class="text-4xl font-bold mt-2">
                    342
                </h3>
                <p class="text-purple-200 text-xs mt-3">Jenis obat aktif</p>
            </div>

        </div>

        {{-- Main Section --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Activity --}}
            <div class="xl:col-span-2 bg-white rounded-2xl shadow-soft-lg border border-slate-100 p-6 slide-up">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">
                            📊 Aktivitas Terbaru
                        </h3>
                        <p class="text-sm text-slate-500 mt-1">
                            Aktivitas sistem terbaru hari ini.
                        </p>
                    </div>
                </div>

                <div class="space-y-3">

                    <div class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-blue-50 to-blue-100/50 border border-blue-100 hover:border-blue-200 hover:shadow-soft transition-all duration-300">
                        <div class="flex-1">
                            <h4 class="font-medium text-slate-800 flex items-center gap-2">
                                <span class="text-blue-600">●</span> Pasien baru ditambahkan
                            </h4>
                            <p class="text-xs text-slate-500 mt-1">
                                5 menit yang lalu
                            </p>
                        </div>

                        <span class="inline-block bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                            Baru
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-emerald-50 to-emerald-100/50 border border-emerald-100 hover:border-emerald-200 hover:shadow-soft transition-all duration-300">
                        <div class="flex-1">
                            <h4 class="font-medium text-slate-800 flex items-center gap-2">
                                <span class="text-emerald-600">●</span> Pemeriksaan selesai
                            </h4>
                            <p class="text-xs text-slate-500 mt-1">
                                15 menit yang lalu
                            </p>
                        </div>

                        <span class="inline-block bg-emerald-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                            Selesai
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-amber-50 to-amber-100/50 border border-amber-100 hover:border-amber-200 hover:shadow-soft transition-all duration-300">
                        <div class="flex-1">
                            <h4 class="font-medium text-slate-800 flex items-center gap-2">
                                <span class="text-amber-600">●</span> Stok obat diperbarui
                            </h4>
                            <p class="text-xs text-slate-500 mt-1">
                                30 menit yang lalu
                            </p>
                        </div>

                        <span class="inline-block bg-amber-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                            Update
                        </span>
                    </div>

                </div>

                <button class="w-full mt-4 py-3 text-blue-600 font-medium hover:bg-blue-50 rounded-lg transition-colors">
                    Lihat semua aktivitas →
                </button>

            </div>

            {{-- Side Card --}}
            <div class="bg-white rounded-2xl shadow-soft-lg border border-slate-100 p-6 slide-up">

                <h3 class="text-xl font-bold text-slate-800 mb-6">
                    📈 Ringkasan Klinik
                </h3>

                <div class="space-y-6">

                    <div class="group">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-medium text-slate-700">
                                Kapasitas Pasien
                            </span>
                            <span class="text-sm font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg">
                                78%
                            </span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2.5 rounded-full w-[78%] group-hover:shadow-glow-blue transition-all duration-300" 
                                 style="box-shadow: 0 0 10px rgba(59, 130, 246, 0.3)"></div>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">Ruang tersedia: 22%</p>
                    </div>

                    <div class="group">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-medium text-slate-700">
                                Stok Obat
                            </span>
                            <span class="text-sm font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg">
                                92%
                            </span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-2.5 rounded-full w-[92%] group-hover:shadow-glow-emerald transition-all duration-300"
                                 style="box-shadow: 0 0 10px rgba(16, 185, 129, 0.3)"></div>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">Perlu restock: 8 jenis</p>
                    </div>

                    <div class="group">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-medium text-slate-700">
                                Jadwal Dokter
                            </span>
                            <span class="text-sm font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg">
                                64%
                            </span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-500 to-amber-600 h-2.5 rounded-full w-[64%] group-hover:shadow-glow-blue transition-all duration-300"
                                 style="box-shadow: 0 0 10px rgba(217, 119, 6, 0.3)"></div>
                        </div>
                        <p class="text-xs text-slate-500 mt-2">Slot tersedia: 36%</p>
                    </div>

                </div>

                <button class="w-full mt-6 py-3 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 font-medium rounded-lg hover:from-blue-100 hover:to-blue-200 transition-all duration-300">
                    Lihat detail →
                </button>

            </div>

        </div>

    </div>
</x-app-layout>