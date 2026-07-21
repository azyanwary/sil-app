@props(['category', 'count' => 0])

<a href="{{ route('sites.index', ['category' => $category->slug ?? $category->id]) }}" class="group relative bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md hover:border-amber-300 transition-all duration-300 flex flex-col items-center text-center h-full">
    <div class="h-12 w-12 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 mb-4 group-hover:bg-amber-100 group-hover:scale-110 transition-transform duration-300">
        <!-- SVG Icon based on category, fallback to default -->
        @if($category->icon)
            @if(str_starts_with($category->icon, 'http'))
                <img src="{{ $category->icon }}" class="h-6 w-6 object-contain" alt="{{ $category->name }}">
            @else
                <img src="{{ Storage::url($category->icon) }}" class="h-6 w-6 object-contain" alt="{{ $category->name }}">
            @endif
        @else
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        @endif
    </div>
    <h3 class="text-lg font-bold text-gray-900 font-outfit mb-1">{{ $category->name }}</h3>
    @if($category->description)
        <p class="text-sm text-gray-500 line-clamp-2 mb-3">{{ $category->description }}</p>
    @endif
    <div class="mt-auto pt-4 flex items-center text-amber-600 text-sm font-medium">
        <span>{{ $count }} {{ __('Sites') }}</span>
        <svg class="ml-1 h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </div>
</a>
