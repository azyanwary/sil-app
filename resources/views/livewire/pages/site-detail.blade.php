<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-public.breadcrumb :links="['Katalog Situs' => route('sites.index'), $site->name => null]" />

        <div class="mt-8 bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
            <!-- Header Image -->
            <div class="h-64 sm:h-96 relative w-full bg-gray-200">
                @php
                    $featuredPhoto = $site->photos()->where('is_featured', true)->first() ?? $site->photos()->first();
                @endphp
                
                @if($featuredPhoto)
                    @if(str_starts_with($featuredPhoto->file_path, 'http'))
                        <img src="{{ $featuredPhoto->file_path }}" alt="{{ $site->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ Storage::url($featuredPhoto->file_path) }}" alt="{{ $site->name }}" class="w-full h-full object-cover">
                    @endif
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                        <svg class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 p-6 sm:p-10 w-full">
                    <div class="flex flex-wrap gap-2 mb-3">
                        <x-public.status-badge :status="$site->status" />
                        @if($site->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white backdrop-blur-sm border border-white/30">
                                {{ $site->category->name }}
                            </span>
                        @endif
                        @if($site->is_facility_available)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500 text-white">
                                {{ __('Facility Available') }}
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-outfit drop-shadow-md">{{ $site->name }}</h1>
                    <div class="mt-2 flex items-center text-sm text-gray-200 drop-shadow">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $site->address }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-gray-200">
                
                <!-- Main Content (2/3) -->
                <div class="p-6 sm:p-10 lg:col-span-2">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 font-outfit">{{ __('Description') }}</h2>
                    <div class="prose prose-amber max-w-none text-gray-600">
                        {!! $site->description !!}
                    </div>
                    
                    @if($site->photos->count() > 1)
                        <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 font-outfit">{{ __('Photo Gallery') }}</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4" x-data="{ openModal: false, selectedImage: '' }">
                            @foreach($site->photos as $photo)
                                @php
                                    $photoUrl = str_starts_with($photo->file_path, 'http') ? $photo->file_path : Storage::url($photo->file_path);
                                @endphp
                                <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 cursor-pointer hover:opacity-75 transition-opacity" 
                                     @click="selectedImage = '{{ $photoUrl }}'; openModal = true">
                                    <img src="{{ $photoUrl }}" alt="Foto {{ $site->name }}" class="object-cover w-full h-full">
                                </div>
                            @endforeach
                            
                            <!-- Image Modal -->
                            <div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90 p-4" style="display: none;">
                                <button @click="openModal = false" class="absolute top-4 right-4 text-white hover:text-gray-300">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <img :src="selectedImage" class="max-w-full max-h-full object-contain" @click.away="openModal = false">
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar (1/3) -->
                <div class="p-6 sm:p-10 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 font-outfit">{{ __('Practical Information') }}</h3>
                    
                    <dl class="space-y-6">
                        @if($site->registration_number)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Registration Number') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $site->registration_number }}</dd>
                        </div>
                        @endif
                        
                        @if($site->designation_year)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Designation Year') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $site->designation_year }}</dd>
                        </div>
                        @endif

                        @if($site->operating_hours)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Operating Hours') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if(is_array($site->operating_hours))
                                    <ul class="space-y-1">
                                        @foreach($site->operating_hours as $day => $hours)
                                            <li><span class="font-medium">{{ $day }}:</span> {{ $hours }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $site->operating_hours }}
                                @endif
                            </dd>
                        </div>
                        @endif

                        @if($site->ticket_price)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Ticket Price') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $site->ticket_price }}</dd>
                        </div>
                        @endif
                    </dl>

                    @if($site->is_facility_available)
                        <div class="mt-10 bg-amber-50 rounded-lg p-5 border border-amber-100">
                            <h4 class="text-amber-800 font-medium mb-2 flex items-center">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Fasilitas Tersedia
                            </h4>
                            <p class="text-sm text-amber-700 mb-4">
                                Situs ini menyediakan fasilitas yang dapat diajukan untuk digunakan oleh publik.
                            </p>
                            <a href="/applicant/login" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                {{ __('Apply for Facility Usage') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
