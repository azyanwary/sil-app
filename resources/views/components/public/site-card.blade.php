@props(['site'])

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
    <div class="aspect-w-16 aspect-h-9 bg-gray-200 relative">
        @if($site->photos()->where('is_featured', true)->first())
            <img src="{{ Storage::url($site->photos()->where('is_featured', true)->first()->photo_path) }}" alt="{{ $site->name }}" class="object-cover w-full h-48">
        @elseif($site->photos()->first())
            <img src="{{ Storage::url($site->photos()->first()->photo_path) }}" alt="{{ $site->name }}" class="object-cover w-full h-48">
        @else
            <div class="w-full h-48 flex items-center justify-center bg-gray-100 text-gray-400">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
        
        <div class="absolute top-2 right-2 flex flex-col gap-1 items-end">
            <x-public.status-badge :status="$site->status" />
            @if($site->is_facility_available)
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 shadow-sm">
                    {{ __('Fasilitas Tersedia') }}
                </span>
            @endif
        </div>
    </div>
    <div class="p-4 flex-grow flex flex-col">
        <div class="flex items-start justify-between">
            <h3 class="text-lg font-bold text-gray-900 font-outfit line-clamp-1">
                <a href="{{ route('sites.show', $site->slug ?? $site->id) }}" class="hover:text-amber-600">
                    {{ $site->name }}
                </a>
            </h3>
        </div>
        <div class="mt-1 flex items-center text-xs text-gray-500 mb-3">
            @if($site->category)
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    {{ $site->category->name }}
                </span>
            @endif
        </div>
        <p class="mt-1 text-sm text-gray-600 line-clamp-2 flex-grow">
            {{ Str::limit(strip_tags($site->description), 100) }}
        </p>
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="truncate">{{ $site->address }}</span>
        </div>
    </div>
</div>
