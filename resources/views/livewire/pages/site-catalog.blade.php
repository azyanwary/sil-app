<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-public.breadcrumb :links="['Katalog Situs' => null]" />

        <div class="mt-8">
            <h1 class="text-3xl font-extrabold text-gray-900 font-outfit">{{ __('Katalog Situs Cagar Budaya') }}</h1>
            <p class="mt-2 text-lg text-gray-500">Jelajahi berbagai peninggalan bersejarah di wilayah kerja kami.</p>
        </div>

        <div class="mt-8 flex flex-col md:flex-row gap-8">
            
            <!-- Filters Sidebar -->
            <div class="w-full md:w-64 flex-shrink-0">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 font-outfit">Filter</h3>
                    
                    <div class="space-y-6">
                        <!-- Search -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Pencarian</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input wire:model.live.debounce.300ms="search" type="text" name="search" id="search" class="focus:ring-amber-500 focus:border-amber-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md" placeholder="Nama situs, alamat...">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select wire:model.live="category" id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm rounded-md">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug ?? $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select wire:model.live="status" id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm rounded-md">
                                <option value="">Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="dalam_renovasi">Dalam Renovasi</option>
                                <option value="tutup_sementara">Tutup Sementara</option>
                            </select>
                        </div>

                        <!-- Sort -->
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700">Urutkan</label>
                            <select wire:model.live="sort" id="sort" name="sort" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm rounded-md">
                                <option value="latest">Terbaru</option>
                                <option value="name_asc">Nama (A-Z)</option>
                                <option value="name_desc">Nama (Z-A)</option>
                            </select>
                        </div>

                        <button wire:click="resetFilters" type="button" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-grow">
                
                <!-- Loading indicator -->
                <div wire:loading class="w-full">
                    <div class="flex justify-center items-center py-12">
                        <svg class="animate-spin -ml-1 mr-3 h-8 w-8 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-gray-500">Memuat data...</span>
                    </div>
                </div>

                <div wire:loading.remove>
                    @if($sites->count() > 0)
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                            @foreach($sites as $site)
                                <x-public.site-card :site="$site" />
                            @endforeach
                        </div>
                        
                        <div class="mt-8">
                            {{ $sites->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-lg p-12 text-center border border-gray-200">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada situs yang ditemukan</h3>
                            <p class="mt-1 text-sm text-gray-500">Coba sesuaikan filter pencarian Anda.</p>
                            <div class="mt-6">
                                <button wire:click="resetFilters" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                    Hapus Filter
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
