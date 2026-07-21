@props(['title', 'subtitle', 'image' => null, 'ctaText' => null, 'ctaLink' => null])

<div class="relative bg-gray-900 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        @if($image)
            <img class="w-full h-full object-cover" src="{{ $image }}" alt="{{ $title }}">
        @else
            <!-- Default placeholder or pattern -->
            <div class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900"></div>
        @endif
        <div class="absolute inset-0 bg-gray-900 opacity-60 mix-blend-multiply" aria-hidden="true"></div>
    </div>
    
    <!-- Content -->
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl font-outfit">
            {{ $title }}
        </h1>
        @if($subtitle)
            <p class="mt-6 text-xl text-gray-100 max-w-3xl">
                {{ $subtitle }}
            </p>
        @endif
        @if($ctaText && $ctaLink)
            <div class="mt-10 flex">
                <a href="{{ $ctaLink }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-amber-900 bg-amber-400 hover:bg-amber-500 shadow-sm transition duration-150 ease-in-out">
                    {{ $ctaText }}
                </a>
            </div>
        @endif
    </div>
</div>
