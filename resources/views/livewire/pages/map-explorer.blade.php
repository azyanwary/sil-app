@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    <style>
        #map { height: calc(100vh - 4rem); min-height: 500px; z-index: 10; }
        .leaflet-popup-content-wrapper { border-radius: 0.5rem; overflow: hidden; padding: 0; }
        .leaflet-popup-content { margin: 0; width: 250px !important; }
        .custom-popup .popup-image { height: 120px; width: 100%; object-fit: cover; }
        .custom-popup .popup-body { padding: 12px; }
        .custom-popup .popup-title { font-weight: 700; font-size: 14px; margin-bottom: 4px; color: #1f2937; }
        .custom-popup .popup-category { font-size: 11px; color: #6b7280; margin-bottom: 8px; text-transform: uppercase; }
        .custom-popup .popup-link { display: inline-block; background-color: #d97706; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; text-decoration: none; margin-top: 8px; }
        .custom-popup .popup-link:hover { background-color: #b45309; }
    </style>
@endpush

<div class="relative w-full h-full flex flex-col md:flex-row">
    
    <!-- Sidebar Panel -->
    <div class="w-full md:w-80 bg-white shadow-lg z-20 flex flex-col h-auto md:h-[calc(100vh-4rem)] overflow-y-auto">
        <div class="p-6">
            <h1 class="text-2xl font-extrabold text-gray-900 font-outfit mb-2">{{ __('Interactive Map') }}</h1>
            <p class="text-sm text-gray-500 mb-6">Jelajahi lokasi situs cagar budaya di peta interaktif kami.</p>
            
            <div class="space-y-5">
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Filter Kategori</label>
                    <select wire:model.live="category" id="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm rounded-md shadow-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="pt-4 border-t border-gray-100">
                    <h3 class="text-sm font-medium text-gray-900 mb-3">Statistik Peta</h3>
                    <div class="bg-amber-50 rounded-lg p-4 flex items-center justify-between border border-amber-100">
                        <span class="text-sm text-amber-800 font-medium">Total Ditampilkan</span>
                        <span class="text-lg font-bold text-amber-600" id="visible-count">0</span>
                    </div>
                </div>
                
                <div class="pt-4">
                    <a href="{{ route('sites.index') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        Ke Katalog Situs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div class="flex-grow relative">
        <div wire:ignore id="map" class="w-full"></div>
    </div>
</div>

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            const defaultLat = -7.7956; // Yogyakarta
            const defaultLng = 110.3695;
            
            // Initialize map
            const map = L.map('map').setView([defaultLat, defaultLng], 9);
            
            // Add tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            
            // Create marker cluster group
            let markers = L.markerClusterGroup({
                chunkedLoading: true,
                maxClusterRadius: 50
            });
            
            function renderMarkers(sites) {
                markers.clearLayers();
                let count = 0;
                
                sites.forEach(site => {
                    if (site.latitude && site.longitude) {
                        count++;
                        
                        const photoHtml = site.photo 
                            ? `<img src="${site.photo}" class="popup-image" alt="${site.name}">` 
                            : `<div class="popup-image" style="background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #9ca3af;"><svg style="width:32px;height:32px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>`;
                        
                        const popupContent = `
                            <div class="custom-popup">
                                ${photoHtml}
                                <div class="popup-body">
                                    <div class="popup-category">${site.category}</div>
                                    <div class="popup-title">${site.name}</div>
                                    <a href="${site.url}" class="popup-link">Lihat Detail</a>
                                </div>
                            </div>
                        `;
                        
                        const marker = L.marker([site.latitude, site.longitude]);
                        marker.bindPopup(popupContent);
                        markers.addLayer(marker);
                    }
                });
                
                map.addLayer(markers);
                document.getElementById('visible-count').textContent = count;
                
                // Fit bounds if we have markers
                if (count > 0) {
                    map.fitBounds(markers.getBounds(), { padding: [50, 50], maxZoom: 14 });
                }
            }
            
            // Initial render
            let initialSites = @json(json_decode($sitesJson, true));
            renderMarkers(initialSites);
            
            // Listen for Livewire updates
            Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
                succeed(({ snapshot, effect }) => {
                    // Because $sitesJson is just string passed to view, we can't easily listen to it,
                    // but we can dispatch an event from Livewire or just let Livewire morph.
                    // Wait, morphing doesn't work for script variables!
                    // I will dispatch an event from Livewire component to update markers.
                })
            })
            
            Livewire.on('map-updated', (data) => {
                let updatedSites = JSON.parse(data[0].sitesJson);
                renderMarkers(updatedSites);
            });
        });
    </script>
@endpush
