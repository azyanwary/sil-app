@props(['count', 'label', 'icon' => null])

<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 flex flex-col items-center text-center transform transition duration-500 hover:scale-105">
    @if($icon)
        <div class="text-amber-500 mb-4 h-12 w-12 bg-amber-50 rounded-full flex items-center justify-center">
            {!! $icon !!}
        </div>
    @endif
    
    <div class="text-4xl font-extrabold text-gray-900 font-outfit" x-data="{ count: 0, target: {{ $count }} }" x-intersect.once="
        let start = null;
        const duration = 2000;
        const step = (timestamp) => {
            if (!start) start = timestamp;
            const progress = Math.min((timestamp - start) / duration, 1);
            count = Math.floor(progress * target);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    ">
        <span x-text="count">0</span>
    </div>
    
    <div class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wide">
        {{ $label }}
    </div>
</div>
