<div>
    <x-public.hero 
        title="Balai Pelestarian Kebudayaan"
        subtitle="Sistem Informasi Layanan Pelestarian Kebudayaan Wilayah X Daerah Istimewa Yogyakarta dan Jawa Tengah."
        ctaText="{{ __('Jelajahi Peta') }}"
        ctaLink="{{ route('map') }}"
    />

    <!-- Statistics Section -->
    <div class="bg-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                <x-public.stat-counter count="{{ $totalSites }}" label="{{ __('Total Situs') }}" />
                <x-public.stat-counter count="{{ $totalCategories }}" label="{{ __('Kategori') }}" />
                <x-public.stat-counter count="{{ $totalApprovedRequests }}" label="{{ __('Fasilitas Digunakan') }}" />
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-gray-50 py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl font-outfit">
                    {{ __('Kategori Situs') }}
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Jelajahi berbagai peninggalan bersejarah berdasarkan kategorinya.
                </p>
            </div>
            
            <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($categories as $category)
                    <x-public.category-card :category="$category" :count="$category->heritage_sites_count" />
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Sites Section -->
    <div class="bg-white py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl font-outfit">
                    {{ __('Situs Unggulan') }}
                </h2>
                <a href="{{ route('sites.index') }}" class="text-amber-600 hover:text-amber-500 font-medium hidden sm:block">
                    Lihat Semua &rarr;
                </a>
            </div>
            
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($featuredSites as $site)
                    <x-public.site-card :site="$site" />
                @endforeach
            </div>
            
            <div class="mt-10 sm:hidden text-center">
                <a href="{{ route('sites.index') }}" class="text-amber-600 hover:text-amber-500 font-medium">
                    Lihat Semua &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-amber-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl font-outfit">
                <span class="block">Ingin menggunakan fasilitas situs?</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-amber-100">
                Kami menyediakan fasilitas di beberapa situs cagar budaya untuk mendukung kegiatan masyarakat dan instansi.
            </p>
            <a href="/applicant/login" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-amber-800 bg-white hover:bg-amber-50 sm:w-auto">
                {{ __('Ajukan Penggunaan Fasilitas') }}
            </a>
        </div>
    </div>
</div>
